<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SPK AHP & WP</title>

    <link href="<?= base_url('assets/sbadmin/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/sbadmin/css/sb-admin-2.min.css') ?>" rel="stylesheet">


</head>

<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        <?= $this->include('layout/sidebar') ?>
        <!-- End of Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- Topbar -->
                <?= $this->include('layout/topbar') ?>
                <!-- End of Topbar -->

                <!-- Page Content -->
                <div class="container-fluid">
                    <?= $this->renderSection('content') ?>
                </div>

            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/sbadmin/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/sbadmin/js/sb-admin-2.min.js') ?>"></script>
</body>

</html>