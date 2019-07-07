<?php
class Mdl_siswa extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
	}

	function daftar_siswa($where,$table)
	{ 
		return $this->db->get_where($table, $where);
	}

	function agama_siswa($where,$table)
	{
	    return $this->db->get_where($table, $where); 
	}
	public function getMyKelas($id_guru)
	{
		$query = $this->db->query(" 
			SELECT S.* 
			FROM tbl_siswa S,tbl_kelas K
			WHERE S.id_kelas=K.id_kelas AND K.id_guru=$id_guru
		")->result();
		return $query;
	}
	public function myIdKelas($id_guru)
	{
		$where = array('id_guru' => $id_guru);
		$query = $this->db->get_where('tbl_kelas',$where)->result_array();
		return $query;
	}
	public function getByNis($nis)
	{
		$query = $this->db->get_where('tbl_siswa',array("nis" => $nis))->result();
		return $query;
	}

	function save()
	{
		$data = array(
			'nis'				=>$this->input->post('nis', TRUE),
			'nisn'				=>$this->input->post('nisn',TRUE),
			'nama_siswa' 		=>$this->input->post('nama_siswa', TRUE),
			'temp_lahir' 		=>$this->input->post('temp_lahir', TRUE),
			'tgl_lahir' 		=>$this->input->post('tgl_lahir',TRUE),
			'j_kelamin' 		=>$this->input->post('j_kelamin', TRUE),
			'kd_agama' 			=>$this->input->post('agama', TRUE),
			'status_keluarga' 	=>$this->input->post('status_keluarga', TRUE),
			'anak_ke' 			=>$this->input->post('anak_ke', TRUE),
			'alamat' 			=>$this->input->post('alamat', TRUE),
			'telp' 				=>$this->input->post('telp', TRUE),
			'asal_sekolah' 		=>$this->input->post('asal_sekolah', TRUE),
			'kelas_diterima'	=>$this->input->post('kelas_diterima', TRUE),
			'tgl_diterima' 		=>$this->input->post('tgl_diterima', TRUE),
			'nama_ayah' 		=>$this->input->post('nama_ayah', TRUE),
			'nama_ibu' 			=>$this->input->post('nama_ibu', TRUE),
			'alamat_orangtua' 	=>$this->input->post('alamat_orangtua', TRUE),
			'tlp_ortu'          =>$this->input->post('telp_ortu', TRUE),
			'pekerjaan_ayah' 	=>$this->input->post('pekerjaan_ayah', TRUE),
			'pekerjaan_ibu' 	=>$this->input->post('pekerjaan_ibu', TRUE),
			'nama_wali' 		=>$this->input->post('nama_wali', TRUE),
			'alamat_wali' 		=>$this->input->post('alamat_wali', TRUE),
			'telp_wali' 		=>$this->input->post('telp_wali', TRUE),
			'pekerjaan_wali' 	=>$this->input->post('pekerjaan_wali', TRUE),
			'foto' 				=>$this->input->post('foto', TRUE),
			);
		$this->db->insert('tbl_siswa', $data);
	}

	function update($data)
	{
		$this->db->set($data);
		$this->db->where('id_siswa', $data['id_siswa']);
		$this->db->update('tbl_siswa', $data);
	}

	// Fungsi untuk melakukan proses upload file 
  	public function upload_file($filename){
		$this->load->library('upload'); // Load librari upload
		
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'xlsx';
		$config['max_size']	= '2048';
		$config['overwrite'] = true;
		$config['file_name'] = $filename;
	
		$this->upload->initialize($config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
		// Jika berhasil :
		$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
		return $return;
		}else{
		// Jika gagal :
		$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
		return $return;
		}
  	}
  
  	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
  	public function insert_multiple($data){
		$this->db->insert_batch('tbl_siswa', $data);
	  }
	  
	public function getSiswaKelas($id_kelas)
	{
		return $this->db->get_where('tbl_siswa',array('id_kelas' => $id_kelas))->result();
	}
}