<?php

Class Peringkat extends CI_Controller
{
    public function __construct()
    {
        Parent::__construct();
        $this->load->model('Mdl_peringkat');
        $this->load->model('Mdl_siswa');
        $this->load->model('Mdl_guru');
    }
    public function index()
    {
        $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
        $id_kelas = $kelas[0]['id_kelas'];
        $data['peringkat'] = $this->Mdl_peringkat->getAllNilai($id_kelas);
        $this->template->load('template','peringkat',$data); 
    }
    public function print()
    {
        $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
        $id_kelas = $kelas[0]['id_kelas'];
        $data['kelas'] = $kelas;
        $data['peringkat'] = $this->Mdl_peringkat->getAllNilai($id_kelas);
        $data['guru'] = $this->Mdl_guru->getById($this->session->userdata('eveuser'));
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "peringkat.pdf";
        $this->pdf->load_view('print/peringkat', $data);
    }
}