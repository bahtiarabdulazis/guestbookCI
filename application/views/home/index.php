<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Buku Tamu</title>
    <!-- Include CSS for Bootstrap and select2 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
</head>

<body>
    <section>
        <div class="container d-flex justify-content-center align-items-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">
                    <div class="img-container">
                        <img src="<?= base_url('assets/images/AASG.jpg'); ?>" class="img" alt="Gambar">
                    </div>
                    <div class="form-container login-wrap p-4 p-md-5">
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
                                    <!-- Opsi akan diisi oleh AJAX -->
                                </select>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-success btn-block" onclick="showModal()" style="padding-left: 35%; padding-right: 35%">Selanjutnya</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>