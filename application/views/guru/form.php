<script>
	$(document).ready(function(){
		$("#kosong").hide();
    });
</script>

<section class="content-header">
  <h1>
    Guru
  </h1>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah guru</h3>
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
        echo "<form method='post' action='".base_url("Guru/import")."'>";
                                
        // Buat sebuah div untuk alert validasi kosong
        echo "<div style='color: red;' id='kosong'>
        Data belum diisi sepenuhnya, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
        </div>";
                                
        echo "<table class='table table-striped table-bordered'>
        <tr>
            <th colspan='23'>Preview Data</th>
        </tr>
        <tr>
            <th>NUPTK</th>
            <th>NAMA GURU</th>
            <th>JENIS KELAMIN</th>
            <th>USERNAME</th>
            <th>PASSWORD</th>
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
        $nuptk = $row['A'];
        $nama_guru = $row['B'];
        $jenis_kelamin = $row['C'];
        $username = $row['D'];
        $password = password_hash($row['E'],PASSWORD_DEFAULT);
                                    
        /* Cek jika semua data tidak diisi */
        if(empty($nis) && empty($nama) && empty($jenis_kelamin) && empty($alamat))
        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
                                    
        /* ---------------------------------------------------
         * Cek $numrow apakah lebih dari 1
         * Artinya karena baris pertama adalah nama-nama kolom
         * Jadi dilewat saja, tidak usah diimport
         * ---------------------------------------------------
         */
        if($numrow > 1){
            /* Validasi apakah semua data telah diisi */
            $numptk_td = ( ! empty($nuptk))? "" : " style='background: #E07171;'";
            $nama_guru_td = ( ! empty($nama_guru))? "" : " style='background: #E07171;'";
            $jk_td = ( ! empty($jenis_kelamin))? "" : " style='background: #E07171;'";
            $username_td = ( ! empty($username))? "" : " style='background: #E07171;'";
            $password_td = ( ! empty($password))? "" : " style='background: #E07171;'";

            /* Jika salah satu data ada yang kosong */
            if(empty($nuptk) or empty($nama_guru) or empty($jenis_kelamin) or empty($username) or empty($password)){
                $kosong++; /* Tambah 1 variabel $kosong */
            }
                                        
            echo "<tr>";
            echo "<td".$numptk_td.">".$nuptk."</td>";
            echo "<td".$nama_guru_td.">".$nama_guru."</td>";
            echo "<td".$jk_td.">".$jenis_kelamin."</td>";
            echo "<td".$username_td.">".$username."</td>";
            echo "<td".$password_td.">".$password."</td>";
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
            echo "<a href='".base_url("/Guru")."' class='btn btn-default'>Cancel</a>";
            
        }
        echo "</form>";
        }
        ?>
        </div>
    </section>
