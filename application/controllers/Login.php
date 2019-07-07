<?php

class Login extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Mdl_guru');
        $this->load->model('Mdl_admin');
    }

    public function index()
    {
		if ( $this->session->has_userdata('eveuser')) {
			redirect('siswa/wl');
        }
        
        $this->load->view('login/index');
    }

    public function proses()
    {
        $password = $this->input->post('password');
        $username = $this->input->post('username');
        $user = $this->Mdl_guru->_verify_credentials($username,$password);
        $admin = $this->Mdl_admin->_verify_credentials($username,$password);
        if ($user) {
            $newdata = array(
                'eveuser'  => $user['id_guru'],
                'nuptk'     => $user['nuptk'],
                'name'      => $user['nama_guru'],
                'jabatan'   => "Guru",
                'menu'      => "2"
            );
        
            $this->session->set_userdata($newdata);
            redirect(base_url()."siswa/wl");
        } elseif ($admin) {
            $newdata = array(
                'eveadmin'  => $admin['id'],
                'name'      => $admin['nama'],
                'jabatan'   => 'Admin',
                'menu'      => '1'
            );
        
            $this->session->set_userdata($newdata);
            redirect(base_url()."sekolah");
        } else {
            $this->session->set_flashdata('item','<div class="alert alert-danger">Username Password Salah !!!</div>'); 
            redirect(base_url()."login");
        } 
    }
    public function out()
    {
        session_destroy();
        redirect(base_url()."login");
    }
}