<?php include(__DIR__ . '/../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL; ?>/arsitek/produk">Produk</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $data['judul'] ?></li>
                    </ol>
                </nav>
                <h1 class="m-0"><?= $data['judul'] ?></h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <div class="row">
            <div class="col-lg-8">
                <a href="#" class="dp-preview card mb-4">
                    <img src="<?= BASEURL."/image/produk/".$data['gambar'];?>" alt="digital product" class="img-fluid">
                </a>
                <?php if($data['tautan_video'] != NULL) { ?>
                <div class="col-12">
                    <iframe width="560" height="315" src="<?= $data['tautan_video'] ?>" title="Pengenalan Produk" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <?php } ?>
                <div>
                    <?= $data['deskripsi']; ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="ml-auto h2 mb-0"><strong>Rp <?= number_format($data['harga'], 0 ,",", ".") ?></strong></div>
                    </div>

                    <div class="mb-4">
                        <a href="../../home/produk/<?= $data['id_produk'];?>" class="btn btn-light btn-block">Lihat Komen</a>
                        <a href="../rating_produk/<?= $data['id_produk'];?>" class="btn btn-light btn-block">Lihat Penilaian</a>
                        <a href="<?= BASEURL ?>/dokumen/produk/<?= $data['dokumen'] ?>" class="btn btn-light btn-block" target="_BLANK">Lihat Desain Lengkap</a>
                    </div>

                    <div class="mb-4 text-center">
                        <div class="d-flex flex-column align-items-center justify-content-center">

                            <span class="mb-1">
                                <?php if ($data['rating'] >= 1.0) { ?>
                                <a href="#" class="rating-link active"><i class="material-icons ">star</i></a>
                                <?php } else if ($data['rating'] >= 0.1) { ?>
                                <a href="#" class="rating-link active"><i class="material-icons ">star_half</i></a>
                                <?php } else { ?>
                                <a href="#" class="rating-link active"><i class="material-icons ">star_outline</i></a>
                                <?php }
                                    if ($data['rating'] >= 2.0) { ?>
                                <a href="#" class="rating-link active"><i class="material-icons ">star</i></a>
                                <?php } else if ($data['rating'] >= 1.1) { ?>
                                <a href="#" class="rating-link active"><i class="material-icons ">star_half</i></a>
                                <?php } else { ?>
                                <a href="#" class="rating-link active"><i class="material-icons ">star_outline</i></a>
                                <?php }
                                    if ($data['rating'] >= 3.0) { ?>
                                <a href="#" class="rating-link active"><i class="material-icons ">star</i></a>
                                <?php } else if ($data['rating'] >= 2.1) { ?>
                                <a href="#" class="rating-link active"><i class="material-icons ">star_half</i></a>
                                <?php } else { ?>
                                <a href="#" class="rating-link active"><i class="material-icons ">star_outline</i></a>
                                <?php }
                                    if ($data['rating'] >= 4.0) { ?>
                                <a href="#" class="rating-link active"><i class="material-icons ">star</i></a>
                                <?php } else if ($data['rating'] >= 3.1) { ?>
                                <a href="#" class="rating-link active"><i class="material-icons ">star_half</i></a>
                                <?php } else { ?>
                                <a href="#" class="rating-link active"><i class="material-icons ">star_outline</i></a>
                                <?php } if ($data['rating'] == 5) { ?>
                                <a href="#" class="rating-link active"><i class="material-icons ">star</i></a>
                                <?php } else if ($data['rating'] >= 4.1) { ?>
                                <a href="#" class="rating-link active"><i class="material-icons ">star_half</i></a>
                                <?php } else { ?>
                                <a href="#" class="rating-link active"><i class="material-icons ">star_outline</i></a>
                                <?php } ?>
                            </span>
                            <div class="d-flex align-items-center">
                                <strong><?= number_format($data['rating'], 1); ?>/5</strong>
                                <span class="text-muted ml-1">&mdash; <?= $data['total_rating']; ?> penilaian</span>
                            </div>

                        </div>
                    </div>

                    <div class="list-group list-group-flush mb-4">
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Kategori Produk</strong>
                            <div class="ml-auto">
                                <?= $data['kategori'] == "1" ? "Desain Rumah Terbaru":""; ?>
                                <?= $data['kategori'] == "2" ? "Desain Rumah Minimalis":""; ?>
                                <?= $data['kategori'] == "3" ? "Desain Rumah Mewah":""; ?>
                                <?= $data['kategori'] == "4" ? "Desain Interior":""; ?>
                                <?= $data['kategori'] == "0" ? "Desain Bangunan Lainnya":""; ?>
                            </div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Status Produk</strong>
                            <div class="ml-auto"><?= ($data['status'] == 0) ? 'Nonaktif':'Aktif'; ?></div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Dibuat</strong>
                            <div class="ml-auto"><?= date('d F Y', strtotime($data['dibuat_pada'])); ?></div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Diperbaharui</strong>
                            <div class="ml-auto"><?= date('d F Y', strtotime($data['diperbaharui_pada'])); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include(__DIR__ . '/../../layouts/footer.php'); ?>