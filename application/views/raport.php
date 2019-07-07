
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
<body>
    <div class="wrap-a4 f-13">
        <div class="wrap-content">
            <table class="mb-2">
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td class="w-20">Nama Peserta Didik</td>
                                <td class="w-2">:</td>
                                <td><?= $siswa[0]->nama_siswa ?></td>
                            </tr>
                            <tr>
                                <td>NISN/NIS</td>
                                <td>:</td>
                                <td><?= $siswa[0]->nisn ." / ". $siswa[0]->nis ?></td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td>:</td>
                                <td><?= $kelas[0]['tingkat'] .'-'. $kelas[0]['nama_jurusan'] ?></td>
                            </tr>
                            <tr>
                                <td>Semester</td>
                                <td>:</td>
                                <td>Genap</td>
                            </tr>
                        </table>
                    </td>
                    <!-- <td>
                        <table>
                            <tr>
                                <td>Nama Sekolah</td>
                                <td>:</td>
                                <td>SMKN 43 JAKARTA</td>
                            </tr>
                            <tr>
                                <td>Alamat Sekolah</td>
                                <td>:</td>
                                <td>JL.CIPULIR 1 KEB LAMA</td>
                            </tr>
                        </table>
                    </td> -->
                </tr>
            </table>

            <strong>A.Nilai Akademik</strong>
            <table class="bordered mb-1">
                <tr>
                    <th>No</th>
                    <th>Mata Pelajaran</th>
                    <th class="centered">Pengetahuan</th>
                    <th class="centered">Keterampilan</th>
                    <th class="centered">Nilai Akhir</th>
                    <th class="centered">Predikat</th>
                </tr>
                <!-- <tr>
                    <th  class="centered">Nilai</th>
                    <th class="centered">Predikat</th>
                    <th class="centered">Nilai</th>
                    <th class="centered">Predikat</th>
                </tr> -->


                <tr>
                    <td colspan="6">A. Muatan Nasional</td>
                </tr>
                <?php $no = 1; foreach($NA as $n): ?>
                <tr class="centered">
                    <td class="mid"><?= $no ?></td>
                    <td class="lefted"><?= $n->nama_mapel ?></td>
                    <td class="mid"><?= $n->nilai_p ?></td>
                    <td class="mid"><?= $n->nilai_k ?></td>
                    <td class="mid"><?= $n->na ?></td>
                    <td class="mid"><?= $n->predikat ?></td>
                </tr>
                <?php $no++; endforeach ?>
                <tr>
                    <td colspan="6">B. Muatan Kewilayahan</td>
                </tr>
                <?php $no = 1; foreach($NB as $n): ?>
                <tr class="centered">
                    <td class="mid"><?= $no ?></td>
                    <td class="lefted"><?= $n->nama_mapel ?></td>
                    <td class="mid"><?= $n->nilai_p ?></td>
                    <td class="mid"><?= $n->nilai_k ?></td>
                    <td class="mid"><?= $n->na ?></td>
                    <td class="mid"><?= $n->predikat ?></td>
                </tr>
                <?php $no++; endforeach ?>
                <tr>
                    <td colspan="6">C. Muatan Peminatan Kejuruan</td>
                </tr>
                <?php if(!empty($NC1)): ?>
                <tr>
                    <td colspan="6">C1. Dasar Bidang Keahlian</td>
                </tr>
                <?php $no = 1; foreach($NC1 as $n): ?>
                <tr class="centered">
                    <td class="mid"><?= $no ?></td>
                    <td class="lefted"><?= $n->nama_mapel ?></td>
                    <td class="mid"><?= $n->nilai_p ?></td>
                    <td class="mid"><?= $n->nilai_k ?></td>
                    <td class="mid"><?= $n->na ?></td>
                    <td class="mid"><?= $n->predikat ?></td>
                </tr>
                <?php $no++; endforeach ?>
                <?php endif ?>
                <?php if(!empty($NC2)): ?>
                <tr>
                    <td colspan="6">C2. Dasar Program Keahlian</td>
                </tr>
                <?php $no = 1; foreach($NC2 as $n): ?>
                <tr class="centered">
                    <td class="mid"><?= $no ?></td>
                    <td class="lefted"><?= $n->nama_mapel ?></td>
                    <td class="mid"><?= $n->nilai_p ?></td>
                    <td class="mid"><?= $n->nilai_k ?></td>
                    <td class="mid"><?= $n->na ?></td>
                    <td class="mid"><?= $n->predikat ?></td>
                </tr>
                <?php $no++; endforeach ?>
                <?php endif ?>
                <?php if(!empty($NC3)): ?>
                <tr>
                    <td colspan="6">C3. Kompetensi Keahlian</td>
                </tr>
                <?php $no = 1; foreach($NC3 as $n): ?>
                <tr class="centered">
                    <td class="mid"><?= $no ?></td>
                    <td class="lefted"><?= $n->nama_mapel ?></td>
                    <td class="mid"><?= $n->nilai_p ?></td>
                    <td class="mid"><?= $n->nilai_k ?></td>
                    <td class="mid"><?= $n->na ?></td>
                    <td class="mid"><?= $n->predikat ?></td>
                </tr>
                <?php $no++; endforeach ?>
                <?php endif ?>
                <?php if(!empty($MULOK)): ?>
                <tr>
                    <td colspan="6"> Muatan Lokal</td>
                </tr>
                <?php $no = 1; foreach($MULOK as $n): ?>
                <tr class="centered">
                    <td class="mid"><?= $no ?></td>
                    <td class="lefted"><?= $n->nama_mapel ?></td>
                    <td class="mid"><?= $n->nilai_p ?></td>
                    <td class="mid"><?= $n->nilai_k ?></td>
                    <td class="mid"><?= $n->na ?></td>
                    <td class="mid"><?= $n->predikat ?></td>
                </tr>
                <?php $no++; endforeach ?>
                <?php endif ?>
            </table>

            <strong>B. Catatan Akademik</strong>
            <div class="catatan">
                <?= $catatan[0]->catatan_akademik ?>
            </div>
        </div>
    </div>
    <div class="page_break sis">
        <div class="wrap-content">
           <!-- <table class="mb-2">
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td class="w-20">Nama Peserta Didik</td>
                                <td class="w-2">:</td>
                                <td><?= $siswa[0]->nama_siswa ?></td>
                            </tr>
                            <tr>
                                <td>NISN/NIS</td>
                                <td>:</td>
                                <td><?= $siswa[0]->nisn ." / ". $siswa[0]->nis ?></td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td>:</td>
                                <td><?= $kelas[0]['tingkat'] .'-'. $kelas[0]['nama_jurusan'] ?></td>
                            </tr>
                            <tr>
                                <td>Semester</td>
                                <td>:</td>
                                <td>Ganjil</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                         <table>
                            <tr>
                                <td>Nama Sekolah</td>
                                <td>:</td>
                                <td>SMKN 43 JAKARTA</td>
                            </tr>
                            <tr>
                                <td>Alamat Sekolah</td>
                                <td>:</td>
                                <td>JL.CIPULIR 1 KEB LAMA</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>-->
            <strong>C. Praktik Kerja Lapangan</strong>
            <table class="bordered mb-1">
                <tr>
                    <th class="centered">No.</th>
                    <th>Mitra DU/DI</th>
                    <th>Lokasi</th>
                    <th>Lamanya(bulan)</th>
                    <th>Keterangan</th>
                </tr>
                <?php $no = 1; foreach($pkl as $l): ?>
                <tr>
                    <td class="centered"><?= $no ?></td>
                    <td><?= $l->dudi ?></td>
                    <td><?= $l->lokasi ?></td>
                    <td class="centered"><?= $l->lama ?></td>
                    <td><?= $l->keterangan ?></td>
                </tr>
                <?php $no++; endforeach ?>
            </table>

            <strong>D. Ekstrakurikuler</strong>
            <table class="bordered mb-1">
                <tr>
                    <th>No.</th>
                    <th>Kegiatan Ekstrakurikuler</th>
                    <th>Keterangan</th>
                </tr>
                <?php $no = 1; foreach($ekskul as $e): ?>
                <tr>
                    <td class="centered"><?= $no ?></td>
                    <td>Kegiatan <?= $e->nama_ekskul ?></td>
                    <?php if($e->nilai == 'A'){$t = "Sangat Baik";} elseif($e->nilai == 'B'){$t = "Baik";} elseif($e->nilai == 'C'){$t = "Cukup Baik";}else{$t = "Kurang";} ?>
                    <td>
                        Melaksanakan kegiatan <?= $e->nama_ekskul ?> dengan <strong><?= $t ?></strong>
                    </td>
                </tr>
                <?php $no++; endforeach ?>
            </table>

            <strong>E. Ketidakhadiran</strong>
            <table class="bordered mb-1 w-50">
                <tr>
                    <td class="w-50">Sakit</td><td class="w-1">:</td><td> <?= $ket[0]->sakit ?> hari</td>
                </tr>
                <tr>
                    <td>Izin</td><td>:</td><td> <?= $ket[0]->izin ?> hari</td>
                </tr>
                <tr>
                    <td>Tanpa Keterangan</td><td>:</td><td> <?= $ket[0]->tk ?> hari</td>
                </tr>
            </table>
            <strong>F. Kenaikan Kelas</strong>
            <div class="bordered w-100 mb-1 pd-1">
                <!-- <b>Keputusan:</b> <br>
                Berdasarkan pencapaian seluruh kompetensi peserta didik dinyatakan: <br><br>
                Naik / Tinggal *) Kelas ............. <br><br>
                *) Coret yang tidak perlu -->
                Naik/Tidak naik ke kelas
            </div>
            <table class="mt-2">
                <tr>
                    <td class="w-100">
                        <table>
                            <tr><td>Mengetahui:</td></tr>
                            <tr><td>Orang Tua/Wali,</td></tr>
                            <tr><td><br><br><br><br><br></td></tr>
                            <tr><td>..................................</td></tr>
                        </table>
                    </td>
                    <td><div class="space">&nbsp;</div></td>
                    <td class="w-100">
                        <table>
                            <tr><td>Jakarta , &nbsp;28 Juni 2019</td></tr>
                            <tr><td>Wali Kelas,</td></tr>
                            <tr><td><br><br><br><br><br></td></tr>
                            <tr><td><?= $guru[0]->nama_guru ?></td></tr>
                            <tr><td>NIP. <?= $guru[0]->nuptk ?> </td></tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <!-- -->
                        &nbsp;
                    </td>
                    <td>
                    <table class="centered">
                            <tr><td>Mengetahui,</td></tr>
                            <tr><td>Kepala Sekolah</td></tr>
                            <tr><td><br><br><br><br><br></td></tr>
                            <tr><td><?= $sekolah[0]->kepsek ?></td></tr>
                            <tr><td>NIP. <?= $sekolah[0]->nip ?></td></tr>
                        </table>
                    </td>
                    <td>
                        <!-- -->
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="page_break sis">
        <div class="wrap-content">
        <table class="mb-2">
                <tr>
                <td>
                        <table>
                            <tr>
                                <td class="w-20">Nama Peserta Didik</td>
                                <td class="w-2">:</td>
                                <td><?= $siswa[0]->nama_siswa ?></td>
                            </tr>
                            <tr>
                                <td>NISN/NIS</td>
                                <td>:</td>
                                <td><?= $siswa[0]->nisn ." / ". $siswa[0]->nis ?></td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td>:</td>
                                <td><?= $kelas[0]['tingkat'] .'-'. $kelas[0]['nama_jurusan'] ?></td>
                            </tr>
                            <tr>
                                <td>Semester</td>
                                <td>:</td>
                                <td>Genap</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                         <!-- <table>
                            <tr>
                                <td>Nama Sekolah</td>
                                <td>:</td>
                                <td>SMKN 43 JAKARTA</td>
                            </tr>
                            <tr>
                                <td>Alamat Sekolah</td>
                                <td>:</td>
                                <td>JL.CIPULIR 1 KEB LAMA</td>
                            </tr>
                        </table>  -->
                    </td>
                </tr>
            </table>

            <strong>G. Deskripsi Perkembangan Karakter</strong>
            <table class="bordered mb-1">
                <tr>
                    <th class="w-20">Karakter yang dibangun</th>
                    <th>Deskripsi</th>
                </tr>
                <tr>
                    <td>Integritas</td>
                    <td><?= $catatan[0]->integritas ?></td>
                </tr>
                <tr>
                    <td>Religius</td>
                    <td><?= $catatan[0]->religius ?></td>
                </tr>
                <tr>
                    <td>Nasionalis</td>
                    <td><?= $catatan[0]->nasionalis ?></td>
                </tr>
                <tr>
                    <td>Mandiri</td>
                    <td><?= $catatan[0]->mandiri ?></td>
                </tr>
                <tr>
                    <td>Gotong-royong</td>
                    <td><?= $catatan[0]->gotong ?></td>
                </tr>
            </table>


            <strong>H. Catatan Perkembangan Karakter</strong>
            <div class="catatan">
                <?= $catatan[0]->catatan_karakter ?>
            </div>
            <table class="mt-2">
                <tr>
                    <td>
                        <table>
                            <tr><td>Mengetahui:</td></tr>
                            <tr><td>Orang Tua/Wali,</td></tr>
                            <tr><td><br><br><br><br><br></td></tr>
                            <tr><td>..................................</td></tr>
                        </table>
                    </td>
                    <td><div class="space">&nbsp;</div></td>
                    <td>
                        <table>
                            <tr><td>Jakarta , &nbsp;28 Juni 2019</td></tr>
                            <tr><td>Wali Kelas,</td></tr>
                            <tr><td><br><br><br><br><br></td></tr>
                            <tr><td><?= $guru[0]->nama_guru ?></td></tr>
                            <tr><td>NIP. <?= $guru[0]->nuptk ?></td></tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td>
                        <div class="space"></div>
                        <!-- <table>
                            <tr><td>Mengetahui,</td></tr>
                            <tr><td>Kepala Sekolah</td></tr>
                            <tr><td><br><br><br></td></tr>
                            <tr><td><?= $sekolah[0]->kepsek ?></td></tr>
                            <tr><td>NIP.<?= $sekolah[0]->nip ?></td></tr>
                        </table> -->
                    </td>
                    <td>

                    </td>
                </tr>
            </table>
    </div>
</body>
</html>
