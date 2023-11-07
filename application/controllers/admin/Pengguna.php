<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Pengguna extends CI_controller
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
   $this->load->model('m_pengguna');
	}

    //Admin
    public function admin($value='')
    {
     $view = array('judul'     =>'Data Admin',
                    'aksi'      =>'admin',
                    'level'     =>$this->db->get('tb_level')->result_array(),
                    'data'      =>$this->m_pengguna->viewAdmin()->result_array(),
                  );

      $this->load->view('admin/pengguna/admin',$view);
    }

    //Dosen
    public function dosen($value='')
    {
     $view = array('judul'     =>'Data Dosen',
                    'aksi'      =>'dosen',
                    'level'     =>$this->db->get('tb_level')->result_array(),
                    'data'      =>$this->m_pengguna->viewDosen()->result_array(),
                  );

      $this->load->view('admin/pengguna/dosen',$view);
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
    
     //mengambil id dokter urut terakhir
     private function id_pengguna_urut($value='')
     {
     $this->m_pengguna->id_urut();
     $query   = $this->db->get();
     $data    = $query->row_array();
     $id      = $data['id_pengguna'];
     $karakter= $this->acak_id(6);
     $urut    = substr($id, 1, 3);
     $tambah  = (int) $urut + 1;
     
     if (strlen($tambah) == 1){
     $newID = "A"."00".$tambah.$karakter;
         }else if (strlen($tambah) == 2){
         $newID = "A"."0".$tambah.$karakter;
             }else (strlen($tambah) == 3){
             $newID = "A".$tambah.$karakter
             };
         return $newID;
     }

  //API add dokter
  public function api_add($value='')
  {
    $rules = array(
      array(
        'field' => 'nama',
        'label' => 'Nama',
        'rules' => 'required',
        'errors' => array(
            'required' => 'Nama tidak boleh kosong',
        ),
      ),
      array(
        'field' => 'nidn',
        'label' => 'NIDN',
        'rules' => 'required|is_unique[tb_pengguna.nidn]',
        'errors' => array(
            'required' => 'NIDN tidak boleh kosong',
            'is_unique' => 'NIDN sudah terdaftar',
        ),
      ),
      array(
        'field' => 'keterangan',
        'label' => 'Keterangan',
        'rules' => 'required',
        'errors' => array(
            'required' => 'Keterangan tidak boleh kosong',
        ),
      ),
      array(
        'field' => 'email',
        'label' => 'Email',
        'rules' => 'required|valid_email|is_unique[tb_pengguna.email]',
        'errors' => array(
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Email tidak valid',
            'is_unique' => 'Email sudah terdaftar',
        ),
      ),

    );
    $this->form_validation->set_rules($rules);
    if ($this->form_validation->run() == FALSE) {
      $response = [
        'status' => false,
        'message' => validation_errors()
      ];
    } else {
      $SQLinsert = [
        'id_pengguna'       =>$this->id_pengguna_urut(),
        'nama'              =>$this->input->post('nama'),
        'nidn'              =>$this->input->post('nidn'),
        'keterangan'        =>$this->input->post('keterangan'),
        'email'             =>$this->input->post('email'),
        'password'          =>md5($this->input->post('password')),
        'id_level'          =>$this->input->post('id_level')
      ];
      if ($this->m_pengguna->add($SQLinsert)) {
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

      //API edit dokter
      public function api_edit($id='', $SQLupdate='')
      {
        $rules = array(
          array(
        'field' => 'nama',
        'label' => 'Nama',
        'rules' => 'required',
        'errors' => array(
            'required' => 'Nama tidak boleh kosong',
        ),
      ),
      array(
        'field' => 'nidn',
        'label' => 'NIDN',
        'rules' => 'required',
        'errors' => array(
            'required' => 'NIDN tidak boleh kosong',
        ),
      ),
      array(
        'field' => 'keterangan',
        'label' => 'Keterangan',
        'rules' => 'required',
        'errors' => array(
            'required' => 'Keterangan tidak boleh kosong',
        ),
      ),
      array(
        'field' => 'email',
        'label' => 'Email',
        'rules' => 'required|valid_email',
        'errors' => array(
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Email tidak valid',
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
            'nama'            => $this->input->post('nama'),
            'nidn'            => $this->input->post('nidn'),
            'keterangan'      => $this->input->post('keterangan'),
            'email'           => $this->input->post('email'),
            'id_level'        => $this->input->post('id_level')
          ];
          if ($this->m_pengguna->update($id, $SQLupdate)) {
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

      //API edit password
      public function api_password($id='', $SQLupdate='')
      {
        $rules = array(
          array(
            'field' => 'password',
            'label' => 'password',
            'rules' => 'required'
          )
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE) {
          $response = [
            'status' => false,
            'message' => 'Tidak ada data'
          ];
        } else {
          $SQLupdate = [
            'password'        => md5($this->input->post('password'))
          ];
          if ($this->m_pengguna->update($id, $SQLupdate)) {
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
          if ($this->m_pengguna->delete($id)) {
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