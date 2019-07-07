<?php

class Mdl_nilai extends CI_Model 
{
    /* Buat sebuah fungsi untuk melakukan insert lebih dari 1 data */
    public function insert_multiple($data)
    {
		$this->db->insert_batch('tbl_nilai', $data);
    }
    public function deleteAllNilai($id)
    {
        $this->db->where('id_mapel', $id);
        $this->db->delete('tbl_nilai');
    } 
    public function cekTabel($idmapel)
    {
        if ( $this->db->get_where('tbl_nilai',array('id_mapel' =>$idmapel) )->result()) {
            return true;
        } else { 
            return false;
        }
    }
    public function getMyNilai($nis,$type)
    {
        $query = $this->db->query("SELECT N.*, M.nama_mapel FROM tbl_nilai N, tbl_mapel M WHERE N.nis='$nis' AND N.id_mapel=M.kd_mapel AND M.type='$type' ORDER BY M.kd_mapel")->result();
        return $query;
    }
    public function getResult($kd_mapel,$id_kelas)
    {
        $query = $this->db->query("
            SELECT S.nis,S.nama_siswa,N.* 
            FROM tbl_siswa S,tbl_nilai N
            WHERE S.id_kelas=$id_kelas AND S.nis=N.nis AND N.id_mapel='$kd_mapel'
        ")->result();
        return $query;
    }
    public function getNilaiKelas($id_kelas)
    {
        $query = $this->db->query("
            SELECT N.na,N.nis, S.nama_siswa FROM tbl_nilai N, tbl_siswa S WHERE S.id_kelas=$id_kelas AND S.nis=N.nis GROUP BY N.nis
        ")->result();
        return $query;
    }
}