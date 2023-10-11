<?php include(__DIR__ . '/../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Riwayat Pembayaran Pengguna</li>
                    </ol>
                </nav>
                <h1 class="m-0">Riwayat Pembayaran Pengguna</h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-12 card-body">
                    <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>
                        <table class="table mb-0 thead-border-top-0">
                            <thead>
                                <tr>
                                    <th>Total Dibayar</th>
                                    <th>Pembayaran</th>
                                    <th>Nama Pengguna</th>
                                    <th>Nama Arsitek</th>
                                    <th>Judul Produk</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list" id="staff02">
                                <?php foreach($data['pembayarans'] as $pembayaran) { ?>
                                <tr>
                                    <td>Rp <?= number_format($pembayaran['total_dibayar'], 0, ',', '.'); ?></td>
                                    <td><?= ($pembayaran['pembayaran']==1) ? 'Kedua':'DP/Uang Muka' ?></td>
                                    <td><?= $pembayaran['nama_lengkap_pengguna']; ?></td>
                                    <td><?= $pembayaran['nama_lengkap_arsitek']; ?></td>
                                    <td><?= $pembayaran['judul_produk']; ?></td>
                                    <td>
                                        <?php if($pembayaran['status'] == -1) { ?>
                                            <span class="badge badge-danger">Pembayaran Ditolak</span>
                                        <?php } else if($pembayaran['status'] == 0) { ?>
                                            <span class="badge badge-warning">Menungu Validasi</span>
                                        <?php } else if($pembayaran['status'] == 1) { ?>
                                            <span class="badge badge-success">Pembayaran Diterima</span>
                                        <?php } ?>
                                    </td>
                                    <td align="right" style="white-space: nowrap;">
                                        <a href="../detail_pembayaran_pengguna/<?= $pembayaran['id_pembayaran']; ?>" class="text-muted"><i class="material-icons">visibility</i>Lihat</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
        $('.table').DataTable({
            "columns": [
                null,
                null,
                null,
                null,
                null,
                null,
                { "searchable": false, "orderable": false},
            ],
            'aaSorting': [],
            'order': [],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json"
            }
        });
    } );
</script>
<?php include(__DIR__ . '/../../layouts/footer.php'); ?>