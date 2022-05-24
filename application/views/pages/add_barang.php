<?php $this->load->view('partials/header.php'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Barang</h1>
    <div class="card shadow py-2">
        <div class="card-body">
            <a href="<?= base_url('admin/barang') ?>" class="btn btn-success mb-3"> <span class="fa fa-arrow-alt-circle-left"></span> Kembali</a>
            <hr>

            <form action="<?= base_url('admin/save_brg'); ?>" method="POST" enctype="multipart/form-data">
                <label>Kode Barang</label>
                <input name="kode_brg" type="text" placeholder="Kode Barang" class="form-control" required>
                <br>
                <label>Nama Barang</label>
                <input name="nama_brg" type="text" placeholder="Nama Barang" class="form-control" required>
                <br>
                <label>Harga Satuan</label>
                <input name="harga_satuan" type="text" id="currency-field" value="" data-type="currency" placeholder="Harga Satuan" class="form-control" >
                <br>
                <label>Harga Grosir</label>
                <input name="harga_grosir" type="text" id="currency-field" value="" data-type="currency" placeholder="Harga Grosir" class="form-control" >
                <br>
                <label>Modal</label>
                <input name="modal" type="text" id="currency-field" value="" data-type="currency" placeholder="Modal" class="form-control" >
                <br>
                <label>Stok</label>
                <input name="stok" type="number" placeholder="Stok" class="form-control" required>
                <br>
                <label>Foto</label>
                <input name="foto" type="file" placeholder="" class="form-control">
                <p>maksimum 3MB</p>
                <br>
                <button type="reset" class="btn btn-danger"> <span class="fa fa-times"></span> Reset</button>
                <button type="submit" class="btn btn-primary"> <span class="fa fa-save"></span> Save</button>
            </form>
        </div>
    </div>
</div>
<script>
    // var rupiah = document.getElementById("rupiah");
    // rupiah.addEventListener("keyup", function(e) {
    //     // tambahkan 'Rp.' pada saat form di ketik
    //     // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    //     rupiah.value = formatRupiah(this.value, "Rp. ");
    // });​
    // /* Fungsi formatRupiah */
    // function formatRupiah(angka, prefix) {
    //     var number_string = angka.replace(/[^,\d]/g, "").toString(),
    //         split = number_string.split(","),
    //         sisa = split[0].length % 3,
    //         rupiah = split[0].substr(0, sisa),
    //         ribuan = split[0].substr(sisa).match(/\d{3}/gi);​
    //     // tambahkan titik jika yang di input sudah menjadi angka ribuan
    //     if (ribuan) {
    //         separator = sisa ? "." : "";
    //         rupiah += separator + ribuan.join(".");
    //     }​
    //     rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    //     return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    // }
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