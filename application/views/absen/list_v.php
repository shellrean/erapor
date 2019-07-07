<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/all.css">

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Absen
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah absen</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
      </div>
    </div> 
    <div class="box-body">
      <!-- form start -->
      <?php
      $atribut_form = array(
        'class' => 'form-horizontal form-label-left',
        'novalidate'=> '',
        'data-parsley-validate'=>''
        );
        echo form_open('absen/input/'.$id_kelas, $atribut_form);
      ?>
      <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
        <thead>
            <tr>
              <th width="50">No.</th>
              <th>NIS</th>
              <th>NAMA</th>
              <th>SAKIT</th>
              <th>IZIN</th>
              <th>ALPA</th>  
            </tr>
        </thead>
        <tbody>

        <?php $no = 1; foreach($siswa as $s): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $s->nis ?></td>
                <td><?= $s->nama_siswa ?></td>
                <td>
                    <input type="text" name="sakit[]" value="0" class="form-control w-40">
                </td>
                <td>
                    <input type="text" name="izin[]" value="0" class="form-control w-40">
                </td>
                <td>
                    <input type="text" name="alpa[]" value="0" class="form-control w-40">
                </td>
            </tr>
            <input type="hidden" name="nis[]" value="<?= $s->nis ?>">
            <input type="hidden" name="id_kelas[]" value="<?= $id_kelas ?>">
        <?php $no++; endforeach ?>
            <tr>
                <td colspan="6">
                    <button type="submit" name="simpan" class="btn btn-success btn-xm" onclick="return konfirmasi_tambah();"><i class="fa fa-save"></i> SIMPAN</button>
                    <?php 
                    $back = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '';
                    echo anchor($back,'<i class="fa fa-share"></i> KEMBALI',array('class'=>'btn btn-danger btn-xm'));
                    ?>
                </td>
            </tr>
        </tbody>
      </table>

      <!-- /.box-footer -->
      <?php 
        echo form_close();
      ?>
    </div>
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->

<!-- Custom Konfirmasi -->
<script src="<?php echo base_url(); ?>assets/bower_components/konfirmasi/js/konfirmasi_tambah.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    //Date picker
    $('#datepicker').datepicker({
      format: "dd-mm-yyyy",
      autoclose: true,
      orientation: "bottom auto",
    });
    $("#mydate").datepicker({
      format: "dd-mm-yyyy",
      autoclose: true,
      orientation: "auto top",
    }).datepicker("setDate", new Date()
    );
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
  })
</script>