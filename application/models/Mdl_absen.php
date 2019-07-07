<?php

class Mdl_absen extends CI_Model
{
    public function cekData($id_kelas)
    {
        $where = array(
            "id_kelas" => $id_kelas
        );
        $query = $this->db->get_where('tbl_absen',$where)->num_rows();
        if($query){
            return true;
        } else {
            return false;
        }
    }
    // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
    public function insert_multiple($data)
    {
		$this->db->insert_batch('tbl_absen', $data);
    }
    public function getAbsenKelas($id_kelas)
    {
        $query = $this->db->query("
            SELECT S.nama_siswa,N.* 
            FROM tbl_siswa S, tbl_absen N
            WHERE N.nis=S.nis AND N.id_kelas=$id_kelas
        ")->result();
        return $query;
    }
    public function deleteKelas($id_kelas)
    {
        $this->db->where('id_kelas',$id_kelas);
        $this->db->delete('tbl_absen');
    }
    public function getByNis($nis)
    {
        $this->db->where('nis',$nis);
        return $this->db->get('tbl_absen')->result();
    }
}