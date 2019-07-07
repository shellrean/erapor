<?php

class Lager extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_mapel');
        $this->load->model('Mdl_siswa');
        $this->load->model('Mdl_nilai');
        $this->load->model('Mdl_guru');
    }

    public function index()
    {
        // var_dump($this->session->userdata('eveuser'));
        $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
        $data['mapel'] = $this->Mdl_mapel->daftar_mapel(array("id_kelas" => $kelas[0]['id_kelas']),'tbl_mapel')->result();
        $this->template->load('template','nilai/lager',$data);
    }
    // public function index()
    // {
    //     $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
    //     $id_kelas = $kelas[0]['id_kelas'];
    //     $kd_mapel = $this->uri->segment('3');
    //     $data['list'] = $this->Mdl_nilai->getResult($kd_mapel,$id_kelas);
    //     $mapel = $this->Mdl_mapel->getByKode($kd_mapel);
    //     var_dump($mapel);
    //     // $data['nama_mapel'] = $mapel[0]->nama_mapel;
    //     // $this->template->load('bug','print/lager',$data);
    // }
    // public function index()
    // {
    //     $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
    //     $data['mapel'] = $this->Mdl_mapel->daftar_mapel(array("id_kelas" => $kelas[0]['id_kelas']),'tbl_mapel')->result();
    //     // $this->template->load('template','nilai/lager',$data);
    //     $data['dat'] = $this->Mdl_nilai->getNilaiKelas($kelas[0]['id_kelas']);
    //     var_dump($data['dat']);
    //     // $this->template->load('bug','print/lager',$data);
    // }

    public function res()
    {
        $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
        $id_kelas = $kelas[0]['id_kelas'];
        $kd_mapel = $this->uri->segment('3');
        $data['list'] = $this->Mdl_nilai->getResult($kd_mapel,$id_kelas);
        $data['count'] = count($data['list']);
        $mapel = $this->Mdl_mapel->getByKode($kd_mapel);
        $data['nama_mapel'] = $mapel[0]->nama_mapel;
        $data['kelas'] = $kelas[0]['nama_kelas'];
        $data['guru'] = $this->Mdl_guru->getById($this->session->userdata('eveuser'));
        // $this->template->load('bug','print/lager',$data);
        // var_dump($data['list']);

        // var_dump($this->pdf);
        // $this->pdf->Image(base_url().'asset/dist/img/logo43.png', 0, 0, 210, 297, 'jpg', '', true, false);
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "raport.pdf";
        $html = $this->load->view('print/lager',$data,true);
        $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/tmp']);
        // $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->SetCreator('Kuswandi');
        $mpdf->Output($data['kelas'] . ' | '. $data['nama_mapel'].'.pdf','I');
    }

    public function excel()
    {
        $kelas = $this->Mdl_siswa->myIdKelas($this->session->userdata('eveuser'));
        $id_kelas = $kelas[0]['id_kelas'];
        $kd_mapel = $this->uri->segment('3');
        $data['list'] = $this->Mdl_nilai->getResult($kd_mapel,$id_kelas);
        $data['count'] = count($data['list']);
        $mapel = $this->Mdl_mapel->getByKode($kd_mapel);
        $data['nama_mapel'] = $mapel[0]->nama_mapel;
        $data['kelas'] = $kelas[0]['nama_kelas'];
        $data['guru'] = $this->Mdl_guru->getById($this->session->userdata('eveuser'));
        $nama_kelas = $data['kelas'];
        $nama_mapel = $data['nama_mapel'];
        // Load plugin PHPExcel nya
    include APPPATH.'third_party/PHPExcel.php';

    // Panggil class PHPExcel nya
    $excel = new PHPExcel();
    // Settingan awal fil excel
    $excel->getProperties()->setCreator('My Notes Code')
                 ->setLastModifiedBy('My Notes Code')
                 ->setTitle("Ladger")
                 ->setSubject("Ladger")
                 ->setDescription("Ladger mapel tertentu")
                 ->setKeywords("Ladger");
    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    $style_col = array(
      'font' => array('bold' => true), // Set font nya jadi bold
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );
    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = array(
      'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );
    $excel->setActiveSheetIndex(0)->setCellValue('A1', "Ladger rapor Smk Negeri 43 Jakarta"); // Set kolom A1 dengan tulisan "DATA SISWA"
    $excel->getActiveSheet()->mergeCells('A1:D3'); // Set Merge Cell pada kolom A1 sampai E1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); // Set text center untuk kolom A1
    $excel->setActiveSheetIndex(0)->setCellValue('B5',"Mata Pelajran");
    $excel->setActiveSheetIndex(0)->setCellValue('C5',$data['nama_mapel']);
    $excel->setActiveSheetIndex(0)->setCellValue('B6',"Kelas");
    $excel->setActiveSheetIndex(0)->setCellValue('C6',$data['kelas']);
    $excel->setActiveSheetIndex(0)->setCellValue('B7',"Tahun Ajaran");
    $excel->setActiveSheetIndex(0)->setCellValue('C7',"2018/2019 Genap");


    // Buat header tabel nya pada baris ke 3
    $excel->setActiveSheetIndex(0)->setCellValue('A9', "NO"); // Set kolom A3 dengan tulisan "NO"
    $excel->setActiveSheetIndex(0)->setCellValue('B9', "NIS"); // Set kolom B3 dengan tulisan "NIS"
    $excel->setActiveSheetIndex(0)->setCellValue('C9', "Nama Siswa"); // Set kolom C3 dengan tulisan "NAMA"
    $excel->setActiveSheetIndex(0)->setCellValue('D9', "Nilai Akhir"); // Set kolom D3 dengan tulisan "nilai akhir"
    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $excel->getActiveSheet()->getStyle('A9')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('B9')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('C9')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('D9')->applyFromArray($style_col);
    // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    $numrow = 10; // Set baris pertama untuk isi tabel adalah baris ke 4
    foreach($data['list'] as $data){ // Lakukan looping pada variabel siswa
      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->nis);
      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->nama_siswa);
      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->na);

      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
      $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('A'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $excel->getActiveSheet()->getStyle('B'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $excel->getActiveSheet()->getStyle('D'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

      $no++; // Tambah 1 setiap kali looping
      $numrow++; // Tambah 1 setiap kali looping
    }
    // Set width kolom
    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(45); // Set width kolom C
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D

    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
    // Set orientasi kertas jadi LANDSCAPE
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    // Set judul file excel nya
    $excel->getActiveSheet(0)->setTitle("Ledger");
    $excel->setActiveSheetIndex(0);
    // Proses file excel
    // $nama_kelas = $data['kelas'];
    // $nama_mapel = $data['nama_mapel'];

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Ledger_'.$nama_kelas.'_'.$nama_mapel.'.xlsx"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');
    }
}
