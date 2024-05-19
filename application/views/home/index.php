<section>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-12 col-lg-10">
            <div class="wrap d-md-flex">
                <img src="<?= base_url('assets/images/Aas.jpg'); ?>" class="img">
                <div class="login-wrap p-4 p-md-5">
                    <div class="d-flex">
                        <div class="w-100">
                            <h3 id="form-title" class="mb-4">Form Buku Tamu</h3>
                        </div>
                    </div>
                    <div id="alert" style="display: none;"></div>

                    <form id="guestForm" action="<?php echo base_url('tamu/simpan'); ?>" method="post">
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
                                <?php if (isset($names) && !empty($names)): ?>
                                    <?php foreach ($names as $name): ?>
                                        <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="">No names available</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-success" type="submit" style="padding-left: 35%; padding-right: 35%">Selanjutnya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
