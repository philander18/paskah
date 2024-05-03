<?= $this->extend('Templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid" style="height: 100vh;">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 mt-5" style="height: 100vh;">
                <a class="btn btn-danger fw-bold fs-2 mb-4" href="<?= base_url(); ?>Home/pendaftaran" role="button" style="width: 80%; height: 4rem; ">Pendaftaran</a>
                <a class="btn btn-danger fw-bold fs-2 mb-4" href="<?= base_url(); ?>Home/cekData" role="button" style="width: 80%; height: 4rem; ">Cek Data</a>
                <a class="btn btn-danger fw-bold fs-2 mb-4" href="<?= base_url(); ?>Home/panitia" role="button" style="width: 80%; height: 4rem; ">Panitia</a>
                <?php if (in_groups('bendahara') or in_groups('pendaftaran')) : ?>
                    <a class="btn btn-danger fw-bold fs-2 mb-4" href="<?= base_url(); ?>Home/cekSetoran" role="button" style="width: 80%; height: 4rem; ">Cek Setoran</a>
                <?php endif; ?>
                <?php if (logged_in()) : ?>
                    <a class="btn btn-danger fw-bold fs-2 mb-4" href="<?= base_url(); ?>change" role="button" style="width: 80%; height: 4rem; ">Ubah Password</a>
                    <a class="btn btn-danger fw-bold fs-2 mb-4" href="<?= base_url('logout'); ?>" role="button" style="width: 80%; height: 4rem; ">Keluar</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection(); ?>