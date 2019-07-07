<?php

class Sekolah extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mdl_sekolah');

		if (! $this->session->has_userdata('eveadmin')) {
			redirect('login');
		} 
	}

	function index()
	{
		if (isset($_POST['submit'])) {
			$this->Mdl_sekolah->update();
			redirect('sekolah','refresh');
		}
		else {
			$data['info']	= $this->db->get('tbl_sekolah_info')->row_array();
			$this->template->load('template', 'info_sekolah_v', $data);
		}
	}
}