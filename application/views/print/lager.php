<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/dist/img/brand.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/print.css">
    <title><?= $kelas ?> | <?= $nama_mapel ?></title>
</head>
<body>
    <div class="text-centere">
        Ledger rapor <br> Smk Negeri 43 Jakarta
    </div>
    <table class="w-100 mb-1 f-13">
        <tr >
            <td class="w-10" rowspan="4"><img src="<?= base_url() ?>assets/dist/img/logo43.png" alt="" class="logo-small"></td>
        </tr>
        <tr class="w-50">
            <td class="w-20 ">Mata Pelajaran</td>
            <td class="w-1">:</td>
            <td><?= $nama_mapel ?></td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>:</td>
            <td><?= $kelas ?></td>
        </tr>
        <tr>
            <td>Tahun ajaran</td>
            <td>:</td>
            <td>2018/2019 Genap</td>
        </tr>
    </table>
    <br>
    <table class="bordered smaller">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Nilai Pengetahuan</th>
                <th>Nilai Keterampilan</th>
                <th>Nilai Akhir</th>
                <th>Predikat</th>
            </tr>
        </thead>
        <tbody>
            <?php if($count <= 25): ?>
            <?php $no = 1; foreach($list as $date): ?>
            <tr>
                <td class="centered"> <?= $no ?></td>
                <td class="centered"> <?= $date->nis ?></td>
                <td> <?= $date->nama_siswa ?></td>
                <td class="centered"> <?= $date->nilai_p ?></td>
                <td class="centered"> <?= $date->nilai_k ?></td>
                <td class="centered"> <?= $date->na ?></td>
                <td class="centered"> <?= $date->predikat ?></td>
            </tr>
            <?php $no ++; endforeach; ?>
            <?php else: ?>
            <?php $no=1; for($i=0; $i<25; $i++): ?>
            <tr>
                <td class="centered"> <?= $no ?></td>
                <td class="centered"> <?= $list[$i]->nis ?></td>
                <td> <?= $list[$i]->nama_siswa ?></td>
                <td class="centered"> <?= $list[$i]->nilai_p ?></td>
                <td class="centered"> <?= $list[$i]->nilai_k ?></td>
                <td class="centered"> <?= $list[$i]->na ?></td>
                <td class="centered"> <?= $list[$i]->predikat ?></td>
            </tr>
            <?php $no ++; endfor; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if($count > 25): ?>
    <div class="page_break">
        <table class="bordered smaller">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Nilai Pengetahuan</th>
                    <th>Nilai Keterampilan</th>
                    <th>Nilai Akhir</th>
                    <th>Predikat</th>
                </tr>
            </thead>
            <tbody>
                <?php if($count > 25): ?>
                <?php for($i=25; $i<$count; $i++): ?>
                <tr>
                    <td class="centered"> <?= $no ?></td>
                    <td class="centered"> <?= $list[$i]->nis ?></td>
                    <td> <?= $list[$i]->nama_siswa ?></td>
                    <td class="centered"> <?= $list[$i]->nilai_p ?></td>
                    <td class="centered"> <?= $list[$i]->nilai_k ?></td>
                    <td class="centered"> <?= $list[$i]->na ?></td>
                    <td class="centered"> <?= $list[$i]->predikat ?></td>
                </tr>
                <?php $no ++; endfor; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <table class="w-100">
        <tr>
            <td class="w-50">&nbsp;</td>
            <td class="w-20">&nbsp;</td>
            <td>
                <table class="mt-1 smaller">
                    <tr>
                        <td>
                            Jakarta,
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Wali Kelas
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <?= $guru[0]->nama_guru ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nip: <?= $guru[0]->nuptk ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>
