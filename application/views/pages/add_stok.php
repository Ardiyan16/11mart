<?php $this->load->view('partials/header.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Stok</h1>
    <div class="card shadow py-2">
        <div class="card-body">
            <a href="<?= base_url('admin/barang') ?>" class="btn btn-success mb-3"> <span class="fa fa-arrow-alt-circle-left"></span> Kembali</a>
            <hr>

            <form action="<?= base_url('admin/save_stok'); ?>" method="POST" enctype="multipart/form-data">
                <label>Nama Barang</label>
                <input type="hidden" value="<?= $stok->id_brg ?>" name="id_brg">
                <input name="nama_brg" value="<?= $stok->nama_brg ?>" type="text" placeholder="Nama Barang" class="form-control" required>
                <br>
                <label>Stok</label>
                <input name="stok" type="number" placeholder="Stok" class="form-control" required>
                <br>
                <button type="reset" class="btn btn-danger"> <span class="fa fa-times"></span> Reset</button>
                <button type="submit" class="btn btn-primary"> <span class="fa fa-save"></span> Tambah Stok</button>
            </form>
        </div>
    </div>
</div>


<?php $this->load->view('partials/footer.php'); ?>