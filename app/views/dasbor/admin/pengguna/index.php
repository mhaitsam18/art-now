<?php include(__DIR__ . '/../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Data Pelanggan</li>
                    </ol>
                </nav>
                <h1 class="m-0">Data Pelanggan</h1>
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
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th align="center">Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list" id="staff02">
                                <?php foreach($data['penggunas'] as $pengguna) { ?>
                                <tr>
                                    <td><?= $pengguna['nama_lengkap']; ?></td>
                                    <td><?= $pengguna['email']; ?></td>
                                    <td><?= $pengguna['telepon']; ?></td>
                                    <td align="center">
                                        <?php if($pengguna['status'] == 1 ) { ?>
                                            <span class="badge badge-success">AKTIF</span>
                                        <?php } else { ?>
                                            <span class="badge badge-danger">NONAKTIF</span>
                                        <?php } ?>
                                    </td>
                                    <td style="white-space: nowrap;" align="right">
                                        <a href="../user/profile_pengguna/<?= $pengguna['id_user']; ?>" class="text-muted"><i class="material-icons">visibility</i> Lihat</a>
                                        <?php if($pengguna['status'] == 1 ) { ?>
                                            <a href="nonaktifkan_user/<?= $pengguna['id_user']; ?>" class="text-danger"><i class="material-icons">block</i> Nonaktifkan</a>
                                        <?php } else { ?>
                                            <a href="aktifkan_user/<?= $pengguna['id_user']; ?>" class="text-success"><i class="material-icons">check</i> Aktifkan</a>
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
    $(document).ready( function () {
        $('.table').DataTable({
            "columns": [
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