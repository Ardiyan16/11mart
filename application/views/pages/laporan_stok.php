<?php $this->load->view('partials/header.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Laporan Stok</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form action="<?php echo base_url(); ?>admin/filter_laporanStok" method="get" class="row">
                <div class="col-md-2">
                    <select name="bulan" class="form-control">
                        <option>--Pilih Bulan--</option>
                        <option value="Januari">Januari</option>
                        <option value="Februari">Februari</option>
                        <option value="Maret">Maret</option>
                        <option value="April">April</option>
                        <option value="Mei">Mei</option>
                        <option value="Juni">Juni</option>
                        <option value="Juli">Juli</option>
                        <option value="Agustus">Agustus</option>
                        <option value="September">September</option>
                        <option value="Oktober">Oktober</option>
                        <option value="November">November</option>
                        <option value="Desember">Desember</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control" name="tahun" id="tahun" required>
                        <option>--Pilih Tahun--</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Filter</button>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Kasir</th>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                            <th>Stok Asli</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($laporan_stok as $ls) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $ls->bulan ?></td>
                                <td><?= $ls->tahun ?></td>
                                <td><?= $ls->username ?></td>
                                <td><?= $ls->nama_brg ?></td>
                                <td><?= $ls->stok_brg ?></td>
                                <td><?= $ls->stok ?></td>
                                <td>
                                    <a href="<?= base_url('admin/delete_laporan_stok/' . $ls->id_ls) ?>" onclick="return confirm('apakah anda yakin menghapus laporan stok ini ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- <script>
   
    <?php if ($this->session->flashdata('delete')) : ?>
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