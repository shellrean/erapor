<!-- Content Header (Page header) --> 
<section class="content-header">
  <h1>
    Nilai siswa
  </h1>
</section>
 
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header with-border">
        <h3 class="box-title"> Hasil Nilai</h3>

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
                        <th>No.</th>
                        <th>NIS</th>
                        <th>NAMA SISWA</th>
                        <th>PENGETAHUAN</th>
                        <th>PREDIKAT</th>
                        <th>KETERAMPILAN</th>
                        <th>PREDIKAT</th>
                    </tr>
                </thead>
                
                <?php $no=1; foreach($list as $l): ?>
                    <tr> 
                        <td><?= $no ?></td>
                        <td><?= $l->nis ?></td>
                        <td><?= $l->nama_siswa ?></td>
                        <td><?= $l->nilai_p ?></td>
                        <td><?= $l->pp ?></td>
                        <td><?= $l->nilai_k ?></td>
                        <td><?= $l->pk ?></td>
                    </tr>
                <?php $no++; endforeach ?>
            </table>
        </div>
    </div>
</section>