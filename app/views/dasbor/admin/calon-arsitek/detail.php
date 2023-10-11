<?php include(__DIR__ . '/../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL; ?>/admin/calon_arsitek">Calon Arsitek</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Calon Arsitek dan Produk</li>
                    </ol>
                </nav>
                <h1 class="m-0"><?= $data['calon_arsitek']['nama_lengkap'] ?></h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <div class="row">
            <div class="col-lg-8">
                <h3><?= $data['produk']['judul']; ?></h3>
                <a href="#" class="dp-preview card mb-4">
                    <img src="<?= BASEURL."/image/produk/".$data['produk']['gambar'];?>" alt="digital product" class="img-fluid">
                </a>
                <?php if($data['produk']['tautan_video']) { ?>
                    <iframe width="560" height="315" src="<?= $data['produk']['tautan_video'] ?>" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <?php } ?>
                <div>
                    <?= $data['produk']['deskripsi']; ?>
                    
                    <p>- Kategori Produk: 
                        <?php if($data['produk']['kategori'] == "1") { ?>
                            Desain Rumah Terbaru
                        <?php } else if($data['produk']['kategori'] == "2") { ?>
                            Desain Rumah Minimalis
                        <?php } else if($data['produk']['kategori'] == "3") { ?>
                            Desain Rumah Mewah
                        <?php } else if($data['produk']['kategori'] == "4") { ?>
                            Desain Interior
                        <?php } else if($data['produk']['kategori'] == "0") { ?>
                            Desain Bangunan Lainnya
                        <?php } else { ?>

                        <?php } ?>
                    </p>
                    <p>- Harga Jasa: <?= number_format($data['produk']['harga'],0,',','.') ?></p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-body">
                    <div class="list-group list-group-flush mb-4">
                        <a href="<?= BASEURL ?>/dokumen/produk/<?= $data['produk']['dokumen'] ?>" class="col-12 btn btn-light btn-block" download="Desain Lengkap <?= $data['calon_arsitek']['nama_lengkap'] ?>">Unduh Desain Lengkap</a>
                    </div>
                    <div class="list-group list-group-flush mb-4">
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Tanggal Produk Dibuat</strong>
                            <div class="ml-auto"><?= date('d F Y', strtotime($data['produk']['dibuat_pada'])); ?></div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Tanggal Produk Diperbaharui</strong>
                            <div class="ml-auto"><?= date('d F Y', strtotime($data['produk']['diperbaharui_pada'])); ?></div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush mb-4">
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <h5>Informasi Dasar</h5>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Email</strong>
                            <div class="ml-auto"><?= $data['calon_arsitek']['email']; ?></div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Telepon</strong>
                            <div class="ml-auto"><?= $data['calon_arsitek']['telepon']; ?></div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Alamat</strong>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <div class="ml-auto"><?= $data['calon_arsitek']['alamat']; ?></div>
                        </div>
                    </div>
                    <?php if ($_SESSION['level'] == 2) { ?>
                        <br>
                        <div class="list-group list-group-flush mb-4">
                            <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                                <h5>Dokumen</h5>
                            </div>
                            <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                                <strong>KTP</strong>
                                <div class="ml-auto">
                                    <?php if ($data['calon_arsitek']['ktp'] != null) {?>
                                        <a class="badge badge-success" href="<?= BASEURL.'/dokumen/'.$data['calon_arsitek']['ktp']; ?>" download="<?= 'CALON ARSITEK-'.$data['calon_arsitek']['nama_lengkap'].'-KTP-'.$data['calon_arsitek']['ktp'];?>">ADA</a>
                                    <?php } else { ?>
                                        <span class="badge badge-danger">BELUM ADA</span>
                                    <?php } ?>    
                                </div>
                            </div>
                            <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                                <strong>Ijazah Terakhir</strong>
                                <div class="ml-auto">
                                    <?php if ($data['calon_arsitek']['ijazah'] != null) {?>
                                        <a class="badge badge-success" href="<?= BASEURL.'/dokumen/'.$data['calon_arsitek']['ijazah']; ?>" download="<?= 'CALON ARSITEK-'.$data['calon_arsitek']['nama_lengkap'].'-Ijazah-'.$data['calon_arsitek']['ijazah'];?>">ADA</a>
                                    <?php } else { ?>
                                        <span class="badge badge-danger">BELUM ADA</span>
                                    <?php } ?>  
                                </div>
                            </div>
                            <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                                <strong>Sertifikasi Arsitek</strong>
                                <div class="ml-auto">
                                    <?php if ($data['calon_arsitek']['sertifikasi_arsitek'] != null) {?>
                                        <a class="badge badge-success" href="<?= BASEURL.'/dokumen/'.$data['calon_arsitek']['sertifikasi_arsitek']; ?>" download="<?= 'CALON ARSITEK-'.$data['calon_arsitek']['nama_lengkap'].'-Sertifikasi Arsitek-'.$data['calon_arsitek']['sertifikasi_arsitek'];?>">ADA</a>
                                    <?php } else { ?>
                                        <span class="badge badge-danger">BELUM ADA</span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div>
                            <h5>Aksi</h5>
                            <?php if(isset($data['produk']['status']) && $data['produk']['status'] != -1) { ?>
                                <a href="../terima_calon_arsitek/<?= $data['calon_arsitek']['id_user']; ?>" class="btn btn-success btn-block">Terima</a>
                            <?php } ?>
                            <?php if($data['produk']['status'] != -1) { ?>
                                <a data-toggle="modal" data-target="#modal-tolak-calon-arsitek" onclick="tolak()" data-url="../tolak_calon_arsitek/<?= $data['calon_arsitek']['id_user']; ?>" href="javascript:void(0)" class="btn btn-danger btn-block">Tolak</a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function tolak(){
        var url = $(event.currentTarget).data('url');
        $('#form-tolak-calon-arsitek').attr('action', url);
    }
</script>
<?php include(__DIR__ . '/../../layouts/footer.php'); ?>