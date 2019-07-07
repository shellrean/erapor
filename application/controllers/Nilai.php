<?php

class Nilai extends CI_Controller
{
    protected $filename; 

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_mapel');
        $this->load->model('Mdl_siswa');
        $this->load->model('Mdl_nilai');

        $this->filename = 'nilai'.$this->session->userdata('eveuser');
    }
    public function index()
    {
        $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
        $data['mapel'] = $this->Mdl_mapel->daftar_mapel(array("id_kelas" => $kelas[0]['id_kelas']),'tbl_mapel')->result();
        $this->template->load('template','nilai/index',$data);
    }
    public function x($kdmapel)
    {
        if ( $this->Mdl_nilai->cekTabel($kdmapel) ) {
            $this->upl_u($kdmapel);
        } else {
            $this->upl($kdmapel);
        }
    }
    public function upl_u($kd_mapel)
    {
        $data['kd_mapel'] = $kd_mapel;
        $this->template->load('template','nilai/upl_u',$data);       
    }
    public function upl($kd_mapel)
    {
        $data['kd_mapel'] = $kd_mapel;
        $this->template->load('template','nilai/upl',$data);
    }
	public function form(){
		$data = array(); /* Buat variabel $data sebagai array */
		
		if(isset($_POST['preview'])){ 
             
            /* ---------------------------------------------------
             * Jika user menekan tombol Preview pada form
			 * lakukan upload file dengan memanggil function upload yang ada di Mdl_Siswa.php
             * ---------------------------------------------------
             */
			$upload = $this->Mdl_mapel->upload_file($this->filename);
			
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
            $data['kdmapel'] = $this->input->post('kdmapel');
		}  
		
        $this->template->load('template', 'nilai/form', $data);
    }
	public function form_u(){
		$data = array(); /* Buat variabel $data sebagai array */
		
		if(isset($_POST['preview'])){ 
             
            /* ---------------------------------------------------
             * Jika user menekan tombol Preview pada form
			 * lakukan upload file dengan memanggil function upload yang ada di Mdl_Siswa.php
             * ---------------------------------------------------
             */
			$upload = $this->Mdl_mapel->upload_file($this->filename);
			
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
            $data['kdmapel'] = $this->input->post('kdmapel');
		}  
		
        $this->template->load('template', 'nilai/form_u', $data);
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

            $np      = ($row['C']+$row['D']+$row['E']+$row['F'])/4;
            $nilai_p = $np;
            $nilai_k = $row['G'];
            $ns      = ($np*$row['H'])/100+($row['G']*$row['I'])/100;
            $na = round($ns);

            if($row['J'] == "C"){
                if($na >= 98){$predikat = "A+"; }
                elseif($na > 94 && $na < 98) {$predikat = "A"; } // 90 - 94
                elseif($na > 90 && $na < 95) {$predikat = "A-"; } // 85 - 89
                elseif($na > 86 && $na < 91) {$predikat = "B+"; } // 80 - 84 
                elseif($na > 82 && $na < 87) {$predikat = "B"; } // 75 - 79 
                elseif($na > 78 && $na < 83) {$predikat = "B-";} // 77 - 74 
                elseif($na > 74 && $na < 79) {$predikat = "C";} // 75 - 78  
                elseif ($na < 75) {$predikat = "D";} // dibawah 65 = 64,63
                // else {$predikat = "E";}
                $predikate = $predikat;

            } else {
                if($na >= 98){$predikat = "A+"; }
                elseif($na > 94 && $na < 98) {$predikat = "A"; } // 90 - 94
                elseif($na > 90 && $na < 95) {$predikat = "A-"; } // 85 - 89
                elseif($na > 86 && $na < 91) {$predikat = "B+"; } // 80 - 84 
                elseif($na > 82 && $na < 87) {$predikat = "B"; } // 75 - 79 
                elseif($na > 78 && $na < 83) {$predikat = "B-";} // 70 - 74 
                elseif($na > 74 && $na < 79) {$predikat = "C";} // 65 - 69  
                elseif ($na < 75) {$predikat = "D";} // dibawah 65 = 64,63
                // else {$predikat = "E";}
                $predikate = $predikat;
            }
            $predi = $predikate;
            /* Kita push (add) array data ke variabel data */
            array_push($data, array(
            'id_nilai'          => '',
            'nis'               =>$row['A'],
            'id_mapel'          =>$this->input->post('kdmapel'),
            'tgs'               =>$row['C'],
            'ph'                =>$row['D'],
            'pts'               =>$row['E'],
            'pas'               =>$row['F'],
            'pk'                =>$row['G'],
            'nilai_k'           =>$nilai_k,
            'nilai_p'           =>$nilai_p,
            'na'                =>$na,
            'predikat'          =>$predi
            ));
        }
        
        $numrow++; // Tambah 1 setiap kali looping
        }

        $this->Mdl_nilai->insert_multiple($data);
        
        redirect("nilai");
    }
    public function import_u(){
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
            $np      = ($row['C']+$row['D']+$row['E']+$row['F'])/4;
            $nilai_p = $np;
            $nilai_k = $row['G'];
            $ns      = ($np*$row['H'])/100+($row['G']*$row['I'])/100;
            $na = round($ns);
 
            if($row['J'] == "C"){
                if($na >= 98){$predikat = "A+"; }
                elseif($na > 94 && $na < 98) {$predikat = "A"; } // 90 - 94
                elseif($na > 90 && $na < 95) {$predikat = "A-"; } // 85 - 89
                elseif($na > 86 && $na < 91) {$predikat = "B+"; } // 80 - 84 
                elseif($na > 82 && $na < 87) {$predikat = "B"; } // 75 - 79 
                elseif($na > 78 && $na < 83) {$predikat = "B-";} // 70 - 74 
                elseif($na > 74 && $na < 79) {$predikat = "C";} // 65 - 69  
                elseif ($na < 75) {$predikat = "D";} // dibawah 65 = 64,63
                // else {$predikat = "E";}
                $predikate = $predikat;

            } else {
                if($na >= 98){$predikat = "A+"; }
                elseif($na > 94 && $na < 98) {$predikat = "A"; } // 90 - 94
                elseif($na > 90 && $na < 95) {$predikat = "A-"; } // 85 - 89
                elseif($na > 86 && $na < 91) {$predikat = "B+"; } // 80 - 84 
                elseif($na > 82 && $na < 87) {$predikat = "B"; } // 75 - 79 
                elseif($na > 78 && $na < 83) {$predikat = "B-";} // 70 - 74 
                elseif($na > 74 && $na < 79) {$predikat = "C";} // 65 - 69  
                elseif ($na < 75) {$predikat = "D";} // dibawah 65 = 64,63
                // else {$predikat = "E";}
                $predikate = $predikat;
            }
            $predi = $predikate;
            /* Kita push (add) array data ke variabel data */
            array_push($data, array(
            'id_nilai'          => '',
            'nis'               =>$row['A'],
            'id_mapel'          =>$this->input->post('kdmapel'),
            'tgs'               =>$row['C'],
            'ph'                =>$row['D'],
            'pts'               =>$row['E'],
            'pas'               =>$row['F'],
            'pk'                =>$row['G'],
            'nilai_k'           =>$nilai_k,
            'nilai_p'           =>$nilai_p,
            'na'                =>$na,
            'predikat'          =>$predi
            ));
        }
        
        $numrow++; // Tambah 1 setiap kali looping
        }
        $this->Mdl_nilai->deleteAllNilai($this->input->post('kdmapel'));
        $this->Mdl_nilai->insert_multiple($data,$this->input->post('kdmapel'));
        
        redirect("nilai");
    }
    public function upd_m($kd_mapel)
    {
        $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
        $id_kelas = $kelas[0]['id_kelas'];
        $result = $this->Mdl_nilai->getResult($kd_mapel,$id_kelas);
        $data['list'] = $result;
        $mapels = $this->db->get_where('tbl_mapel',['kd_mapel' => $kd_mapel])->row();
        $data['tipe'] = $mapels->type;
        $mapel = $this->Mdl_mapel->getByKode($kd_mapel);
        $data['nama_mapel'] = $mapel[0]->nama_mapel;
        $data['kd_mapel'] = $kd_mapel;
        $this->template->load('template','nilai/upd_m',$data);
    }
    public function upd_s()
    {
      $nis     = $this->input->post('nis',true);
      $kd_mapel = $this->input->post('kd_mapel',true);
      $np      = ($this->input->post('tgs')+$this->input->post('ph')+$this->input->post('pts')+$this->input->post('pas'))/4;
      $nilai_p = $np;
      $nilai_k = $this->input->post('pk');
      $bobot = explode('-',$this->input->post('bobot'));
      $bobot_p = $bobot[0];
      $bobot_k = $bobot[1];
      $ns      = ($np*$bobot_p)/100+($nilai_k*$bobot_k)/100;
      $na = round($ns);

      if($row['J'] == "C"){
        if($na >= 98){$predikat = "A+"; }
        elseif($na > 94 && $na < 98) {$predikat = "A"; } // 90 - 94
        elseif($na > 90 && $na < 95) {$predikat = "A-"; } // 85 - 89
        elseif($na > 86 && $na < 91) {$predikat = "B+"; } // 80 - 84 
        elseif($na > 82 && $na < 87) {$predikat = "B"; } // 75 - 79 
        elseif($na > 78 && $na < 83) {$predikat = "B-";} // 70 - 74 
        elseif($na > 74 && $na < 79) {$predikat = "C";} // 65 - 69  
        elseif ($na < 75) {$predikat = "D";} // dibawah 65 = 64,63
        // else {$predikat = "E";}
        $predikate = $predikat;

    } else {
        if($na >= 98){$predikat = "A+"; }
        elseif($na > 94 && $na < 98) {$predikat = "A"; } // 90 - 94
        elseif($na > 90 && $na < 95) {$predikat = "A-"; } // 85 - 89
        elseif($na > 86 && $na < 91) {$predikat = "B+"; } // 80 - 84 
        elseif($na > 82 && $na < 87) {$predikat = "B"; } // 75 - 79 
        elseif($na > 78 && $na < 83) {$predikat = "B-";} // 70 - 74 
        elseif($na > 74 && $na < 79) {$predikat = "C";} // 65 - 69  
        elseif ($na < 75) {$predikat = "D";} // dibawah 65 = 64,63
        // else {$predikat = "E";}
        $predikate = $predikat;
    }
    $predi = $predikate;

      $data = [
          'tgs' => $this->input->post('tgs',true),
          'ph'  => $this->input->post('ph',true),
          'pts' => $this->input->post('pts',true),
          'pas' => $this->input->post('pas',true),
          'pk'  => $this->input->post('pk',true),
          'nilai_k' => $nilai_k,
          'nilai_p' => $nilai_p,
          'na'  => $na,
          'predikat' => $predi,
          'bobot' => $this->input->post('bobot',true)
      ];

      $this->db->where(['nis' => $nis, 'id_mapel' => $kd_mapel]);
      $this->db->update('tbl_nilai',$data);
    $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Nilai dengan nis '.$nis.' berhasil diubah
  </div>');
      redirect("nilai/upd_m/".$kd_mapel);

    //   var_dump($bobot_p."-".$bobot_k."-".$na);
    }
    public function result()
    {
        $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
        $id_kelas = $kelas[0]['id_kelas'];
        $kd_mapel = $this->uri->segment('3');
        $data['list'] = $this->Mdl_nilai->getResult($kd_mapel,$id_kelas);
        $mapel = $this->Mdl_mapel->getByKode($kd_mapel);
        $data['nama_mapel'] = $mapel[0]->nama_mapel;
        $this->template->load('template','print/result',$data);
        // $this->pdf->setPaper('A4', 'potrait');
        // $this->pdf->filename = "hasil-nilai.pdf";
        // $this->pdf->load_view('print/result', $data);
    }
}