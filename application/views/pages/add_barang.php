<?php $this->load->view('partials/header.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Barang</h1>
    <div class="card shadow py-2">
        <div class="card-body">
            <a href="<?= base_url('admin/barang') ?>" class="btn btn-success mb-3"> <span class="fa fa-arrow-alt-circle-left"></span> Kembali</a>
            <hr>

            <form action="<?= base_url('admin/save_brg'); ?>" method="POST" enctype="multipart/form-data">
                <label>Kode Barang</label>
                <input name="kode_brg" type="text" placeholder="Kode Barang" class="form-control" required>
                <br>
                <label>Nama Barang</label>
                <input name="nama_brg" type="text" placeholder="Nama Barang" class="form-control" required>
                <br>
                <label>Harga Satuan</label>
                <input name="harga_satuan" type="number" placeholder="Harga Satuan" class="form-control" required>
                <br>
                <label>Harga Grosir</label>
                <input name="harga_grosir" type="number" placeholder="Harga Grosir" class="form-control" required>
                <br>
                <label>Modal</label>
                <input name="modal" type="number" placeholder="Modal" class="form-control" required>
                <br>
                <label>Stok</label>
                <input name="stok" type="number" placeholder="Stok" class="form-control" required>
                <br>
                <label>Foto</label>
                <input name="foto" type="file" placeholder="" class="form-control">
                <p>maksimum 3MB</p>
                <br>
                <button type="reset" class="btn btn-danger"> <span class="fa fa-times"></span> Reset</button>
                <button type="submit" class="btn btn-primary"> <span class="fa fa-save"></span> Save</button>
            </form>
        </div>
    </div>
</div>


<?php $this->load->view('partials/footer.php'); ?>