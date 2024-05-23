<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Buku Tamu</title>
</head>
<body>
    <section>
        <div class="container d-flex justify-content-center align-items-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">
                    <img src="<?= base_url('assets/images/Aas.jpg'); ?>" class="img" alt="Gambar">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 id="form-title" class="mb-4">Form Buku Tamu</h3>
                            </div>
                        </div>
                        <!-- Form untuk menambahkan tamu -->
                        <div id="alert" style="display: none;"></div>
                        <form id="guestForm" action="<?php echo base_url('TamuController/simpanTamu'); ?>" method="post">
                            <div class="form-group mb-3">
                                <label class="label" for="nama">Nama</label>
                                <?php echo form_input('nama', '', 'id="nama" class="form-control" required'); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="aslpt">Nama Perusahaan</label>
                                <?php echo form_input('aslpt', '', 'id="aslpt" class="form-control" required'); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="makkun">Maksud Kunjungan</label>
                                <?php echo form_textarea(array('name' => 'makkun', 'id' => 'makkun', 'class' => 'form-control', 'required' => 'required'), ''); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="ygdituju">Yang Dituju</label>
                                <select id="ygdituju" name="ygdituju" class="form-control" required>
                                    <option value="">Memuat data...</option>
                                </select>
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-success" type="submit" style="padding-left: 35%; padding-right: 35%">Selanjutnya</button>
                            </div>
                        </form>
                        <!-- Akhir form -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "<?php echo base_url('TamuController/ygDituju'); ?>",
                type: "GET",
                success: function(data) {
                    if (data && data.length > 0) {
                        $('#ygdituju').empty(); // Bersihkan opsi dropdown sebelum menambahkan yang baru
                        $('#ygdituju').append('<option value="">Pilih Yang Dituju</option>'); // Tambahkan opsi default
                        $.each(data, function(i, pegawai) {
                            $('#ygdituju').append('<option value="' + pegawai.nama + '">' + pegawai.nama + '</option>');
                        });
                    } else {
                        console.error('Respons tidak memiliki properti yang diharapkan.');
                        $('#ygdituju').html('<option value="">Gagal memuat data</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    $('#ygdituju').html('<option value="">Gagal memuat data</option>');
                }
            });
        });
        </script>
</body>
</html>
