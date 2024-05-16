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
        table {
            border-collapse: collapse;
            margin-top: auto; /* Menempatkan tabel di tengah-tengah halaman */
            margin-bottom: auto;
        }
        td {
            text-align: center;
        }
    </style>
</head>
<body>
    <table border='1'>
        <tr>
            <th>Kode QR</th>
        </tr>
        <?php if (!empty($data)): ?>
            <?php foreach ($data as $row): ?>
            <tr>
                <td>
                    <a href="<?php echo site_url('some/path/' . $row->ygdituju); ?>">
                        <img src="<?php echo site_url('render/QRcode/' . $row->ygdituju); ?>" alt="QR Code">
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td>Tidak ada data terbaru.</td>
        </tr>
        <?php endif; ?>
    </table>
</body>
</html>
