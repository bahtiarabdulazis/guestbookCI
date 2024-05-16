<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku users</title>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        .content {
            width: 100%;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .data-item {
            margin-bottom: 10px;
        }
        .label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Detail Buku Tamu</h2>
        <?php if ($users): ?>
            <div class="content">
                <div class="data-item">
                    <p><span class="label">Nama:</span> <?php echo $users->nama; ?></p>
                </div>
                <div class="data-item">
                    <p><span class="label">Nama Perusahaan:</span> <?php echo $users->aslpt; ?></p>
                </div>
                <div class="data-item">
                    <p><span class="label">Maksud Kunjungan:</span> <?php echo $users->makkun; ?></p>
                </div>
                <div class="data-item">
                    <p><span class="label">Yang Dituju:</span> <?php echo $users->ygdituju; ?></p>
                </div>
                <button onclick="confirmData(<?php echo $users->id; ?>)">Konfirmasi</button>
            </div>
        <?php else: ?>
            <p>Data tidak ditemukan.</p>
        <?php endif; ?>
    </div>

    <script>
    function confirmData(id) {
        fetch('<?php echo site_url('render/confirmQR'); ?>/' + id, {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Data confirmed and QR code removed.');
                window.location.href = '<?php echo site_url('home/index'); ?>'; // Redirect to home or another page
            } else {
                alert('Error confirming data');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    </script>
</body>
</html>
