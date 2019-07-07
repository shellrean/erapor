<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/all.css">

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Data Sekolah
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit data sekolah</h3>

      <div class="box-tools pull-right">
        <a href="printout/raport" target="_blank" class="btn btn-box-tool"><i class="fa fa-book"></i></a>
        <a href="printout/infoSekolah" target="_blank" class="btn btn-box-tool"><i class="fa fa-print"></i></a>
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"title="Collapse">
          <i class="fa fa-minus"></i>
        </button>
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
        echo form_open('sekolah/index', $atribut_form);
      ?>
      <div class="col-md-12">
        <div class="col-md-6">
          <div class="form-group">
            <label class="col-sm-3 control-label">Nama Sekolah</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nama_sekolah" placeholder="Nama Lengkap Sekolah" value="<?= $info['nama_sekolah']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">NPSN</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="npsn" placeholder="NPSN" value="<?= $info['NPSN']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">NIS/NSS/NDS</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nds" placeholder="NIS/NSS/NDS" value="<?= $info['NDS']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Alamat Sekolah</label>
            <div class="col-sm-9">
              <textarea class="form-control" name="alamat_sekolah" placeholder="Alamat sekolah"><?= $info['alamat_sekolah']; ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Kode Pos</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="kode_pos" placeholder="Kode Pos" value="<?= $info['kode_post']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Telp</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="telp_sekolah" placeholder="Telepon Sekolah" value="<?= $info['telp']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Kelurahan</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="kelurahan" placeholder="Kelurahan" value="<?= $info['kelurahan']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Kecamatan</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="kecamatan" placeholder="Kecamatan" value="<?= $info['kecamatan']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Kota/Kabupaten</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="kota" placeholder="Kota/kabupaten" value="<?= $info['kota']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Provinsi</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="provinsi" placeholder="Provinsi" value="<?= $info['provinsi']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Website</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="website" placeholder="Website" value="<?= $info['website']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">E-mail</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="email" placeholder="Email" value="<?= $info['email']; ?>">
            </div>
          </div>
          <div class="form-group"> 
            <label class="col-sm-3 control-label">Kepala Sekolah</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="kepsek" placeholder="Nama Kepala Sekolah" value="<?= $info['kepsek']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">NIP</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nip" placeholder="NIP" value="<?= $info['nip']; ?>">
            </div>
          </div>
        </div>
        <div class="form-group col-md-12">
        <label class="col-sm-3"></label>
          <div class="col-sm-9">
            <button type="submit" name="submit" class="btn btn-success btn-xm" onclick="return konfirmasi_tambah();"><i class="fa fa-save"></i> SIMPAN</button>
          </div>
        </div>
      </div>
      <!-- /.box-footer -->
      <?=  form_close(); ?>
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