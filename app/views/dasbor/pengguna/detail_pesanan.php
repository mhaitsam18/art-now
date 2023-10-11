<?php include(__DIR__ . '../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item" aria-current="page"><a href="../index">Pesanan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Formulir dan Tawaran Harga</li>
                    </ol>
                </nav>
                <h1 class="m-0">Detail Formulir dan Tawaran Harga</h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h3>Luas Tanah:</h3>
                        <p><?= $data['luas_tanah'] ?> m²</p>
                        <h3>Detail:</h3>
                        <p><?= $data['detail'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-body">
                    <div class="list-group list-group-flush mb-4">
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Nama Arsitek</strong>
                            <div class="ml-auto"><a href="<?= BASEURL ?>/user/profile_arsitek/<?= $data['id_arsitek'] ?>" target="_BLANK"><?= $data['nama_lengkap_arsitek']; ?></a></div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Produk</strong>
                            <div class="ml-auto"><a href="<?= BASEURL ?>/home/produk/<?= $data['id_produk'] ?>" target="_BLANK"><?= $data['judul']; ?></a></div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Kategori Produk</strong>
                            <div class="ml-auto">
                                <?= $data['kategori'] == "1" ? "Desain Rumah Terbaru" : ""; ?>
                                <?= $data['kategori'] == "2" ? "Desain Rumah Minimalis" : ""; ?>
                                <?= $data['kategori'] == "3" ? "Desain Rumah Mewah" : ""; ?>
                                <?= $data['kategori'] == "4" ? "Desain Interior" : ""; ?>
                                <?= $data['kategori'] == "0" ? "Desain Bangunan Lainnya" : ""; ?>
                            </div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Harga Produk</strong>
                            <div class="ml-auto">Rp <?= number_format($data['harga'], 0, ",", ".") ?></div>
                        </div>
                        <div class="mt-3">
                            <h5>Aksi</h5>
                            <form action="../terima_pesanan/<?= $data['id_pesanan']; ?>" method="post" class="form">
                                <div class="form-group">
                                    <h6>Tawaran Harga</h6>
                                    <p>Rp <?= number_format($data['tawaran_harga'], 0, ",", ".") ?></p>
                                </div>
                                <div class="form-group">
                                    <h6>Jadwal Survei</h6>
                                    <p><?= date('j F Y', strtotime($data['jadwal_survei'])) ?></p>
                                </div>
                                <button type="submit" class="btn btn-success btn-block"><i class="material-icons">check</i> Terima Sesuai Dengan Tawaran Di Atas</button>
                            </form>
                            <a href="../tolak_pesanan/<?= $data['id_pesanan']; ?>" class="btn btn-danger btn-block mt-2"><i class="material-icons">block</i> Tolak</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include(__DIR__ . '../../layouts/footer.php'); ?>