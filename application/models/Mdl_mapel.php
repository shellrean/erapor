<?php
class Mdl_mapel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function daftar_mapel($where,$table)
	{
		return $this->db->get_where($table, $where);
	}

	function agama_mapel()
	{
		$this->db->select('tbl_agama.nama_agama');
		$this->db->from('tbl_agama');
		$this->db->join('tbl_mapel', 'tbl_agama.kd_agama = tbl_mapel.kd_agama');
		$query = $this->db->get();
		if($query->num_rows() > 0) {
	        $results = $query->result_array();
	    }
	    return $results;
	}

	function save()
	{
		$data = array(
			'kd_mapel'			=>$this->input->post('kd_mapel', TRUE),
			'nama_mapel' 		=>$this->input->post('nama_mapel', TRUE),
			'id_kelas'			=>$this->input->post('kelas', TRUE),
			'type'				=>$this->input->post('type',TRUE)
			);
		$this->db->insert('tbl_mapel', $data);
	}
	function update($data)
	{
		$this->db->set($data);
		$this->db->where('kd_mapel', $data['kd_mapel']);
		$this->db->update('tbl_mapel', $data);
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
		$this->db->insert_batch('tbl_mapel', $data);
  	}
	
	public function getByKode($kode)
	{
		$this->db->where('kd_mapel',$kode);
		return $this->db->get('tbl_mapel')->result();
	}
}