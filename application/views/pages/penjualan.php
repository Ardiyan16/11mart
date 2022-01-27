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
    <div class="card-body">
        <form action="<?= base_url('kasir/aksipenjualan') ?>" method="POST">
            <div class="row">
                <div class="col-md-4">
                    <label for="">No Nota</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><span class="fas fa-credit-card"></span> </span>
                        </div>
                        <input type="text" name="kode_penjualan" id="no_nota" class="form-control no_nota">
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
                        <input type="text" value="<?= $tgl ?>" name="tanggal_jual" class="form-control datepicker">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="">Nama Pembeli</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><span class="fas fa-address-book"></span> </span>
                        </div>
                        <input type="text" name="nama_pembeli" class="form-control">
                    </div>
                </div>
            </div>
            <hr>
            <!-- <div class="loop-detail" data-counting='1'>
                <?php
                $this->load->view('penjualan/loop-detail', ['start' => 1, 'now' => 1])
                ?>
            </div> -->
            <div class="row">
                <div class="table-responsive">
                    <table class="table text-center" id="tabeltransaksi">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Barang</th>
                                <!-- <th scope="col">Cari</th> -->
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Ket</th>
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
                    <button type="button" style="margin-top: 25px;" class="btn-sm btn-primary" id="BarisBaru">
                        <i class="fa fa-plus"> Baris Baru</i>
                    </button>
                    <!-- <a href="<?= base_url() . "transaksi/addDetailPenjualan" ?>" class="btn btn-default addDetail"><span class="fa fa-plus"></span> Tambah Item</a> -->
                </div>
                <div class="col-auto ml-auto">
                </div>
                <div class="col-auto ml-auto">
                    <h4 class="total">Total : <span id='totalbelanja2'>0</span> &nbsp; <span class='color-blue'> Kembalian : </ span><span id='kembalian2'>0</span> </h4>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <label for="">Keterangan</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><span class="fas fa-address-book"></span> </span>
                        </div>
                        <input type="text" name="keterangan2" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="">Total Bayar</label>
                    <div class="input-group mb-3">
                        <input type="number" name="total_bayar" class="form-control totalKembalian" id='inputBayar' value='0'>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="">Total Potongan</label>
                    <div class="input-group mb-3">
                        <input type="number" name="potongan" class="form-control totalKembalian" id='inputPotongan' value='0'>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="">Total Belanja</label>
                    <div class="input-group mb-3">
                        <!-- <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><span class="fas fa-money-check"></span> </span>
                        </div> -->
                        <input type="text" readonly name="total_penjualan" class="form-control totalbelanja" id='totalbelanja'>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="">Kembalian</label>
                    <div class="input-group mb-3">
                        <input type="text" readonly name="kembalian" class="form-control totalKembalian" id='kembalian' value='0'>
                    </div>
                </div>
                <!-- <div class="col-md-4">
                    <label for="">Kembalian</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><span class="fas fa-address-book"></span> </span>
                        </div>
                        <input type="text" name="kembalian" class="form-control totalKembalian" id='kembaliann'>
                    </div>
                </div> -->
            </div>

            <div class="mt-3">
                <?php
                $this->load->view('common/btn');
                ?>
            </div>
            <span id="datanya"></span>
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
                            <td>Harga Jual</td>
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
<?php $this->load->view('partials/footer'); ?>