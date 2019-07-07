<?php

class Absen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_absen');
        $this->load->model('Mdl_siswa');
    }
    public function index()
    {
        $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
        $id_kelas = $kelas[0]['id_kelas'];
        if ($this->Mdl_absen->cekData($id_kelas)) {
            $this->update($id_kelas);
        } else {
            $this->input($id_kelas);
        }
    }
    public function input($id_kelas)
    {
        if(isset($_POST['simpan'])) {
 

            // Ambil data yang dikirim dari form
            $nis = $this->input->post('nis'); // Ambil data nis dan masukkan ke variabel nis
            $sakit = $this->input->post('sakit'); // Ambil data nama dan masukkan ke variabel nama
            $izin = $this->input->post('izin'); // Ambil data telp dan masukkan ke variabel telp
            $alpa = $this->input->post('alpa'); // Ambil data alamat dan masukkan ke variabel alamat 
            $data = array();
            
            $index = 0; // Set index array awal dengan 0
            foreach($nis as $datanis){ // Kita buat perulangan berdasarkan nis sampai data terakhir
            array_push($data, array(
                'nis'=>$datanis,
                'id_kelas'=>$id_kelas,  // Ambil dan set data nama sesuai index array dari $index
                'sakit'=>$sakit[$index],  // Ambil dan set data telepon sesuai index array dari $index
                'izin'=>$izin[$index],  // Ambil dan set data alamat sesuai index array dari $index
                'tk'  =>$alpa[$index]
            ));
            
            $index++;
            }
            $this->Mdl_absen->insert_multiple($data);
            redirect('absen');
        } else {
            $data['id_kelas'] = $id_kelas;
            $data['siswa'] = $this->Mdl_siswa->getMyKelas($this->session->userdata('eveuser'));
            $this->template->load('template','absen/list_v',$data);
        }
    }
    public function update($id_kelas)
    {
        if ( isset($_POST['simpan'])) {
            // Ambil data yang dikirim dari form
            $nis = $this->input->post('nis'); // Ambil data nis dan masukkan ke variabel nis
            $sakit = $this->input->post('sakit'); // Ambil data nama dan masukkan ke variabel nama
            $izin = $this->input->post('izin'); // Ambil data telp dan masukkan ke variabel telp
            $alpa = $this->input->post('alpa'); // Ambil data alamat dan masukkan ke variabel alamat
            $data = array();
            
            $index = 0; // Set index array awal dengan 0
            foreach($nis as $datanis){ // Kita buat perulangan berdasarkan nis sampai data terakhir
            array_push($data, array(
                'nis'=>$datanis,
                'id_kelas'=>$id_kelas,  // Ambil dan set data nama sesuai index array dari $index
                'sakit'=>$sakit[$index],  // Ambil dan set data telepon sesuai index array dari $index
                'izin'=>$izin[$index],  // Ambil dan set data alamat sesuai index array dari $index
                'tk'  =>$alpa[$index]
            ));
            
            $index++;
            }
            $this->Mdl_absen->deleteKelas($id_kelas);
            $this->Mdl_absen->insert_multiple($data);
            redirect('absen');            
        } else {
            $data['id_kelas'] = $id_kelas;
            $data['siswa'] = $this->Mdl_absen->getAbsenKelas($id_kelas);
            $this->template->load('template','absen/list_u',$data);
        }

    }
}