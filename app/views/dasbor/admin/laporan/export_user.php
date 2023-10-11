<!DOCTYPE html>
<html>
<head>
	<title>Pengguna</title>
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
	header("Content-Disposition: attachment; filename=Laporan Pengguna.xls");
	?>
 
	<center>
		<h3>Laporan Pengguna</h3>
	</center>
 
    <table>
        <tr>
            <td></td>
            <td>Status</td>
            <td>: <?=$data['status']?></td>
        </tr>
        <tr>
            <td></td>
            <td>Level</td>
            <td>: <?=$data['level']?></td>
        </tr>
        <tr>
            <td></td>
            <td>Tanggal</td>
            <td>: <?=$data['rentang_tanggal']?></td>
        </tr>
    </table>
	<table border="1">
		<tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Status</th>
            <th>Level</th>
            <th>Dibuat Pada</th>
            <th>Diperbaharui Pada</th>
		</tr>
        <?php $i = 1; foreach($data['users'] as $user) { ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $user['nama_lengkap']; ?></td>
                <td><?= $user['email']; ?></td>
                <td><?= $user['telepon']; ?></td>
                <td align="center">
                    <?php if($user['status'] == 1 ) { ?>
                        AKTIF
                    <?php } else { ?>
                        NONAKTIF
                    <?php } ?>
                </td>
                <td align="center">
                    <?php if($user['level'] == -1 ) { ?>
                        CALON ARSITEK
                    <?php } else if($user['level'] == 0 ) { ?>
                        PELANGGAN
                    <?php } else if($user['level'] == 1 ) { ?>
                        ARSITEK
                    <?php } else { ?>
                        ADMIN
                    <?php } ?>
                </td>
                <td><?= date('Y-m-d H:i', strtotime($user['dibuat_pada']));?></td>
                <td><?= date('Y-m-d H:i', strtotime($user['diperbaharui_pada']));?></td>
            </tr>
        <?php $i++; } ?>
	</table>
</body>
</html>