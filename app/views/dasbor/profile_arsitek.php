<?php include('layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Profil Arsitek</li>
                    </ol>
                </nav>
                <h1 class="m-0"><?= $data['nama_lengkap'] ?></h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <div class="row">
            <div class="col-lg-8">
                <a href="#" class="dp-preview card mb-4" align="center">
                    <?php if ($data['foto'] != null) { ?>
                        <img src="<?= BASEURL."/image/profile/".$data['foto'];?>" alt="profile" class="img-fluid">
                    <?php } else { ?>
                        <p>[Arsitek tidak memiliki foto]</p>
                    <?php } ?>
                </a>
                <div>
                    <?= $data['deskripsi']; ?>
                </div>
                <?php if($_SESSION['level'] == 2) { ?>
                <hr><br><br>
                <div class="card card-body">
                    <div class="card-title">
                        <h1>Produk</h1>
                    </div>
                    <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>
                        <table class="table mb-0 thead-border-top-0">
                            <thead>
                                <tr>
                                    <th>Judul Produk</th>
                                    <th>Harga Jasa</th>
                                    <th>Penilaian</th>
                                    <th>Tautan Video</th>
                                    <th>Kategori</th>
                                    <th align="center">Status</th>
                                    <th>Dibuat Pada</th>
                                    <th>Diperbaharui Pada</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list" id="staff02">
                                <?php foreach($data['produks'] as $produk) { ?>
                                <tr>
                                    <td><?= $produk['judul']; ?></td>
                                    <td>Rp <?= number_format($produk['harga'], 0, ',', '.'); ?></td>
                                    <td><span class="badge badge-warning"><?= number_format($produk['rating'], 1); ?></span></td>
                                    <td><?= $produk['tautan_video']; ?></td>
                                    <td>
                                        <?php if($produk['kategori'] == "1") { ?>
                                            Desain Rumah Terbaru
                                        <?php } else if($produk['kategori'] == "2") { ?>
                                            Desain Rumah Minimalis
                                        <?php } else if($produk['kategori'] == "3") { ?>
                                            Desain Rumah Mewah
                                        <?php } else if($produk['kategori'] == "4") { ?>
                                            Desain Interior
                                        <?php } else if($produk['kategori'] == "0") { ?>
                                            Desain Bangunan Lainnya
                                        <?php } else { ?>

                                        <?php } ?>
                                    </td>
                                    <td align="center">
                                        <?php if($produk['status'] == 1 ) { ?>
                                            <span class="badge badge-success">AKTIF</span>
                                        <?php } else { ?>
                                            <span class="badge badge-danger">NONAKTIF</span>
                                        <?php } ?>
                                    </td>
                                    <td><?= date('Y-m-d H:i', strtotime($produk['dibuat_pada']));?></td>
                                    <td><?= date('Y-m-d H:i', strtotime($produk['diperbaharui_pada']));?></td>
                                    <td style="white-space: nowrap;" align="right">
                                        <?php if($produk['status'] == 1 ) { ?>
                                        <a href="<?= BASEURL ?>/home/produk/<?= $produk['id_produk']; ?>" class="text-muted"><i class="material-icons">visibility</i> Lihat</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="col-lg-4">
                <div class="card card-body">
                    <div class="mb-4">
                        <a href="../../home/arsitek/<?= $data['id_user'];?>" class="btn btn-light btn-block">Lihat Produk</a>
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
                            <h5>Informasi Dasar</h5>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Email</strong>
                            <div class="ml-auto"><?= $data['email']; ?></div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Telepon</strong>
                            <div class="ml-auto"><?= $data['telepon']; ?></div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Alamat</strong>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <div class="ml-auto"><?= $data['alamat']; ?></div>
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
                        </div>
                        <br>
                        <div class="list-group list-group-flush mb-4">
                            <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                                <h5>Dokumen</h5>
                            </div>
                            <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                                <strong>KTP</strong>
                                <div class="ml-auto">
                                    <?php if ($data['ktp'] != null) {?>
                                        <a class="badge badge-success" href="<?= BASEURL.'/dokumen/'.$data['ktp']; ?>" download="<?= 'CALON ARSITEK-'.$data['nama_lengkap'].'-KTP-'.$data['ktp'];?>">ADA</a>
                                    <?php } else { ?>
                                        <span class="badge badge-danger">BELUM ADA</span>
                                    <?php } ?>    
                                </div>
                            </div>
                            <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                                <strong>Ijazah Terakhir</strong>
                                <div class="ml-auto">
                                    <?php if ($data['ijazah'] != null) {?>
                                        <a class="badge badge-success" href="<?= BASEURL.'/dokumen/'.$data['ijazah']; ?>" download="<?= 'CALON ARSITEK-'.$data['nama_lengkap'].'-Ijazah-'.$data['ijazah'];?>">ADA</a>
                                    <?php } else { ?>
                                        <span class="badge badge-danger">BELUM ADA</span>
                                    <?php } ?>  
                                </div>
                            </div>
                            <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                                <strong>Sertifikasi Arsitek</strong>
                                <div class="ml-auto">
                                    <?php if ($data['sertifikasi_arsitek'] != null) {?>
                                        <a class="badge badge-success" href="<?= BASEURL.'/dokumen/'.$data['sertifikasi_arsitek']; ?>" download="<?= 'CALON ARSITEK-'.$data['nama_lengkap'].'-Sertifikasi Arsitek-'.$data['sertifikasi_arsitek'];?>">ADA</a>
                                    <?php } else { ?>
                                        <span class="badge badge-danger">BELUM ADA</span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
        $('.table').DataTable({
            "searching":false,
            'aaSorting': [],
            'order': [],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json"
            }
        });
    } );
</script>
<?php include('layouts/footer.php'); ?>