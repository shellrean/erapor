<script>
	$(document).ready(function(){
		$("#kosong").hide();
    });
</script>

<section class="content-header">
  <h1>
    PKL
  </h1>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah pkl</h3>
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
        echo "<form method='post' action='".base_url("pkl/import")."'>";
        echo "<input type='hidden' name='id_kelas' value='".$id_kelas."'>";
                                
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
            <th>NIS</th>
            <th>NAMA SISWA</th>
            <th>MITRA DU/DI</th>
            <th>LOKASI</th>
            <th>LAMA</th>
            <th>KETERANGAN</th>
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
        $nis = $row['A'];
        $nama_siswa = $row['B'];
        $dudi = $row['C'];
        $lokasi = $row['D'];
        $lama = $row['E'];
        $ket = $row['F'];
                                    
        /* Cek jika semua data tidak diisi */
        if(empty($nis) && empty($nama_siswa) && empty($dudi) && empty($lokasi) && empty($lama) && empty($ket))
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
            $nama_td = ( ! empty($nama_siswa))? "" : " style='background: #E07171;'";
            $dudi_td = ( ! empty($dudi))? "" : " style='background: #E07171;'";
            $lokasi_td = ( ! empty($lokasi))? "" : " style='background: #E07171;'";
            $lama_td = ( ! empty($lama))? "" : " style='background: #E07171;'";
            $ket_td = ( ! empty($ket))? "" : " style='background: #E07171;'";

            /* Jika salah satu data ada yang kosong */
            if(empty($nis) or empty($nama_siswa) or empty($dudi) or empty($lokasi) or empty($lama)){
                $kosong++; /* Tambah 1 variabel $kosong */
            }
                                        
            echo "<tr>";
            echo "<td>".$no."</td>";
            echo "<td".$nis_td.">".$nis."</td>";
            echo "<td".$nama_td.">".$nama_siswa."</td>";
            echo "<td".$dudi_td.">".$dudi."</td>";
            echo "<td".$lokasi_td.">".$lokasi."</td>";
            echo "<td".$lama_td.">".$lama."</td>";
            echo "<td".$ket_td.">".$ket."</td>";
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
            echo "<a href='".base_url("/pkl/upl")."' class='btn btn-default'>Cancel</a>";
            
        }
        echo "</form>";
        }
        ?>
        </div>
    </section>
