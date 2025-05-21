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
                <table width="90%" class="mx-auto">
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
            <div class="text-surat col-11 mx-auto">
                <p>Yang bertanda tangan di bawah ini:</p>
                <table class="ms-5">
                    <?php foreach ($data as $d) { ?>
                        <tr>
                            <td>Nama</td>
                            <td>: </td>
                            <td><?= $d->nama ?></td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>: </td>
                            <td><?= $d->nik ?></td>
                        </tr>
                        <tr>
                            <td>Tempat/Tanggal Lahir</td>
                            <td>: </td>
                            <td><?= $d->tempat_lahir ?>, <?= $d->tgl_lahir ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: </td>
                            <td><?= $d->alamat ?></td>
                        </tr>
                        <tr>
                            <td>Hubungan dengan yang meninggal</td>
                            <td>: </td>
                            <td><?= $d->hubungan ?></td>
                        </tr>
                    <?php } ?>
                </table>
                <br>
                <p>Menyatakan bahwa:</p>
                <table class="ms-5">
                    <?php foreach ($data as $d) { ?>
                        <tr>
                            <td>Nama</td>
                            <td>: </td>
                            <td><?= $d->nama_alm ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>: </td>
                            <td><?= $d->jekel_a ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: </td>
                            <td><?= $d->alamat_a ?></td>
                        </tr>
                    <?php } ?>
                </table>
                <br>
                <p>Adalah benar - benar meninggal pada:</p>
                <table class="ms-5">
                    <?php foreach ($data as $d) { ?>
                        <tr>
                            <td>Hari</td>
                            <td>: </td>
                            <td><?= $d->hari ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>: </td>
                            <td><?= $d->tanggal_meninggal ?></td>
                        </tr>
                        <tr>
                            <td>Dimakamkan di</td>
                            <td>: </td>
                            <td><?= $d->tempat_pemakaman ?></td>
                        </tr>
                    <?php } ?>
                </table>
                <br>
                <p style="text-align: justify;">
                    Demikian surat pernyataan ini saya buat dengan sebenar-benarnya dan apabila dikemudian hari
                    ternyata pernyataan saya ini tidak benar, maka saya bersedia diproses secara hukum sesuai
                    peraturan perundang-undangan dan dokumen yangditerbitkan akibat dan pernyataan tidak benar
                    menjadi tidak sah/batal demi hukum.
                </p>

                <br>
                <div class=" float-end">
                  <div class="col-12 text-center" style="padding:0 !important; margin:0;">
                        <span class="mb-2">Tunjung, <?= formatTanggal(date('d M Y')) ?></span>
                        <p>KEPALA DESA TUNJUNG</p>

                        <div class="mx-auto" class='col-12 text-center'>
                            <!-- <img src="<?= base_url($signature['pathSignature']) ?>" class="" style=" style="
                                text-align:center; filter: contrast(150%); display: block; margin: 0 auto; z-index: 1;
                                height: auto;" width="200">
                            <img src="<?= base_url($signature['pathStempel']) ?>" width="150" class="" style="opacity: 0.8; position: absolute; top: -10%; left: -30%;  margin-top:
                                -5px; z-index: 2; height: auto;"> -->
                                 <img src="<?= $qr_image ?>" width="100">
                            <p class="fw-bold"
                                style="text-align:center; margin-top: 5px; z-index:2; text-transform: uppercase;">
                                <?= $signature['namaLurah'] ?>
                            </p>
                        </div>

                        <div>

                     
                            
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