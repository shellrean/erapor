<?php

class Mdl_catatan extends CI_Model
{
    public function cekData($nis)
    {
        $data = $this->db->get_where('tbl_catatan',array("nis" => $nis))->result();
        if ( $data) {
            return true;
        } else {
            return false; 
        } 
    } 
	public function save()
	{
		$data = array(
            'id_catatan'            =>'',
			'nis'			        =>$this->input->post('nis', TRUE),
            'catatan_akademik' 	    =>$this->input->post('catatan_akademik', TRUE),
            'catatan_karakter'      =>$this->input->post('catatan_karakter',TRUE)
		);
		$this->db->insert('tbl_catatan', $data);
    }
    public function update()
    {
		$data = array(
			'nis'			        =>$this->input->post('nis', TRUE),
            'catatan_akademik' 	    =>$this->input->post('catatan_akademik', TRUE),
            'catatan_karakter'      =>$this->input->post('catatan_karakter',TRUE)
        );
		$this->db->where('id_catatan', $this->input->post('idcat',TRUE));
		$this->db->update('tbl_catatan', $data);
    }
    public function getByNis($nis)
    {
        $query = $this->db->get_where("tbl_catatan",array("nis" => $nis))->result();
        return $query;
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

      public function insert_multiple($data){
		$this->db->insert_batch('tbl_catatan', $data);
      }
      
    public function deleteKelas($id_kelas)
    {
        $this->db->where('id_kelas',$id_kelas);
        $this->db->delete('tbl_catatan');
    }
}