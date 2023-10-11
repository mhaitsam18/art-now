<!DOCTYPE html>
<html>
<head>
	<title>Keuangan</title>
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
	header("Content-Disposition: attachment; filename=Laporan Keuangan.xls");
	?>
 
	<center>
		<h3>Laporan Keuangan</h3>
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
            <th>Arsitek</th>
            <th>Keterangan</th>
            <th>Nominal</th>
            <th>status</th>
            <th>Waktu</th>
		</tr>
        <?php $i = 1; foreach($data['keuangans'] as $keuangan) { ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $keuangan['nama_lengkap']; ?></td>
                <td><?= $keuangan['keterangan']; ?></td>
                <td>
                    <?php if($keuangan['nominal'] > 0) {?>
                        +<?= number_format($keuangan['nominal'], 0, ',', '.'); ?>
                    <?php } else { ?>
                        <?php if($keuangan['keterangan'] == "Biaya admin penarikan saldo") {?>
                            =<?= number_format($keuangan['nominal']*-1, 0, ',', '.'); ?>
                        <?php } else { ?>
                            <?= number_format($keuangan['nominal'], 0, ',', '.'); ?>
                        <?php } ?>
                    <?php } ?>
                </td>
                <td>
                    <?php if($keuangan['nominal'] > 0) {?>
                        Uang Masuk
                    <?php } else { ?>
                        <?php if($keuangan['keterangan'] == "Biaya admin penarikan saldo") {?>
                            Uang Tetap
                        <?php } else { ?>
                            Uang Keluar
                        <?php } ?>
                    <?php } ?>
                </td>
                <td><?= date('Y-m-d H:i', strtotime($keuangan['dibuat_pada']));?></td>
            </tr>
        <?php $i++; } ?>
	</table>
</body>
</html>