<?= $this->extend('auth/templates/index'); ?>
<?= $this->section('page-content'); ?>
<section class="ftco-section pt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-3">
                <h1 class="text-dark">Panitia Paskah</h1>
                <h2 class="text-dark">Reset Password</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <p>Enter token, email and new password</p>
                    <form class="signin-form" action="<?= url_to('reset-password') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <input type="text" class="form-control <?php if (session('errors.token')) : ?>is-invalid<?php endif ?>" name="token" placeholder="<?= lang('Auth.token') ?>" value="<?= old('token', $token ?? '') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors.token') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors.email') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="password" id="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                            <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            <div class="invalid-feedback">
                                <?= session('errors.password') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="password" id="pass_confirm" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off" required>
                            <span toggle="#pass_confirm" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            <div class="invalid-feedback">
                                <?= session('errors.pass_confirm') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3 btn-block"><?= lang('Auth.resetPassword') ?></button>
                        </div>
                        <div class="form-group">
                            <p>Not reset? <a href="<?= url_to('login') ?>"><?= lang('Auth.signIn') ?></a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>