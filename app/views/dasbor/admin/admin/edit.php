<?php include(__DIR__ . '/../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL; ?>/admin/data_admin">Data Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
                <h1 class="m-0"><?= $data['nama_lengkap'] ?></h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-12 card-form__body card-body">
                    <form method="POST" id="form" action="<?= BASEURL.'/admin/update_admin/'.$data['id_user']; ?>">
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap:</label>
                            <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" placeholder="Masukkan Nama Lengkap..." value="<?= $data['nama_lengkap']?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email..." value="<?= $data['email']?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password<sup>(pilihan, masukkan untuk mengganti)</sup>:</label>
                            <input type="text" name="password" class="form-control" id="password" placeholder="Masukkan Password...">
                        </div>
                        <div class="form-group">
                            <label for="telepon">Telepon:</label>
                            <input type="text" name="telepon" class="form-control" id="telepon" placeholder="Masukkan Telepon..." value="<?= $data['telepon']?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="update">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include(__DIR__ . '/../../layouts/footer.php'); ?>