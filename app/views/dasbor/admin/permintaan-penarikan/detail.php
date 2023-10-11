<?php include(__DIR__ . '/../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL; ?>/admin/permintaan_penarikan">Permintaan Penarikan Saldo</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
                <h1 class="m-0"><?= $data['nama_lengkap']?></h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <div class="row">
            <div class="col-lg-7">
                <a href="#" class="dp-preview card mb-4" align="center">
                    <?php if ($data['foto'] != null) { ?>
                        <img src="<?= BASEURL."/image/profile/".$data['foto'];?>" alt="profile" class="img-fluid">
                    <?php } else { ?>
                        <p>[Arsitek tidak memiliki foto]</p>
                    <?php } ?>
                </a>
            </div>
            <div class="col-lg-5">
                <div class="card card-body">
                    <div class="mb-4">
                        <a href="../../user/profile_arsitek/<?= $data['id_user'];?>" target="_blank" class="btn btn-light btn-block">Profil Lengkap Arsitek</a>
                    </div>
                    <div class="list-group list-group-flush mb-4">
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <h5>Informasi Dasar</h5>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Nama</strong>
                            <div class="ml-auto"><?= $data['nama_lengkap']; ?></div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Email</strong>
                            <div class="ml-auto"><?= $data['email']; ?></div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Telepon</strong>
                            <div class="ml-auto"><?= $data['telepon']; ?></div>
                        </div>
                    </div>
                    <?php if ($_SESSION['level'] == 2) { ?>
                        <br>
                        <div class="list-group list-group-flush mb-4">
                            <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                                <h5>Informasi Rekening</h5>
                            </div>
                            <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                                <strong>Bank</strong>
                                <div class="ml-auto"><?= $data['bank']; ?></div>
                            </div>
                            <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                                <strong>Nomor Rekening</strong>
                                <div class="ml-auto"><?= $data['nomor_rekening']; ?></div>
                            </div>
                            <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                                <strong>Nama</strong>
                                <div class="ml-auto"><?= $data['nama_lengkap']; ?></div>
                            </div>
                        </div>
                        <br>
                        <div class="list-group list-group-flush mb-4">
                            <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                                <h5>Informasi Saldo</h5>
                            </div>
                            <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                                <strong>Saldo Saat Ini</strong>
                                <div class="ml-auto">Rp <?= number_format($data['saldo'], 0, ",", "."); ?></div>
                            </div>
                            <div class="list-group-item bg-transparent d-flex align-items-center px-0 text-danger">
                                <strong>Permintaan Penarikan Saldo</strong>
                                <div class="ml-auto">Rp <?= number_format($data['saldo'], 0, ",", "."); ?></div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($data['status_permintaan'] == 0) { ?>
                    <div class="mb-4">
                        <h5>Aksi</h5>
                        <form action="../tandai_permintaan_selesai/<?= $data['id_permintaan_penarikan'];?>" method="post" class="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="bukti">Bukti Transfer</label>
                                <input type="file" name="bukti[]" class="form-control" id="bukti" required>
                            </div>
                            <button type="submit" class="btn btn-success btn-block"><i class="material-icons">check</i> Tandai Selesai</button>
                        </form>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include(__DIR__ . '/../../layouts/footer.php'); ?>