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
                        <?php if ($this->session->flashdata('error')) : ?>
                            <div id="alert" class="alert alert-danger">
                                <?php echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php endif; ?>
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
                                <button type="button" class="btn btn-success" onclick="showModal()" style="padding-left: 35%; padding-right: 35%">Selanjutnya</button>
                            </div>
                        </form>
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
                dataType: "json",
                success: function(data) {

                    if (data && Array.isArray(data) && data.length > 0) {
                        $('#ygdituju').empty();
                        $('#ygdituju').append('<option value="" hidden>Pilih Yang Dituju</option>');
                        $.each(data, function(i, pegawai) {
                            data.sort(function(a, b) {
                                return b.id - a.id;
                            });
                            if (pegawai.id != 23 && pegawai.id != 30 && pegawai.id != 163) {
                                $('#ygdituju').append('<option value="' + pegawai.nama + '">' + pegawai.nama + '</option>');
                            }
                        });
                    } else {
                        $('#ygdituju').html('<option value="">Gagal memuat data</option>');
                    }
                },
                error: function(xhr, status, error) {
                    $('#ygdituju').html('<option value="">Gagal memuat data</option>');
                }
            });
        });
    </script>
    
</body>

</html>