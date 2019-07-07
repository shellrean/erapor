<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Nilai siswa
  </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
        <h3 class="box-title"> Pilih mapel</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
        </div> 
        <div class="box-body">
            <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
                <?php $no=1; foreach($mapel as $m): ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><a href="<?= base_url() ?>nilai/x/<?= $m->kd_mapel ?>">
                                <?= $m->nama_mapel ?>
                            </a>
                        </td>
                    </tr>
                <?php $no++; endforeach ?>
            </table>
        </div>
    </div>
</section>