<!DOCTYPE html>
<html lang="en">

<?php
function formatTanggal($tanggal)
{
    // Menggunakan DateTime untuk mendapatkan objek tanggal
    $date = new DateTime($tanggal);

    // Mendapatkan hari dan tahun
    $hari = $date->format('d');
    $tahun = $date->format('Y');

    // Array nama bulan dalam bahasa Indonesia
    $bulanIndo = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];

    // Mendapatkan bulan dalam angka
    $bulan = $date->format('n'); // 'n' untuk bulan tanpa nol di depan

    // Mengembalikan format: hari bulan tahun
    return $hari . ' ' . $bulanIndo[$bulan] . ' ' . $tahun;
}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url(); ?>./assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>./assets/css/print.css">
    <style>
        @page {
            size: A4 portrait;

        }

        body {
            /* font-family: Arial, sans-serif; */
            /* font-size: 13px; */
        }

        .container {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>

</head>


<body>
    <div class="col-11 mx-auto">
        <div class="">
            <center>
                <table width="100%">
                    <tr>
                        <td class="text-center">
                            <img src="<?= base_url() ?>./assets/logo/jpr.png" width="130px" height="130px">
                        </td>
                        <td>
                            <center>
                                <strong>
                                    <h5>PEMERINTAHAN KABUPATEN BANYUMAS</h5>
                                    <h5>KECAMATAN JATILAWANG</h5>
                                    <h5>DESA TUNJUNG</h5>
                                    <small>Jalan Raya Jatilawang - Tunjung | Email :
                                        desatunjungjatilawang@gmail.com</small>
                                </strong>
                            </center>
                        </td>
                    </tr>
                </table>
            </center>
            <br>
            <hr style="border: none; border-top: 2px solid black; margin: 1.5px 0;">
            <hr style="border: none; border-top: 2px solid black; margin: 0;">
            <div class="identitas">
                <?php foreach ($data as $d) { ?>
                    <!-- <p class="text-end fw-bold">
                        <small>
                            <?= $d->tanggal_surat ?>
                        </small>
                    </p> -->
                    <p>
                        <small>
                            Kode Desa : 02032010
                        </small>
                    </p>
                    <span class="text-center">

                        <p style="font-weight: bold;">
                            <u><?= $d->jenis_surat ?></u>
                        </p>
                        <p>Nomor : <?= $d->nomor_surat ?></p>
                    </span>
                <?php } ?>
            </div>
            <div class="text-surat">
                <p>Yang bertanda tangan di bawah ini, kami Kepala Desa Tunjung Kecamatan Jatilawang, Kabupaten Banyumas,
                    Jawa Tengah, menerangkan bahwa:</p>
                <table class="ms-5">
                    <?php foreach ($data as $d) { ?>
                        <tr>
                            <td>Nama Bayi </td>
                            <td>: </td>
                            <td><?= $d->nama_bayi ?></td>
                        </tr>
                        <tr>
                            <td>No. KK</td>
                            <td>: </td>
                            <td><?= $d->no_kk ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>: </td>
                            <td><?= $d->jekel_b ?></td>
                        </tr>
                        <tr>
                            <td>Tempat/Tanggal Lahir</td>
                            <td>: </td>
                            <td><?= $d->tempat_lahir_b ?>, <?= $d->tanggal_lahir_b ?></td>
                        </tr>
                        <tr>
                            <td>Anak Ke</td>
                            <td>: </td>
                            <td><?= $d->anak_ke ?></td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap Orang Tua</td>
                            <td>: </td>
                            <td>Ayah : <?= $d->ayah ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Ibu : <?= $d->ibu ?></td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>: </td>
                            <td><?= $d->agama_b ?></td>
                        </tr>
                        <tr>
                            <td>Kewarganegaraan</td>
                            <td>: </td>
                            <td><?= $d->kewarganegaraan_b ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: </td>
                            <td><?= $d->alamat_b ?></td>
                        </tr>
                    <?php } ?>
                </table>

                <br>

                <p>Demikian Surat Pengantar Akte Kelahiran ini dibuat agar digunakan
                    sebagaimana mestinya.</p>
                <br>
                <br>
                <div class=" float-end">
                    <div class="col-8 float-end" style="padding:0 !important; margin:0; >
                        <span class=" mb-n2">Tunjung, <?= formatTanggal(date('d M Y')) ?></span>
                        <p>KEPALA DESA TUNJUNG</p>

                        <div class="mx-auto" style="position: relative; padding: 0; margin: 0;" class='col-10'>
                            <img src="<?= base_url($signature['pathSignature']) ?>" class="" style=" style="
                                text-align:center; filter: contrast(150%); display: block; margin: 0 auto; z-index: 1;
                                height: auto;" width="200">
                            <img src="<?= base_url($signature['pathStempel']) ?>" width="150" class="" style="opacity: 0.8; position: absolute; top: -10%; left: -30%;  margin-top:
                                -5px; z-index: 2; height: auto;">
                            <p class="fw-bold"
                                style="text-align:center; margin-top: -5px; z-index:2; text-transform: uppercase;">
                                <?= $signature['namaLurah'] ?>
                            </p>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
    </div>
    <script src="<?= base_url(); ?>./assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>