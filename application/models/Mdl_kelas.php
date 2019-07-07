<?php

class Mdl_kelas extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	public function daftar_kelas($where,$table)
	{
		return $this->db->get_where($table, $where); 
	}
    public function getAll()
    {
        $query = $this->db->query("
            SELECT K.id_kelas,K.nama_kelas,K.tingkat,G.nama_guru,J.nama_jurusan
            FROM tbl_kelas K,tbl_guru G,tbl_jurusan J
            WHERE K.id_guru=G.id_guru AND K.id_jurusan=J.kd_jurusan 
        ")->result_array();
        return $query; 
    }
	public function save()
	{
		$data = array(
			'nama_kelas'	=>$this->input->post('nama_kelas', TRUE),
            'id_guru' 		=>$this->input->post('guru', TRUE),
            'id_jurusan'    =>$this->input->post('jurusan',TRUE),
            'tingkat'       =>$this->input->post('tingkat',TRUE)
			);
		$this->db->insert('tbl_kelas', $data);
    }
    public function getKelas($id_guru) 
    {
        $query = $this->db->query("
            SELECT * FROM tbl_jurusan J, tbl_kelas K WHERE K.id_guru = '$id_guru' AND K.id_jurusan=J.kd_jurusan
        ")->result_array();
        return $query;
    }
}