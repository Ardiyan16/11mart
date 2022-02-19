<?php $this->load->view('partials/header.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">List Barang</h1>
    <div class="card shadow py-2">
        <div class="card-body">
            <a href="<?= base_url('admin/barang') ?>" class="btn btn-success mb-3"> <span class="fa fa-arrow-alt-circle-left"></span> Kembali</a>
            <hr>

            <form action="<?= base_url('admin/update_brg'); ?>" method="POST" enctype="multipart/form-data">
                <label>Kode Barang</label>
                <input type="hidden" name="id_brg" value="<?= $edit->id_brg ?>">
                <input name="kode_brg" type="text" value="<?= $edit->kode_brg ?>" placeholder="Kode Barang" class="form-control" required>
                <br>
                <label>Nama Barang</label>
                <input name="nama_brg" type="text" value="<?= $edit->nama_brg ?>" placeholder="Nama Barang" class="form-control" required>
                <br>
                <label>Harga Satuan</label>
                <input name="harga_satuan" type="number" value="<?= $edit->harga_satuan ?>" placeholder="Harga Satuan" class="form-control" required>
                <br>
                <label>Harga Grosir</label>
                <input name="harga_grosir" type="number" value="<?= $edit->harga_grosir ?>" placeholder="Harga Grosir" class="form-control" required>
                <br>
                <label>Modal</label>
                <input name="modal" value="<?= $edit->modal ?>" type="number" placeholder="Modal" class="form-control" required>
                <br>
                <input name="stok" type="hidden" value="<?= $edit->stok ?>" placeholder="Stok" class="form-control" required>
                <label>Foto</label>
                <input name="foto" type="file" placeholder="" class="form-control">
                <input name="old_image" type="hidden" value="<?= $edit->foto ?>">
                <p>maksimum 3MB</p>
                <br>
                <img src="<?= base_url('assets/img/produk/' . $edit->foto) ?>" width="150">
                <small><?= $edit->foto ?></small>
                <br>
                <button type="reset" class="btn btn-danger"> <span class="fa fa-times"></span> Reset</button>
                <button type="submit" class="btn btn-primary"> <span class="fa fa-save"></span> Save Update</button>
            </form>
        </div>
    </div>
</div>


<?php $this->load->view('partials/footer.php'); ?>