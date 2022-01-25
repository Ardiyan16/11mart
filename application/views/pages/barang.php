<?php $this->load->view('partials/header.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">List Barang</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('admin/add_barang') ?>" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah Barang</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga Satuan</th>
                            <th>Harga Grosir</th>
                            <th>Stok</th>
                            <th>Foto</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($barang as $brg) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $brg->kode_brg ?></td>
                                <td><?= $brg->nama_brg ?></td>
                                <td><?= $brg->harga_satuan ?></td>
                                <td><?= $brg->harga_grosir ?></td>
                                <td><?= $brg->stok ?></td>
                                <td><img src="<?= base_url('assets/img/produk/' . $brg->foto) ?>" width="64"></td>
                                <td>
                                    <?php
                                    $dropdown['link'] = array(
                                        "Edit" => base_url('admin/edit_barang/' . $brg->id_brg),
                                        "Delete" => array('confirm', base_url('admin/delete_brg/' . $brg->id_brg)),
                                        "Tambah Stok" => base_url('admin/add_stok/' . $brg->id_brg)
                                    );
                                    $this->load->view("partials/option", $dropdown);
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    <?php if ($this->session->flashdata('insert')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Produk berhasil ditambahkan!',
            text: 'produk baru berhasil ditambahkan',
            showConfirmButton: true,
            // timer: 1500
        })
    <?php elseif ($this->session->flashdata('update')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Produk berhasil diubah!',
            text: 'data produk berhasil diupdate / diubah',
            showConfirmButton: true,
            // timer: 1500
        })
    <?php elseif ($this->session->flashdata('tambah_stok')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Stok berhasil ditambahkan!',
            text: 'stok barang anda berhasil bertambah',
            showConfirmButton: true,
            // timer: 1500
        })
    <?php elseif ($this->session->flashdata('delete')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Barang berhasil dihapus!',
            text: 'data barang berhasil dihapus',
            showConfirmButton: true,
            // timer: 1500
        })
    <?php endif ?>
</script>
<?php $this->load->view('partials/footer.php'); ?>