<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
            * {
    font-size: 12px;
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
    width: 75px;
    max-width: 75px;
}

td.quantity,
th.quantity {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}

td.price,
th.price {
    width: 75px;
    max-width: 75px;
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
}
        </style>
        <title>KP. SELAMAT MAKMUR</title>
    </head>
    <body>
        <div class="ticket">
            <!-- <img src="./logo.png" alt="Logo"> -->
            <p class="centered">KP. SELAMAT MAKMUR
                <br>    JL. AMD / Bajenis Tebing Tinggi
                <br> HP. 0852 6240 8736 - 0813 7602 7637</p>
            <table>
                <thead>
                    <tr>
                        <th class="description">Nama</th>
                        <th class="quantity">Qty</th>
                        <th class="price">Rp.</th>
                                        </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($jual_detail as $items) {?>
                     <tr>
                    <td class="description"><?= $items['d_jual_barang_nama']?></td>
                        <td class="quantity"><?= $items['d_jual_qty'] ?></td>
                        <td class="price"><?= $items['d_jual_total']?></td>
                    </tr>
                <?php }   ?>
                
                </tbody>
                <tfoot>
                <tr>
                        <td class="quantity"></td>
                        <td class="description">TOTAL</td>
                        <td class="price"><?= $jual['jual_total']?></td>
                    </tr>
                </tfoot>
            </table>
            <p class="centered">Terima Kasih sudah Belanja
                <br>KP. SELAMAT MAKMUR</p>
        </div>
        <!-- <button id="btnPrint" class="hidden-print">Print</button> -->
        <!-- <script src="<?= base_url('dist/js/invoice.js')?>"></script> -->
    </body>
</html>