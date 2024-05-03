<?= $this->extend('Templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid" style="height: 100vh;">
    <div class="container">
        <form autocomplete="off" action="" method="POST">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6" style="height: 100vh;">
                    <div class="text-dark mb-3 fw-bold">
                        <h3 class="fw-bold text-center">PENDAFTARAN PASKAH</h3>
                        <h4 class="text-center">GPdI Padalarang 2024</h4>
                    </div>
                    <div class="flash">
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success" role="alert" style="padding: 6px 12px; margin-bottom: 8px;">
                                <?= session()->getFlashdata('pesan'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" id="nama" name="nama" placeholder="Nama" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" id="hp" name="hp" placeholder="Nomor HP" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" id="anggota" name="anggota" rows="3" placeholder="Daftar anggota"></textarea>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <label class="text-dark fw-bold" for="transportasi" style="text-shadow: 2px 2px white;">Transportasi</label>
                            </div>
                            <div class="col-6 col-md-8">
                                <select class="form-select" aria-label=".form-select-sm example" name="transportasi" id="transportasi">
                                    <option value="panitia">Panitia</option>
                                    <option value="pribadi" selected>Pribadi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <label class="text-dark fw-bold" for="dewasa" style="text-shadow: 2px 2px white;">Jumlah Dewasa</label>
                            </div>
                            <div class="col-6 col-md-8">
                                <select class="form-select" aria-label=".form-select-sm example" name="dewasa" id="dewasa">
                                    <option value="0" selected>0</option>
                                    <?php for ($x = 1; $x <= 10; $x++) { ?>
                                        <option value="<?= $x; ?>"><?= $x; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <label class="text-dark fw-bold" for="anak" style="text-shadow: 2px 2px white;">Jumlah Anak</label>
                            </div>
                            <div class="col-6 col-md-8">
                                <select class="form-select" aria-label=".form-select-sm example" name="anak" id="anak">
                                    <option value="0" selected>0</option>
                                    <?php for ($x = 1; $x <= 10; $x++) { ?>
                                        <option value="<?= $x; ?>"><?= $x; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-5 col-md-3">
                                <button type="submit" class="btn btn-light text-dark fw-bold" style="width: 100%">Submit</button>
                            </div>
                            <div class="col-5 col-md-3">
                                <a class="btn btn-light text-dark fw-bold" href="<?= base_url(); ?>Home" role="button" style="width: 80%">Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
</form>
</div>
<?= $this->endSection(); ?>