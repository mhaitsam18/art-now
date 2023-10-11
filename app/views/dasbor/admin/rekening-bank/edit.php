<?php include(__DIR__ . '/../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL; ?>/admin/rekening_bank">Data Rekening Bank</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
                <h1 class="m-0"><?= $data['nama'] ?></h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-12 card-form__body card-body">
                    <form method="POST" id="form" action="<?= BASEURL.'/admin/update_rekening_bank/'.$data['id_rekening']; ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="logo">Logo<sup>(masukkan logo untuk mengganti)</sup>:</label>
                            <input type="file" name="logo[]" class="form-control" id="logo" accept="image/png, image/jpeg">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama..." value="<?=$data['nama']?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nomor">Nomor:</label>
                            <input type="number" name="nomor" class="form-control" id="nomor" placeholder="Masukkan Nomor..." value="<?=$data['nomor']?>" required>
                        </div>
                        <div class="form-group">
                            <label for="pemegang">Pemegang:</label>
                            <input type="text" name="pemegang" class="form-control" id="pemegang" placeholder="Masukkan Pemegang..." value="<?=$data['pemegang']?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="update">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include(__DIR__ . '/../../layouts/footer.php'); ?>