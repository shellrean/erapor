<!-- Content Header (Page header) --> 
<style>
    .centered {text-align: center;}
</style>
<section class="content-header">
  <h1>
    Nilai siswa
  </h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
        <h3 class="box-title"><?= $nama_mapel ?></h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
        </div> 
        <div class="box-body">
            <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th class="centered">No.</th>
                    <th class="centered">NIS</th>
                    <th>NAMA SISWA</th>
                    <th class="centered">TUGAS</th>
                    <th class="centered">HARIAN</th>
                    <th class="centered">PTS</th>
                    <th class="centered">PAS</th>
                    <th class="centered">KETERAMPILAN</th>
                    <th class="centered">NILAI AKHIR</th>
                    <th class="centered">PREDIKAT</th>
                </tr>
                </thead>
                <?php $no = 1; foreach($list as $s): ?>
                    <tr>
                        <td class="centered"><?= $no ?></td>
                        <td class="centered"><?= $s->nis ?></td>
                        <td><?= $s->nama_siswa ?></td>
                        <td class="centered"><?= $s->tgs ?></td>
                        <td class="centered"><?= $s->ph ?></td>
                        <td class="centered"><?= $s->pts ?></td>
                        <td class="centered"><?= $s->pas ?></td>
                        <td class="centered"><?= $s->pk ?></td>
                        <td class="centered"><?= $s->na ?></td>
                        <td class="centered"><?= $s->predikat ?></td>
                    </tr>
                <?php $no++; endforeach; ?>
            </table>
        </div>
    </div>
</section>
