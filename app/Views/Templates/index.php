<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul; ?></title>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>public/fontawesome-free-6.5.1-web/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>public/css/styles.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>public/css/bootstrap.min.css">
    <link rel="shortcut icon" href="<?= base_url(); ?>public/images/icon.png">
</head>

<body class="paskah">
    <!-- Begin Page Content -->
    <?= $this->renderSection('page-content'); ?>
    <!-- /.container-fluid -->


    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>public/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>public/js/jquery-3.7.1.min.js"></script>
    <script src="<?= base_url(); ?>public/fontawesome-free-6.5.1-web/js/all.min.js"></script>
    <script src="<?= base_url(); ?>public/js/popper.js"></script>
    <script src="<?= base_url(); ?>public/js/main.js"></script>

    <!-- Menangani cekData -->
    <?= $this->include('Home/script'); ?>
</body>

</html>