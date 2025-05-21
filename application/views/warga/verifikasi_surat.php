<!DOCTYPE html>
<html>
<head>
    <title>Hasil Verifikasi Surat</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            padding: 40px;
            margin: 0;
        }

        .container {
            background-color: #fff;
            max-width: 600px;
            margin: 0 auto;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .info p {
            font-size: 16px;
            color: #555;
            margin: 10px 0;
        }

        .result {
            font-size: 18px;
            font-weight: 600;
            padding: 20px;
            border-left: 6px solid <?= strpos($status, '✅') !== false ? '#2ecc71' : '#e74c3c' ?>;
            background-color: <?= strpos($status, '✅') !== false ? '#eafaf1' : '#fdecea' ?>;
            color: <?= strpos($status, '✅') !== false ? '#2c3e50' : '#c0392b' ?>;
            border-radius: 6px;
            margin-top: 25px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Verifikasi Keaslian Surat</h2>

        <div class="info">
            <!-- <p><strong>ID Surat:</strong> <?= htmlspecialchars($surat['id']) ?></p> -->
            <p><strong>Jenis Surat:</strong> <?= htmlspecialchars($surat['jenis_surat']) ?></p>
            <p><strong>Nomor Surat:</strong> <?= htmlspecialchars($surat['nomor_surat']) ?></p>
            <p><strong>Nama Pemohon:</strong> <?= htmlspecialchars($surat['nama'] ?? '-') ?></p>
            <p><strong>Tanggal Surat:</strong> <?= htmlspecialchars($surat['tanggal_surat'] ?? '-') ?></p>
            <p><strong>Tanggal Kadaluarsa:</strong> <?= htmlspecialchars($surat['tanggal_kadaluarsa'] ?? '-') ?></p>
        </div>

        <div class="result"><?= htmlspecialchars($status) ?></div>
    </div>

</body>
</html>
