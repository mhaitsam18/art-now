<!DOCTYPE html>
<html>
<head>
	<title>Saldo Arsitek</title>
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
	header("Content-Disposition: attachment; filename=Laporan Saldo Arsitek.xls");
	?>
 
	<center>
		<h3>Laporan Saldo Arsitek</h3>
	</center>
 
    <table>
        <tr>
            <td>Total Pemasukan Kotor Perusahaan</td>
            <td>Rp <?= number_format($data['biaya_admin'], 0, ',', '.'); ?></td>
        </tr>
    </table>
	<table border="1">
		<tr>
            <th>Nama Arsitek</th>
            <th>Email Arsitek</th>
            <th>Total Pendapatan (bruto)</th>
            <th>Saldo Sekarang (neto)</th>
            <th>Saldo Sudah Ditarik (neto)</th>
            <th>Jumlah Penarikan</th>
            <th>Pemasukan Kotor Perusahaan</th>
		</tr>
        <?php foreach($data['saldos'] as $saldo) { ?>
        <tr>
            <td><?= $saldo['nama_lengkap']; ?></td>
            <td><?= $saldo['email']; ?></td>
            <td>Rp <?= number_format($saldo['saldo']+$saldo['total_penarikan']+$saldo['biaya_admin'], 0, ',', '.'); ?></td>
            <td>Rp <?= number_format($saldo['saldo'], 0, ',', '.'); ?></td>
            <td>Rp <?= number_format($saldo['total_penarikan'], 0, ',', '.'); ?></td>
            <td><?= $saldo['jumlah_penarikan']; ?></td>
            <td>Rp <?= number_format($saldo['biaya_admin'], 0, ',', '.'); ?></td>
        </tr>
        <?php } ?>
	</table>
</body>
</html>