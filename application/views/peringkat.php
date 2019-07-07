
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Peringkat kelas
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Peringkat </h3>

      <div class="box-tools pull-right">
        <?= anchor('peringkat/print', '<i class="fa fa-print"></i>', 'class="btn btn-box-tool" data-toggle="tooltip" title="Print" target="_blank"'); ?>
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
              <th>NIS</th>
              <th>NAMA SISWA</th>
              <th>JUMLAH NILAI</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; foreach($peringkat as $p): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $p->nis ?></td>
                <td><?= $p->nama_siswa ?></td>
                <td><?= $p->per ?></td>
            </tr>
        <?php $no++; endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- /.box -->

</section>