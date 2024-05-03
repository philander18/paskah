<?= $this->extend('paskah/template/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid" style="height: 100vh;">
    <div class="container">
        <form autocomplete="off" action="<?= base_url(); ?>change/done" method="POST">
            <input type="hidden" name="token" id="token" value="<?= $token; ?>">
            <input type="hidden" name="email" id="email" value="<?= user()->email; ?>">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6" style="height: 100vh;">
                    <div class="text-dark mb-3 fw-bold mt-3">
                        <h3 class="fw-bold text-center">Ubah Password</h3>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <label class="text-dark fw-bold" for="password" style="text-shadow: 2px 2px white;">New password</label>
                            </div>
                            <div class="col-6 col-md-8">
                                <input class="form-control" type="password" id="password" name="password" placeholder="New Password" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <label class="text-dark fw-bold" for="pass_confirm" style="text-shadow: 2px 2px white;">Confirm password</label>
                            </div>
                            <div class="col-6 col-md-8">
                                <input class="form-control" type="password" id="pass_confirm" name="pass_confirm" placeholder="Confirm Password" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-5 col-md-3">
                                <button type="submit" class="btn btn-light text-dark fw-bold" id="ubahpassword" style="width: 100%">Submit</button>
                            </div>
                            <div class="col-5 col-md-3">
                                <a class="btn btn-light text-dark fw-bold" href="<?= base_url(); ?>paskah" role="button" style="width: 80%">Home</a>
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