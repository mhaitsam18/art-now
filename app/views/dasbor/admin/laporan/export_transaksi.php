<!DOCTYPE html>
<html>
<head>
	<title>Transaksi</title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;
 
	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>
 
	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Laporan Transaksi.xls");
	?>
 
	<center>
		<h3>Laporan Transaksi</h3>
	</center>
 
    <table>
        <tr>
            <td></td>
            <td>Tanggal</td>
            <td>: <?=$data['rentang_tanggal']?></td>
        </tr>
    </table>
	<table border="1">
		<tr>
            <th>No</th>
            <th>Total Dibayar</th>
            <th>Pembayaran</th>
            <th>Nama Pelanggan</th>
            <th>Email Pelanggan</th>
            <th>Nama Arsitek</th>
            <th>Email Arsitek</th>
            <th>Judul Produk</th>
            <th>Waktu</th>
		</tr>
        <?php $i = 1; foreach($data['transaksis'] as $transaksi) { ?>
            <tr>
                <td><?= $i; ?></td>
                <td>Rp <?= number_format($transaksi['total_telah_dibayar'], 0, ',', '.'); ?></td>
                <td><?= ($transaksi['status_pembayaran']==1) ? 'Kedua':'Pertama' ?></td>
                <td><?= $transaksi['nama_lengkap_pengguna']; ?></td>
                <td><?= $transaksi['email_pengguna']; ?></td>
                <td><?= $transaksi['nama_lengkap_arsitek']; ?></td>
                <td><?= $transaksi['email_arsitek']; ?></td>
                <td><?= $transaksi['judul_produk']; ?></td>
                <td><?= date('Y-m-d H:i', strtotime($transaksi['dibuat_pada']));?></td>
            </tr>
        <?php $i++; } ?>
	</table>
</body>
</html>