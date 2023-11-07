<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Judul_skripsi extends CI_controller
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
	 if($this->session->userdata('admin') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->model('m_judul_skripsi');
	}

    //Lihat Data
    public function lihat($value='')
    {
     $view = array('judul'      =>'Data Judul Skripsi',
                    'aksi'      =>'lihat',
                    'data'      =>$this->m_judul_skripsi->view()->result_array(),
                  );

      $this->load->view('admin/judul_skripsi/lihat',$view);
    }

    private function acak_id($panjang)
    {
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $string = '';
        for ($i = 0; $i < $panjang; $i++) {
            $pos = rand(0, strlen($karakter) - 1);
            $string .= $karakter{$pos};
        }
        return $string;
    }
    
     //mengambil id urut terakhir
     private function id_judul_urut($value='')
     {
     $this->m_judul_skripsi->id_urut();
     $query   = $this->db->get();
     $data    = $query->row_array();
     $id      = $data['id_judul_skripsi'];
     $karakter= $this->acak_id(6);
     $urut    = substr($id, 1, 3);
     $tambah  = (int) $urut + 1;
     
     if (strlen($tambah) == 1){
     $newID = "J"."00".$tambah.$karakter;
         }else if (strlen($tambah) == 2){
         $newID = "J"."0".$tambah.$karakter;
             }else (strlen($tambah) == 3){
             $newID = "J".$tambah.$karakter
             };
         return $newID;
     }

  //API add
  public function api_add($value='')
  {
    $rules = array(
      array(
        'field' => 'nama_judul_skripsi',
        'label' => 'Judul Skripsi',
        'rules' => 'required|is_unique[tb_judul_skripsi.nama_judul_skripsi]',
        'errors' => array(
            'required' => 'Judul Skripsi tidak boleh kosong',
            'is_unique' => 'Judul Skripsi sudah ada',
        ),
      ),
      array(
        'field' => 'nama_mahasiswa',
        'label' => 'Nama Mahasiswa',
        'rules' => 'required',
        'errors' => array(
            'required' => 'Nama Mahasiswa tidak boleh kosong',
          ),
        ),
        array(
          'field' => 'nim',
          'label' => 'NIM',
          'rules' => 'required',
          'errors' => array(
              'required' => 'NIM tidak boleh kosong',
            ),
          ),
    );
    $this->form_validation->set_rules($rules);
    if ($this->form_validation->run() == FALSE) {
      $response = [
        'status' => false,
        'message' => validation_errors(),
      ];
    } else {
      $SQLinsert = [
        'id_judul_skripsi'      =>$this->id_judul_urut(),
        'nama_mahasiswa'        =>$this->input->post('nama_mahasiswa'),
        'nim'                   =>$this->input->post('nim'),
        'nama_judul_skripsi'    =>$this->input->post('nama_judul_skripsi')
      ];
      if ($this->m_judul_skripsi->add($SQLinsert)) {
        $response = [
          'status' => true,
          'message' => 'Berhasil menambahkan data'
        ];
      } else {
        $response = [
          'status' => false,
          'message' => 'Gagal menambahkan data'
        ];
      }
  }
  
  $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));
}

      //API edit
      public function api_edit($id='', $SQLupdate='')
      {
        $rules = array(
          array(
            'field' => 'nama_mahasiswa',
            'label' => 'Nama Mahasiswa',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Nama Mahasiswa tidak boleh kosong',
              ),
            ),
            array(
              'field' => 'nim',
              'label' => 'NIM',
              'rules' => 'required',
              'errors' => array(
                  'required' => 'NIM tidak boleh kosong',
                ),
              ),  
          array(
        'field' => 'nama_judul_skripsi',
        'label' => 'Nama Judul Skripsi',
        'rules' => 'required',
        'errors' => array(
            'required' => 'Nama Judul Skripsi tidak boleh kosong',
          ),
        ),
      );

        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE) {
          $response = [
            'status' => false,
            'message' => 'Tidak ada data'
          ];
        } else {
          $SQLupdate = [
            'nama_mahasiswa'        =>$this->input->post('nama_mahasiswa'),
            'nim'                   =>$this->input->post('nim'),
            'nama_judul_skripsi'    =>$this->input->post('nama_judul_skripsi')
          ];
          if ($this->m_judul_skripsi->update($id, $SQLupdate)) {
            $response = [
              'status' => true,
              'message' => 'Berhasil mengubah data'
            ];
          } else {
            $response = [
              'status' => false,
              'message' => 'Gagal mengubah data'
            ];
          }
        }
        $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($response));
      }

      
      //API hapus
      public function api_hapus($id='')
      {
        if(empty($id)){
          $response = [
            'status' => false,
            'message' => 'Data kosong'
          ];
        }else{
          if ($this->m_judul_skripsi->delete($id)) {
            $response = [
              'status' => true,
              'message' => 'Berhasil menghapus data'
            ];
          } else {
            $response = [
              'status' => false,
              'message' => 'Gagal menghapus data'
            ];
          }
        }
        $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($response));
      }
	
}