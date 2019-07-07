<script>
	$(document).ready(function(){
		$("#kosong").hide();
    });
</script>

<section class="content-header">
  <h1>
    Siswa
  </h1>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah Siswa</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> 
          <i class="fa fa-minus"></i>
        </button>
      </div>
    </div> 
    <div class="box-body scrool">
    <?php
        /* ---------------------------------------------------
         * Validasi
         * --------------------------------------------------
         * Jika user menekan tombol preview pada form
         * masuk kepada validasi error 
         * tampilkan pesan error dan stop skrip
         * @return true
         */
            if(isset($_POST['preview'])){
            if(isset($upload_error)){
                echo "<div style='color: red;'>".$upload_error."</div>";
                die;
            }
                                
        // Buat sebuah tag form untuk proses import data ke database
        echo "<form method='post' action='".base_url("Siswa/import")."'>";
                                
        // Buat sebuah div untuk alert validasi kosong
        echo "<div style='color: red;' id='kosong'>
        Data belum diisi sepenuhnya, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
        </div>";
                                
        echo "<table class='table table-striped table-bordered'>
        <tr>
            <th colspan='23'>Preview Data</th>
        </tr>
        <tr>
            <th>NIS</th>
            <th>NAMA SISWA</th>
            <th>JK</th>
            <th>KOTA LAHIR</th>
            <th>TANGGAL LAHIR</th>
            <th>AGAMA</th>
            <th>STATUS</th>
            <th>ANAK KE</th>
            <th>ALAMAT PESERTA DIDIK</th>
            <th>TELP RUMAH</th>
            <th>ASAL SEKOLAH</th>
            <th>DITERIMA DIKELAS</th>
            <th>TANGGAL DITERIMA</th>
            <th>NAMA AYAH</th>
            <th>NAMA IBU</th>
            <th>ALAMAT ORTU</th>
            <th>TELP ORTU</th>
            <th>PEKERJAAN AYAH</th>
            <th>PEKERJAAN IBU</th>
            <th>NAMA WALI</th>
            <th>ALAMAT WALI</th>
            <th>TELP WALI</th>
            <th>PEKERJAAN WALI</th>
        </tr>"; 
                                
        $numrow = 1;
        $kosong = 0;
                                
        /* ----------------------------------------------------
         * PERULANGAN
         * ---------------------------------------------------- 
         * Lakukan perulangan dari data yang ada di excel
         * $sheet adalah variabel yang dikirim dari controller
         */
        foreach($sheet as $row){ 

        // Ambil data pada excel sesuai Kolom
        $nis = $row['A'];
        $nisn = $row['B'];
        $nama = $row['C'];
        $jenis_kelamin = $row['D'];
        $k_lahir = $row['E'];
        $t_lahir = $row['F'];
        $agama = $row['G'];
        $status = $row['H'];
        $anak = $row['I'];
        $a_pdidik = $row['J'];
        $tlp_pdidik = $row['K'];
        $asal_sekolah = $row['L'];
        $pd_kelas = $row['M'];
        $tgl_diterima = $row['N'];
        $n_ayah = $row['O'];
        $n_ibu = $row['P'];
        $a_ortu = $row['Q'];
        $tlp_ortu = $row['R'];
        $p_ayah = $row['S'];
        $p_ibu = $row['T'];
        $wali = $row['U'];
        $a_wali = $row['V'];
        $tlp_wali = $row['W'];
        $p_wali = $row['X'];
                                    
        // Cek jika semua data tidak diisi
        if(empty($nis) && empty($nama) && empty($jenis_kelamin) && empty($alamat))
        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
                                    
        // Cek $numrow apakah lebih dari 1
        // Artinya karena baris pertama adalah nama-nama kolom
        // Jadi dilewat saja, tidak usah diimport
        if($numrow > 1){
            // Validasi apakah semua data telah diisi
            $nis_td = ( ! empty($nis))? "" : " style='background: #E07171;'";
            $nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'";
            $jk_td = ( ! empty($jenis_kelamin))? "" : " style='background: #E07171;'";
            $k_lahir_td = ( ! empty($k_lahir))? "" : " style='background: #E07171;'";
            $t_lahir_td = ( ! empty($t_lahir))? "" : " style='background: #E07171;'";
            $agama_td = ( ! empty($agama))? "" : " style='background: #E07171;'";                       
            $status_td = ( ! empty($status))? "" : " style='background: #E07171;'";
            $anak_td = ( ! empty($anak))? "" : " style='background: #E07171;'";
            $a_pdidik_td = ( ! empty($a_pdidik))? "" : " style='background: #E07171;'";
            $tlp_pdidik_td = ( ! empty($tlp_pdidik))? "" : " style='background: #E07171;'";
            $asal_sekolah_td = ( ! empty($asal_sekolah))? "" : " style='background: #E07171;'";
            $pd_kelas_td = ( ! empty($pd_kelas))? "" : " style='background: #E07171;'";
            $tgl_diterima_td = ( ! empty($tgl_diterima))? "" : " style='background: #E07171;'";
            $n_ayah_td = ( ! empty($n_ayah))? "" : " style='background: #E07171;'";
            $n_ibu_td = ( ! empty($n_ibu))? "" : " style='background: #E07171;'";
            $a_ortu_td = ( ! empty($a_ortu))? "" : " style='background: #E07171;'";
            $tlp_ortu_td = ( ! empty($tlp_ortu))? "" : " style='background: #E07171;'";
            $p_ayah_td = ( ! empty($p_ayah))? "" : " style='background: #E07171;'";
            $p_ibu_td = ( ! empty($p_ibu))? "" : " style='background: #E07171;'";
            $wali_td = ( ! empty($wali))? "" : " style='background: #E07171;'";
            $a_wali_td = ( ! empty($a_wali))? "" : " style='background: #E07171;'";
            $tlp_wali_td = ( ! empty($tlp_wali))? "" : " style='background: #E07171;'";
            $p_wali_td = ( ! empty($p_wali))? "" : " style='background: #E07171;'";

            // Jika salah satu data ada yang kosong
            if(empty($nis) or empty($nama) or empty($jenis_kelamin) or empty($a_pdidik) or empty($k_lahir) or empty($t_lahir) or empty($agama) or empty($status) or empty($anak) or empty($tlp_pdidik) or empty($asal_sekolah) or empty($pd_kelas) or empty($tgl_diterima)){
                $kosong++; // Tambah 1 variabel $kosong
            }
                                        
            echo "<tr>";
            echo "<td".$nis_td.">".$nis."</td>";
            echo "<td".$nama_td.">".$nama."</td>";
            echo "<td".$jk_td.">".$jenis_kelamin."</td>";
            echo "<td".$k_lahir_td.">".$k_lahir."</td>";
            echo "<td".$t_lahir_td.">".$t_lahir."</td>";
            echo "<td".$agama_td.">".$agama."</td>";
            echo "<td".$status_td.">".$status."</td>";
            echo "<td".$anak_td.">".$anak."</td>";
            echo "<td".$a_pdidik_td.">".$a_pdidik."</td>";
            echo "<td".$tlp_pdidik_td.">".$tlp_pdidik."</td>";
            echo "<td".$asal_sekolah_td.">".$asal_sekolah."</td>";
            echo "<td".$pd_kelas_td.">".$pd_kelas."</td>";
            echo "<td".$tgl_diterima_td.">".$tgl_diterima."</td>";
            echo "<td".$n_ayah_td.">".$n_ayah."</td>";
            echo "<td".$n_ibu_td.">".$n_ibu."</td>";
            echo "<td".$a_ortu_td.">".$a_ortu."</td>";
            echo "<td".$tlp_ortu_td.">".$tlp_ortu."</td>";
            echo "<td".$p_ayah_td.">".$p_ayah."</td>";
            echo "<td".$p_ibu_td.">".$p_ibu."</td>";
            echo "<td".$wali_td.">".$wali."</td>";
            echo "<td".$a_wali_td.">".$a_wali."</td>";
            echo "<td".$tlp_wali_td.">".$tlp_wali."</td>";
            echo "<td".$p_wali_td.">".$p_wali."</td>";
            echo "</tr>";
        }
        $numrow++; // Tambah 1 setiap kali looping
        }
                                
        echo "</table>";
                                
        // Cek apakah variabel kosong lebih dari 0
        // Jika lebih dari 0, berarti ada data yang masih kosong
        if($kosong > 0){
        ?>
        <script>
            $(document).ready(function(){
                // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                $("#jumlah_kosong").html('<?php echo $kosong; ?>');
                $("#kosong").show(); // Munculkan alert validasi kosong
            });
        </script>
        <?php
        }else{ // Jika semua data sudah diisi
            echo "<hr>";

            // Buat sebuah tombol untuk mengimport data ke database
            echo "<button type='submit' name='import' class='btn btn-info'>Import</button>";
            echo "<a href='".base_url("/Siswa")."' class='btn btn-default'>Cancel</a>";
            
        }
        echo "</form>";
        }
        ?>
        </div>
    </section>
