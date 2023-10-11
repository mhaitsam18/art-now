<?php include(__DIR__ . '../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item" aria-current="page"><a href="../index">Pesanan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Desain</li>
                    </ol>
                </nav>
                <h1 class="m-0">Desain Pesanan</h1>
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
                                    <th>Dokumen</th>
                                    <th>Tautan</th>
                                    <th>Dibuat</th>
                                    <th>Minta Revisi</th>
                                </tr>
                            </thead>
                            <tbody class="list" id="staff02">
                                <?php foreach ($data['desains'] as $desain) { ?>
                                    <tr>
                                        <td><a href="<?= BASEURL ?>/dokumen/desain/<?= $desain['dokumen'] ?>" class="btn btn-sm btn-success" target="_BLANK">Lihat Dokumen</a></td>
                                        <td><a href="<?= $desain['tautan'] ?>" target="_blank"><?= $desain['tautan'] ?></a></td>
                                        <td><?= $desain['dibuat_pada'] ?></td>
                                        <td>
                                            <form action="<?= BASEURL ?>/pengguna/revisi_desain/<?= $desain['id_desain'] ?>" method="post">
                                                <div class="form-group">
                                                    <textarea name="catatan_revisi" id="catatan_revisi" class="form-control"><?= $desain['catatan_revisi'] ?></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Kirim</button>
                                            </form>
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
</script>
<?php include(__DIR__ . '../../layouts/footer.php'); ?>