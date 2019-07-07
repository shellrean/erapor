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
      <h3 class="box-title">Tambah nilai</h3>
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
        echo "<form method='post' action='".base_url("nilai/import_u")."'>";
        echo "<input type='hidden' name='kdmapel' value='".$kdmapel."'>";
                                
        // Buat sebuah div untuk alert validasi kosong
        echo "<div style='color: red;' id='kosong'>
        Data belum diisi sepenuhnya, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
        </div>";
                                
        echo "<table class='table table-striped table-bordered'>
        <tr>
            <th colspan='23'>Preview Data</th>
        </tr>
        <tr>
            <th>NO</th>
            <th>NIS</th>
            <th>NAMA</th>
            <th>TUGAS</th>
            <th>PH</th>
            <th>PTS</th>
            <th>PAS</th>
            <th>Keterampilan</th>
            <th>Bobot Pengetahuan</th>
            <th>Bobot Keterampilan</th>
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
        $no = $no;
        $nis = $row['A'];
        $nama = $row['B'];
        $tgs = $row['C'];
        $ph = $row['D'];
        $pts = $row['E'];
        $pas = $row['F'];
        $k = $row['G'];
        $bp = $row['H'];
        $bk = $row['I'];
                                    
        /* Cek jika semua data tidak diisi */
        if(empty($nis) && empty($nama) && empty($tgs) && empty($ph) && empty($pts) && empty($pas) && empty($k) && empty($bp) && empty($bk))
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
            $nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'";
            $tgs_td = ( ! empty($tgs))? "" : " style='background: #E07171;'";
            $ph_td = ( ! empty($ph))? "" : " style='background: #E07171;'";
            $pts_td = ( ! empty($pts))? "" : " style='background: #E07171;'";
            $pas_td = ( ! empty($pas))? "" : " style='background: #E07171;'";
            $k_td = ( ! empty($k))? "" : " style='background: #E07171;'";
            $bp_td = ( ! empty($bp))? "" : " style='background: #E07171;'";
            $bk_td = ( ! empty($bk))? "" : " style='background: #E07171;'";

            /* Jika salah satu data ada yang kosong */
            if(empty($nis) or empty($nama) or empty($tgs) or empty($ph) or empty($pts) or empty($pas) or empty($k) or empty($bp) or empty($bk)){
                $kosong++; /* Tambah 1 variabel $kosong */ 
            }
            echo "<tr>";
            echo "<td>".$no."</td>";
            echo "<td".$nis_td.">".$nis."</td>";
            echo "<td".$nama_td.">".$nama."</td>";
            echo "<td".$tgs_td.">".$tgs."</td>";
            echo "<td".$ph_td.">".$ph."</td>";
            echo "<td".$pts_td.">".$pts."</td>";
            echo "<td".$pas_td.">".$pas."</td>";
            echo "<td".$k_td.">".$k."</td>";
            echo "<td".$bp_td.">".$bp."</td>";
            echo "<td".$bk_td.">".$bk."</td>";
            echo "</tr>"; 
        }
        $no++;
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
            echo "<a href='".base_url("/nilai")."' class='btn btn-default'>Cancel</a>";
        }
        echo "</form>";
        }
        ?>
        </div>
    </section>