<?php

class Cetak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_siswa');
        $this->load->model('Mdl_kelas');
        $this->load->model('Mdl_nilai');
        $this->load->model('Mdl_catatan');
        $this->load->model('Mdl_pkl');
        $this->load->model('Mdl_ekskul');
        $this->load->model('Mdl_absen');
        $this->load->model('Mdl_guru');
        $this->load->model('Mdl_sekolah');
    }  
    public function index()
    {
        $data['siswa'] = $this->Mdl_siswa->getMyKelas($this->session->userdata('eveuser'));
        $this->template->load('template','print/print_nilai',$data);
    }
    public function printout($nis)
    {
        $data['siswa'] = $this->Mdl_siswa->getByNis($nis);
        // $data['kelas'] = $this->Mdl_kelas->getKelas($this->session->userdata('eveuser'));
        $data['kelas'] = $this->Mdl_kelas->getKelas($this->session->userdata('eveuser'));
        $data['NA'] = $this->Mdl_nilai->getMyNilai($nis,'A'); 
        $data['NB'] = $this->Mdl_nilai->getMyNilai($nis,'B');
        $data['NC1'] = $this->Mdl_nilai->getMyNilai($nis,'C1');
        $data['NC2'] = $this->Mdl_nilai->getMyNilai($nis,'C2');
        $data['NC3'] = $this->Mdl_nilai->getMyNilai($nis,'C3');
        $data['MULOK'] = $this->Mdl_nilai->getMyNilai($nis,'D');
        $data['catatan'] = $this->Mdl_catatan->getByNis($nis);
        $data['pkl']    = $this->Mdl_pkl->getByNis($nis);
        $data['ekskul'] = $this->Mdl_ekskul->getRaportByNis($nis);
        $data['ket'] = $this->Mdl_absen->getByNis($nis);
        $data['guru'] = $this->Mdl_guru->getById($this->session->userdata('eveuser'));
        $data['sekolah'] = $this->Mdl_sekolah->getData();
        // $this->load->view('raport',$data);

        // $this->load->library('pdf');
        // $data['siswa'] = $this->Mdl_siswa->getByNis($nis);

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "raport.pdf";
        $this->pdf->load_view('raport', $data);
    } 
    public function cover()
    {
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "raport.pdf";
        $this->pdf->load_view('cover');
    }
}