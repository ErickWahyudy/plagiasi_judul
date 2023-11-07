<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Cek_plagiasi extends CI_controller
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
	 if($this->session->userdata('dosen') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->model('M_judul_skripsi');
	}

    //Lihat Data
    public function input($value='')
    {
     $view = array('judul'      =>'Cek Plagiasi Judul Skripsi',
                    'aksi'      =>'input',
                  );

      $this->load->view('dosen/cek_plagiasi/input',$view);
    }

    public function calculate_similarity() {
        $userTitle = $this->input->post('nama_judul_skripsi');
        
        $titles = $this->M_judul_skripsi->view()->result();
    
        // Threshold kemiripan yang diperbolehkan
        $threshold = 1; // Ganti dengan nilai threshold yang Anda inginkan
    
        // Variabel untuk menyimpan data judul skripsi yang sesuai
        $matchingData = array(); // Default kosong
    
        // Hitung kemiripan dengan judul dari database
        $similarTitles = array();
        foreach ($titles as $dbTitle) {
            $jaccardSimilarity = $this->calculateJaccardSimilarity($userTitle, $dbTitle->nama_judul_skripsi);
            if ($jaccardSimilarity >= $threshold) {
                // Simpan data judul skripsi, nama mahasiswa, dan nim ke dalam array
                $matchingData[] = array(
                    'nama_mahasiswa' => $dbTitle->nama_mahasiswa,
                    'nim' => $dbTitle->nim,
                    'judul_skripsi' => $dbTitle->nama_judul_skripsi,
                    'kemiripan' => min($jaccardSimilarity, 100)
                );
            }
        }
    
        $data['matchingData'] = $matchingData; // Menyimpan semua data yang sesuai
        $data['userTitle'] = $userTitle;
        $data['threshold'] = $threshold;
        $data['judul'] = 'Hasil Cek Plagiasi';
        $this->load->view('dosen/cek_plagiasi/hasil', $data);
    }  
  

  private function calculateJaccardSimilarity($str1, $str2) {
    $set1 = explode(' ', strtolower($str1));
    $set2 = explode(' ', strtolower($str2));

    $intersection = count(array_intersect($set1, $set2));
    $union = count(array_unique(array_merge($set1, $set2)));

    if ($union == 0) {
        return 0; // Menghindari pembagian oleh nol
    }

    return ($intersection / $union) * 100; // Menghitung persentase
}

    
	
}