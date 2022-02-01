<?php $this->load->view('partials/header_kasir'); ?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Pendapatan</h1>
    <div class="card shadow py-2">
        <div class="card-body">
            <hr>
            <form action="<?= base_url('kasir/save_pendapatan'); ?>" method="POST" enctype="multipart/form-data">
                <label>Hari</label>
                <select name="hari" class="form-control">
                    <option>--Pilih Hari--</option>
                    <option value="senin">Senin</option>
                    <option value="selasa">Selasa</option>
                    <option value="rabu">Rabu</option>
                    <option value="kamis">Kamis</option>
                    <option value="jumat">Jumat</option>
                    <option value="sabtu">Sabtu</option>
                    <option value="minggu">Minggu</option>
                </select>
                <br>
                <?php
                $tgl = date('d-m-Y');
                ?>
                <label>Tanggal</label>
                <input name="tanggal" type="text" value="<?= $tgl ?>" placeholder="" class="form-control" required>
                <br>
                <label>Pendapatan Hari Ini</label>
                <input name="pendapatan" type="number" placeholder="Pendapatan" class="form-control" required>
                <br>
                <label>Keterangan</label>
                <input name="keterangan" type="text" placeholder="Keterangan" class="form-control" required>
                <br>
                <button type="reset" class="btn btn-danger"> <span class="fa fa-times"></span> Reset</button>
                <button type="submit" class="btn btn-primary"> <span class="fa fa-save"></span> Simpan</button>
            </form>
        </div>
    </div>
</div>

<script>
    <?php if ($this->session->flashdata('insert')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Pendapatan hari ini berhasil disimpan!',
            showConfirmButton: true,
            // timer: 1500
        })
        <?php endif ?>
</script>
<?php $this->load->view('partials/footer'); ?>