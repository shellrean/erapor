<?php

class Deskripsi extends CI_Controller
{
    protected $filename;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_siswa');
        $this->load->model('Mdl_catatan');
        $this->filename = 'deskripsi'.$this->session->userdata('eveuser');
    }
    public function index()
    {
        $data['siswa'] = $this->Mdl_siswa->getMyKelas($this->session->userdata('eveuser'));
        $this->template->load('template','deskripsi/index',$data);
    }
    public function x($nis)
    {
        if($this->Mdl_catatan->cekData($nis)) {
            $this->update($nis);
        } else {
            $this->add($nis);
        }
    }
    public function add($nis)
    {
        if(isset($_POST['simpan'])) {
            $this->Mdl_catatan->save();
            redirect('deskripsi');
        } else {
            $data['siswa'] = $this->Mdl_siswa->getByNis($nis);
            $this->template->load('template','deskripsi/add_a',$data);
        }
    }
    public function update($nis)
    {
        if(isset($_POST['simpan'])) {
            $this->Mdl_catatan->update();
            redirect('deskripsi');
        } else {
            $data['siswa'] = $this->Mdl_siswa->getByNis($nis);
            $data['catatan'] = $this->Mdl_catatan->getByNis($nis);
            $this->template->load('template','deskripsi/edit',$data);
        }     
    }
    public function upl()
    {
        $this->template->load('template','deskripsi/upl_v');
    }
	public function form(){
		$data = array(); /* Buat variabel $data sebagai array */
		
		if(isset($_POST['preview'])){ 
             
            /* ---------------------------------------------------
             * Jika user menekan tombol Preview pada form
			 * lakukan upload file dengan memanggil function upload yang ada di Mdl_Siswa.php
             * ---------------------------------------------------
             */
			$upload = $this->Mdl_catatan->upload_file($this->filename);
			
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
        $this->template->load('template', 'deskripsi/form', $data);
    }
    public function import(){
        $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
        $id_kelas = $kelas[0]['id_kelas'];
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
            'id_catatan'          => '',
            'nis'            =>$row['A'],
            'catatan_akademik'        =>$row['D'],
            'catatan_karakter'  =>$row['C'],
            'integritas'    =>$row['E'],
            'religius'      =>$row['F'],
            'nasionalis'    =>$row['G'],
            'mandiri'       =>$row['H'],
            'gotong'        =>$row['I'],
            'id_kelas'      =>$id_kelas
            ));
        }
        
        $numrow++; // Tambah 1 setiap kali looping
        }
        $this->Mdl_catatan->deleteKelas($id_kelas);
        $this->Mdl_catatan->insert_multiple($data);
        
        redirect("deskripsi/upl");
    }
}