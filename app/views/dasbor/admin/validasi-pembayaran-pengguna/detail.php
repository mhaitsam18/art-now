<?php include(__DIR__ . '/../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL; ?>/admin/validasi_pembayaran_pengguna">Validasi Pembayaran Pengguna</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Pembayaran Pengguna</li>
                    </ol>
                </nav>
                <h1 class="m-0">Pembayaran <?= ($data['pembayaran'] == 1) ? 'Kedua':'DP/Uang Muka' ?></h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <div class="row">
            <div class="col-lg-8">
                <a href="#" class="dp-preview card mb-4">
                    <img src="<?= BASEURL."/image/bukti-pembayaran/".$data['bukti_pembayaran'];?>" alt="bukti pembayaran" class="img-fluid">
                </a>
            </div>
            <div class="col-lg-4">
                <div class="card card-body">
                    <div class="list-group list-group-flush mb-4">
                        <h5>Informasi Produk</h5>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Produk</strong>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <div class="ml-auto"><a href="../../home/produk/<?= $data['id_produk'] ?>" target="_blank"><?= $data['judul_produk'] ?></a></div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Tawaran Harga</strong>
                            <div class="ml-auto">Rp <?= number_format($data['tawaran_harga'], 0 ,",", ".") ?></div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush mb-4">
                        <h5>Informasi Pembayaran</h5>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Status</strong>
                            <div class="ml-auto">
                                <?php if($data['status'] == -1) { ?>
                                    <span class="badge badge-danger">Pembayaran Ditolak</span>
                                <?php } else if($data['status'] == 0) { ?>
                                    <span class="badge badge-warning">Menungu Validasi</span>
                                <?php } else if($data['status'] == 1) { ?>
                                    <span class="badge badge-success">Pembayaran Diterima</span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Pembayaran</strong>
                            <div class="ml-auto"><?= ($data['pembayaran'] == 1) ? 'Kedua':'DP/Uang Muka' ?></div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Total harus dibayar</strong>
                            <div class="ml-auto">Rp <?= number_format($data['total_dibayar'], 0 ,",", ".") ?></div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Diunggah</strong>
                            <div class="ml-auto"><?= date('d-m-Y H:i', strtotime($data['diperbaharui_pada'])); ?></div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Dibayar Oleh</strong>
                            <div class="ml-auto"><a href="../../user/profile_pengguna/<?= $data['id_pengguna'] ?>" target="_blank"><?= $data['nama_lengkap_pengguna'] ?></a></div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Dibayar Kepada</strong>
                            <div class="ml-auto"><a href="../../user/profile_arsitek/<?= $data['id_arsitek'] ?>" target="_blank"><?= $data['nama_lengkap_arsitek'] ?></a></div>
                        </div>
                    </div>
                    <?php if($data['status'] == 0) { ?>
                    <div class="mb-4">
                        <h5>Aksi</h5>
                        <a href="../terima_pembayaran_pengguna/<?= $data['id_pembayaran'];?>" class="btn btn-success btn-block">Terima</a>
                        <a data-toggle="modal" data-target="#modal-tolak-pembayaran-pelanggan" onclick="tolak()" data-url="../tolak_pembayaran_pengguna/<?= $data['id_pembayaran'];?>" href="javascript:void(0)" class="btn btn-danger btn-block">Tolak</a>
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
        $('#form-tolak-pembayaran-pelanggan').attr('action', url);
    }
</script>
<?php include(__DIR__ . '/../../layouts/footer.php'); ?>