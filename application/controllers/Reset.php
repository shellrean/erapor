<?php

class Reset extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_ekskul');
    }
    public function ekskul()
    {
        if( isset($_POST['submit'])) {
            $id_kelas = $this->input->post('kd_kelas');
            $kd_ekskul = $this->input->post('kd_ekskul');
            $this->Mdl_ekskul->resetAnggota($id_kelas,$kd_ekskul);
            redirect('reset/ekskul');
        } else {
            $this->template->load('template','reset/ekskul');
        }
    }
}