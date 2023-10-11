<?php include('layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Profil Pelanggan</li>
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
                        <p>[Pelanggan tidak memiliki foto]</p>
                    <?php } ?>
                </a>
            </div>
            <div class="col-lg-4">
                <div class="card card-body">
                    <div class="list-group list-group-flush mb-4">
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Email</strong>
                            <div class="ml-auto"><?= $data['email']; ?></div>
                        </div>
                        <div class="list-group-item bg-transparent d-flex align-items-center px-0">
                            <strong>Telepon</strong>
                            <div class="ml-auto"><?= $data['telepon']; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('layouts/footer.php'); ?>