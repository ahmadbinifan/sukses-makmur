<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur Penjualan <?= $jual['jual_customer'] ?></title>
    <style>
        body {
            font-size: 20px;
            line-height: 30px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
            transform: scale(1);
            transform-origin: 0 0;
        }

        .row {
            margin-top: 15px;
        }

        .table {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .border-black td {

            border-top: 1px solid black !important;

        }

        .table-condensed>thead>tr>th {

            border-bottom: 1px solid black !important;
            border-right: 1px solid black !important;
        }

        .br>tr>td {
            border-right: 1px solid black !important;
        }

        @media print {
            body {
                font-size: 20px;
                font-weight: bold;
                line-height: 24px;
                font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                color: #555;
                transform: scale(1);
                transform-origin: 0 0;
            }

            .row {
                margin-top: 15px;
            }

            .table {
                border: 1px solid black;
                border-collapse: collapse;
            }

            .border-black td {

                border-top: 1px solid black !important;

            }

            .table-condensed>thead>tr>th {

                border-bottom: 1px solid black !important;
                border-right: 1px solid black !important;
            }

            .br>tr>td {
                border-right: 1px solid black !important;
            }
        }
    </style>
</head>

<body>
    <center>
        <b style="font-size: 28px;">FAKTUR PENJUALAN</b>
    </center>
    <span style="font-weight: bold; font-size : 19px; margin-left: 4px">KP. SELAMAT MAKMUR</span>
    <span style="font-size : 17px;margin-left:27%;"><?= date('d M Y', strtotime($jual['jual_tanggal'])) ?></span>
    <span style="font-size : 22px; float:right;"><b>Kepada Yth. <?= $jual['jual_customer'] ?><br>NO HP. <?= $jual['jual_customer_nohp'] ?> <br>Alamat. <?= $jual['jual_customer_alamat'] ?> </b></span>
    <br>
    <span style="font-size : 17px; margin-left: 4px">Jl. AMD / Bajenis Tebing Tinggi</span>

    <br>
    <span style="font-size : 17px; margin-left: 4px">NO HP. 0822 7957 2457 - 0852 6240 8736</span>
    <table class="table table-condensed" style="width:100%; margin: top 2px;">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody class="br">
            <?php
            $no = 1;
            foreach ($jual_detail as $items) {
            ?>
                <tr>
                    <td align="center"><?= $no++ ?></td>
                    <td style="font-size: 22px; font-weight : bold"><?= $items['d_jual_barang_nama'] ?></td>
                    <td align="center"><?= $items['d_jual_qty'] ?></td>
                    <td align="right"><?= number_format($items['d_jual_barang_harpok']) ?></td>
                    <td align="right"><?= number_format($items['d_jual_total']) ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <?php
        $totalArray = count($jual_detail);
        $baru = 15 - $totalArray;
        for ($i = 0; $i - $baru; $i++) {
        ?>
            <tbody class="br">
                <tr>
                    <td align="center"><?= $no++ ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

            </tbody>
        <?php } ?>
        <tfoot style="border-top: 1px solid black;">
            <tr>
                <td colspan="4" align="center" style="border-right: 1px solid black;">Grand Total</td>
                <td align="right"><?= number_format($jual['jual_total']) ?></td>
            </tr>
        </tfoot>
    </table>
    <div class="row">
        <span style="width:50px;height:70px;margin-right:210px;">
            Hormat Kami
        </span>
        <span style="width:50px;height:70px;margin-right:210px;">
            Diketahui Oleh
        </span>
        <span style="width:50px;height:70px;margin-right:210px;">
            Diketahui Oleh
        </span>
        <span style="width:50px;height:70px;margin-right:100;">
            Diterima Oleh
        </span>
        <br><br><br>
        <span style="width:80px;height:70px;margin-right:205px;">___________</span>
        <span style="width:80px;height:70px;margin-right:220px;">___________</span>
        <span style="width:80px;height:70px;margin-right:215px;">___________</span>
        <span>___________</span>
        <br>
        <span style="width:80px;height:70px;margin-right:250px;margin-left:15px">Admin</span>
        <span style="width:80px;height:70px;margin-right:285px">Supervisor</span>
        <span style="width:80px;height:70px;margin-right:250px">Supir</span>
    </div>
    <div class="row">
        <span style="font-weight: bold; font-size: 17px">NB: Maaf, Barang yang sudah dibeli tidak bisa ditukar / dikembelikan</span>
    </div>
    <script>
        document.onkeyup = KeyCheck;

        function KeyCheck(e) {
            var KeyID = (window.event) ? event.keyCode : e.keyCode;
            if (KeyID == 13) {
                window.print()
            }
        }
    </script>
</body>

</html>