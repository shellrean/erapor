<script>
	$(document).ready(function(){
		$("#kosong").hide();
    });
</script>

<section class="content-header">
  <h1>
    Mapel
  </h1>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah mapel</h3>
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
        echo "<form method='post' action='".base_url("mapel/import")."'>";
                                
        // Buat sebuah div untuk alert validasi kosong
        echo "<div style='color: red;' id='kosong'>
        Data belum diisi sepenuhnya, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
        </div>";
                                
        echo "<table class='table table-striped table-bordered'>
        <tr>
            <th colspan='23'>Preview Data</th>
        </tr>
        <tr>
            <th>NO.</th>
            <th>KODE MAPEL</th>
            <th>NAMA MAPEL</th>
            <th>ID KELAS</th>
            <th>KELOMPOK</th>
        </tr>";
                                
        $numrow = 1;
        $kosong = 0;
        $no = 0;
                                
        /* ----------------------------------------------------
         * PERULANGAN
         * ---------------------------------------------------- 
         * Lakukan perulangan dari data yang ada di excel
         * $sheet adalah variabel yang dikirim dari controller
         */
        foreach($sheet as $row){ 

        /* Ambil data pada excel sesuai Kolom */
        $kdmapel = $row['A'];
        $namamapel = $row['B'];
        $idkelas = $row['C'];
        $kelompok = $row['D'];
                                    
        /* Cek jika semua data tidak diisi */
        if(empty($kdmapel) && empty($namamapel) && empty($idkelas) && empty($kelompok))
        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
                                    
        /* ---------------------------------------------------
         * Cek $numrow apakah lebih dari 1
         * Artinya karena baris pertama adalah nama-nama kolom
         * Jadi dilewat saja, tidak usah diimport
         * ---------------------------------------------------
         */
        if($numrow > 1){
            /* Validasi apakah semua data telah diisi */
            $kdmapel_td = ( ! empty($kdmapel))? "" : " style='background: #E07171;'";
            $namamapel_td = ( ! empty($namamapel))? "" : " style='background: #E07171;'";
            $idkelas_td = ( ! empty($idkelas))? "" : " style='background: #E07171;'";
            $k_td = ( ! empty($kelompok))? "" : " style='background: #E07171;'";
            /* Jika salah satu data ada yang kosong */
            if(empty($kdmapel) or empty($namamapel) or empty($idkelas) or empty($kelompok)){
                $kosong++; /* Tambah 1 variabel $kosong */
            }
                                        
            echo "<tr>";
            echo "<td>".$no."</td>";
            echo "<td".$kdmapel_td.">".$kdmapel."</td>";
            echo "<td".$namamapel_td.">".$namamapel."</td>";
            echo "<td".$idkelas_td.">".$idkelas."</td>";
            echo "<td".$k_td.">".$kelompok."</td>";
            echo "</tr>";
        }
        $no++; $numrow++; /* Tambah 1 setiap kali looping */
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
            echo "<a href='".base_url("/mapel")."' class='btn btn-default'>Cancel</a>";
            
        }
        echo "</form>";
        }
        ?>
        </div>
    </section>
