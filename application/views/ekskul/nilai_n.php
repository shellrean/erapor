<section class="content-header">
  <h1>
    Ekstrakurikuler
  </h1>
</section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
            <h3 class="box-title"><?= $nama_ekskul[0]->nama_ekskul ?></h3>

            <div class="box-tools pull-right">
                <?= anchor('ekskul/add_anggota', '<i class="fa fa-plus-square"></i>', 'class="btn btn-box-tool" data-toggle="tooltip" title="Tambah Data"'); ?>
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div> 
        <?php
            $atribut_form = array(
                'class' => 'form-horizontal form-label-left',
                'novalidate'=> '',
                'data-parsley-validate'=>''
                );
            echo form_open('ekskul/add_nilai/'.$kd_ekskul, $atribut_form);
        ?>
        <div class="box-body">
            <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th class="w-1">No.</th>
                    <th>NIS</th>
                    <th>NAMA SISWA</th>
                    <th>NILAI</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach($siswa as $s): ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $s->nis ?></td>
                        <input type="hidden" name="nis[]" value="<?= $s->nis ?>">
                        <input type="hidden" name="kd_ekskul[]" value="<?= $kd_ekskul ?>">
                        <input type="hidden" name="id_kelas" value="<?= $id_kelas ?>">
                        <td><?= $s->nama_siswa ?></td>
                        <td class="w-30">
                            <input type="text" class="form-control" name="nilai[]" value="B">
                        </td>
                    </tr>
                <?php $no++; endforeach ?>
                    <tr>
                        <td colspan="4">
                            <button type="submit" name="submit" class="btn btn-success" onclick="return konfirmasi_simpan();"><i class="fa fa-save"></i> SIMPAN</button>
                            <?php 
                            $back = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '';
                            echo anchor($back,'<i class="fa fa-share"></i> KEMBALI',array('class'=>'btn btn-danger'));
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?= form_close() ?>
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