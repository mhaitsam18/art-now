<?php include(__DIR__ . '/../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
                    </ol>
                </nav>
                <h1 class="m-0">Pesanan</h1>
            </div>
            <a href="laporan_pesanan" class="btn btn-success ml-3">Ekspor Pesanan</a>
        </div>
    </div>
    <div class="container page__container">
        <?php foreach ($data['pesanans'] as $pesanan) {
            if ($pesanan['status'] == 1) { ?>
                <div class="alert alert-soft-warning d-flex align-items-center card-margin" role="alert">
                    <i class="material-icons mr-3">error_outline</i>
                    <div class="text-body"><strong>
                            Sedang Mengerjakan Pesanan <a href="<?= BASEURL . '/user/profile_pengguna/' . $pesanan['id_user']; ?>"><?= $pesanan['nama_lengkap']; ?></a>.</strong>
                    </div>
                </div>
        <?php }
        } ?>
        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-12 card-body">

                    <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>
                        <table class="table mb-0 thead-border-top-0">
                            <thead>
                                <tr>
                                    <th>Pelanggan</th>
                                    <th>Produk</th>
                                    <th align="center">Status</th>
                                    <th>Tanggal Pesanan</th>
                                    <th>Diperbaharui</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list" id="staff02">
                                <?php foreach ($data['pesanans'] as $pesanan) { ?>
                                    <tr>
                                        <td><a href="<?= BASEURL . '/user/profile_pengguna/' . $pesanan['id_user']; ?>"><?= $pesanan['nama_lengkap']; ?></a></td>
                                        <td><a href="<?= BASEURL . '/arsitek/detail_produk/' . $pesanan['id_produk']; ?>"><?= $pesanan['judul']; ?></a></td>
                                        <td align="center">
                                            <?php if ($pesanan['status'] == -2) { ?>
                                                <span class="badge badge-danger">PESANAN DIBATALKAN PELANGGAN</span>
                                            <?php } else if ($pesanan['status'] == -1) { ?>
                                                <span class="badge badge-danger">PESANAN DITOLAK</span>
                                            <?php } else if ($pesanan['status'] == 0) { ?>
                                                <?php if ($pesanan['tawaran_harga'] <= 0) { ?>
                                                    <span class="badge badge-info">MENUNGGU DIKONFIRMASI</span>
                                                <?php } else { ?>
                                                    <span class="badge badge-info">MENUNGGU KONFIRMASI PELANGGAN</span>
                                                <?php } ?>
                                            <?php } else if ($pesanan['status'] == 1) { ?>
                                                <span class="badge badge-warning">SEDANG MENGERJAKAN PROYEK</span>
                                                <?php if ($pesanan['status_pembayaran_dp'] == NULL) { ?>
                                                    <na class="badge badge-danger">DP BELUM DIBAYAR</span>
                                                    <?php } else if ($pesanan['status_pembayaran_dp'] == -1 || $pesanan['status_pembayaran_dp'] == 0) { ?>
                                                        <span class="badge badge-warning">DP SEDANG DIVALIDASI</span>
                                                    <?php } else if ($pesanan['status_pembayaran_dp'] == 1) { ?>
                                                        <a class="badge badge-success" href="javascript:void(0)">DP TELAH DIBAYAR</span>
                                                        <?php } ?>
                                                    <?php } else if ($pesanan['status_pembayaran'] == NULL) { ?>
                                                        <span class="badge badge-danger">MENUNGGU PEMBAYARAN DARI PELANGGAN</span>
                                                    <?php } else if ($pesanan['status_pembayaran'] == -1 || $pesanan['status_pembayaran'] == 0) { ?>
                                                        <span class="badge badge-warning">PEMBAYARAN SEDANG DIVALIDASI</span>
                                                    <?php } else if ($pesanan['status'] == 3 && $pesanan['status_pembayaran'] == 1) { ?>
                                                        <span class="badge badge-success">SELESAI</span>
                                                    <?php } else if ($pesanan['status'] == 4) { ?>
                                                        <span class="badge badge-primary">REVISI DESAIN DENGAN DEADLINE <?= date('d-m-Y', strtotime($pesanan['status'])) ?> </span>
                                                    <?php } ?>
                                        </td>
                                        <td><?= date('d F Y H:i', strtotime($pesanan['dibuat_pada'])); ?></td>
                                        <td><?= date('d F Y H:i', strtotime($pesanan['diperbaharui_pada'])); ?></td>
                                        <td align="right" style="white-space: nowrap;">
                                            <?php if ($pesanan['status'] == 0) { ?>
                                                <?php if ($pesanan['tawaran_harga'] <= 0) { ?>
                                                    <a href="detail_pesanan/<?= $pesanan['id_pesanan']; ?>" class="text-muted"><i class="material-icons">receipt</i> Detail Formulir</a>
                                                <?php } ?>
                                            <?php } else if ($pesanan['status'] >= 0 && $pesanan['status_pembayaran_dp'] != NULL) { ?>
                                                <a href="../arsitek/desain_pesanan/<?= $pesanan['id_pesanan']; ?>" class="text-muted"><i class="material-icons">home</i> Desain</a>
                                            <?php } ?>
                                            <a href="../chat/index?ke=<?= $pesanan['id_user']; ?>" class="text-success"><i class="material-icons">chat</i> Kirim Pesan</a>
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
    $(document).ready(function() {
        $('.table').DataTable({
            "columns": [
                null,
                null,
                null,
                null,
                null,
                {
                    "searchable": false,
                    "orderable": false
                },
            ],
            'aaSorting': [],
            'order': [],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json"
            }
        });
    });

    function deleteData() {
        var postId = $(event.currentTarget).data('value');
        var url = "<?= BASEURL; ?>/arsitek/hapus_pesanan/" + postId;
        $('#delete-url').attr('href', url);

        $('#text-delete').html('Apakah kamu yakin ingin menghapus pesanan dengan judul: ' + $(event.currentTarget).data('judul') + '?');
    }
</script>
<?php include(__DIR__ . '/../../layouts/footer.php'); ?>