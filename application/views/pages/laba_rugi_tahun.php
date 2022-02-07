<?php $this->load->view('partials/header.php'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Laba Rugi Pertahun</h1>
    <div class="card shadow py-2">
        <div class="card-body">

            <form action="<?php echo base_url(); ?>admin/export_laba_rugi" method="POST" class="row">
                <div class="col-md-2">
                    <select class="form-control labaRugiFilter" data-other='#bulan' name="tahun" id="tahun" required>
                        <?php
                        $yearNow = (int)date('Y');
                        for ($i = $yearNow; $i >= $yearNow - 10; $i--) {
                            echo "<option>$i</option>";
                        }
                        ?>
                    </select>
                </div>
                <input style="margin-right: 10px;" name="submit1" type="submit" value="Cek" class="btn btn-success" />
                <input style="margin-right: 10px;" name="submit2" type="submit" value="Cetak PDF" class="btn btn-success" />
            </form>
            <br>
            <div class="table-responsive">
                <table class="table table-striped table-custom" id="tbl_labarugi">
                    <tr>
                        <td>
                            <h5 style="color: green;">PENJUALAN</h5>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>-Hasil Penjualan</td>
                        <td></td>
                        <td id='totalPenjualan'></td>
                    </tr>
                    <tr>
                        <td>
                            <h5 style="color: green;">BEBAN KEUANGAN</h5>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>- Biaya Gaji Karyawan</td>
                        <td></td>
                        <td id='gaji'></td>
                    </tr>
                    <tr>
                        <td>- Biaya Listrik</td>
                        <td></td>
                        <td id='listrik'></td>
                    </tr>
                    <tr>
                        <td>- Biaya Kebersihan</td>
                        <td></td>
                        <td id='kebersihan'></td>
                    </tr>
                    <tr>
                        <td>- Biaya Pajak</td>
                        <td></td>
                        <td id='pajak'></td>
                    </tr>
                    <tr>
                        <td>- Biaya Lain-lain</td>
                        <td></td>
                        <td id='lainlain'></td>
                    </tr>
                    <tr>
                        <td>- Biaya Kulaan</td>
                        <td></td>
                        <td id='kulaan'></td>
                    </tr>
                    <tr>
                        <td>- Total Beban</td>
                        <td></td>
                        <td id='totalbeban'></td>
                    </tr>
                    <tr>
                        <td>
                            <h5 style="color: green;">LABA BERSIH</h5>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            - Laba Bersih
                        </td>
                        <td></td>
                        <td id='lababersih'></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('partials/footer.php'); ?>