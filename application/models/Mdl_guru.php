<?php
class Mdl_guru extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	} 

	function daftar_guru($where,$table)
	{
		return $this->db->get_where($table, $where);
	}

	function save()
	{
		$data = array(
			'nuptk'			=>$this->input->post('nuptk', TRUE),
			'nama_guru' 	=>$this->input->post('nama_guru', TRUE),
			'jenis_kelamin' =>$this->input->post('j_kelamin', TRUE),
			'username'      =>$this->input->post('username', TRUE),
			'password'      =>password_hash($this->input->post('password'),PASSWORD_DEFAULT)
		);
		$this->db->insert('tbl_guru', $data);
	}

	/* Fungsi untuk melakukan proses upload file */
	public function upload_file($filename){
		$this->load->library('upload'); /* Load librari upload */
		
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'xlsx';
		$config['max_size']	= '2048';
		$config['overwrite'] = true;
		$config['file_name'] = $filename;
	
		$this->upload->initialize($config); /* Load konfigurasi uploadnya */
		if($this->upload->do_upload('file')){ /* Lakukan upload dan Cek jika proses upload berhasil */

		/* Jika berhasil */
		$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
		return $return;
		}else{

		/* Jika gagal */
		$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
		return $return;
		}
  	}
  
  	/* Buat sebuah fungsi untuk melakukan insert lebih dari 1 data */
  	public function insert_multiple($data){
		$this->db->insert_batch('tbl_guru', $data);
  	}

	function update($data)
	{
		$this->db->set($data);
		$this->db->where('id_guru', $data['id_guru']);
		$this->db->update('tbl_guru', $data);
	}
	public function _verify_credentials($username, $password){
		$condition = [
					'username' => $username
				];
	
		$result = $this->db->get_where('tbl_guru', $condition);
		if($result->num_rows() == 1){
			$user = $result->row_array();
			if (password_verify($password, $user['password'])) {
				unset($user['password']);
				return $user;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	public function getById($id)
	{
		return $this->db->get_where('tbl_guru',["id_guru" => $id])->result();
	}
}