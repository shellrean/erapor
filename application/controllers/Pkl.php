<?php

class Pkl extends CI_Controller
{
    protected $filename;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_pkl');
        $this->load->model('Mdl_siswa');
        $this->filename = 'pkl'.$this->session->userdata('eveuser');
    }
    public function index()
    {
        $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
        if($this->Mdl_pkl->cekData($kelas[0]['id_kelas'])) {
            $this->update();
        } else {
            $this->add();
        }
    }
    public function add()
    {
        if(isset($_POST['submit'])) {
            $nis        = $this->input->post('nis');
            $dudi       = $this->input->post('dudi');
            $lokasi      = $this->input->post('lokasi');
            $lama       = $this->input->post('lama');
            $ket        = $this->input->post('keterangan');
            $kd_kelas   = $this->input->post('id_kelas');
            $data       = array();
            
            $index = 0;
            foreach($nis as $datanis){
            array_push($data, array(
                'nis'       => $datanis,
                'id_kelas'  => $kd_kelas,
                'dudi'      => $dudi[$index],
                'lokasi'    => $lokasi[$index],
                'lama'      => $lama[$index],
                'keterangan'=> $ket[$index]
            ));
            
            $index++;
            }
            $this->Mdl_pkl->insertNilaipkl($data);
            redirect('pkl');
        } else {
            $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
            $data['id_kelas'] = $kelas[0]['id_kelas'];
            $data['siswa'] = $this->Mdl_siswa->getMyKelas($this->session->userdata('eveuser'));
            $this->template->load('template','pkl/list_v',$data);
        }
    }
    public function update()
    {
        if(isset($_POST['submit'])) {
            $nis        = $this->input->post('nis');
            $dudi       = $this->input->post('dudi');
            $lokasi      = $this->input->post('lokasi');
            $lama       = $this->input->post('lama');
            $ket        = $this->input->post('keterangan');
            $kd_kelas   = $this->input->post('id_kelas');
            $data       = array();
            
            $index = 0;
            foreach($nis as $datanis){
            array_push($data, array(
                'nis'       => $datanis,
                'id_kelas'  => $kd_kelas,
                'dudi'      => $dudi[$index],
                'lokasi'    => $lokasi[$index],
                'lama'      => $lama[$index],
                'keterangan'=> $ket[$index]
            ));
            
            $index++;
            }
            $this->Mdl_pkl->deleteKelas($kd_kelas);
            $this->Mdl_pkl->insertNilaipkl($data);
            redirect('pkl');
        } else {
            
            $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
            $data['id_kelas'] = $kelas[0]['id_kelas'];
            $data['siswa'] = $this->Mdl_pkl->getKelas($data['id_kelas']);
            $this->template->load('template','pkl/list_u',$data);
        }        
    }
    public function upl()
    {
        $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
        $data['id_kelas'] = $kelas[0]['id_kelas'];
        $this->template->load('template','pkl/upl_v',$data);
    }
	public function form(){
		$data = array(); /* Buat variabel $data sebagai array */
		
		if(isset($_POST['preview'])){ 
             
            /* ---------------------------------------------------
             * Jika user menekan tombol Preview pada form
			 * lakukan upload file dengan memanggil function upload yang ada di Mdl_Siswa.php
             * ---------------------------------------------------
             */
			$upload = $this->Mdl_pkl->upload_file($this->filename);
			
			if($upload['result'] == "success"){ /* Jika proses upload sukses */
				
				include APPPATH.'third_party/PHPExcel.php';

				$excelreader = new PHPExcel_Reader_Excel2007();

				$loadexcel = $excelreader->load('uploads/'.$this->filename.'.xlsx'); /* Load file yang tadi diupload ke folder excel */
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				
                /* -------------------------------------------------------------------
                 * Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				 * Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
                 * --------------------------------------------------------------------
                 */
                 $data['sheet'] = $sheet; 
			}else{ /* Jika proses upload gagal */
				$data['upload_error'] = $upload['error']; /* Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan */
			}
		} 
		$data['id_kelas'] = $this->input->post('id_kelas');
        $this->template->load('template', 'pkl/form', $data);
    }

    public function import(){
        /* Load plugin PHPExcel nya */
        include APPPATH.'third_party/PHPExcel.php';
        
        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('uploads/'.$this->filename.'.xlsx'); /* Load file yang telah diupload ke folder excel */
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
        
        /* Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database */
        $data = array();
        
        $numrow = 1; 
        foreach($sheet as $row){

        /* ----------------------------------------------
         * Cek $numrow apakah lebih dari 1
         * Artinya karena baris pertama adalah nama-nama kolom
         * Jadi dilewat saja, tidak usah diimport
         * ----------------------------------------------
         */

        if($numrow > 1){
            
            /* Kita push (add) array data ke variabel data */
            array_push($data, array(
            'id_nilai'          => '',
            'nis'               =>$row['A'],
            'id_kelas'          =>$this->input->post('id_kelas'),
            'dudi'              =>$row['C'],
            'lokasi'            =>$row['D'],
            'lama'              =>$row['E'],
            'keterangan'        =>$row['F']
            ));
        }
        
        $numrow++; // Tambah 1 setiap kali looping
        }
        $this->Mdl_pkl->deleteKelas($this->input->post('id_kelas'));
        $this->Mdl_pkl->insert_multiple($data);
        
        redirect("pkl/upl");
    }
    public function add_anot()
    {
        if( isset($_POST['submit']))
        {
            $this->Mdl_pkl->save();
            redirect('pkl/upl');
        } else {
            $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
            $data['id_kelas'] = $kelas[0]['id_kelas'];
            $this->template->load('template','pkl/add',$data);
        }
    }

    public function result()
    {
        $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
        $id_kelas = $kelas[0]['id_kelas'];
        $data['list'] = $this->Mdl_pkl->getResult($id_kelas);
        $this->template->load('template','pkl/result',$data);
    }

} 