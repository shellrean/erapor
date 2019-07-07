<?php 

class Printout extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('Mdl_sekolah');

		// if (! $this->session->has_userdata('eveuser') OR !$this->session->has_userdata('eveadmin')) {
		// 	redirect('login');
		// }
	}

	public function  infoSekolah()
	{
		$data['info']	= $this->db->get('tbl_sekolah_info')->row_array();
        $this->load->view('print/info_sekolah',$data);
	}

	public function raport()
	{
		$this->load->view('print/raport');
	}
}


