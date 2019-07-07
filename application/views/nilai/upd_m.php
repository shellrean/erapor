 <!-- Content Header (Page header) -->
 <section class="content-header">
  <h1>
    Nilai
  </h1>
</section>
<!-- Main content -->
<section class="content">
<?= $this->session->flashdata('message') ?>


    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
        <h3 class="box-title"> <?= $nama_mapel ?></h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
            <i class="fa fa-minus"></i></button> 
        </div>
        </div> 
        <div class="box-body">
          <table class="table table-striped table-responsive table-hover">
            <thead>
              <tr>
                <th class="centered">No.</th>
                <th class="centered">NIS</th>
                <th>NAMA SISWA</th>
                <th>Bobot (p:k)</th>
                <th>TIPE</th>
                <th class="centered">TUGAS</th>
                <th class="centered">HARIAN</th>
                <th class="centered">PTS</th>
                <th class="centered">PAS</th>
                <th class="centered">KETERAMPILAN</th>
              </tr>
            </thead> 
              <?php $no = 1; foreach($list as $s): ?>
                <tr>
                  <form action="<?= base_url() ?>nilai/upd_s" method="post">
                    <td class="centered"><?= $no ?></td>
                    <input type="hidden" name="nis" value="<?= $s->nis ?>">
                    <input type="hidden" name="kd_mapel" value="<?= $kd_mapel ?>">
                    <td class="centered"><?= $s->nis ?></td>
                    <td><?= $s->nama_siswa ?></td>
                    <td>
                      <select name="bobot" id="">
                        <option value="50-50" <?= ($s->bobot == '50-50') ? 'selected' : '' ?>>50 : 50</option>
                        <option value="60-40" <?= ($s->bobot == '60-40') ? 'selected' : '' ?>>60 : 40</option>
                        <option value="40-60" <?= ($s->bobot == '40-60') ? 'selected' : '' ?>>40 : 60</option>
                        <option value="70-30" <?= ($s->bobot == '70-30') ? 'selected' : '' ?>>70 : 30</option>
                        <option value="30-70" <?= ($s->bobot == '30-70') ? 'selected' : '' ?>>30 : 70</option>
                      </select>
                    </td>
                    <td>
                      <select name="tipe">
                        <option value="A" <?= ($tipe == 'A') ? 'selected' : ''?>>A</option>
                        <option value="B" <?= ($tipe == 'B') ? 'selected' : ''?>>B</option>
                        <option value="C" <?= ($tipe != 'A' && $tipe != 'B' ) ? 'selected' : '' ?>>C</option>
                      </select>
                    </td>
                    <td class="centered">
                      <input type="number" name="tgs" value="<?= $s->tgs ?>" style="width:35px">
                    </td>
                    <td class="centered">
                      <input type="number" name="ph" value="<?= $s->ph ?>" style="width:35px">
                    </td>
                    <td class="centered">
                      <input type="number" name="pts" value="<?= $s->pts ?>" style="width:35px">
                    </td>
                    <td class="centered">
                      <input type="number" name="pas" value="<?= $s->pas ?>" style="width:35px"> 
                    </td>
                    <td class="centered">
                      <input type="number" name="pk" value="<?= $s->pk ?>" style="width:35px">
                    </td>
                    <td>
                      <button type="submit" class="btn btn-success btn-xs">Update</button>
                    </td>
                    </form>
                </tr>
              <?php $no++; endforeach; ?>

          </table>
        </div>
    </div>
</section>