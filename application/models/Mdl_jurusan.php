<?php

class Mdl_jurusan extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function daftar_jurusan($where,$table)
	{
		return $this->db->get_where($table, $where);
	}

	public function agama_jurusan()
	{
		$this->db->select('tbl_agama.nama_agama');
		$this->db->from('tbl_agama');
		$this->db->join('tbl_jurusan', 'tbl_agama.kd_agama = tbl_jurusan.kd_agama');
		$query = $this->db->get();
		if($query->num_rows() > 0) {
	        $results = $query->result_array();
	    }
	    return $results;
	}

	public function save()
	{
		$data = array(
			'kd_jurusan'		=>$this->input->post('kd_jurusan', TRUE),
			'nama_jurusan' 		=>$this->input->post('nama_jurusan', TRUE)
			);
		$this->db->insert('tbl_jurusan', $data);
	}

	public function update($data)
	{
		$this->db->set($data);
		$this->db->where('kd_jurusan', $data['kd_jurusan']);
		$this->db->update('tbl_jurusan', $data);
	}
}