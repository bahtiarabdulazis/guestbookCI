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
            }
        </style>
    </head>
    <body>

        <table style="border-collapse: collapse;" border='1'>
            <tr>
                <!-- <th>No</th>
                <th>Nama</th>
                <th>Maksud Kunjungan</th>
                <th>Yang Dituju</th> -->
                <th>Kode QR</th>
            </tr>
            <?php $no = 1; foreach ($data as $row): ?>
            <tr>
                <!-- <td><?= $no++; ?></td>
                <td><?= $row->nama ?></td>
                <td><?= $row->makkun ?></td>
                <td><?= $row->ygdituju ?></td> -->
                <td>
                    <img src="<?php echo site_url('render/QRcode/' . $row->ygdituju); ?> " alt="">
                </td>
            </tr>
            <?php endforeach ?>
        </table>
    </body>
    </html>