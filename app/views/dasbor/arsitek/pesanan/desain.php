<?php include(__DIR__ . '/../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item" aria-current="page"><a href="../pesanan">Pesanan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Desain</li>
                    </ol>
                </nav>
                <h1 class="m-0">Desain Pesanan</h1>
            </div>
            <?php if ($data['pesanan']['status'] == 1 || $data['pesanan']['status'] == 4) { ?>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-tambah-desain" class="btn btn-success ml-3"><i class="fa fa-plus"></i> Tambah Desain</a>
            <?php } ?>
        </div>
    </div>
    <div class="container page__container">
        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-12 card-body">
                    <!-- <a href="<?= BASEURL ?>/arsitek/create_desain/<?= $data['id_pesanan'] ?>" class="btn btn-primary">Tambah Desain</a> -->
                    <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>
                        <table class="table mb-0 thead-border-top-0">
                            <thead>
                                <tr>
                                    <th>Dokumen</th>
                                    <th>Tautan</th>
                                    <th>Dibuat</th>
                                    <th>Catatan Revisi</th>
                                    <th>Konfirmasi Revisi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="list" id="staff02">
                                <?php foreach ($data['desains'] as $desain) { ?>
                                    <tr>
                                        <td><a href="<?= BASEURL ?>/dokumen/desain/<?= $desain['dokumen'] ?>" class="btn btn-sm btn-success" target="_BLANK">Lihat Dokumen</a></td>
                                        <td><a href="<?= $desain['tautan'] ?>" target="_blank"><?= $desain['tautan'] ?></a></td>
                                        <td><?= $desain['dibuat_pada'] ?></td>
                                        <td>
                                            <?= $desain['catatan_revisi'] ?>
                                        </td>
                                        <td>
                                            <?php if ($desain['konfirmasi_revisi'] == 0 && $desain['catatan_revisi']) : ?>
                                                <a href="<?= BASEURL ?>/arsitek/konfirmasi_revisi/<?= $desain['id_desain'] ?>/1" class="btn btn-primary">Terima</a>
                                                <a href="<?= BASEURL ?>/arsitek/konfirmasi_revisi/<?= $desain['id_desain'] ?>/2" class="btn btn-danger">Tolak</a>
                                            <?php else : ?>
                                                <?php if ($desain['konfirmasi_revisi'] == 1) : ?>
                                                    Revisi diterima
                                                <?php elseif ($desain['konfirmasi_revisi'] == 2) : ?>
                                                    Revisi ditolak
                                                <?php else : ?>
                                                    Tidak ada Revisi
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($data['pesanan']['status'] == 1) { ?>
                                                <a onclick="deleteData()" href="#" data-value="<?= $data['pesanan']['id_pesanan']; ?>" data-desain="<?= $desain['id_desain'] ?>" data-toggle="modal" data-target="#modal-delete" class="text-danger">
                                                    <i class="material-icons">delete</i> Hapus
                                                </a>
                                            <?php } ?>
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
        var desainId = $(event.currentTarget).data('desain');
        var url = "<?= BASEURL; ?>/arsitek/hapus_desain/" + postId + "/" + desainId;
        $('#delete-url').attr('href', url);

        $('#text-delete').html('Apakah kamu yakin ingin menghapus desain tersebut?');
    }
</script>
<?php include(__DIR__ . '/../../layouts/footer.php'); ?>