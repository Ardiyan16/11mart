<?php $this->load->view('partials/header_kasir'); ?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Laporan Stok</h1>
    <div class="card shadow py-2">
        <div class="card-body">
            <hr>
            <form action="<?= base_url('kasir/save_laporan_stok'); ?>" method="POST" enctype="multipart/form-data">
                <label>Bulan</label>
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
                <br>
                <label>Tahun</label>
                <select class="form-control" name="tahun" id="tahun" required>
                    <option>--Pilih Tahun--</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                </select>
                <input name="id_kasir" type="hidden" value="<?= $this->session->userdata('id') ?>" placeholder="" class="form-control" required>
                <br>
                <label>Nama Barang</label>
                <input type="text" name="nama_brg" placeholder="Nama Barang" class="form-control" required>
                <br>
                <a href="#barang" data-toggle="modal" class="btn btn-info"><i class="fa fa-search"></i> Cari Barang</a>
                <br>
                <input name="kode_brg" id="kode_brg" type="hidden" class="form-control kode_brg" required>
                <br>
                <label>Stok</label>
                <input name="stok_brg" type="number" placeholder="Stok" class="form-control" required>
                <br>
                <button type="reset" class="btn btn-danger"> <span class="fa fa-times"></span> Reset</button>
                <button type="submit" class="btn btn-primary"> <span class="fa fa-save"></span> Simpan</button>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Centang</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($barang as $brg) { ?>
                                <tr>
                                    <td><input type="checkbox" class="checklist" id="checklist" value="<?= $brg->kode_brg ?>"></td>
                                    <td><?= $brg->kode_brg ?></td>
                                    <td><?= $brg->nama_brg ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary pilihan" data-dismiss="modal">Pilih</button>
            </div>
        </div>
    </div>
</div>
<script>
    <?php if ($this->session->flashdata('insert')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Laporan stok berhasil disimpan!',
            showConfirmButton: true,
            // timer: 1500
        })
    <?php endif ?>

    $('.pilihan').click(function(e) {
        e.preventDefault();
        var arr = [];
        var checkedValue = $(".checklist:checked").val();
        console.log('checked', checkedValue);
        //$('#tambahpenggajian').modal('show');
        $.ajax({
            url: "<?php echo base_url('kasir/get_id/') ?>" + checkedValue,
            type: "GET",
            dataType: "JSON",
            success: function(result) {
                $('[name="kode_brg"]').val(result.kode_brg);
                //$('[name="id_invoices"]').val(result.id_service);
                $('[name="nama_brg"]').val(result.nama_brg);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Data Eror');
            }
        })
    });

    $(".checklist").on("click", function() {
        if ($(".checklist:checked").length < 2) {
            $('.pilihan').prop('disabled', false);
            // $('.dipilihan').prop('disabled', false);
        } else {
            $('.pilihan').prop('disabled', true);
            // $('.diambil').prop('disabled', true);
        }
    });
</script>
<?php $this->load->view('partials/footer'); ?>