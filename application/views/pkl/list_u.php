<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/iCheck/all.css">

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    PKL
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">PKL</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"title="Collapse">
          <i class="fa fa-minus"></i>
        </button>
      </div>
    </div> 
    <div class="box-body">
        <?php
        $atribut_form = array(
            'class' => 'form-horizontal form-label-left',
            'novalidate'=> '',
            'data-parsley-validate'=>''
            );
            echo form_open('pkl/update', $atribut_form);
        ?>
        <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
            <thead>
                <th class="w-1">No.</th>
                <th>NAMA SISWA</th>
                <th>MITRA DU/DI</th>
                <th>LOKASI</th>
                <th>LAMANYA</th>
                <th>KETERANGAN</th>
            </thead>

            <?php $no = 1; foreach($siswa as $s): ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $s->nama_siswa ?></td>
                    <input type="hidden" name="nis[]" value="<?= $s->nis ?>">
                    <input type="hidden" name="id_kelas" value="<?= $id_kelas ?>">
                    <td>
                        <input type="text" name="dudi[]" class="form-control" placeholder="Nama DU/DI" value="<?= $s->dudi ?>">
                    </td>
                    <td>
                        <input type="text" name="lokasi[]" class="form-control" placeholder="Lokasi" value="<?= $s->lokasi ?>">
                    </td>
                    <td>
                        <input type="text" name="lama[]" class="form-control" placeholder="Lama" value="<?= $s->lama ?>">
                    </td>
                    <td>
                        <input type="text" name="keterangan[]" class="form-control" placeholder="Keterangan" value="<?= $s->keterangan ?>">
                    </td>
                </tr>
            <?php $no++; endforeach ?>
                <tr>
                    <td colspan="5">
                        <input type="submit" value="SIMPAN" class="btn btn-success" name="submit">
                    </td>
                </tr>
        </table>        
        <?= form_close(); ?>
    </div>
  </div>

</section>

<script src="<?= base_url(); ?>assets/bower_components/konfirmasi/js/konfirmasi_tambah.js"></script>
<script src="<?= base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
  })
</script>