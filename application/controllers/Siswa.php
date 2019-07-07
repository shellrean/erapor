<?php 

class Siswa extends CI_Controller
{
    private $filename = "import_data";
    
	function __construct()
	{
		parent::__construct();
		$this->load->library('Ssp');
        $this->load->model('Mdl_siswa');
        
        // if (! $this->session->has_userdata('eveadmin') || ! $this->session->has_userdata('eveuser')) {
		// 	redirect('login');
		// }
	}

	function data() 
	{
		$table 		= 'tbl_siswa';
        $primaryKey = 'id_siswa';
        $columns 	= array(
        	array('db' => 'id_siswa', 'dt' => 'id_siswa'),
        	array(
                'db' => 'foto',
                'dt' => 'foto',
                'formatter' => function( $d) {
                    return '<img src="assets/foto/default-siswa.png">';
                }
            ),
            array('db' => 'nis', 'dt' => 'nis'),
            array('db' => 'nama_siswa', 'dt' => 'nama'),
            array('db' => 'temp_lahir', 'dt' => 'temp_lahir'),
            array('db' => 'tgl_lahir', 'dt' => 'tgl_lahir'),
            array(
                'db' => 'id_siswa',
                'dt' => 'aksi',
                'formatter' => function($d) {
                    return anchor('siswa/edit/'.$d, '<i class="fa fa-edit"></i>', 'class="btn btn-info btn-xs" title="Edit"').'
                    '.anchor('siswa/delete/'.$d, '<i class="fa fa-trash"></i>', 'class="btn btn-danger btn-xs" title="Delete" onclick="return konfirmasi_hapus()"').'
                    '.anchor('siswa/detail/'.$d, '<i class="fa fa-list"></i>', 'class="btn btn-primary btn-xs" title="Detail Siswa"');
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
    function data_w()
	{
        $table = "tbl_siswa";
        $primaryKey = 'id_siswa';
        $columns 	= array(
        	array('db' => 'id_siswa', 'dt' => 'id_siswa'),
        	array(
                'db' => 'foto',
                'dt' => 'foto',
                'formatter' => function( $d) {
                    return '<img src="assets/foto/default-siswa.png">';
                }
            ),
            array('db' => 'nis', 'dt' => 'nis'),
            array('db' => 'nama_siswa', 'dt' => 'nama'),
            array('db' => 'temp_lahir', 'dt' => 'temp_lahir'),
            array('db' => 'tgl_lahir', 'dt' => 'tgl_lahir'),
            array(
                'db' => 'id_siswa',
                'dt' => 'aksi',
                'formatter' => function($d) {
                    return anchor('siswa/edit/'.$d, '<i class="fa fa-edit"></i>', 'class="btn btn-info btn-xs" title="Edit"').'
                    '.anchor('siswa/delete/'.$d, '<i class="fa fa-trash"></i>', 'class="btn btn-danger btn-xs" title="Delete" onclick="return konfirmasi_hapus()"').'
                    '.anchor('siswa/detail/'.$d, '<i class="fa fa-list"></i>', 'class="btn btn-primary btn-xs" title="Detail Siswa"');
                }
            ),
        );
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname
        );
 
        $id_kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
        if ( $id_kelas) {
            $id = $id_kelas[0]['id_kelas'];
        } else {
            $id = 0;
        }
        echo json_encode(
                SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns,null, "id_kelas=$id")
        );
	}
	function index()
	{
		$this->template->load('template', 'siswa/list_v');
    }
    public function wl()
    {
        $this->template->load('template','siswa/list_w');
    }

	function detail($id_siswa)
	{
		$where			= array('id_siswa' => $id_siswa);
		$data['konten']	= $this->Mdl_siswa->daftar_siswa($where, 'tbl_siswa')->result();
		$this->template->load('template', 'siswa/detail_v', $data);
	}

	function add()
	{
		if (isset($_POST['submit'])) {
			$this->Mdl_siswa->save(); 
			redirect('siswa','refresh'); 
		} else {
			$this->template->load('template', 'siswa/add_v');
		}
    }
    function upl()
    {
        $this->template->load('template','siswa/upl_v');
    }
	public function form(){
		$data = array(); /* Buat variabel $data sebagai array */
		
		if(isset($_POST['preview'])){ 
            
            /* ---------------------------------------------------
             * Jika user menekan tombol Preview pada form
			 * lakukan upload file dengan memanggil function upload yang ada di Mdl_Siswa.php
             * ---------------------------------------------------
             */
			$upload = $this->Mdl_siswa->upload_file($this->filename);
			
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
		
        $this->template->load('template', 'siswa/form', $data);
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
            'id_siswa' => '',
            'nis'=>$row['A'],
            'nisn'=>$row['B'],
            'nama_siswa'=>$row['C'],
            'j_kelamin'=>$row['D'],
            'temp_lahir'=>$row['E'],
            'tgl_lahir'=>$row['F'],
            'kd_agama'=>$row['G'],
            'status_keluarga'=>$row['H'],
            'anak_ke'=>$row['I'],
            'alamat'=>$row['J'],
            'telp'=>$row['K'],
            'asal_sekolah'=>$row['L'],
            'kelas_diterima'=>$row['M'],
            'tgl_diterima'=>$row['N'],
            'nama_ayah'=>$row['O'],
            'nama_ibu'=>$row['P'],
            'alamat_orangtua'=>$row['Q'],
            'tlp_ortu'=>$row['R'],
            'pekerjaan_ayah'=>$row['S'],
            'pekerjaan_ibu'=>$row['T'],
            'nama_wali'=>$row['U'],
            'alamat_wali'=>$row['V'],
            'telp_wali'=>$row['W'],
            'pekerjaan_wali'=>$row['X'],
            'id_kelas'      =>$row['Y']
            ));
        }
        
        $numrow++; // Tambah 1 setiap kali looping
        }

