<link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/iCheck/all.css">
<section class="content-header">
  <h1>
    Ekstrakurikuler
  </h1>
</section>

<section class="content">

        <div class="box">
            <div class="box-header with-border">
            <h3 class="box-title">Ekstrakurikuler</h3>

            <div class="box-tools pull-right">
            <?= anchor('ekskul/add_anggota', '<i class="fa fa-plus-square"></i>', 'class="btn btn-box-tool" data-toggle="tooltip" title="Tambah Data"'); ?>
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
        </div> 
        <div class="box-body">
            <?php
            $atribut_form = array(
                'class' => 'form-horizontal form-label-left',
                'novalidate'=> '',
                'data-parsley-validate'=>''
                );
                echo form_open('ekskul/add_anggota', $atribut_form);
            ?>
            <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <select name="ekskul" id="" class="form-control">
                        <?php foreach ($ekskul as $e): ?>
                            <option value="<?= $e->kd_ekskul ?>"><?= $e->nama_ekskul ?></option>
                        <?php endforeach ?>
                        </select>
                    </tr>
                </thead>
                <tbody>
                </thead>
                <?php $no=1; foreach($siswa as $s): ?>
                    <tr>
                        <td class="w-1"><input name="nis[]" value="<?= $s->nis ?>" type="checkbox" class="flat-red"></td>
                        <td class="w-10"><?= $s->nis  ?></td>
                        <td><?= $s->nama_siswa ?></td>
                        <input type="hidden" name="kd_kelas[]" value="<?= $id_kelas ?>">
                    </tr>
                <?php $no++; endforeach ?>
                <tr>
                    <td colspan="3">
                    <button type="submit" name="submit" class="btn btn-success btn-xm" onclick="return konfirmasi_tambah();"><i class="fa fa-save"></i> SIMPAN</button>
                    <?php 
                        $back = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '';
                        echo anchor($back,'<i class="fa fa-share"></i> KEMBALI',array('class'=>'btn btn-danger btn-xm'));
                    ?>
                    </td>
                </tr>
                </tbody>
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