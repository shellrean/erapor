<section class="content-header">
  <h1>
    Ekstrakurikuler
  </h1>
</section>

<section class="content">

        <div class="box">
            <div class="box-header with-border">
            <h3 class="box-title">Pilih Ekstrakurikuler</h3>

            <div class="box-tools pull-right">
            <?= anchor('ekskul/add_anggota', '<i class="fa fa-plus-square"></i>', 'class="btn btn-box-tool" data-toggle="tooltip" title="Tambah Data"'); ?>
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
        </div> 
        <div class="box-body">
            <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
                <?php $no=1; foreach($ekskul as $m): ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><a href="<?= base_url() ?>ekskul/x/<?= $m->kd_ekskul ?>">
                                <?= $m->nama_ekskul ?>
                            </a>
                        </td>
                    </tr>
                <?php $no++; endforeach ?>
            </table>
        </div>
</section>
<script src="<?= base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
  })
</script>