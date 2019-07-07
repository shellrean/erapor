<section class="content-header">
  <h1>
    Raport
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Cetak raport</h3>

      <div class="box-tools pull-right">
        <!-- <a href="<?= base_url() ?>Cetak/cover" class="btn btn-box-tool" title="Cetak Cover" target="_blank"><i class="fa fa-file"></i></a> -->
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
        <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="50px">No.</th>
                    <th>NIS</th>
                    <th>NAMA SISWA</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach($siswa as $s): ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $s->nis ?></td>
                    <td><?= $s->nama_siswa ?></td>
                    <td>
                        <a target="_blank" href="<?= base_url() ?>cetak/printout/<?= $s->nis ?>" class="fa fa-print text-ses"></a>
                    </td>
                </tr>
                <?php $no++; endforeach ?>
            </tbody>
        </table>
      <!-- /.box-footer -->
      <?= form_close(); ?>
    </div>
  </div>
  <!-- /.box -->

</section>
<script>
  $(function () {
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
  })
</script>