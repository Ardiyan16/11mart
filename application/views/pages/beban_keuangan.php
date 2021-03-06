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
                                <td>Rp. <?= number_format($k->nominal_keuangan) ?></td>
                                <td><?= $k->kebutuhan ?></td>
                                <td><?= $k->keterangan ?></td>
                                <td>
                                    <a href="#edit<?= $k->kode_keuangan ?>" data-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
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
                    <input type="text" id="currency-field" value="" data-type="currency" name="nominal_keuangan" class="form-control">
                    <br>
                    <label>Kebutuhan</label>
                    <select name="id_kebutuhan" class="form-control">
                        <option>--Pilih Kebutuhan--</option>
                        <?php foreach ($kebutuhan as $k) { ?>
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

<?php foreach ($edit as $e) { ?>
    <div class="modal fade" id="edit<?= $e->kode_keuangan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="<?= base_url('admin/update_keuangan') ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Keuangan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>Kode Keuangan</label>
                        <input type="text" name="kode_keuangan" value="<?= $e->kode_keuangan ?>" readonly class="form-control">
                        <br>
                        <label>Tanggal Input</label>
                        <input type="date" value="<?= $e->tgl_input ?>" name="tgl_input" class="form-control">
                        <br>
                        <label>Nominal Keuangan</label>
                        <input type="text" value="<?= $e->nominal_keuangan ?>" name="nominal_keuangan" class="form-control">
                        <br>
                        <label>Kebutuhan</label>
                        <select name="id_kebutuhan" class="form-control">
                            <option>--Pilih Kebutuhan--</option>
                            <?php foreach ($kebutuhan as $k) { ?>
                                <option <?php if ($e->id_kebutuhan == $k->id) {
                                            echo 'selected="selected"';
                                        } ?> value="<?= $k->id ?>"><?= $k->kebutuhan ?></option>
                            <?php } ?>
                        </select>
                        <br>
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" value="<?= $e->keterangan ?>" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Edit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
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

    $("input[data-type='currency']").on({
        keyup: function() {
            formatCurrency($(this));
        },
        blur: function() {
            formatCurrency($(this), "blur");
        }
    });


    function formatNumber(n) {
        // format number 1000000 to 1,234,567
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }


    function formatCurrency(input, blur) {
        // appends $ to value, validates decimal side
        // and puts cursor back in right position.

        // get input value
        var input_val = input.val();

        // don't validate empty input
        if (input_val === "") {
            return;
        }

        // original length
        var original_len = input_val.length;

        // initial caret position 
        var caret_pos = input.prop("selectionStart");

        // check for decimal
        if (input_val.indexOf(".") >= 0) {

            // get position of first decimal
            // this prevents multiple decimals from
            // being entered
            var decimal_pos = input_val.indexOf(".");

            // split number by decimal point
            // var left_side = input_val.substring(0, decimal_pos);
            // var right_side = input_val.substring(decimal_pos);

            // add commas to left side of number
            left_side = formatNumber(left_side);

            // validate right side
            right_side = formatNumber(right_side);

            // On blur make sure 2 numbers after decimal
            // if (blur === "blur") {
            //     right_side += "00";
            // }

            // Limit decimal to only 2 digits
            // right_side = right_side.substring(0, 2);

            // join number by .
            input_val = left_side;

        } else {
            // no decimal entered
            // add commas to number
            // remove all non-digits
            input_val = formatNumber(input_val);
            // input_val = "$" + input_val;

            // final formatting
            // if (blur === "blur") {
            //     input_val += ".00";
            // }
        }

        // send updated string to input
        input.val(input_val);

        // put caret back in the right position
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }
</script>
<?php $this->load->view('partials/footer.php'); ?>