<?php 
/**
 * PHP for Codeigniter
 *
 * @package       CodeIgniter
 * @pengembang		Kassandra Production (https://kassandra.my.id)
 * @Author			@erikwahyudy
 * @version			3.0
 */

class login_m extends CI_model
{
	
 public function superadmin($nama='', $nidn='', $email='', $password='', $id_level='1')
 {
  return $this->db->query("SELECT * from tb_pengguna where (nama='$nama' OR nidn='$nidn' OR email='$email') AND password='$password' AND id_level='$id_level' limit 1");
 }

 public function admin($nama='', $nidn='', $email='', $password='', $id_level='2')
 {
  return $this->db->query("SELECT * from tb_pengguna where (nama='$nama' OR nidn='$nidn' OR email='$email') AND password='$password' AND id_level='$id_level' limit 1");
 }

 public function dosen($nama='', $nidn='', $email='', $password='', $id_level='3')
 {
  return $this->db->query("SELECT * from tb_pengguna where (nama='$nama' OR nidn='$nidn' OR email='$email') AND password='$password' AND id_level='$id_level' limit 1");
 }

 public function IsEmailValid($email)
    {
    return $this->db->query("SELECT * from tb_pengguna where email='$email' or nidn='$email' limit 1");
    }


}