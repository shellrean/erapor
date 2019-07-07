<?php

class Kelas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ssp');
        $this->load->model('Mdl_kelas');
        $this->load->model('Mdl_jurusan');
        $this->load->model('Mdl_guru');
    }
    public function index()
    {
        $data['all'] = $this->Mdl_kelas->getAll();
        $this->template->load('template','kelas/list_v',$data);
    }
    public function add()
	{
		if (isset($_POST['submit'])) {
			$this->Mdl_kelas->save();
			redirect('kelas','refresh');
		} else {
            $data['jurusan'] = $this->Mdl_jurusan->daftar_jurusan(null,'tbl_jurusan')->result();
            $data['guru'] = $this->Mdl_guru->daftar_guru(null,'tbl_guru')->result();
			$this->template->load('template', 'kelas/add_v',$data);
		}
	}
    public function delete()
    {
        $id = $this->uri->segment(3);
        if (!empty($id)) {
            $this->db->where('id_kelas', $id);
            $this->db->delete('tbl_kelas');
            redirect('kelas','refresh');
        }
        else {
            redirect('kelas','refresh');
        }
    }
}