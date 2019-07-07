<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/all.css">

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
      <h3 class="box-title">Tambah guru</h3>

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
        echo form_open('guru/add', $atribut_form);
      ?>
      <div class="col-md-12">
        <div class="col-md-6">
          <div class="form-group">
            <label class="col-sm-3 control-label">NIP</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nuptk" placeholder="Masukkan NIP">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Nama guru</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nama_guru" placeholder="Masukkan Nama Guru">
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Jenis Kelamin</label>
            <div class="col-sm-3">
              <label>
                <input type="radio" name="j_kelamin" value="L" class="flat-red" checked> Laki-laki
              </label>
            </div>
            <div class="col-sm-3">
              <label>
                <input type="radio" name="j_kelamin" value="P" class="flat-red"> Perempuan
              </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Username</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="username" placeholder="Masukkan Username">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Password</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" name="password" placeholder="Masukkan Password">
            </div>
          </div>
        </div>
        <div class="form-group col-md-12">
        <label class="col-sm-2"></label>
          <div class="col-sm-4">
            <button type="submit" name="submit" class="btn btn-success btn-xm" onclick="return konfirmasi_tambah();"><i class="fa fa-save"></i> SIMPAN</button>
            <?php 
              $back = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '';
              echo anchor($back,'<i class="fa fa-share"></i> KEMBALI',array('class'=>'btn btn-danger btn-xm'));
            ?>
          </div>
        </div>
      </div>
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