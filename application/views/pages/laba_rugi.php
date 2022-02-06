<?php $this->load->view('partials/header.php'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Laba Rugi</h1>
    <div class="card shadow py-2">
        <div class="card-body">

            <form action="<?php echo base_url(); ?>admin/cetak_pdf_labarugi" method="POST" class="row">
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
                <input style="margin-right: 10px;" name="submit" type="submit" value="Cetak PDF" class="btn btn-success" />
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
<script>
    $(".labaRugiFilter").change(function() {
        var thisVal = $(this).val();
        var other = $(this).data('other');
        var otherVal = $(other).val();

        if (thisVal != '' && otherVal != '') {
            var dataPost;
            if (other == '#tahun') {
                dataPost = {
                    bulan: thisVal,
                    tahun: otherVal
                }
            } else {
                dataPost = {
                    tahun: thisVal,
                    bulan: otherVal
                }
            }
            console.log(dataPost);
            $.ajax({
                type: 'post',
                data: dataPost,
                url: "<?php base_url() ?>getLabarugi",
                success: function(data) {
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
                    $("#kebersihan").html(rupiah(parseInt(data.kebersihan)))
                    $("#perawatan").html(rupiah(parseInt(data.perawatan)))
                    $("#barcode").html(rupiah(parseInt(data.barcode)))
                    $("#lainlain").html(rupiah(parseInt(data.lainlain)))
                    $("#totalbeban").html(rupiah(parseInt(data.totalbeban)))
                    $("#lababersih").html(rupiah(data.laba_bersih))
                    $("#pendapatanlain").html(rupiah(parseInt(data.pendapatan_lain)))
                    $("#kulaan").html(rupiah(parseInt(data.kulaan)))
                    $("#totalnon").html(rupiah(parseInt(data.total_non)))
                    // $("#total").val(parseInt(data.kas))
                    // $("#lababersih").val(data.laba_bersih)

                }
            })
        }

        // hitung_labarugi();
    })

    function rupiah(angka) {
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
<?php $this->load->view('partials/footer.php'); ?>