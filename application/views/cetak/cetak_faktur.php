<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur Penjualan <?= $jual['jual_customer']?></title>
    <style>
        body{
            font-size:16px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
        }
        .table {
  border: 1px solid black;
  border-collapse: collapse;
}
.border-black td {

border-top: 1px solid black !important;

}

.table-condensed > thead > tr > th {

border-bottom: 1px solid black !important;
border-right: 1px solid black !important;
}
.br > tr > td {
    border-right: 1px solid black !important;
}

    </style>
</head>
<body>
    <center>
      <b>FAKTUR PENJUALAN</b>
    </center>
    <table style="width:100%; margin-bottom: 10px">
        <tr>      
<th align="left">Tanggal. <?=$jual['jual_tanggal']?></th>
<th rowspan="2" align="left" style="border-left: 1px solid black;border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black !important;"><b>Kepada Yth. <br><?= $jual['jual_customer']?></b></th>
</tr>    
<tr>
    <th align="left">No Faktur. <?= $jual['jual_nofak']?> </th>
    <!-- <th align="right" style="border-left: 1px solid black;border-borrom: 1px solid black;border-right: 1px solid black;"> </th> -->
</tr>
</table>
<table class="table table-condensed" style="width:100%; margin: top 2px;" >
<thead >
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
    foreach($jual_detail as $items) {
        
        ?>
    
    <tr>
        <td align="center"><?= $no++?></td>
        <td><?= $items['d_jual_barang_nama']?></td>
        <td align="center"><?= $items['d_jual_qty']?></td>
        <td align="right"><?= number_format($items['d_jual_barang_harpok'])?></td>
        <td align="right"><?= number_format($items['d_jual_total'])?></td>
    </tr>
<?php } ?> 
</tbody>
</table>
</body>
</html>