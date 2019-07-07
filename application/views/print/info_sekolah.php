<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= base_url()?>assets/dist/css/print.css">
    <title>Info sekolah</title>
</head>
<body>
    <div class="wrap">
        <div class="header-info mb-2">
            RAPORT PESERTA DIDIK <br>
            SEKOLAH MENENGAH KEJURUAN <br>
            (SMK)
        </div>
        <div class="content-info">
            <table class="pder">
                <tr>
                    <td class="w-20">Nama Sekolah</td>
                    <td class="w-1">:</td>
                    <td><?= $info['nama_sekolah']; ?></td>
                </tr>
                <tr>
                    <td class="w-20">NPSN</td>
                    <td class="w-1">:</td>
                    <td><?= $info['NPSN']; ?></td>
                </tr>
                <tr>
                    <td class="w-20">NIS/NSS/NDS</td>
                    <td class="w-1">:</td>
                    <td><?= $info['NDS']; ?></td>
                </tr>
                <tr>
                    <td rowspan="2" class="text-top w-20">Alamat Sekolah</td>
                    <td class="w-1">:</td>
                    <td><?= $info['alamat_sekolah']; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Kode Pos <?= $info['kode_post']; ?></td>
                    <td>Telp. <?= $info['telp']; ?></td>
                </tr>
                <tr>
                    <td>Kelurahan</td>
                    <td>:</td>
                    <td><?= $info['kelurahan']; ?></td>
                </tr>
                <tr>
                    <td>Kecamatan</td>
                    <td>:</td>
                    <td><?= $info['kecamatan']; ?></td>
                </tr>
                <tr>
                    <td>Kota/Kabupaten</td>
                    <td>:</td>
                    <td><?= $info['kota']; ?></td>
                </tr>
                <tr>
                    <td>Provinsi</td>
                    <td>:</td>
                    <td><?= $info['provinsi']; ?></td>
                </tr>
                <tr>
                    <td>Website</td>
                    <td>:</td>
                    <td><?= $info['website']; ?></td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td>:</td>
                    <td><?= $info['email']; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>