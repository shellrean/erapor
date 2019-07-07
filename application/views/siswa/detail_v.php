<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Siswa
  </h1>
</section>

<!-- Main content -->
<section class="content">

<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
      	<h3 class="box-title">Detail siswa</h3>
		<div class="box-tools pull-right">
		<?= anchor('siswa','<i class="fa fa-arrow-left"></i>',array('type'=>'button', 'class'=>'btn btn-box-tool', 'data-widget'=>'back', 'data-toggle'=>'tooltip', 'title'=>'Back')); ?>
		<?= anchor('siswa/cetakIdentitas/'.$konten[0]->nis,'<i class="fa fa-print"></i>',array('type'=>'button','class' => 'btn btn-box-tool','title' => 'Cetak','target'=>'_blank'));?>
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
      </div>  
    </div> 
    <div class="box-body">
    	<table class="table table-striped table-hover">
			<tbody>
				<?php
					//$no = 1;
					foreach ($konten as $k0 => $v0) {
						$id_siswa  		= $v0->id_siswa;
						$nis 			= $v0->nis;
						$nama   		= $v0->nama_siswa;
						$temp_lahir 	= $v0->temp_lahir;
						$tgl_lahir 		= $v0->tgl_lahir;
						$agama          = $v0->kd_agama;
						$j_kelamin		= $v0->j_kelamin;
						$status_keluarga= $v0->status_keluarga;
						$anak_ke 		= $v0->anak_ke;
						$alamat 		= $v0->alamat;
						$telp 			= $v0->telp;
						$asal_sekolah 	= $v0->asal_sekolah;
						$kelas_diterima	= $v0->kelas_diterima;
						$tgl_diterima 	= $v0->tgl_diterima;
						$nama_ayah 		= $v0->nama_ayah;
						$nama_ibu 		= $v0->nama_ibu;
						$alamat_orangtua= $v0->alamat_orangtua;
						$pekerjaan_ayah = $v0->pekerjaan_ayah;
						$pekerjaan_ibu 	= $v0->pekerjaan_ibu;
						$nama_wali 		= $v0->nama_wali;
						$alamat_wali 	= $v0->alamat_wali;
						$telp_wali 		= $v0->telp_wali;
						$pekerjaan_wali = $v0->pekerjaan_wali;
						$foto 			= $v0->foto;
				?>
				<tr>
				    <td rowspan="13">
				      <img src="<?= base_url(); ?>assets/foto/<?= $foto ?>" class="img-rounded" width="90px">
				    </td>
			  	</tr>
				<tr>
					<td width="15%">NIS</td>
					<td>:</td>
					<td width="34%"><?= $nis; ?></td>
					<td width="15%">Diterima dikelas</td>
					<td>:</td>
					<td width="34%"><?= $kelas_diterima; ?></td>
				</tr>
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td><strong><?= $nama; ?></strong></td>
					<td>Tanggal diterima</td>
					<td>:</td>
					<td><?= $tgl_diterima; ?></td>
				</tr>
				<tr>
					<td>Tempat Lahir</td>
					<td>:</td>
					<td><?= $temp_lahir; ?></td>
					<td>Nama ayah</td>
					<td>:</td>
					<td><?= $nama_ayah; ?></td>
				</tr>
				<tr>
					<td>Tanggal Lahir</td>
					<td>:</td>
					<td><?= $tgl_lahir; ?></td>
					<td>Nama ibu</td>
					<td>:</td>
					<td><?= $nama_ibu; ?></td>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td>:</td>
					<td>
						<?php
						if ($j_kelamin=='L') {
							echo "Laki-laki";
						}
						else {
							echo "Perempuan";
						}
						?>						
					</td>
					<td>Alamat orangtua</td>
					<td>:</td>
					<td><?= $alamat_orangtua; ?></td>
				</tr>
				<tr>
					<td>Agama</td>
					<td>:</td>
					<td>
						<?= $agama; ?>
					</td>
					<td>No Telp Rumah</td>
					<td>:</td>
					<td><?= $telp; ?></td>
				</tr>
				<tr>
					<td>Status Keluarga</td>
					<td>:</td>
					<td><?= $status_keluarga; ?></td>
					<td>Pekerjaan Ayah</td>
					<td>:</td>
					<td><?= $pekerjaan_ayah; ?></td>
				</tr>
				<tr>
					<td>Anak Ke</td>
					<td>:</td>
					<td><?= $anak_ke; ?></td>
					<td>Pekerjaan Ibu</td>
					<td>:</td>
					<td><?= $pekerjaan_ibu; ?></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>:</td>
					<td><?= $alamat; ?></td>
					<td>Nama Wali</td>
					<td>:</td>
					<td><?= $nama_wali; ?></td>
				</tr>
				<tr>
					<td>Telp</td>
					<td>:</td>
					<td><?= $telp; ?></td>
					<td>Alamat Wali</td>
					<td>:</td>
					<td><?= $alamat_wali; ?></td>
				</tr>
				<tr>
					<td>Sekolah Asal</td>
					<td>:</td>
					<td><?= $asal_sekolah; ?></td>
					<td>Telp wali</td>
					<td>:</td>
					<td><?= $telp_wali; ?></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Pekerjaan Wali</td>
					<td>:</td>
					<td><?= $pekerjaan_wali; ?></td>
				</tr>
				<?php } ?>
			</tbody>

		</table>
	</div>
</div>

</section>

<script type="text/javascript">
	function konfirmasi() {
		tanya = confirm("Anda yakin ingin menghapus data ini ?");
		if (tanya==true) return true;
        else return false;
    }
</script>