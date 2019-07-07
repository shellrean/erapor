<?php

class Ekskul extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_siswa');
        $this->load->model('Mdl_ekskul');
        $this->load->library('Ssp');
    }
    public function index()
    {
        $id_kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
        $id = $id_kelas[0]['id_kelas'];
        $data['ekskul'] = $this->Mdl_ekskul->getAllList();
        $this->template->load('template','ekskul/list_v',$data);
    }
	public function data()
	{
		$table 		= 'tbl_ekskul';
        $primaryKey = 'id_ekskul';
        $columns 	= array(
            array('db' => 'kd_ekskul', 'dt' => 'kd_ekskul'),
            array('db' => 'nama_ekskul', 'dt' => 'nama_ekskul'),
            array(
                'db'        => 'kd_ekskul',
                'dt'        => 'aksi',
                'formatter' => function($d) {
                    return anchor('ekskul/edit/'.$d, '<i class="fa fa-edit"></i>', 'class="btn btn-info btn-xs" title="Edit"').'
                    '.anchor('ekskul/delete/'.$d, '<i class="fa fa-trash"></i>', 'class="btn btn-danger btn-xs" title="Delete" onclick="return konfirmasi_hapus()"');
                }
            ),
        );
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname
        );
 
        echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );
	}
    public function list()
    {
        $this->template->load('template','ekskul/index');
    }
    public function add()
    {
        if ( isset($_POST['submit'])) {
            $this->Mdl_ekskul->save();
            redirect('ekskul/list','refresh');
        } else {
            $this->template->load('template','ekskul/add_v');
        }
    }
    public function edit()
    {
        if ( isset($_POST['submit'])) {
            $this->Mdl_ekskul->update();
            redirect('ekskul/list','refresh');
        } else {
            $id             = $this->uri->segment(3);
            $where          = array('kd_ekskul' => $id );
            $data['ekskul']  = $this->Mdl_ekskul->daftar_ekskul($where, 'tbl_ekskul')->result();
            $this->template->load('template','ekskul/edit_v',$data);
        }
    }

    public function delete()
    {
        $id = $this->uri->segment(3);
        if (!empty($id)) {
            $this->db->where('kd_ekskul', $id);
            $this->db->delete('tbl_ekskul');
            redirect('ekskul/list','refresh');
        }
        else {
            redirect('ekskul/list','refresh');
        }
    }
    public function add_anggota()
    {
        if ( isset($_POST['submit'])) {

            $nis = $this->input->post('nis'); // Ambil data nis dan masukkan ke variabel nis
            $kd_ekskul = $this->input->post('ekskul');
            $kd_kelas = $this->input->post('kd_kelas');
            $data = array();
            
            $index = 0; // Set index array awal dengan 0
            foreach($nis as $datanis){ // Kita buat perulangan berdasarkan nis sampai data terakhir
            array_push($data, array(
                'nis'=>$datanis,
                'kd_ekskul' => $kd_ekskul,
                'kd_kelas' => $kd_kelas[$index]
            ));
            
            $index++;
            }
            $this->Mdl_ekskul->insertAnggota($data);
            redirect('ekskul');
        } else {
            $data['ekskul'] = $this->Mdl_ekskul->getAllList();
            $data['siswa'] = $this->Mdl_siswa->getMyKelas($this->session->userdata('eveuser'));
            $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
            $data['id_kelas'] = $kelas[0]['id_kelas'];
            $this->template->load('template','ekskul/add_a',$data);
        }
    }
    public function x($kd_ekskul)
    {
        $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
        $id_kelas = $kelas[0]['id_kelas'];
        if($this->Mdl_ekskul->cekData($id_kelas,$kd_ekskul)) {
            $this->update_nilai($kd_ekskul);
        } else {
            $this->add_nilai($kd_ekskul);
        }        
    }
    public function add_nilai($kd_ekskul)
    {
        if ( isset($_POST['submit'])) {
            $nis = $this->input->post('nis');
            $kd_ekskul = $this->input->post('kd_ekskul');
            $kd_kelas = $this->input->post('id_kelas');
            $nilai = $this->input->post('nilai');
            $data = array();
            
            $index = 0;
            foreach($nis as $datanis){
            array_push($data, array(
                'nis'       => $datanis,
                'kd_ekskul' => $kd_ekskul[$index],
                'id_kelas'  => $kd_kelas,
                'nilai'     => $nilai[$index]
            ));
            
            $index++;
            }
            $this->Mdl_ekskul->insertNilaiEkskul($data);
            redirect('ekskul');
        } else {
            $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
            $id_kelas = $kelas[0]['id_kelas'];
            $data['id_kelas'] = $id_kelas;
            $data['kd_ekskul'] = $kd_ekskul;
            $data['nama_ekskul'] = $this->Mdl_ekskul->getByKode($kd_ekskul);
            $data['siswa'] = $this->Mdl_ekskul->listSiswa($id_kelas, $kd_ekskul);
            $this->template->load('template','ekskul/nilai_n',$data);
        }
    }
    public function update_nilai($kd_ekskul)
    {
        if ( isset($_POST['submit'])) {
            $nis = $this->input->post('nis');
            $kd_ekskul = $this->input->post('kd_ekskul');
            $kd_kelas = $this->input->post('id_kelas');
            $nilai = $this->input->post('nilai');
            $data = array();
            
            $index = 0;
            foreach($nis as $datanis){
            array_push($data, array(
                'nis'       => $datanis,
                'kd_ekskul' => $kd_ekskul[$index],
                'id_kelas'  => $kd_kelas,
                'nilai'     => $nilai[$index]
            ));
            
            $index++;
            }
            $this->Mdl_ekskul->deleteKelas($kd_kelas, $kd_ekskul[0]);
            $this->Mdl_ekskul->insertNilaiEkskul($data);
            redirect('ekskul');
        } else {
            $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
            $id_kelas = $kelas[0]['id_kelas'];
            $data['id_kelas'] = $id_kelas;
            $data['kd_ekskul'] = $kd_ekskul;
            $data['nama_ekskul'] = $this->Mdl_ekskul->getByKode($kd_ekskul);
            $data['siswa'] = $this->Mdl_ekskul->listNilaiEkskul($id_kelas, $kd_ekskul);
            $this->template->load('template','ekskul/nilai_u',$data);
        }        
    }
}