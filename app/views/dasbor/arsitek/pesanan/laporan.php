<!DOCTYPE html>
<html>
<head>
	<title>Pesanan</title>
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
	header("Content-Disposition: attachment; filename=Pesanan.xls");
	?>
 
	<center>
		<h3>Laporan Pesanan</h3>
	</center>
 
	<table border="1">
		<tr>
			<th>No</th>
			<th>Nama Pelanggan</th>
			<th>Judul Produk</th>
			<th>Status Pesanan</th>
			<th>Tanggal Pesanan</th>
			<th>Diperbaharui</th>
		</tr>
        <?php $i = 1; foreach($data['pesanans'] as $pesanan) { ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $pesanan['nama_lengkap']; ?></td>
                <td><?= $pesanan['judul']; ?></td>
                <td>
                    <?php if($pesanan['status'] == -2 ) { ?>
                        dibatalkan
                    <?php } else if($pesanan['status'] == -1 ) { ?>
                        ditolak
                    <?php } else if($pesanan['status'] == 0 ) { ?>
                        menunggu
                    <?php } else if($pesanan['status'] == 1 ) { ?>
                        sedang
                    <?php } else if($pesanan['status'] == 2 ) { ?>
                        menunggu pembayaran
                    <?php } else if($pesanan['status'] == 3 ) { ?>
                        selesai
                    <?php } ?>
                </td>
                <td><?= date('d F Y H:i', strtotime($pesanan['dibuat_pada']));?></td>
                <td><?= date('d F Y H:i', strtotime($pesanan['diperbaharui_pada']));?></td>
            </tr>
        <?php $i++; } ?>
	</table>
</body>
</html>