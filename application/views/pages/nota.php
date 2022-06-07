<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Nota</title>
</head>
<style>
    * {
        font-size: 9px;
        font-family: 'Times New Roman';
    }

    td,
    th,
    tr,
    table {
        border-top: 1px solid black;
        border-collapse: collapse;
    }

    td.description,
    th.description {
        width: 70px;
        max-width: 70px;
    }

    td.quantity,
    th.quantity {
        width: 20px;
        max-width: 20px;
        text-align: center;
        word-break: break-all;
    }

    td.hs,
    th.hs {
        width: 32px;
        max-width: 32px;
        word-break: break-all;
    }

    td.price,
    th.price {
        width: 33px;
        max-width: 33px;
        word-break: break-all;
    }

    .centered {
        text-align: center;
        align-content: center;
    }

    .ticket {
        width: 155px;
        max-width: 155px;
    }

    img {
        max-width: inherit;
        width: inherit;
    }

    @media print {

        .hidden-print,
        .hidden-print * {
            display: none !important;
        }

        .hidden-back,
        .hidden-back * {
            display: none !important;
        }
    }
</style>

<body>
    <div class="ticket">
        <p class="centered">Toko 11 Mart
            <br>Jl Menuju Kebahagiaan
            <br>08211223344
        </p>
        <p align="left"><?= $jual['kasir'] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; <?= $jual['tgl_pj'] ?></p>
        <table >
            <thead>
                <tr>
                    <th class="description">Nama</th>
                    <th class="quantity">Qty</th>
                    <th class="hs">stn</th>
                    <th class="price">Sub</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detail as $d) : ?>
                    <tr>
                        <td class="description"><?= $d->nama_brg ?></td>
                        <td class="quantity"><?= $d->qty ?></td>
                        <td class="hs"><?= $d->harga ?></td>
                        <td class="price"><?= $d->subtotal ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="description"></td>
                    <td class="quantity"></td>
                    <td class="hs">Total</td>
                    <td class="price"><?= $jual['total_pj'] ?></td>
                </tr>
                <tr>
                    <td class="description"></td>
                    <td class="quantity"></td>
                    <td class="hs">Bayar</td>
                    <td class="price"><?= $jual['total_byr'] ?></td>
                </tr>
                <tr>
                    <td class="description"></td>
                    <td class="quantity"></td>
                    <td class="hs">Diskon</td>
                    <td class="price"><?= $jual['total_potongan'] ?></td>
                </tr>
                <tr>
                    <td class="description"></td>
                    <td class="quantity"></td>
                    <td class="hs">kembali</td>
                    <td class="price"><?= $jual['kembalian'] ?></td>
                </tr>
            </tfoot>
        </table>
        <p class="centered">Terima Kasih telah berbelanja
            <br>Semoga bermanfaat
        </p>
    </div>
    <button id="btnPrint" class="hidden-print">Cetak</button>
    <a href="<?= base_url('kasir') ?>" class="hidden-back">Kembali</a>
</body>
<script>
    const $btnPrint = document.querySelector("#btnPrint");
    $btnPrint.addEventListener("click", () => {
        window.print();
    });
</script>

</html>