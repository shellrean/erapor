<?php 

class Mapel extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('Ssp');
        $this->load->model('Mdl_mapel');
        $this->load->model('Mdl_kelas');
        
        if (! $this->session->has_userdata('eveadmin')) {
			redirect('login');
		}
	} 

	function data()
	{
		$table 		= 'tbl_mapel';
        $primaryKey = 'kd_mapel';
        $columns 	= array(
            array('db' => 'kd_mapel', 'dt' => 'kd_mapel'),
            array('db' => 'nama_mapel', 'dt' => 'nama_mapel'),
            array(
                'db' => 'kd_mapel',
                'dt' => 'aksi',
                'formatter' => function($d) {
                    return anchor('mapel/edit/'.$d, '<i class="fa fa-edit"></i>', 'class="btn btn-info btn-xs" title="Edit"').'
                    '.anchor('mapel/delete/'.$d, '<i class="fa fa-trash"></i>', 'class="btn btn-danger btn-xs" title="Delete" onclick="return konfirmasi_hapus()"');
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
		$this->template->load('template', 'mapel/list_v');
	}

	function detail($id_mapel)
	{
		$where			= array('id_mapel' => $id_mapel);
		$data['konten']	= $this->Mdl_mapel->daftar_mapel($where, 'tbl_mapel')->result();
        $data['agamaku']  = $this->Mdl_mapel->agama_mapel($id_mapel);
		$this->template->load('template', 'mapel/detail_v', $data);
	}

	function add()
	{
		if (isset($_POST['submit'])) {
			$this->Mdl_mapel->save();
			redirect('mapel','refresh');
		} else {
            $data['kelas'] = $this->Mdl_kelas->daftar_kelas(null,'tbl_kelas')->result_array();
			$this->template->load('template', 'mapel/add_v',$data);
		}
    }
    public function upl()
    {
        $this->template->load('template','mapel/upl_v');
    }
	public function form(){
		$data = array(); /* Buat variabel $data sebagai array */
		
		if(isset($_POST['preview'])){ 
             
            /* ---------------------------------------------------
             * Jika user menekan tombol Preview pada form
			 * lakukan upload file dengan memanggil function upload yang ada di Mdl_Siswa.php
             * ---------------------------------------------------
             */
			$upload = $this->Mdl_mapel->upload_file('upl_mapel');
			
			if($upload['result'] == "success"){ /* Jika proses upload sukses */
				
				include APPPATH.'third_party/PHPExcel.php';

				$excelreader = new PHPExcel_Reader_Excel2007();

				$loadexcel = $excelreader->load('uploads/upl_mapel.xlsx'); /* Load file yang tadi diupload ke folder excel */
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
		
        $this->template->load('template', 'mapel/form', $data);
    }
    public function import(){
        /* Load plugin PHPExcel nya */
        include APPPATH.'third_party/PHPExcel.php';
        
        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('uploads/upl_mapel.xlsx'); /* Load file yang telah diupload ke folder excel */
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
            'kd_mapel'    =>$row['A'],
            'nama_mapel'  =>$row['B'],
            'id_kelas'    =>$row['C'],
            'type'        =>$row['D']
            ));
        }
        
        $numrow++; // Tambah 1 setiap kali looping
        }

        $this->Mdl_mapel->insert_multiple($data);
        
        redirect("mapel");
    }

    public function edit($kd_mapel)
    {
        if (isset($_POST['submit'])) {
            $this->Mdl_mapel->update();
            redirect('mapel','refresh');
        }
        else{
            $id             = $this->uri->segment(3);
            $where          = array('kd_mapel' => $kd_mapel );
            $data['mapel']  = $this->Mdl_mapel->daftar_mapel($where, 'tbl_mapel')->result();
            $this->template->load('template', 'mapel/edit_v', $data);
        }
    }

    function update()
    {
        $this->load->model('Mdl_mapel', 'mod');
        $data = array(
            'kd_mapel'      =>$this->input->post('kd_mapel', TRUE),
            'nama_mapel'        =>$this->input->post('nama_mapel', TRUE)
            );
        $this->mod->update($data);
        redirect('mapel');
    }

    function delete()
    {
        $id = $this->uri->segment(3);
        if (!empty($id)) {
            $this->db->where('kd_mapel', $id);
            $this->db->delete('tbl_mapel');
            redirect('mapel','refresh');
        }
        else {
            redirect('mapel','refresh');
        }
    }
}