<?php 

class Guru extends CI_Controller
{
    private $filename = "import_data";
    
	function __construct()
	{
		parent::__construct();
		$this->load->library('Ssp');
        $this->load->model('Mdl_guru');

		if (! $this->session->has_userdata('eveadmin')) {
			redirect('login');
		} 
	}

	function data()
	{
		$table 		= 'tbl_guru';
        $primaryKey = 'id_guru';
        $columns 	= array(
            array('db' => 'id_guru', 'dt' => 'id_guru'),
            array('db' => 'nuptk', 'dt' => 'nuptk'),
            array('db' => 'nama_guru', 'dt' => 'nama_guru'),
            array(
                'db'        => 'jenis_kelamin',
                'dt'        => 'jenis_kelamin',
                'formatter' => function($k) {
                    return $k=='L'?'Laki-laki':'Perempuan';
                }
            ),
            array(
                'db'        => 'id_guru',
                'dt'        => 'aksi',
                'formatter' => function($d) {
                    return anchor('guru/edit/'.$d, '<i class="fa fa-edit"></i>', 'class="btn btn-info btn-xs" title="Edit"').'
                    '.anchor('guru/delete/'.$d, '<i class="fa fa-trash"></i>', 'class="btn btn-danger btn-xs" title="Delete" onclick="return konfirmasi_hapus()"').'
                    '.anchor('guru/detail/'.$d, '<i class="fa fa-list"></i>', 'class="btn btn-primary btn-xs" title="Detail guru"');
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

	function index()
	{
		$this->template->load('template', 'guru/list_v');
	}

	function detail($id_guru)
	{
		$where			= array('id_guru' => $id_guru);
		$data['konten']	= $this->Mdl_guru->daftar_guru($where, 'tbl_guru')->result();
		$this->template->load('template', 'guru/detail_v', $data);
	}
 
	function add()
	{
		if (isset($_POST['submit'])) {
			$this->Mdl_guru->save();
			redirect('guru','refresh');
		} else {
			$this->template->load('template', 'guru/add_v');
		} 
	}

    public function upl()
    {
        $this->template->load('template','guru/upl_v');
    }

	public function form(){
		$data = array(); /* Buat variabel $data sebagai array */
		
		if(isset($_POST['preview'])){ 
             
            /* ---------------------------------------------------
             * Jika user menekan tombol Preview pada form
			 * lakukan upload file dengan memanggil function upload yang ada di Mdl_Siswa.php
             * ---------------------------------------------------
             */
			$upload = $this->Mdl_guru->upload_file($this->filename);
			
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
		
        $this->template->load('template', 'guru/form', $data);
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
            'id_guru'          => '',
            'nuptk'            =>$row['A'],
            'nama_guru'        =>$row['B'],
            'jenis_kelamin'    =>$row['C'],
            'username'         =>$row['D'],
            'password'         =>password_hash($row['E'],PASSWORD_DEFAULT)
            ));
        }
        
        $numrow++; // Tambah 1 setiap kali looping
        }

        $this->Mdl_guru->insert_multiple($data);
        
        redirect("Guru");
    }
    public function edit($id_guru)
    {
        if (isset($_POST['submit'])) {
            $this->Mdl_guru->update();
            redirect('guru','refresh');
        }
        else{
            $id             = $this->uri->segment(3);
            $where          = array('id_guru' => $id_guru );
            $data['guru']  = $this->Mdl_guru->daftar_guru($where, 'tbl_guru')->result();
            $this->template->load('template', 'guru/edit_v', $data);
        }
    }

    function update()
    {
        $this->load->model('Mdl_guru', 'mod');
        $data = array(
            'id_guru'         =>$this->input->post('id_guru', TRUE),
            'nuptk'         =>$this->input->post('nuptk', TRUE),
            'nama_guru'     =>$this->input->post('nama_guru', TRUE),
            'jenis_kelamin' =>$this->input->post('j_kelamin', TRUE)
        );
        $this->mod->update($data);
        redirect('guru');
    }

    function delete()
    {
        $id = $this->uri->segment(3);
        if (!empty($id)) {
            $this->db->where('id_guru', $id);
            $this->db->delete('tbl_guru');
            redirect('guru','refresh');
        }
        else {
            redirect('guru','refresh');
        }
    }
}