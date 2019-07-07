<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/iCheck/all.css">

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
      <h3 class="box-title">Tambah Siswa</h3>

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
        echo form_open('siswa/add', $atribut_form);
      ?>
      <div class="col-md-12">
        <div class="col-md-6">
          <div class="form-group">
            <label class="col-sm-3 control-label">NIS</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nis" placeholder="Nomor Induk Siswa">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">NISN</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nisn" placeholder="Nomor Induk Siswa Nasional">
            </div>
          </div> 
          <div class="form-group">
            <label class="col-sm-3 control-label">Nama</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nama_siswa" placeholder="Nama Lengkap Siswa">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Tempat, Tanggal Lahir</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="temp_lahir" placeholder="Tempat Lahir Siswa">
            </div>
            <div class="col-sm-4">
              <input type="date" class="form-control" name="tgl_lahir" placeholder="Tanggal Lahir Siswa">
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
            <label for="inputPassword3" class="col-sm-3 control-label">Agama</label>
            <div class="col-sm-9">
              <?= cmb_dinamis('agama', 'tbl_agama', 'nama_agama', 'nama_agama'); ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Status Keluarga</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="status_keluarga" placeholder="Status dalam keluarga">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Anak Ke</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" name="anak_ke" placeholder="Anak" min="1">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Alamat</label>
            <div class="col-sm-9">
              <textarea class="form-control" name="alamat" placeholder="Alamat siswa"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Telp</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="telp" placeholder="Telepon">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Asal Sekolah</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="asal_sekolah" placeholder="Asal Sekolah Siswa">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Tanggal Diterima</label>
            <div class="col-sm-9">
              <input type="date" class="form-control" id="mydate" name="tgl_diterima" placeholder="Tanggal diterima">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Kelas Diterima</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" name="kelas_diterima" placeholder="Diterima di kelas?" min="1">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="col-sm-3 control-label">Nama Ayah</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nama_ayah" placeholder="Nama Lengkap Ayah">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Nama Ibu</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nama_ibu" placeholder="Nama Lengkap Ibu">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Alamat Orang Tua</label>
            <div class="col-sm-9">
              <textarea class="form-control" name="alamat_orangtua" placeholder="Alamat Orang tua"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Pekerjaan Ayah</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="pekerjaan_ayah" placeholder="Pekerjaan Ayah">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Pekerjaan Ibu</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="pekerjaan_ibu" placeholder="Pekerjaan Ibu">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Telp. Ortu</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="telp_ortu" placeholder="Telp orang tua">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Nama Wali</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nama_wali" placeholder="Nama Wali Siswa">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Alamat Wali</label>
            <div class="col-sm-9">
              <textarea class="form-control" name="alamat_wali" placeholder="Alamat Wali"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Telp. Wali</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="telp_wali" placeholder="Telepon Wali">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Pekerjaan Wali</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="pekerjaan_wali" placeholder="Pekerjaan Wali">
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Foto</label>
            <div class="col-sm-9">
              <input type="file" name="foto">
            </div>
          </div>
        </div>
        <div class="form-group col-md-12">
        <label class="col-sm-2"></label>
          <div class="col-sm-4">
            <button type="submit" name="submit" class="btn btn-info btn-xm" onclick="return konfirmasi_tambah();"><i class="fa fa-save"></i> SAVE</button>
            <?php 
              $back = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '';
              echo anchor($back,'<i class="fa fa-share"></i> KEMBALI',array('class'=>'btn btn-danger btn-xm'));
            ?>
          </div>
        </div>
      </div>
      <!-- /.box-footer -->
      <?= form_close(); ?>
    </div>
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->

<!-- Custom Konfirmasi -->
<script src="<?php echo base_url(); ?>assets/bower_components/konfirmasi/js/konfirmasi_tambah.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
  })
</script>