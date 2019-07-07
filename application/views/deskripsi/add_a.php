

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Catatan
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah catatan</h3>

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
        echo form_open('deskripsi/add/'.$siswa[0]->nis, $atribut_form);
      ?>
      <div class="col-md-12">
        <div class="col-md-6">
          <div class="form-group">
            <label class="col-sm-3 control-label">Nama Siswa</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="namasiswa" value="<?= $siswa[0]->nama_siswa ?>" readonly="">
              <input type="hidden" name="nis" value="<?= $siswa[0]->nis ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Catatan Akademik</label> <div class="col-sm-9">
              <textarea name="catatan_akademik" id="" cols="30" rows="5" class="form-control" placeholder="Masukkan catatan disini...."></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Perkembangan Karakter</label> <div class="col-sm-9">
              <textarea name="catatan_karakter" id="" cols="30" rows="5" class="form-control" placeholder="Masukkan catatan Perkembangan karakter disini...."></textarea>
            </div>
          </div>
          <label class="col-sm-3"></label>
          <div class="col-sm-9">
            <button type="submit" name="simpan" class="btn btn-success btn-xm" onclick="return konfirmasi_tambah();"><i class="fa fa-save"></i> SIMPAN</button>
            <?php 
              $back = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '';
              echo anchor($back,'<i class="fa fa-share"></i> KEMBALI',array('class'=>'btn btn-danger btn-xm'));
            ?>
          </div>
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
<script>
  $(function () {

    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
  })
</script>