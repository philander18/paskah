<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>vendor/fontawesome-free-6.5.1-web/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>public/css/style.css" rel="stylesheet" type="text/css">

</head>

<body class="img js-fullheight" style="background-image: url(<?= base_url('/public/assets/img/background_telur.png'); ?>)">
    <!-- Begin Page Content -->
    <?= $this->renderSection('page-content'); ?>
    <!-- /.container-fluid -->


    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>vendor/DataTables/Bootstrap-5-5.3.0/jsbootstrap.bundle.js"></script>
    <script src="<?= base_url(); ?>vendor/DataTables/jQuery-1.12.4/jquery-1.12.4.js"></script>
    <script src="<?= base_url(); ?>vendor/fontawesome-free-6.5.1-web/js/all.js"></script>
    <script src="<?= base_url(); ?>public/js/popper.js"></script>
    <script src="<?= base_url(); ?>public/js/main.js"></script>
</body>

</html>