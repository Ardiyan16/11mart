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
                            <th>Modal</th>
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
                                <td>
                                    <?= $brg->kode_brg ?>
                                    <br>
                                    <a href="<?= base_url('admin/view_barcode/' . $brg->kode_brg) ?>" class="btn btn-success"><i class="fa fa-barcode"></i> barcode</a>
                                </td>
                                <td><?= $brg->nama_brg ?></td>
                                <td><?= $brg->harga_satuan ?></td>
                                <td><?= $brg->harga_grosir ?></td>
                                <td><?= $brg->modal ?></td>
                                <td><?= $brg->stok ?></td>
                                <td><img src="<?= base_url('assets/img/produk/' . $brg->foto) ?>" width="64"></td>
                                <td>
                                    <?php
                                    $dropdown['link'] = array(
                                        "Edit" => base_url('admin/edit_barang/' . $brg->id_brg),
                                        "Delete" => array('confirm', base_url('admin/delete_brg/' . $brg->id_brg)),
                                        "Tambah Stok" => base_url('admin/add_stok/' . $brg->id_brg),
                                        "Persentase" => base_url('admin/persentase_laba/' . $brg->id_brg)
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
<!-- <?php foreach ($barang2 as $brg2) : ?>
    <div class="modal fade" id="persentase<?= $brg2->id_brg ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Persentase Laba <?= $brg2->nama_brg ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">Harga Jual Satuan</label>
                            <input type="text" class="form-control" id="hargajual" value="<?= $brg2->harga_satuan ?>" aria-describedby="emailHelp" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword1">Modal</label>
                            <input type="text" class="form-control" readonly id="modal" value="<?= $brg2->modal ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword1">Laba</label>
                            <input type="text" class="form-control" readonly id="hasil">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword1">Persentase</label>
                            <input type="text" class="form-control" readonly id="persentase">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?> -->
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