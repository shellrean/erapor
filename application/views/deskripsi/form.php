<script>
	$(document).ready(function(){
		$("#kosong").hide();
    });
</script>

<section class="content-header">
  <h1>
    Catatan
  </h1>
</section>
 
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah catatan</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
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
        echo "<form method='post' action='".base_url("deskripsi/import")."'>";
                                
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
            <th colspan='3'>NAMA SISWA</th>
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

        /* Ambil data pada excel sesuai Kolom */
        $nis = $row['A'];
        $nama_siswa = $row['B'];
        $karakter = $row['C'];
        $akademik = $row['D'];
        $integritas = $row['E'];
        $religius = $row['F'];
        $nasionalis = $row['G'];
        $mandiri = $row['H'];
        $gotong = $row['I'];

                                    
        /* Cek jika semua data tidak diisi */
        if(empty($nis) && empty($nama_siswa) && empty($karakter) && empty($akademik) && empty($integritas) && empty($religius) && empty($nasionalis) && empty($mandiri) && empty($gotong))
        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
                                    
        /* ---------------------------------------------------
         * Cek $numrow apakah lebih dari 1
         * Artinya karena baris pertama adalah nama-nama kolom
         * Jadi dilewat saja, tidak usah diimport
         * ---------------------------------------------------
         */
        if($numrow > 1){
            /* Validasi apakah semua data telah diisi */
            $nis_td = ( ! empty($nis))? "" : " style='background: #E07171;'";
            $nama_siswa_td = ( ! empty($nama_siswa))? "" : " style='background: #E07171;'";
            $karakter_td = ( ! empty($karakter))? "" : " style='background: #E07171;'";
            $akademik_td = ( ! empty($akademik))? "" : " style='background: #E07171;'";
            $integritas_td = ( ! empty($integritas))? "" : " style='background: #E07171;'";
            $religius_td = ( ! empty($religius))? "" : " style='background: #E07171;'";
            $nasionalis_td = ( ! empty($nasionalis))? "" : " style='background: #E07171;'";
            $mandiri_td = ( ! empty($mandiri))? "" : " style='background: #E07171;'";
            $gotong_td = ( ! empty($gotong))? "" : " style='background: #E07171;'";

            /* Jika salah satu data ada yang kosong */
            if(empty($nis) or empty($nama_siswa) or empty($karakter) or empty($akademik) or empty($integritas) or empty($religius) or empty($nasionalis) or empty($mandiri) or empty($gotong)){
                $kosong++; /* Tambah 1 variabel $kosong */
            }
                                        
            echo "<tr>";
            echo "<td rowspan='9'".$nis_td.">".$nis."</td>";
            echo "<td rowspan='9'".$nama_siswa_td.">".$nama_siswa."</td>";
            echo "</tr><tr>";
            echo "<th>KARAKTER</th><th>AKADEMIK</th>";
            echo "</tr><tr>";
            echo "<td".$karakter_td.">".$karakter."</td>";
            echo "<td".$akademik_td.">".$akademik."</td>";
            echo "</tr><tr>";
            echo "<th>INTEGRITAS</th><th>RELIGIUS</th>";
            echo "</tr><tr>";
            echo "<td".$integritas_td.">".$integritas."</td>";
            echo "<td".$religius_td.">".$religius."</td>";
            echo "</tr><tr>";
            echo "<th>NASIONALIS</th><th>MANDIRI</th>";
            echo "</tr><tr>";
            echo "<td".$nasionalis_td.">".$nasionalis."</td>";
            echo "<td".$mandiri_td.">".$mandiri."</td>";
            echo "</tr><tr>";
            echo "<th>GOTONG-ROYONG</th>";
            echo "</tr><tr>";
            echo "<td".$gotong_td.">".$gotong."</td>";
            echo "<tr><td colspan='6'></td></tr>";
            echo "</tr>";
        }
        $numrow++; /* Tambah 1 setiap kali looping */
        }
                                
        echo "</table>";
                                
        /* -----------------------------------------------------
         * Cek apakah variabel kosong lebih dari 0
         * Jika lebih dari 0, berarti ada data yang masih kosong
         * -----------------------------------------------------
         */
        if($kosong > 0){
        ?>
        <script>
            $(document).ready(function(){
                // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                $("#jumlah_kosong").html('<?= $kosong; ?>');
                $("#kosong").show(); // Munculkan alert validasi kosong
            });
        </script>
        <?php
        }else{ // Jika semua data sudah diisi
            echo "<hr>";

            // Buat sebuah tombol untuk mengimport data ke database
            echo "<button type='submit' name='import' class='btn btn-info'>Import</button>";
            $back = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '';
            echo anchor($back,'Cancel',array('class'=>'btn btn-default btn-xm'));
            
        }
        echo "</form>";
        }
        ?>
        </div>
    </section>
