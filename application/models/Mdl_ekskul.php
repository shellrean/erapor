<?php

class Mdl_ekskul extends CI_Model
{
    public function getAllList() 
    {
        return $this->db->get('tbl_ekskul')->result();
    }
	public function daftar_ekskul($where,$table)
	{
		return $this->db->get_where($table, $where); 
    }
    public function cekData($id_kelas,$id_ekskul)
    {
        $this->db->where('id_kelas',$id_kelas);
        $this->db->where('kd_ekskul',$id_ekskul);
        return $this->db->get('tbl_nilai_ekskul')->result();
    }
    public function save()
    {
        $data = array(
			'kd_ekskul'		=>$this->input->post('kd_ekskul', TRUE),
			'nama_ekskul' 		=>$this->input->post('nama_ekskul', TRUE)
			);
		$this->db->insert('tbl_ekskul', $data);
    }
    public function update()
    {
        $this->db->where('kd_ekskul',$this->input->post('kd_ekskul'));
        $this->db->set('nama_ekskul',$this->input->post('nama_ekskul'));
        $this->db->update('tbl_ekskul');
    }
    public function insertAnggota($data)
    {
        $this->db->insert_batch('tbl_anggota_ekskul', $data);
    }
    public function listSiswa($id_kelas,$kd_ekskul)
    {
        $query = $this->db->query("
            SELECT A.nis, E.nama_ekskul, S.nama_siswa 
            FROM tbl_anggota_ekskul A,tbl_ekskul E,tbl_siswa S 
            WHERE A.kd_ekskul='$kd_ekskul' AND A.kd_ekskul=E.kd_ekskul AND kd_kelas='$id_kelas' AND A.nis=S.nis
        ")->result();
        return $query;
    }
    public function listNilaiEkskul($id_kelas,$kd_ekskul)
    {
        $query = $this->db->query("
            SELECT N.nilai,S.nama_siswa ,N.nis
            FROM tbl_nilai_ekskul N, tbl_siswa S 
            WHERE N.kd_ekskul='$kd_ekskul' AND N.nis=S.nis AND N.id_kelas='$id_kelas'
        ")->result();
        return $query;
    }
    public function getByKode($kd_ekskul)
    {
        return $this->db->get_where('tbl_ekskul',["kd_ekskul" => $kd_ekskul])->result();
    }
    public function insertNilaiEkskul($data)
    {
        $this->db->insert_batch('tbl_nilai_ekskul', $data);
    }
    public function deleteKelas($id_kelas,$kd_ekskul)
    {
        $this->db->where('id_kelas',$id_kelas);
        $this->db->where('kd_ekskul',$kd_ekskul);
        $this->db->delete('tbl_nilai_ekskul');
    }
    public function getRaportByNis($nis)
    {
        $query = $this->db->query("
            SELECT E.nama_ekskul, N.nilai
            FROM tbl_ekskul E, tbl_nilai_ekskul N
            WHERE N.nis='$nis' AND N.kd_ekskul=E.kd_ekskul
        ")->result();
        return $query;
    }
    public function resetAnggota($id_kelas,$kd_ekskul)
    {
        $this->db->where('kd_kelas',$id_kelas);
        $this->db->where('kd_ekskul',$kd_ekskul);
        $this->db->delete('tbl_anggota_ekskul');
    }
}