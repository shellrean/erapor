<!DOCTYPE html>
<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/dist/img/brand.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/print.css">
    <title>rapot | SMKN 43 JAKARTA</title>
</head>
<body class="sis lower">
    <div class="wrap-a4 pd-2"> 
        <div class="wrap-content">  
            <div class="header-info mb-2">
                RAPOR PESERTA DIDIK <br>
                SEKOLAH MENENGAH KEJURUAN <br>
                (SMK)
            </div>
            <div class="centered sizes">
                <img src="<?= base_url() ?>assets/dist/img/logo1.png" alt="" class="logo mt-2">

                <div>
                    <strong>Nama Peserta didik:</strong> 
                    <div class="input mt-1 mb-8">
                        <?= $siswa[0]->nama_siswa ?>
                    </div>  
                    <strong>NISN:</strong>
                    <div class="input mt-1">
                        <?= $siswa[0]->nisn ?>
                    </div>
                </div>
            </div>
            <div class="header-info mt-top">
                KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN  <br>
                REPUBLIK INDONESIA
            </div>
        </div>
    </div>

    <div class="arap-test">
    <div class="text-center pd-2 page_break">
    <h3>KETERANGAN TENTANG DIRI PESERTA DIDIK</h3><br> 
 
    </div> 
    <table width="100%" id="alamat"> 
    <tr>
        <td style="width: 5%;">1.</td>
        <td style="width: 28%;">Nama Siswa (Lengkap)</td>
        <td style="width: 2%;">:</td>
        <td style="width: 65%"><span class="uper"><?= $siswa[0]->nama_siswa ?></span></td>
    </tr>
    <tr>
        <td style="width: 5%;">2.</td>
        <td style="width: 28%;">Nomor Induk/NISN</td>
        <td style="width: 2%;">:</td>
        <td style="width: 65%"><?= $siswa[0]->nis.' / '.$siswa[0]->nisn ?></td>
    </tr>
    <tr>
        <td style="width: 5%;">3.</td>
        <td style="width: 28%;">Tempat, Tanggal Lahir</td>
        <td style="width: 2%">:</td>
        <td style="width: 65%"><?= $siswa[0]->temp_lahir.' , '.$siswa[0]->tgl_lahir ?></td>
    </tr>
    <tr>
        <td style="width: 5%;">4.</td>
        <td style="width: 28%;">Jenis Kelamin</td>
        <td style="width: 2%">:</td>
        <?php if($siswa[0]->j_kelamin == 'L'){$jk = 'Laki-laki';}else{$jk='Perempuan';} ?>
        <td style="width: 65%"><?= $jk ?></td>
    </tr>
    <tr>
        <td style="width: 5%;">5.</td>
        <td style="width: 28%;">Agama</td>
        <td style="width: 2%">:</td>
        <td style="width: 65%"><?= $siswa[0]->kd_agama ?></td>
    </tr>
    <tr>
        <td style="width: 5%;">6.</td>
        <td style="width: 28%;">Status dalam Keluarga</td>
        <td style="width: 2%">:</td>
        <td style="width: 65%"><?= $siswa[0]->status_keluarga ?></td>
    </tr>
    <tr>
        <td style="width: 5%;">7.</td>
        <td style="width: 28%;">Anak Ke</td>
        <td style="width: 2%">:</td>
        <td style="width: 65%"><?= $siswa[0]->anak_ke ?></td>
    </tr>
    <tr>
        <td style="width: 5%;">8.</td>
        <td style="width: 28%;">Alamat Siswa</td>
        <td style="width: 2%">:</td>
        <td style="width: 65%"><?= $siswa[0]->alamat ?></td>
    </tr>
    <tr>
        <td style="width: 5%;">9.</td>
        <td style="width: 28%;">Nomor Telepon Rumah</td>
        <td style="width: 2%">:</td>
        <td style="width: 65%"><?= $siswa[0]->telp ?></td>
    </tr>
    <tr>
        <td style="width: 5%;">10.</td>
        <td style="width: 28%;">Sekolah Asal</td>
        <td style="width: 2%">:</td>
        <td style="width: 65%"><?= $siswa[0]->asal_sekolah ?></td>
    </tr>
    <tr>
        <td style="width: 5%;">11.</td>
        <td style="width: 28%;">Diterima di sekolah ini</td>
        <td style="width: 2%"></td>
        <td style="width: 65%"></td>
    </tr>
    <tr>
        <td style="width: 5%;">&nbsp;</td>
        <td style="width: 28%;">Di kelas</td>
        <td style="width: 2%">:</td>
        <td style="width: 65%"><?= $siswa[0]->kelas_diterima ?></td>
    </tr>
    <tr>
        <td style="width: 5%;">&nbsp;</td>
        <td style="width: 28%;">Pada tanggal</td>
        <td style="width: 2%">:</td>
        <td style="width: 65%"><?= $siswa[0]->tgl_diterima ?></td>
    </tr>
    <tr>
        <td style="width: 5%;">&nbsp;</td>
        <td style="width: 28%;">Nama Orang Tua</td>
        <td style="width: 2%">:</td>
        <td style="width: 65%">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 5%;">&nbsp;</td>
        <td style="width: 28%;">a. Ayah</td>
        <td style="width: 2%">:</td>
        <td style="width: 65%"><?= $siswa[0]->nama_ayah ?></td>
    </tr>
    <tr>
        <td style="width: 5%;">&nbsp;</td>
        <td style="width: 28%;">b. Ibu</td>
        <td style="width: 2%">:</td>
        <td style="width: 65%"><?= $siswa[0]->nama_ibu ?></td>
    </tr>
    <tr>
        <td style="width: 5%;">12.</td>
        <td style="width: 28%;">Alamat Orang Tua</td>
        <td style="width: 2%">:</td>
        <td style="width: 65%"><?= $siswa[0]->alamat_orangtua ?></td>
    </tr>
    <tr>
        <td style="width: 5%;">&nbsp;</td>
        <td style="width: 28%;">Nomor Telepon Rumah</td>
        <td style="width: 2%">:</td>
        <td style="width: 65%"><?= $siswa[0]->tlp_ortu ?></td>
    </tr>
    <tr>
        <td style="width: 5%;">13.</td>
        <td style="width: 28%;">Pekerjaan Orang Tua</td>
        <td style="width: 2%">:</td>
        <td style="width: 65%">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 5%;">&nbsp;</td>
        <td style="width: 28%;">a. Ayah</td>
        <td style="width: 2%">:</td>
        <td style="width: 65%"><?= $siswa[0]->pekerjaan_ayah ?></td>
    </tr>
    <tr>
        <td style="width: 5%;">&nbsp;</td>
        <td style="width: 28%;">b. Ibu</td>
        <td style="width: 2%">:</td>
        <td style="width: 65%"><?= $siswa[0]->pekerjaan_ibu ?></td>
    </tr>
    <tr>
        <td style="width: 5%;">14.</td>
        <td style="width: 28%;">Nama Wali Siswa</td>
        <td style="width: 2%">:</td>
        <td style="width: 65%"><?= $siswa[0]->nama_wali ?></td>
    </tr>
    <tr>
        <td style="width: 5%;">15.</td>
        <td style="width: 28%;">Alamat Wali Siswa</td>
        <td style="width: 2%">:</td>
        <td style="width: 65%"><?= $siswa[0]->alamat_wali ?></td>
    </tr>
    <tr>
        <td style="width: 5%;">&nbsp;</td>
        <td style="width: 28%;">Nomor Telepon Rumah</td>
        <td style="width: 2%">:</td>
        <td style="width: 65%"><?= $siswa[0]->telp_wali ?></td>
    </tr>
    <tr>
        <td style="width: 5%;">16.</td>
        <td style="width: 28%;">Pekerjaan Wali Siswa</td>
        <td style="width: 2%">:</td>
        <td style="width: 65%"><?= $siswa[0]->pekerjaan_wali ?></td>
    </tr>
    </table>
    <table width="100%" class="mt-4">
    <tr>
        <td style="width: 35%;padding:5px;" rowspan="5">
        </td>
        <td style="width: 15%;padding:5px;" rowspan="5" colspan="5">
        -
            <!-- <table width="100%" border="1">
                <tr>
                    <td align="center" style="padding-top:50px; padding-bottom:50px;">Pas Foto<br>3 x 4</td>
                </tr>
            </table> -->
        </td>
        <td style="width: 15%;" rowspan="5">&nbsp;</td>
        <td style="width: 50%;">JAKARTA, <?= $siswa[0]->tgl_diterima ?></td>
    </tr>
    <tr>
        <td style="width: 50%;">Kepala Sekolah</td>
    </tr>
    <tr>
        <td style="width: 50%;padding:30px 0;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 50%;">Drs. Ismunanto, M.M.  </td>
    </tr>
    <tr>
        <td style="width: 50%;">NIP.1961051619890310003</td>
    </tr>
    </table>
    </div>
</body>
</html>