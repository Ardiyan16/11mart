<?php $this->load->view('partials/header.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Kebutuhan</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form action="<?php echo base_url(); ?>admin/save_kebutuhan" method="post" class="row">
                <div class="col-md-2">
                    <input type="text" id="kebutuhan" name="kebutuhan" class="form-control">
                </div>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kebutuhan</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($kebutuhan as $k) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $k->kebutuhan ?></td>
                                <td>
                                    <a href="#edit<?= $k->id ?>" data-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="<?= base_url('admin/delete_kebutuhan/' . $k->id) ?>" onclick="return confirm('apakah anda yakin menghapus kebutuhan ini ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php foreach ($edit as $e) { ?>
    <div class="modal fade" id="edit<?= $e->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?= base_url('admin/update_kebutuhan') ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Kebutuhan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>Kebutuhan</label>
                        <input name="id" type="hidden" value="<?= $e->id ?>">
                        <input name="kebutuhan" type="text" value="<?= $e->kebutuhan ?>" placeholder="Kebutuhan" class="form-control" required>
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
<?php } ?>
<script>
    <?php if ($this->session->flashdata('update')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Kebutuhan berhasil diubah!',
            text: 'data kebutuhan berhasil diupdate / diubah',
            showConfirmButton: true,
            // timer: 1500
        })
        <?php elseif ($this->session->flashdata('insert')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Kebutuhan berhasil ditambahkan!',
            text: 'data kebutuhan baru berhasil disimpan',
            showConfirmButton: true,
            // timer: 1500
        })
    <?php elseif ($this->session->flashdata('delete')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Kebutuhan berhasil dihapus!',
            text: 'data kebutuhan berhasil dihapus',
            showConfirmButton: true,
            // timer: 1500
        })
    <?php endif ?>
</script>
<?php $this->load->view('partials/footer.php'); ?>