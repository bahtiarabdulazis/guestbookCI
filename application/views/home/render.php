<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>
<body>
    <h1>Scan QR Code</h1>
    <?php if (!empty($data)): ?>
        <div id="qrcode">
            <?php foreach ($data as $user): ?>
                <a href="<?= base_url('form/' . $user->id) ?>"><img src="<?php echo base_url('render/QRcode/' . $user->id); ?>" alt="QR Code"></a>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No data available</p>
    <?php endif; ?>
</body>
</html>
