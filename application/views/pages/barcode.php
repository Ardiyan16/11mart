<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?php echo base_url() . "assets/" ?>vendor/select2-develop/dist/css/select2.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() . "assets/" ?>vendor/sweetalert-master/dist/sweetalert.css" rel="stylesheet" />
    <link href="<?php echo base_url() . "assets/" ?>vendor/bootstrap-datepicker-master/dist/css/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" />
    <script src="<?php echo base_url() . "assets/" ?>vendor/jquery/jquery.min.js"></script>

    <script src="<?= base_url() ?>assets/js/sweetalert2-all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <style>
        body {
            text-align: center;
        }

        p {
            font-size: 12px;
        }

        @media print {

            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <img src="<?= base_url('admin/barcode/' . $brg['kode_brg']) ?>">
    <br>
    <br>
    <p><?= $brg['nama_brg'] ?> Rp.<?= $brg['harga_satuan'] ?></p>
    <button id="btnPrint" class="hidden-print">Cetak</button>
</body>
<script>
    const $btnPrint = document.querySelector("#btnPrint");
    $btnPrint.addEventListener("click", () => {
        window.print();
    });
</script>

</html>