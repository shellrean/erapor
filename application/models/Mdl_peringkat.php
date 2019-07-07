<?php

Class Mdl_peringkat extends CI_Model
{
    public function getAllNilai($id_kelas)
    {
        $query = $this->db->query("
            SELECT S.nis,S.nama_siswa, N.na, SUM(N.na) as per, COUNT(*) as jumlah FROM tbl_siswa S, tbl_nilai N WHERE S.id_kelas='$id_kelas' AND S.nis=N.nis GROUP BY N.nis ORDER BY per DESC;
        ")->result();
        return $query;
    }
}