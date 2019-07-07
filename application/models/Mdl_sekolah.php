<?php 

class Mdl_sekolah extends CI_Model
{
	
	function update()
	{
		$data = array(
			'NPSN'              => $this->input->post('npsn',TRUE),
			'NDS'               => $this->input->post('nds',TRUE),
			'nama_sekolah' 		=> $this->input->post('nama_sekolah', TRUE),
			'alamat_sekolah' 	=> $this->input->post('alamat_sekolah', TRUE),
			'kode_post'         => $this->input->post('kode_pos',TRUE),
			'email' 	        => $this->input->post('email_sekolah', TRUE),
			'telp'		        => $this->input->post('telp_sekolah', TRUE),
			'kelurahan'         => $this->input->post('kelurahan',TRUE),
			'kecamatan'         => $this->input->post('kecamatan',TRUE),
			'kota'              => $this->input->post('kota',TRUE),
			'provinsi'          => $this->input->post('provinsi',TRUE),
			'website'           => $this->input->post('website',TRUE),
			'email'             => $this->input->post('email',TRUE),
			'kepsek'			=> $this->input->post('kepsek',TRUE),
			'nip'				=> $this->input->post('nip',TRUE)
		);
		$id_sekolah = $this->input->post('id_sekolah');  
		$this->db->update('tbl_sekolah_info', $data);
	}
	public function getData()
	{
		return $this->db->get('tbl_sekolah_info')->result();
	}
}