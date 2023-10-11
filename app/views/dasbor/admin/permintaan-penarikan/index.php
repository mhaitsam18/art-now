<?php include(__DIR__ . '/../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Permintaan Penarikan Saldo</li>
                    </ol>
                </nav>
                <h1 class="m-0">Permintaan Penarikan Saldo</h1>
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
                                    <th>Nama Arsitek</th>
                                    <th>Email Arsitek</th>
                                    <th>Tanggal Permintaan</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list" id="staff02">
                                <?php foreach($data['permintaan_penarikan'] as $permintaan_penarikan) { ?>
                                <tr>
                                    <td><?= $permintaan_penarikan['nama_lengkap']; ?></td>
                                    <td><?= $permintaan_penarikan['email']; ?></td>
                                    <td><?= date('d-m-Y H:i', strtotime($permintaan_penarikan['tanggal'])); ?></td>
                                    <td align="right" style="white-space: nowrap;">
                                        <a href="detail_permintaan_penarikan/<?= $permintaan_penarikan['id_permintaan_penarikan']; ?>" class="text-muted"><i class="material-icons">visibility</i> Lihat</a>
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