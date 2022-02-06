<?php $this->load->view('partials/header.php'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Laba Rugi</h1>
    <div class="card shadow py-2">
        <div class="card-body">

            <form action="<?php echo base_url(); ?>Laporan/exportlabarugi" method="POST" class="row">
                <div class="col-md-2">
                    <select class="form-control labaRugiFilter" id='bulan' data-other='#tahun' name="bulan" required>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
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
                        <td id='penjualan'></td>
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
                        <td id='pajak'></td>
                    </tr>
                    <tr>
                        <td>- Biaya Pajak</td>
                        <td></td>
                        <td id='peralatan'></td>
                    </tr>
                    <tr>
                        <td>- Biaya Lain-lain</td>
                        <td></td>
                        <td id='perawatan'></td>
                    </tr>
                    <tr>
                        <td>- Biaya Kulaan</td>
                        <td></td>
                        <td id='barcode'></td>
                    </tr>
                    <tr>
                        <td>- Total Beban</td>
                        <td></td>
                        <td id='total'></td>
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
<script>
    $(".labaRugiFilter").change(function(){
		var thisVal = $(this).val();
		var other = $(this).data('other');
		var otherVal = $(other).val();

		if(thisVal!='' && otherVal!=''){
			var dataPost;
			if(other=='#tahun'){
				dataPost = {bulan : thisVal, tahun : otherVal}
			}
			else{
				dataPost = {tahun : thisVal, bulan : otherVal}
			}
			console.log(dataPost);
			$.ajax({
				type : 'post',
				data : dataPost,
				url : "<?php base_url() ?>admin/getLabarugi",
				success : function(data){
					$("#penjualan").html(rupiah(parseInt(data.penjualan)))
					$("#potonganPenjualan").html(rupiah(parseInt(data.potongan_penjualan)))
					// $("#return").html(rupiah(parseInt(data.return_penjualan)))
					$("#totalPenjualan").html(rupiah(parseInt(data.total_penjualan)))
					//$("#dataPokok").html(rupiah(parseInt(data.da)))
					$("#labakotor").html(rupiah(parseInt(data.total_penjualan)))
					$("#labaRugi").html(rupiah(parseInt(data.laba_rugi)))
					$("#gaji").html(rupiah(parseInt(data.gaji)))
					$("#listrik").html(rupiah(parseInt(data.listrik)))
					$("#pajak").html(rupiah(parseInt(data.pajak)))
					$("#peralatan").html(rupiah(parseInt(data.peralatan)))
					$("#perawatan").html(rupiah(parseInt(data.perawatan)))
					$("#barcode").html(rupiah(parseInt(data.barcode)))
					$("#lain").html(rupiah(parseInt(data.lain)))
					$("#total").html(rupiah(parseInt(data.kas)))
					$("#lababersih").html(rupiah(data.laba_bersih))
					$("#pendapatanlain").html(rupiah(parseInt(data.pendapatan_lain)))
					$("#bebanlain").html(rupiah(parseInt(data.beban_lain)))
					$("#totalnon").html(rupiah(parseInt(data.total_non)))
					// $("#total").val(parseInt(data.kas))
					// $("#lababersih").val(data.laba_bersih)

				}
			})
		}

		// hitung_labarugi();
	})
</script>
<?php $this->load->view('partials/footer.php'); ?>