<?php include(__DIR__ . '/../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL; ?>/arsitek/produk">Produk</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL.'/arsitek/detail_produk/'.$data['id_produk']; ?>"><?= $data['judul'] ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Penilaian</li>
                    </ol>
                </nav>
                <h1 class="m-0">Penilaian - <?= $data['judul'] ?></h1>
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
                                    <th>Nama Pelanggan</th>
                                    <th>Penilaian</th>
                                    <th>Komentar</th>
                                </tr>
                            </thead>
                            <tbody class="list" id="staff02">
                                <?php foreach($data['ratings'] as $rating) { ?>
                                <tr>
                                    <td><?= $rating['nama_lengkap']; ?></td>
                                    <td><span class="badge badge-warning"><?= number_format($rating['rating'], 0); ?></span></td>
                                    <td><?= $rating['komen']; ?></td>
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
        $('.table').DataTable();
    } );
</script>
<?php include(__DIR__ . '/../../layouts/footer.php'); ?>