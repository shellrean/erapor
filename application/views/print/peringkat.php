<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/print.css">
    <title>Print | Perignkat</title>
</head>
<body>
    <h2 class="centered">DAFTAR PERINGKAT KELAS</h2>
    <table class="w-20">
        <tr>
            <td>Nama Kelas</td>
            <td>:</td>
            <td><?= $kelas[0]['nama_kelas'] ?></td>
        </tr>
    </table>
    <table class="bordered">
        <tr>
            <th>No.</th>
            <th>NIS</th>
            <th>NAMA SISWA</th>
            <th>JUMLAH NILAI</th>
            <th>RATA RATA </th>
        </tr>
        <?php $no = 1; foreach($peringkat as $p): ?>
            <tr>
            <?php $rata = $p->per/$p->jumlah;
             $nil = number_format($rata,2); ?>
                <td><?= $no ?></td>
                <td><?= $p->nis ?></td>
                <td><?= $p->nama_siswa ?></td>
                <td class="centered"><?= $p->per ?></td>
                <td class="centered"><?= $nil ?></td>
            </tr>
        <?php $no++; endforeach; ?>
    </table>
            <table class="mt-2">
                <tr>
                    <td>&nbsp;</td>
                    <td><div class="space">&nbsp;</div></td>
                    <td class="w-100">
                        <table>
                            <tr><td>Jakarta , 28 Juni 2019</td></tr>
                            <tr><td>Wali Kelas,</td></tr>
                            <tr><td><br><br><br><br><br></td></tr>
                            <tr><td><?= $guru[0]->nama_guru ?></td></tr>
                            <tr><td>NIP. <?= $guru[0]->nuptk ?> </td></tr>
                        </table>
                    </td>
                </tr>
            </table>

</body>
</html>