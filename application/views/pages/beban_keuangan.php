<?php $this->load->view('partials/header.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Beban Keuangan</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="#tambah" data-toggle="modal" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Keuangan</th>
                            <th>Tanggal Input</th>
                            <th>Nominal</th>
                            <th>Kebutuhan</th>
                            <th>Keterangan</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($keuangan as $k) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $k->kode_keuangan ?></td>
                                <td><?= $k->tgl_input ?></td>
                                <td><?= $k->nominal_keuangan ?></td>
                                <td><?= $k->kebutuhan ?></td>
                                <td><?= $k->keterangan ?></td>
                                <td>
                                    <a href="#edit<?= $k->id ?>" data-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="<?= base_url('admin/delete_keuangan/' . $k->kode_keuangan) ?>" onclick="return confirm('apakah anda yakin menghapus keuangan ini ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="<?= base_url('admin/save_keuangan') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Keuangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Kode Keuangan</label>
                    <input type="text" name="kode_keuangan" value="<?= $kode ?>" readonly class="form-control">
                    <br>
                    <label>Tanggal Input</label>
                    <input type="date" name="tgl_input" class="form-control">
                    <br>
                    <label>Nominal Keuangan</label>
                    <input type="text" name="nominal_keuangan" class="form-control">
                    <br>
                    <label>Kebutuhan</label>
                    <select name="id_kebutuhan" class="form-control">
                        <option>--Pilih Kebutuhan--</option>
                        <?php foreach($kebutuhan as $k) { ?>
                            <option value="<?= $k->id ?>"><?= $k->kebutuhan ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- <?php foreach ($edit as $e) { ?>
    <div class="modal fade" id="edit<?= $e->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?= base_url('admin/update_pendapatan') ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Pendapatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>Hari</label>
                        <select name="hari" class="form-control">
                            <option>--Pilih Hari--</option>
                            <option <?php if ($e->hari == 'senin') {
                                        echo 'selected="selected"';
                                    } ?>value="senin">Senin</option>
                            <option <?php if ($e->hari == 'selasa') {
                                        echo 'selected="selected"';
                                    } ?> value="selasa">Selasa</option>
                            <option <?php if ($e->hari == 'rabu') {
                                        echo 'selected="selected"';
                                    } ?> value="rabu">Rabu</option>
                            <option <?php if ($e->hari == 'kamis') {
                                        echo 'selected="selected"';
                                    } ?> value="kamis">Kamis</option>
                            <option <?php if ($e->hari == 'jumat') {
                                        echo 'selected="selected"';
                                    } ?> value="jumat">Jumat</option>
                            <option <?php if ($e->hari == 'sabtu') {
                                        echo 'selected="selected"';
                                    } ?> value="sabtu">Sabtu</option>
                            <option <?php if ($e->hari == 'minggu') {
                                        echo 'selected="selected"';
                                    } ?> value="minggu">Minggu</option>
                        </select>
                        <br>
                        <?php
                        $tgl = date('d-m-Y');
                        ?>
                        <label>Tanggal</label>
                        <input type="hidden" value="<?= $e->id ?>" name="id">
                        <input name="tanggal" type="text" value="<?= $e->tanggal ?>" placeholder="" class="form-control" required>
                        <br>
                        <label>Pendapatan Hari Ini</label>
                        <input name="pendapatan" type="number" placeholder="Pendapatan" value="<?= $e->pendapatan ?>" class="form-control" required>
                        <br>
                        <label>Keterangan</label>
                        <input name="keterangan" type="text" value="<?= $e->keterangan ?>" placeholder="Keterangan" class="form-control" required>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Edit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?> -->
<script>
    <?php if ($this->session->flashdata('update')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Pendapatan berhasil diubah!',
            text: 'data pendapatan berhasil diupdate / diubah',
            showConfirmButton: true,
            // timer: 1500
        })
        <?php elseif ($this->session->flashdata('insert')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Keuangan berhasil tambahkan!',
            text: 'data beban keuangan berhasil tambahkan',
            showConfirmButton: true,
            // timer: 1500
        })
    <?php elseif ($this->session->flashdata('delete')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Keuangan berhasil dihapus!',
            text: 'data keuangan berhasil dihapus',
            showConfirmButton: true,
            // timer: 1500
        })
    <?php endif ?>
</script>
<?php $this->load->view('partials/footer.php'); ?>