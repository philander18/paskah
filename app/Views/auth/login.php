<?= $this->extend('auth/templates/index'); ?>
<?= $this->section('page-content'); ?>
<section class="ftco-section pt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-3">
                <h1 class="text-dark">Panitia Paskah</h1>
                <h2 class="text-dark">GPdI Padalarang 2024</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <?= view('Myth\Auth\Views\_message_block') ?>

                    <form class="signin-form" action="<?= url_to('login') ?>" method="post">
                        <?= csrf_field() ?>
                        <?php if ($config->validFields === ['email']) : ?>
                            <div class="form-group">
                                <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.login') ?>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="form-group">
                                <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.login') ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <input type="password" id="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
                            <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            <div class="invalid-feedback">
                                <?= session('errors.password') ?>
                            </div>
                        </div>
                        <?php if ($config->allowRemembering) : ?>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">
                                        <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>><?= lang('Auth.rememberMe') ?>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3 mb-3"><?= lang('Auth.loginAction') ?></button>
                            <a class="form-control btn btn-primary submit px-3 align-middle" href="<?= base_url(); ?>paskah" role="button">Home</a>
                        </div>
                    </form>
                    <?php if ($config->allowRegistration) : ?>
                        <p class="mb-1"><a href="<?= url_to('register') ?>"><?= lang('Auth.needAnAccount') ?></a></p>
                    <?php endif; ?>
                    <?php if ($config->activeResetter) : ?>
                        <p><a href="<?= url_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>