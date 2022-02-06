<script src="<?php echo base_url() ?>assets/js/sprintf.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />
<script src="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"></script>
<?php $this->load->view('partials/header_kasir'); ?>

<style>
    /* .table>tbody>tr>td{
		vertical-align: middle;
		position: relative;
	} */
    .daftar-autocomplete {
        list-style: none;
        margin: 0;
        padding: 0;
        width: 106%;
        max-height: 350px;
    }

    .daftar-autocomplete li {
        padding: 5px 10px 5px 10px;
        background: #FAFAFA;
        border-bottom: #ddd 1px solid;
    }

    .daftar-autocomplete li:hover,
    .daftar-autocomplete li.autocomplete_active {
        background: #304ffe;
        color: #fff;
        cursor: pointer;
    }

    #hasil_pencarian {
        padding: 0px;
        display: none;
        position: absolute;
        overflow: auto;
        border: 1px solid #ddd;
        z-index: 1;
        width: 17%;
    }

    .--focus {
        background: #304ffe !important;
        color: white;
    }
</style>
<div class="card shadow py-2">
    <h1 class="h3 mb-2 text-gray-800" style="margin-left: 10px;">Transaksi Penjualan Grosir</h1>
    <div class="card-body">
        <hr>
        <form action="<?= base_url('kasir/proses_penjualanGrosir') ?>" method="POST">
            <div class="row">
                <div class="col-md-4">
                    <label for="">No Nota</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><span class="fas fa-credit-card"></span> </span>
                        </div>
                        <input type="text" name="kode_pj" id="no_nota" class="form-control no_nota">
                    </div>
                </div>
                <div class="col-md-4">
                    <?php
                    $tgl = date('Y/m/d');
                    ?>
                    <label for="">Tanggal</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><span class="fa fa-calendar"></span> </span>
                        </div>
                        <input type="text" value="<?= $tgl ?>" name="tgl_pj" class="form-control datepicker">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="">Kasir</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><span class="fas fa-address-book"></span> </span>
                        </div>
                        <input type="text" name="kasir" value="<?= $this->session->userdata('username') ?>" class="form-control">
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="table-responsive">
                    <table class="table text-center" id="tabeltransaksi">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Barang</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Harga Grosir</th>
                                <th scope="col">Potongan</th>
                                <th scope="col">Sub Total</th>
                                <th scope="col">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <button type="button" style="margin-top: 25px;" class="btn btn-primary" id="BarisBaru">
                        <i class="fa fa-plus"> Baris Baru</i>
                    </button>
                    <!-- <a href="<?= base_url() . "transaksi/addDetailPenjualan" ?>" class="btn btn-default addDetail"><span class="fa fa-plus"></span> Tambah Item</a> -->
                </div>
                <div class="col-auto ml-auto">
                </div>
                <div class="col-auto ml-auto">
                    <h4 class="total" style="color: orange;">Total : <span id='totalbelanja2'>0</span> &nbsp; <span class='color-blue' style="color: blue;"> Kembalian : </ span><span id='kembalian2'>0</span> </h4>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <label for="">Total Bayar</label>
                    <div class="input-group mb-3">
                        <input type="number" name="total_byr" class="form-control totalKembalian" id='inputBayar' value='0'>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="">Total Belanja</label>
                    <div class="input-group mb-3">
                        <!-- <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><span class="fas fa-money-check"></span> </span>
                        </div> -->
                        <input type="text" readonly name="total_pj" class="form-control totalbelanja" id='totalbelanja'>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="">Total Potongan</label>
                    <div class="input-group mb-3">
                        <input type="number" name="total_potongan" class="form-control totalKembalian" id='totalPotongan' value='0' readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="">Kembalian</label>
                    <div class="input-group mb-3">
                        <input type="text" readonly name="kembalian" class="form-control totalKembalian" id='kembalian' value='0'>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Transaksi</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="listbarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">List Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tabelbarang" class="tabelbarang">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Kode Barang</td>
                            <td>Nama Barang</td>
                            <td>Harga Satuan</td>
                            <td>Harga Grosir</td>
                            <td>opsi</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    let dataBarang;

    $(document).ready(function() {
        getDataBarang();
        //detail_barang();
        $('html, body').animate({
            scrollTop: 0
        }, 0);
        $.ajax({
            url: "<?php echo base_url() . 'kasir/max_nota'; ?>",
            dataType: 'json',
            method: 'POST',
            success: function(json) {
                var d = "<?php echo date('d') ?>";
                var m = "<?php echo date('m') ?>";
                var y = "<?php echo date('Y') ?>";

                if (json.maxs == null) {
                    max = 'PJ' + '' + y + '' + m + '' + d + '-' + '0000';
                } else {
                    max = json.maxs;
                }

                var ambil_tanggal = max.substring(8, 10);
                console.log('max', max);
                console.log('ambil_tanggal', ambil_tanggal);

                if (d == ambil_tanggal) {
                    // urut = max.substring(18, 20);
                    urut = max.split('-')[1];
                } else {
                    urut = "000";
                }

                urut++;
                console.log('urut', urut);
                var kodene = sprintf("%05s", urut);

                var invoice = 'PJ' + '' + y + '' + m + '' + d + '-' + kodene;
                console.log('invoice' + invoice);
                $('#no_nota').val(invoice);
            }
        });
    });

    function detail_barang(id) {
        // getDataBarang()
        $('#listbarang').modal('show');
        table2 = $('#tabelbarang').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true,
            "bDestroy": true,
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo base_url() ?>kasir/ajax_listall/" + id,
                "type": "POST"
            },

            order: [1, 'asc']

        }).fnDestroy();
        table2.ajax.reload();
    }

    $('#BarisBaru').on('click', function() {
        BarisBaru();
    });

    function runningFormatter(value, row, index) {
        return index + 1;
    }

    $(document).on('click', '#HapusBaris', function(e) {
        e.preventDefault();
        if ($(this).parent().parent().find("#pencarian_kode").val() == "") {
            $(this).parent().parent().remove();
            var nomor = 1;
            $('#tabeltransaksi tbody tr').each(function() {
                $(this).find('td:nth-child(1)').html(nomor);
                nomor++;
            })
            HitungTotalBayar();
        } else {
            $(this).parent().parent().remove();
            var nomor = 1;
            $('#tabeltransaksi tbody tr').each(function() {
                $(this).find('td:nth-child(1)').html(nomor);
                nomor++;
            })
            HitungTotalBayar();
        }
    });

    function BarisBaru() {
        var nomor = $('#tabeltransaksi tbody tr').length + 1;
        console.log(nomor);
        //1
        var baris = "<tr>";
        baris += "<td>" + nomor + "</td>";

        //2
        baris += "<td style='display: flex;height: 58px;'>";
        baris += "<input autocomplete='off' required  type='text' class='form-control kode_brg" + nomor + "' name='kode_brg[]' id='pencarian_kode' placeholder='Ketik Kode / Nama Barang'><button type='button' class='btn-sm btn-success' onclick='detail_barang(" + nomor + ")' style='margin-left: 4px;'> <i class='ace-icon fa fa-search'></i></button>";
        baris += "<div id='hasil_pencarian' class='hasil_pencarian'></div>";
        baris += "</td>";


        //3
        baris += "<td><input type='text' name='nama_brg[]' id='nama_brg' class='form-control nama_brg" + nomor + "' readonly></td>";

        //4
        baris += "<td><input type='number' name='qty[]' id='qty' value'0' class='form-control qty" + nomor + "'></td>";

        //5
        baris += "<td><input type='number' name='harga_grosir[]' id='harga_grosir' class='form-control harga_grosir" + nomor + "'></td>";

        //6
        baris += "<td><input type='text' name='potongan[]' id='potongan' class='form-control potongan" + nomor + "'></td>";

        //7
        baris += "<td>";
        baris += "<input required type='hidden' name='subtotal[]' id='subtotal' class='subtotal" + nomor + "'>";
        baris += '<span></span>';
        baris += "</td>";

        //hapus
        baris += "<td><button  class='btn btn-danger' id='HapusBaris'><i class='fa fa-times' style='color:white;'></i></button></td>";
        baris += "</tr>";

        $('#tabeltransaksi').append(baris);
        // Fokus Input
        $('#tabeltransaksi tbody tr').each(function() {
            $(this).find('td:nth-child(2) input').focus();
        });
    }

    function getDataBarang() {
        $.ajax({
            url: "<?php echo base_url() ?>kasir/getDataBarang",
            method: 'POST',
            dataType: 'JSON',
            success: function(json) {
                console.log(json);
                dataBarang = json.datanya;
            }
        })
    }

    let intervalPress;

    function cariBarang(keyword, Indexnya, foundItem) {
        let htmlFoundItem = "<ul id='daftar-autocomplete' class='daftar-autocomplete'>";
        foundItem.forEach((b, i) => {
            //	var b.stok_gudang = 0;
            if (i == 0) {
                htmlFoundItem += '<li class="--focus">';
            } else {
                htmlFoundItem += '<li>';
            }

            htmlFoundItem += `
					<b>Kode</b> : 
					`
                // <span id='kodenya'>` + b.kode_barang + `</span> <br />
                +
                `
					<span id='kode'>` + b.kode_brg + `</span> <br />
					<span id='nama_brg'>` + b.nama_brg + `</span><br />
					<span id='harga_satuan' style='display:none;'>` + b.harga_satuan + `</span>
                    <span id='harga_grosir' style='display:none;'>` + b.harga_grosir + `</span>
				</li>
			`;
        })
        htmlFoundItem += "</ul>";

        if (foundItem.length > 0 && keyword != "") {
            $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(2)').find('div#hasil_pencarian').show('fast');
            $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(2)').find('div#hasil_pencarian').html(htmlFoundItem);
        } else {
            let tidakAda = '<ul class="daftar-autocomplete"><li> <span>Data Tidak Ditemukan</span></li><ul>'
            $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(2)').find('div#hasil_pencarian').html(tidakAda);
            $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(2)').find('div#hasil_pencarian').show('fast');
        }
        console.log(foundItem);
        return foundItem.length;
    }

    let tempKeyword = false;
    $(document).on('keyup', '#pencarian_kode', function(e) {
        var keyword = $(this).val();
        console.log(keyword);
        var Indexnya = $(this).parent().parent().index();
        var key = e.which || e.keyCode;
        if (e.which == 40) {
            $(this).select();
            $(this).parent().find("#hasil_pencarian > #daftar-autocomplete li").each(function(i, e) {
                if ($(this).hasClass("--focus") && i < $(this).parent().find('li').length - 1) {
                    $(this).removeClass("--focus");
                    $(this).parent().find('li').each(function(ii, e) {
                        if (ii == (i + 1)) {
                            $(this).addClass("--focus");
                            if ($(this).position().top > 350) {
                                $(this).parent().parent().scrollTop($(this).parent().parent().scrollTop() + 71);
                            }
                        }
                    })
                    return false;
                }
            })
            e.preventDefault();
            return false;
        } else if (e.which == 38) {
            $(this).select();
            $(this).parent().find("#hasil_pencarian > #daftar-autocomplete li").each(function(i, e) {
                if ($(this).hasClass("--focus") && i != 0) {
                    $(this).removeClass("--focus");
                    $(this).parent().find('li').each(function(ii, e) {
                        if (ii == (i - 1)) {
                            $(this).addClass("--focus");
                            if ($(this).position().top < 0) {
                                $(this).parent().parent().scrollTop($(this).parent().parent().scrollTop() - 71);
                            }
                        }
                    })
                    return false;
                }
            })
            e.preventDefault();
            return false;
        } else if (e.which == 13) {
            $(this).select();
            let foundItem = [];
            for (let i = 0; i < dataBarang.length; i++) {
                let reg = new RegExp('^' + keyword + '.*$', 'i');
                if (
                    // dataBarang[i].kode_barcode_varian == keyword ||
                    // dataBarang[i].kode_barang.match(reg) || 
                    // dataBarang[i].nama_barang.includes(keyword) || 
                    ((dataBarang[i].kode_brg ? dataBarang[i].kode_brg : '').toLowerCase()).includes(keyword.toLowerCase()) ||
                    ((dataBarang[i].id ? dataBarang[i].id : '').toLowerCase()).includes(keyword.toLowerCase()) ||
                    ((dataBarang[i].nama_brg ? dataBarang[i].nama_brg : '').toLowerCase()).includes(keyword.toLowerCase())
                ) {
                    foundItem.push(dataBarang[i])
                }
            }

            // foundItem = [foundItem[0]];

            if (foundItem.length > 1) {
                if ($(this).parent().find('#hasil_pencarian > #daftar-autocomplete').is(':visible') && tempKeyword) {
                    $(this).parent().find("#hasil_pencarian > #daftar-autocomplete li").each(function(i, e) {
                        if ($(this).hasClass('--focus')) {
                            $(this).parent().parent().parent().find('input').val($(this).find('span#kode').html());

                            var Indexnya = $(this).parent().parent().parent().parent().index();
                            var KodeBarang = $(this).find('span#kode').html();
                            var NamaBarang = $(this).find('span#nama_brg').html();
                            var IdBarang = $(this).find('span#id_brg').html();
                            var HargaSatuan = $(this).find('span#harga_satuan').html();
                            var HargaGrosir = $(this).find('span#harga_grosir').html();


                            $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(2)').find('div#hasil_pencarian').hide();
                            $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(3) input#nama_brg').val(NamaBarang);
                            // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(4) input#qty').val(0);
                            $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(5) input#harga_satuan').val(HargaSatuan);
                            // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(4)').html(Berat + ' Gram');
                            // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(5)').html(Kadar + ' %');
                            $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(6) input#harga_grosir').val(HargaGrosir);
                            // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(7) input#ongkoskirim').val(Ongkos);
                            // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(8) input#diskon').val(0);
                            // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(9) input#kadar_emas').val(Kadar);
                            // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(9) input#kode_kelompok').val(Kelompok);
                            // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(9) input#sub_total').val(0);
                            // $('#tabeltransaksi tbody tr:eq('+Indexnya+') td:nth-child(4) input#jumlah_beli').removeAttr('disabled').val(1);

                            var IndexIni = Indexnya + 1;
                            var TotalIndex = $('#tabeltransaksi tbody tr').length;
                            if (IndexIni == TotalIndex) {
                                //BarisBaru();
                                $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(4) input').focus();
                                // $('html, body').animate({ scrollTop: $(document).height() }, 0);
                            } else {
                                $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(4) input').focus();
                            }
                            //HitungTotalBayar();
                        }
                    })
                } else {
                    cariBarang(keyword, Indexnya, foundItem);
                    tempKeyword = true;
                }
            } else {
                cariBarang(keyword, Indexnya, foundItem);
                $(this).parent().find("#hasil_pencarian > #daftar-autocomplete li").each(function(i, e) {
                    if ($(this).hasClass('--focus')) {
                        $(this).parent().parent().parent().find('input').val($(this).find('span#kode').html());

                        var Indexnya = $(this).parent().parent().parent().parent().index();
                        var KodeBarang = $(this).find('span#kode').html();
                        var NamaBarang = $(this).find('span#nama_brg').html();
                        var IdBarang = $(this).find('span#id_brg').html();
                        var HargaSatuan = $(this).find('span#harga_satuan').html();
                        var HargaGrosir = $(this).find('span#harga_grosir').html();


                        $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(2)').find('div#hasil_pencarian').hide();
                        $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(3) input#nama_brg').val(NamaBarang);
                        // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(4) input#qty').val(0);
                        $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(5) input#harga_satuan').val(HargaSatuan);
                        // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(4)').html(Berat + ' Gram');
                        // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(5)').html(Kadar + ' %');
                        $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(6) input#harga_grosir').val(HargaGrosir);
                        // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(7) input#ongkoskirim').val(Ongkos);
                        // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(8) input#diskon').val(0);
                        // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(9) input#kadar_emas').val(Kadar);
                        // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(9) input#kode_kelompok').val(Kelompok);
                        // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(9) input#sub_total').val(0);
                        // $('#tabeltransaksi tbody tr:eq('+Indexnya+') td:nth-child(4) input#jumlah_beli').removeAttr('disabled').val(1);

                        var IndexIni = Indexnya + 1;
                        var TotalIndex = $('#tabeltransaksi tbody tr').length;
                        if (IndexIni == TotalIndex) {
                            //BarisBaru();
                            $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(4) input').focus();
                        } else {
                            $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(4) input').focus();
                        }
                        //HitungTotalBayar();

                    }
                })
            }
        } else {
            tempKeyword = false;
        }
    })

    $(document).on('click', '#daftar-autocomplete li', function() {
        $(this).parent().find(".--focus").each(function() {
            $(this).removeClass("--focus");
        })
        $(this).addClass("--focus");
        $(this).parent().parent().parent().find('input').val($(this).find('span#kode').html());

        var Indexnya = $(this).parent().parent().parent().parent().index();
        var KodeBarang = $(this).find('span#kode').html();
        var NamaBarang = $(this).find('span#nama_brg').html();
        var IdBarang = $(this).find('span#id_brg').html();
        var HargaSatuan = $(this).find('span#harga_satuan').html();
        var HargaGrosir = $(this).find('span#harga_grosir').html();


        $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(2)').find('div#hasil_pencarian').hide();
        $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(3) input#nama_brg').val(NamaBarang);
        // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(4) input#qty').val(0);
        $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(5) input#harga_satuan').val(HargaSatuan);
        // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(4)').html(Berat + ' Gram');
        // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(5)').html(Kadar + ' %');
        $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(6) input#harga_grosir').val(HargaGrosir);
        // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(7) input#ongkoskirim').val(Ongkos);
        // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(8) input#diskon').val(0);
        // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(9) input#kadar_emas').val(Kadar);
        // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(9) input#kode_kelompok').val(Kelompok);
        // $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(9) input#sub_total').val(0);
        // $('#tabeltransaksi tbody tr:eq('+Indexnya+') td:nth-child(4) input#jumlah_beli').removeAttr('disabled').val(1);

        var IndexIni = Indexnya + 1;
        var TotalIndex = $('#tabeltransaksi tbody tr').length;
        if (IndexIni == TotalIndex) {
            //BarisBaru();
            $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(4) input').focus();
            // $('html, body').animate({ scrollTop: $(document).height() }, 0);
        } else {
            $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(4) input').focus();
        }
        //HitungTotalBayar();	

    });

    function pencarian_kode(kode_brg, nama_brg, harga_satuan, harga_grosir, nomor) {
        $('.kode_brg' + nomor).val(kode_brg);
        $('.nama_brg' + nomor).val(nama_brg);
        $('.harga_satuan' + nomor).val(harga_satuan);
        $('.harga_grosir' + nomor).val(harga_grosir);
        $('#listbarang').modal('hide');
    }

    $(window).click(function() {
        var Indexnya = $(this).parent().parent().index();
        $('.hasil_pencarian').hide();
    });
    $(document).on('click', '#pencarian_kode', function() {
        $('.hasil_pencarian').hide();
        var Indexnya = $(this).parent().parent().index();
        $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(2)').find('div#hasil_pencarian').show();
    });
    $(document).on('keypress', '#tabeltransaksi', function(e) {
        var key = e.which || e.keyCode;
        if (key == 13) {
            return false;
        }
    });

    $(document).on('keypress', '#tabeltransaksi', function(e) {
        var key = e.which || e.keyCode;
        if (key == 13) {
            return false;
        }
    });

    $(document).on('keydown', 'body', function(e) {
        var charCode = (e.which) ? e.which : event.keyCode;

        if (charCode == 118) //F7
        {
            BarisBaru();
            return false;
        }

        if (charCode == 119) //F8
        {
            $('#UangCash').focus();
            return false;
        }
        if (charCode == 121) //F10
        {
            $('#Simpan').click();
            return false;
        }
    });


    $(document).on('keyup', '#qty', function() {
        var Indexnya = $(this).parent().parent().index();
        var Qty = $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(4) input#qty').val();
        var Harga_Grosir = $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(5) input#harga_grosir').val();
        var Potongan = $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(6) input#potongan').val();

        var SubTotal = parseInt(Harga_Satuan) * parseInt(Qty) - parseInt(Potongan);
        if (SubTotal > 0) {
            var SubTotalVal = SubTotal;
            SubTotal = to_rupiah(SubTotal);
        } else {
            SubTotal = '';
            var SubTotalVal = 0;
        }

        var SubTotal2 = parseInt(Harga_Grosir) * parseInt(Qty) - parseInt(Potongan);
        if (SubTotal2 > 0) {
            var SubTotalVal2 = SubTotal2;
            SubTotal2 = to_rupiah(SubTotal2);
        } else {
            SubTotal2 = '';
            var SubTotalVal2 = 0;
        }
        $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(7) input#subtotal').val(SubTotalVal);
        $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(7) span').html(SubTotal2);
        // console.log(SubTotal);
        // console.log(SubTotal2);
        HitungTotalBayar();
    })

    $(document).on('keyup', '#potongan', function() {
        var Indexnya = $(this).parent().parent().index();
        var Qty = $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(4) input#qty').val();
        var Harga_Grosir = $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(5) input#harga_grosir').val();
        var Potongan = $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(6) input#potongan').val();

        var SubTotal = parseInt(Harga_Grosir) * parseInt(Qty) - parseInt(Potongan);
        if (SubTotal > 0) {
            var SubTotalVal = SubTotal;
            SubTotal = to_rupiah(SubTotal);
        } else {
            SubTotal = '';
            var SubTotalVal = 0;
        }

        var SubTotal2 = parseInt(Harga_Grosir) * parseInt(Qty) - parseInt(Potongan);
        if (SubTotal2 > 0) {
            var SubTotalVal2 = SubTotal2;
            SubTotal2 = to_rupiah(SubTotal2);
        } else {
            SubTotal2 = '';
            var SubTotalVal2 = 0;
        }
        $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(7) input#subtotal').val(SubTotalVal);
        $('#tabeltransaksi tbody tr:eq(' + Indexnya + ') td:nth-child(7) span').html(SubTotal2);
        // console.log(SubTotal);
        // console.log(SubTotal2);
        HitungTotalBayar();
    })

    function HitungTotalBayar() {
        var Total = 0;
        var TotalBayar = 0;
        var TotalPotongan = 0;
        //var TotalDiskon = 0;
        $('#tabeltransaksi tbody tr').each(function() {
            if ($(this).find('td:nth-child(7) input#subtotal').val() > 0) {
                var SubTotal = $(this).find('td:nth-child(7) input#subtotal').val();
                Total = parseInt(Total) + parseInt(SubTotal);
            }
        });

        // $(document).on('keyup', '#inputBayar', function() {
        //     var SubTotalPotongan = $(this).find('td:nth-child(7) input#potongan').val();
        //     TotalPotongan = parseInt(TotalPotongan) + parseInt(SubTotalPotongan);
        // })


        $('#tabeltransaksi tbody tr').each(function() {
            if ($(this).find('td:nth-child(6) input#potongan').val() > 0) {
                var SubTotalPotongan = $(this).find('td:nth-child(6) input#potongan').val();
                TotalPotongan = parseInt(TotalPotongan) + parseInt(SubTotalPotongan);
            }
        });

        $(document).on('keyup', '#inputBayar', function() {
            var bayar = $('input#inputBayar').val();
            // var potongan = $('input#inputPotongan').val();
            var kembalian = 0;

            // console.log(bayar);
            // console.log(potongan);
            // console.log('Total', Total);

            kembalian = parseInt(kembalian) + parseInt(bayar) - parseInt(Total);

            console.log('kembalian', kembalian)
            $('#kembalian').val(to_rupiah(kembalian));
            $('#kembalian2').html(to_rupiah(kembalian));

        })
        // $(document).on('keyup', '#inputPotongan', function() {
        //     var bayar = $('input#inputBayar').val();
        //     var potongan = $('input#inputPotongan').val();
        //     var kembalian = 0;

        //     // console.log(bayar);
        //     // console.log(potongan);
        //     // console.log('Total', Total);

        //     kembalian = parseInt(kembalian) + parseInt(bayar) - parseInt(Total) + parseInt(potongan);

        //     console.log('kembalian', kembalian)
        //     $('#kembalian').val(to_rupiah(kembalian));
        //     $('#kembalian2').html(to_rupiah(kembalian));

        // })
        // $('#tabeltransaksi tbody tr').each(function() {
        // 	if ($(this).find('td:nth-child(8) input#diskon').val() > 0) {
        // 		var SubTotalDiskon = $(this).find('td:nth-child(8) input#diskon').val();
        // 		TotalDiskon = parseInt(TotalDiskon) + parseInt(SubTotalDiskon);
        // 	}
        // });
        // console.log('Total', Total);
        // console.log('Kembalian', kembalian);
        $('#totalPotongan').val(TotalPotongan);
        $('#totalbelanja').val(Total);
        $('#totalbelanja2').html(to_rupiah(Total));

        // $('#TotalOngkir').val(TotalOngkos);
        //$('#TotalDiskon').val(TotalDiskon);

        $('#terbilang').val(sayit(Total));


    }

    function to_rupiah(angka) {
        var rev = parseInt(angka, 10).toString().split('').reverse().join('');
        var rev2 = '';
        for (var i = 0; i < rev.length; i++) {
            rev2 += rev[i];
            if ((i + 1) % 3 === 0 && i !== (rev.length - 1)) {
                rev2 += '.';
            }
        }
        return rev2.split('').reverse().join('');
    }

    var thoudelim = ".";
    var decdelim = ",";
    var curr = "Rp ";
    var d = document;

    function format(s, r) {
        s = Math.round(s * Math.pow(10, r)) / Math.pow(10, r);
        s = String(s);
        s = s.split(".");
        var l = s[0].length;
        var t = "";
        var c = 0;
        while (l > 0) {
            t = s[0][l - 1] + (c % 3 == 0 && c != 0 ? thoudelim : "") + t;
            l--;
            c++;
        }
        s[1] = s[1] == undefined ? "0" : s[1];
        for (i = s[1].length; i < r; i++) {
            s[1] += "0";
        }
        return curr + t + decdelim + s[1];
    }

    function threedigit(word) {
        eja = Array("Nol", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan");
        while (word.length < 3) word = "0" + word;
        word = word.split("");
        a = word[0];
        b = word[1];
        c = word[2];
        word = "";
        word += (a != "0" ? (a != "1" ? eja[parseInt(a)] : "Se") : "") + (a != "0" ? (a != "1" ? " Ratus" : "ratus") : "");
        word += " " + (b != "0" ? (b != "1" ? eja[parseInt(b)] : "Se") : "") + (b != "0" ? (b != "1" ? " Puluh" : "puluh") : "");
        word += " " + (c != "0" ? eja[parseInt(c)] : "");
        word = word.replace(/Sepuluh ([^ ]+)/gi, "$1 Belas");
        word = word.replace(/Satu Belas/gi, "Sebelas");
        word = word.replace(/^[ ]+$/gi, "");

        return word;
    }

    function sayit(s) {
        var thousand = Array("", "Ribu", "Juta", "Milyar", "Trilyun");
        s = Math.round(s * Math.pow(10, 2)) / Math.pow(10, 2);
        s = String(s);
        s = s.split(".");
        var word = s[0];
        var cent = s[1] ? s[1] : "0";
        if (cent.length < 2) cent += "0";

        var subword = "";
        i = 0;
        while (word.length > 3) {
            subdigit = threedigit(word.substr(word.length - 3, 3));
            subword = subdigit + (subdigit != "" ? " " + thousand[i] + " " : "") + subword;
            word = word.substring(0, word.length - 3);
            i++;
        }
        subword = threedigit(word) + " " + thousand[i] + " " + subword;
        subword = subword.replace(/^ +$/gi, "");

        word = (subword == "" ? "NOL" : subword.toUpperCase()) + " RUPIAH";
        subword = threedigit(cent);
        cent = (subword == "" ? "" : " ") + subword.toUpperCase() + (subword == "" ? "" : " SEN");
        return word + cent;
    }
</script>
<script>
    $(document).ready(function() {
        $("button").click(function() {
            //$("#d").trigger("reset");
            //$("#d").get(0).reset();
            $("#d")[0].reset()
        });
    });
</script>
<?php $this->load->view('partials/footer'); ?>