        $this->Mdl_siswa->insert_multiple($data);
        
        redirect("siswa");
    }

    public function edit($id_siswa)
    {
        if (isset($_POST['submit'])) {
            $this->Mdl_siswa->update();
            redirect('siswa','refresh');
        }
        else{
            $id             = $this->uri->segment(3);
            $where          = array('id_siswa' => $id_siswa );
            $data['siswa']  = $this->Mdl_siswa->daftar_siswa($where, 'tbl_siswa')->result();
            $this->template->load('template', 'siswa/edit_v', $data);
        }
    }

    function update()
    {
        $this->load->model('Mdl_siswa', 'mod');
        $data = array(
            'id_siswa'          =>$this->input->post('id_siswa', TRUE),
            'nis'               =>$this->input->post('nis', TRUE),
            'nisn'              =>$this->input->post('nisn',TRUE),
            'nama_siswa'        =>$this->input->post('nama_siswa', TRUE),
            'temp_lahir'        =>$this->input->post('temp_lahir', TRUE),
            'tgl_lahir'         =>$this->input->post('tgl_lahir', TRUE),
            'j_kelamin'         =>$this->input->post('j_kelamin', TRUE),
            'kd_agama'          =>$this->input->post('agama', TRUE),
            'status_keluarga'   =>$this->input->post('status_keluarga', TRUE),
            'anak_ke'           =>$this->input->post('anak_ke', TRUE),
            'alamat'            =>$this->input->post('alamat', TRUE),
            'telp'              =>$this->input->post('telp', TRUE),
            'asal_sekolah'      =>$this->input->post('asal_sekolah', TRUE),
            'kelas_diterima'    =>$this->input->post('kelas_diterima', TRUE),
            'tgl_diterima'      =>$this->input->post('tgl_diterima', TRUE),
            'nama_ayah'         =>$this->input->post('nama_ayah', TRUE),
            'nama_ibu'          =>$this->input->post('nama_ibu', TRUE),
            'alamat_orangtua'   =>$this->input->post('alamat_orangtua', TRUE),
            'pekerjaan_ayah'    =>$this->input->post('pekerjaan_ayah', TRUE),
            'pekerjaan_ibu'     =>$this->input->post('pekerjaan_ibu', TRUE),
            'tlp_ortu'         =>$this->input->post('telp_ortu',TRUE),
            'nama_wali'         =>$this->input->post('nama_wali', TRUE),
            'alamat_wali'       =>$this->input->post('alamat_wali', TRUE),
            'telp_wali'         =>$this->input->post('telp_wali', TRUE),
            'pekerjaan_wali'    =>$this->input->post('pekerjaan_wali', TRUE),
            'foto'              =>$this->input->post('foto', TRUE)
        );
        $this->mod->update($data);
        redirect('siswa'); 
    }

    function delete()
    {
        $id = $this->uri->segment(3);
        if (!empty($id)) {
            $this->db->where('id_siswa', $id);
            $this->db->delete('tbl_siswa');
            redirect('siswa','refresh');
        }
        else {
            redirect('siswa','refresh'); 
        }
    }
    public function cetakIdentitas($nis)
    { 
        $this->load->library('pdf'); 
        $data['siswa'] = $this->Mdl_siswa->getByNis($nis);

        // $this->pdf->setPaper('A4', 'potrait');
        // $this->pdf->filename = "laporan-petanikode.pdf";
        // $this->pdf->load_view('print/identitas_siswa', $data);
        $this->load->view('print/identitas_siswa',$data);
    
        // $rapor_identitas_siswa=$this->load->view('print/identitas', $data);
        // $this->pdfgenerator->generate($rapor_identitas_siswa,'nilai_siswa'); 
    } 
}