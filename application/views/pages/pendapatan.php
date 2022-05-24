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
                <input name="id_auth" type="hidden" value="<?= $this->session->userdata('id') ?>" placeholder="" class="form-control" required>
                <br>
                <label>Pendapatan Hari Ini</label>
                <input name="pendapatan" type="text" id="currency-field" value="" data-type="currency" placeholder="Pendapatan" class="form-control" required>
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
<?php $this->load->view('partials/footer'); ?>