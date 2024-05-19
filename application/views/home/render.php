<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Menempatkan halaman di tengah-tengah vertikal */
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: auto; /* Menempatkan kontainer di tengah-tengah halaman */
            margin-bottom: auto;
        }

        .item {
            text-align: center;
            padding: 10px;
        }

        .note {
            margin-top: 20px;
            font-style: italic;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Kode QR</h3>
        <?php if (!empty($data)) : ?>
            <?php foreach ($data as $row) : ?>
                <div class="item">
                    <img src="<?php echo site_url('render/QRcode/' . $row->nama); ?>" alt="QR Code">
                    <div class="note">
                        Berikan QR ini ketika anda telah selesai berkunjung.
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="item">Tidak ada data terbaru.</div>
        <?php endif; ?>

        <h3>Data dari API</h3>
        <?php if (!empty($api_data)) : ?>
            <?php foreach ($api_data as $item) : ?>
                <div class="item">
                    <p>Nama: <?php echo $item['nama']; ?></p>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="item">Tidak ada data dari API.</div>
        <?php endif; ?>
    </div>
</body>

</html>
