<?php

class Mdl_pkl extends CI_Model
{
    public function cekData($kelas) 
    {
        $query = $this->db->get_where('tbl_nilai_pkl',["id_kelas" => $kelas])->result();
        if ($query) {
            return true;
        } else {
            return false; 
        }
    }
    public function insertNilaipkl($data)
    {
        $this->db->insert_batch('tbl_nilai_pkl', $data);
    }
    public function getKelas($id_kelas)
    {
        $query = $this->db->query("
            SELECT S.nis,S.nama_siswa,P.dudi,P.lokasi,P.lama,P.keterangan FROM tbl_siswa S,tbl_nilai_pkl P WHERE P.nis=S.nis AND P.id_kelas='$id_kelas'
        ")->result();
        return $query;
    }
    public function deleteKelas($id_kelas)
    {
        $this->db->where('id_kelas',$id_kelas);
        $this->db->delete('tbl_nilai_pkl');
    }
    public function getByNis($nis)
    {
        $this->db->where('nis',$nis);
        return $this->db->get('tbl_nilai_pkl')->result();
    }
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
    public function insert_multiple($data)
    {
		$this->db->insert_batch('tbl_nilai_pkl', $data);
  	} 
    
    public function save()
    {
		$data = array(
            'id_kelas'          =>'',
            'nis'               =>$this->input->post('nis',TRUE),
            'id_kelas'          =>$this->input->post('id_kelas',TRUE),
            'dudi'               =>$this->input->post('dudi',TRUE),
            'lokasi'            =>$this->input->post('lokasi',TRUE),
            'lama'              =>$this->input->post('lama',TRUE),
            'keterangan'        =>$this->input->post('ket',TRUE)
			);
		$this->db->insert('tbl_nilai_pkl', $data);
    }
    public function getResult($id_kelas)
    {
        $query = $this->db->query("
            SELECT S.nis,S.nama_siswa,N.* 
            FROM tbl_siswa S,tbl_nilai_pkl N
            WHERE S.id_kelas=$id_kelas AND S.nis=N.nis
        ")->result();
        return $query;
    }
}