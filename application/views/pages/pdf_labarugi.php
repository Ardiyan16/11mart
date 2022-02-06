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
</head>

<div class="card shadow py-2">
    <div class="card-body">
        <div class="table-responsive">
            <center>
                <h2>LAPORAN LABA RUGI</h2>
            </center>
            <table class="table table-striped table-hover table-bordered table-custom">
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Laporan Laba Rugi</td>
                    <td><?= $tanggal ?></td>
                </tr>
                <tr>
                    <td>Hasil Total Penjualan</td>
                    <td>Rp.<?= $total_penjualan ?></td>
                </tr>
                <tr>
                    <td>Biaya Gaji Karyawan</td>
                    <td>Rp.<?= $gaji ?></td>
                </tr>
                <tr>
                    <td>Biaya Listrik</td>
                    <td>Rp.<?= $listrik ?></td>
                </tr>
                <tr>
                    <td>Biaya Kebersihan</td>
                    <td>Rp.<?= $kebersihan ?></td>
                </tr>
                <tr>
                    <td>Biaya Pajak</td>
                    <td>Rp.<?= $pajak ?></td>
                </tr>
                <tr>
                    <td>Biaya Lain-lain</td>
                    <td>Rp.<?= $lainlain ?></td>
                </tr>
                <tr>
                    <td>Biaya Kulaan</td>
                    <td>Rp.<?= $kulaan ?></td>
                </tr>
                <tr>
                    <td>Total Beban</td>
                    <td>Rp.<?= $total_beban ?></td>
                </tr>
                <tr>
                    <td>
                        Laba Bersih
                    </td>
                    <td>Rp.<?= $laba_bersih ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url() ?>assets/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url() ?>assets/js/demo/chart-area-demo.js"></script>
<script src="<?= base_url() ?>assets/js/demo/chart-pie-demo.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/select2-develop/dist/js/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/sweetalert-master/dist/sweetalert-dev.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url() ?>assets/js/demo/datatables-demo.js"></script>

<script>
    window.print();
</script>
</body>

</html>