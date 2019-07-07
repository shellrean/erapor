<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/all.css">

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Kelas
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah kelas</h3>

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
        echo form_open('kelas/add', $atribut_form);
      ?>
      <div class="col-md-12">
        <div class="col-md-6">
          <div class="form-group">
            <label class="col-sm-3 control-label">Nama Kelas</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nama_kelas" placeholder="Masukkan Nama Kelas">
            </div>
          </div>

          <div class="form-group">
              <label for="" class="col-sm-3 control-label">Jurusan</label>
              <div class="col-sm-9">
                  <select name="jurusan" id="" class="form-control">
                      <?php foreach ($jurusan as $j): ?>
                        <option value="<?= $j->kd_jurusan ?>"><?= $j->nama_jurusan ?></option>
                      <?php endforeach ?>
                  </select>
              </div>
          </div>
          <div class="form-group">
              <label for="" class="col-sm-3 control-label">Guru</label>
              <div class="col-sm-9">
                  <select name="guru" id="" class="form-control">
                      <?php foreach ($guru as $g): ?>
                        <option value="<?= $g->id_guru ?>"><?= $g->nama_guru ?></option>
                      <?php endforeach ?>
                  </select>
              </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Tingkat</label>
            <div class="col-sm-3">
              <label>
                <input type="radio" name="tingkat" value="10" class="flat-red" checked> 10
              </label>
            </div>
            <div class="col-sm-3">
              <label>
                <input type="radio" name="tingkat" value="11" class="flat-red"> 11
              </label>
            </div>
            <div class="col-sm-3">
              <label>
                <input type="radio" name="tingkat" value="12" class="flat-red"> 12
              </label>
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
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
  })
</script>