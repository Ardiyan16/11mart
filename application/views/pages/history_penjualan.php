<?php $this->load->view('partials/header.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">List Penjualan</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <p>Data Penjualan</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Penjualan</th>
                            <th>Tanggl Penjualan</th>
                            <th>Total Qty</th>
                            <th>Total Penjualan</th>
                            <th>Total Bayar</th>
                            <th>Total Potongan</th>
                            <th>Kembalian</th>
                            <th>Kasir</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($penjualan as $pj) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $pj->kode_pj ?></td>
                                <td><?= $pj->tgl_pj ?></td>
                                <td><?= $pj->total_qty ?></td>
                                <td>Rp. <?= number_format($pj->total_pj) ?></td>
                                <td>Rp. <?= number_format($pj->total_byr) ?></td>
                                <td>Rp. <?= number_format($pj->total_potongan) ?></td>
                                <td><?= $pj->kembalian ?></td>
                                <td><?= $pj->kasir ?></td>
                                <td><a href="<?= base_url('admin/detail_barangTerjual/'. $pj->kode_pj) ?>" class="btn btn-success btn-sm"><i class="fa fa-info-circle"></i> Detail</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- <script>
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
</script> -->
<?php $this->load->view('partials/footer.php'); ?>