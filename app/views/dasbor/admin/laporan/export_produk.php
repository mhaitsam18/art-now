<!DOCTYPE html>
<html>
<head>
	<title>Produk Arsitek</title>
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
	header("Content-Disposition: attachment; filename=Laporan Produk Arsitek.xls");
	?>
 
	<center>
		<h3>Laporan Produk Arsitek</h3>
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
            <th>Judul Produk</th>
            <th>Harga Jasa</th>
            <th>Penilaian</th>
			<th>Tautan Video</th>
			<th>Kategori</th>
            <th>Status Jasa</th>
            <!-- <th>Nama Arsitek</th>
            <th>Email Arsitek</th>
            <th>Telepon Arsitek</th> -->
            <th>Dibuat Pada</th>
            <th>Diperbaharui Pada</th>
		</tr>
        <?php $i = 1; foreach($data['produks'] as $produk) { ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $produk['judul']; ?></td>
                <td>Rp <?= number_format($produk['harga'], 0, ',', '.'); ?></td>
                <td><?= number_format($produk['rating'], 1); ?>/5 dari <?= $produk['total_rating']; ?> penilaian</td>
				<td><?= $produk['tautan_video']; ?></td>
				<td>
					<?php if($produk['kategori'] == "1") { ?>
						Desain Rumah Terbaru
					<?php } else if($produk['kategori'] == "2") { ?>
						Desain Rumah Minimalis
					<?php } else if($produk['kategori'] == "3") { ?>
						Desain Rumah Mewah
					<?php } else if($produk['kategori'] == "4") { ?>
						Desain Interior
					<?php } else if($produk['kategori'] == "0") { ?>
						Desain Bangunan Lainnya
					<?php } else { ?>

					<?php } ?>
				</td>
                <td align="center">
                    <?php if($produk['status'] == 1 ) { ?>
                        AKTIF
                    <?php } else { ?>
                        NONAKTIF
                    <?php } ?>
                </td>
                <!-- <td><?= $produk['nama_lengkap']; ?></td>
                <td><?= $produk['email']; ?></td>
                <td><?= $produk['telepon']; ?></td> -->
                <td><?= date('Y-m-d H:i', strtotime($produk['dibuat_pada']));?></td>
                <td><?= date('Y-m-d H:i', strtotime($produk['diperbaharui_pada']));?></td>
            </tr>
        <?php $i++; } ?>
	</table>
</body>
</html>