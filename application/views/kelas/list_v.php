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
      <h3 class="box-title">Daftar kelas</h3>

      <div class="box-tools pull-right">
        <?php echo anchor('kelas/add', '<i class="fa fa-plus-square"></i>', 'class="btn btn-box-tool" data-toggle="tooltip" title="Tambah Data"'); ?>
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
      </div>
    </div> 
    <div class="box-body">
      <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
        <thead>
            <tr>
              <th>No.</th>
              <th>NAMA KELAS</th>
              <th>TINGKAT</th>
              <th>JURUSAN</th>
              <th>WALI KELAS</th>
              <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach($all as $kelas): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $kelas['nama_kelas'] ?></td>
                <td><?= $kelas['tingkat'] ?></td>
                <td><?= $kelas['nama_jurusan'] ?></td>
                <td><?= $kelas['nama_guru'] ?></td>
                <td>
                    <a href="<?= base_url() ?>kelas/delete/<?= $kelas['id_kelas'] ?>" class="btn btn-danger btn-xs" title="Delete" onclick="return konfirmasi_hapus()"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            <?php $no++; endforeach ?>
        </tbody>
      </table>
    </div>
  </div>

</section>
<!-- Custom Konfirmasi -->
<script src="<?php echo base_url(); ?>assets/bower_components/konfirmasi/js/konfirmasi_hapus.js"></script>