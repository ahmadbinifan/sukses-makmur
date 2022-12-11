<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur Penjualan</title>
    <style>
        body {
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .row {
            margin-top: 15px;
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

        .isi th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <center>
        <b>LAPORAN HISTORY PENJUALAN</b>
    </center>
    <span style="font-weight: bold; font-size : 19px; margin-left: 4px">KP. SELAMAT MAKMUR</span><br>
    <span style="font-size : 17px; margin-left: 4px">Jl. AMD / Bajenis Tebing Tinggi</span><br>
    <span style="font-size : 17px; margin-left: 4px">NO HP. 0822 7957 2457 - 0852 6240 8736</span>
    <table style="width:100%; margin-bottom: 10px">
        <tr>
            <th>Tanggal . <?= $tanggal ?></th>
        </tr>
    </table>
    <table class="isi" style="width: 100%; border: 1px solid black;border-collapse: collapse;">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Customer</th>
                <th>Tanggal</th>
                <th>No Faktur.</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($header as $value) {

            ?>
                <tr>
                    <td align="center"><?= $no++ ?></td>
                    <td align="center"><?= $value['jual_customer'] ?></td>
                    <td align="center"><?= $value['jual_tanggal'] ?></td>
                    <td align="center"><?= $value['jual_nofak'] ?></td>
                    <td align="right"><?= "Rp. " . number_format($value['jual_total']) ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot style="border-top: 1px solid black;">
            <tr>
                <td colspan="4" align="center" style="border-right: 1px solid black;">Grand Total</td>
                <td align="right"><?= "Rp. " . number_format($total) ?></td>
            </tr>
        </tfoot>
    </table>
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