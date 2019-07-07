<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Guru
  </h1>
</section>

<!-- Main content -->
<section class="content">

<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
      	<h3 class="box-title">Detail guru</h3>

      	<div class="box-tools pull-right">
      	<?php
			echo anchor('siswa','<i class="fa fa-arrow-left"></i>',array('type'=>'button', 'class'=>'btn btn-box-tool', 'data-widget'=>'back', 'data-toggle'=>'tooltip', 'title'=>'Back'));
		?>
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
      </div>
    </div> 
    <div class="box-body">
    	<table class="table table-striped table-hover">
			<tbody>
				<?php
					//$no = 1;
					foreach ($konten as $k0 => $v0) {
						$id_guru  		= $v0->id_guru;
						$nuptk 			= $v0->nuptk;
						$nama   		= $v0->nama_guru;
						$j_kelamin		= $v0->jenis_kelamin;
						$username		= $v0->username;
				?>
				<tr>
				    <td rowspan="5" width="15%">
				      <img src="<?php echo base_url(); ?>assets/foto/folio.png" class="img-rounded" width="90px">
				    </td>
			  	</tr>
				<tr>
					<td width="15%">NUPTK</td>
					<td width="1%">:</td>
					<td><?= $nuptk; ?></td>
				</tr>

				<tr>
					<td>Nama</td>
					<td>:</td>
					<td><strong><?= $nama; ?></strong></td>
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
				</tr>
				<tr>
					<td>Username</td>
					<td>:</td>
					<td><?= $username; ?></td>
				</tr>
				<?php } ?>
			</tbody>

		</table>
	</div>
</div>
<!-- /.box -->

</section>
<!-- /.content -->

<script type="text/javascript" language="JavaScript" >
	function konfirmasi() {
		tanya = confirm("Anda yakin ingin menghapus data ini ?");
		if (tanya==true) return true;
        else return false;
    }
</script>