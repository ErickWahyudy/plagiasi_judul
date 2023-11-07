 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Imporexcel extends CI_controller
{
	function __construct()
	{
	 parent:: __construct();
     $this->load->helper('url');
      // needed ???
      $this->load->database();
      $this->load->library('session');
      $this->load->library('form_validation');
      
	 // error_reporting(0);
	 if($this->session->userdata('superadmin') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->model('M_judul_skripsi');
	}

    //Lihat Data
    public function input($value='')
    {
     $view = array('judul'      =>'Data Judul Skripsi',
                    'aksi'      =>'input',
                  );

      $this->load->view('superadmin/cek_plagiasi/input',$view);
    }

    public function buatTemplateExcel()
    {
        // Load PhpSpreadsheet library
        $this->load->library('PhpSpreadsheet');
    
        // Buat objek Spreadsheet baru
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    
        // Isi lembar kerja dengan data sesuai kebutuhan Anda
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Header 1');
        $sheet->setCellValue('B1', 'Header 2');
        $sheet->setCellValue('A2', 'Data 1');
        $sheet->setCellValue('B2', 'Data 2');
    
        // Atur nama file Excel
        $filename = 'template_excel.xlsx';
    
        // Set header agar browser mengenali sebagai file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
    
        // Output file Excel ke browser
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
    
    
      public function api_imporExcel()
      {
          // Pastikan Anda telah memuat pustaka PHPSpreadsheet atau pustaka sejenis
          $this->load->library('PhpSpreadsheet');
    
          if ($_FILES['excelFile']['name']) {
              $config['upload_path'] = './uploads/'; // Lokasi penyimpanan file Excel
              $config['allowed_types'] = 'xlsx|xls';
              $this->load->library('upload', $config);
    
              if (!$this->upload->do_upload('excelFile')) {
                  // Gagal mengunggah file Excel
                  $error = $this->upload->display_errors();
                  echo json_encode(['status' => false, 'message' => $error]);
              } else {
                  // File Excel berhasil diunggah
                  $fileData = $this->upload->data();
                  $filePath = $fileData['full_path'];
    
                  // Sekarang, Anda dapat membaca dan memproses file Excel
                  $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
                  $worksheet = $spreadsheet->getActiveSheet();
                  $excelData = $worksheet->toArray();
    
                  // Mulai dari baris kedua (indeks 1) karena baris pertama biasanya header
                  for ($i = 1; $i < count($excelData); $i++) {
                      $nama_judul_skripsi = $excelData[$i][0]; // Sesuaikan dengan kolom di file Excel
    
                      // Validasi data jika diperlukan
                      // Misalnya, Anda dapat memeriksa apakah judul_skripsi sudah ada dalam database
    
                      // Jika data valid, masukkan ke dalam database
                      $SQLinsert = [
                          'id_judul_skripsi' => $this->id_judul_skripsi_urut(),
                          'nama_judul_skripsi' => $nama_judul_skripsi
                      ];
    
                      if ($this->M_judul_skripsi->add($SQLinsert)) {
                          // Data berhasil dimasukkan ke database
                      } else {
                          // Data gagal dimasukkan ke database
                          // Mungkin ada kesalahan atau duplikasi data
                      }
                  }
    
                  echo json_encode(['status' => true, 'message' => 'Data berhasil diimpor']);
              }
          } else {
              // Tidak ada file Excel yang dipilih
              echo json_encode(['status' => false, 'message' => 'Pilih file Excel terlebih dahulu']);
          }
      }




    
	
}