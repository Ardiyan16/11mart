<?php $this->load->view('partials/header.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Persentase Laba <?= $data->nama_brg ?></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('admin/barang') ?>" class="btn btn-success"><i class="fa fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4">
                    <!-- <label for="exampleInputEmail1">Harga Jual Satuan</label> -->
                    <input type="text" hidden class="form-control" id="hargajual" value="<?= $data->harga_satuan ?>" aria-describedby="emailHelp" readonly>
                </div>
                <div class="form-group col-md-4">
                    <!-- <label for="exampleInputPassword1">Modal</label> -->
                    <input type="text" hidden class="form-control" readonly id="modal" value="<?= $data->modal ?>">
                </div>
                <div class="form-group col-md-4">
                    <!-- <label for="exampleInputPassword1">Laba</label> -->
                    <input type="text" hidden class="form-control" readonly id="hasil">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-1">
                    <label for="exampleInputPassword1">Persentase Satuan</label>
                    <input type="text" class="form-control" readonly id="persentase">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="form-group col-md-4">
                    <!-- <label for="exampleInputEmail1">Harga Jual Grosir</label> -->
                    <input type="text" hidden class="form-control" id="hargagrosir" value="<?= $data->harga_grosir ?>" aria-describedby="emailHelp" readonly>
                </div>
                <div class="form-group col-md-4">
                    <!-- <label for="exampleInputPassword1">Modal</label> -->
                    <input type="text" hidden class="form-control" readonly id="modal2" value="<?= $data->modal ?>">
                </div>
                <div class="form-group col-md-4">
                    <!-- <label for="exampleInputPassword1">Laba</label> -->
                    <input type="text" hidden class="form-control" readonly id="hasil2">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-1">
                    <label for="exampleInputPassword1">Persentase Grosir</label>
                    <input type="text" class="form-control" readonly id="persentase2">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#hargajual, #modal").each(function() {
            var harga = $("#hargajual").val();
            var modal = $("#modal").val();

            var hasil = parseInt(harga) - parseInt(modal);
            $("#hasil").val(hasil);
        });
    });

    $(document).ready(function() {
        $("#hargajual, #modal").each(function() {
            var hasil = $("#hasil").val();
            var modal = $("#modal").val();

            var hitung = parseInt(hasil) / parseInt(modal) * 100;
            var persentase = hitung.toFixed(1);
            $("#persentase").val(persentase);
        });
    });


    $(document).ready(function() {
        $("#hargagrosir, #modal").each(function() {
            var hargagrosir = $("#hargagrosir").val();
            var modal2 = $("#modal2").val();

            var hasil2 = parseInt(hargagrosir) - parseInt(modal2);
            $("#hasil2").val(hasil2);
        });
    });

    $(document).ready(function() {
        $("#hargajual, #modal").each(function() {
            var hasil2 = $("#hasil2").val();
            var modal2 = $("#modal2").val();

            var hitung1 = parseInt(hasil2) / parseInt(modal2) * 100;
            var persentase2 = hitung1.toFixed(1);
            $("#persentase2").val(persentase2);
        });
    });
</script>
<?php $this->load->view('partials/footer.php'); ?>