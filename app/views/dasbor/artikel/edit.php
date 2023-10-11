<?php include(__DIR__ . '/../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL; ?>/artikel/index">Artikel</a></li>
                    </ol>
                </nav>
                <h1 class="m-0">Edit - <?= $data['judul'] ?></h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-12 card-form__body card-body">
                    <form method="POST" id="form" action="<?= BASEURL.'/artikel/update/'.$data['id_artikel']; ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="judul">Judul:</label>
                            <input type="text" name="judul" class="form-control" id="judul" placeholder="Masukkan Judul..." value="<?= $data['judul']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar<sup>(pilih gambar untuk mengganti)</sup>:</label>
                            <input type="file" name="gambar[]" class="form-control" id="gambar" accept="image/png, image/jpeg">
                        </div>
                        <label>Isi</label>
                        <div style="height: 150px;" data-toggle="quill" id="isi" data-quill-placeholder="Isi Artikel..."></div>
                        <button type="submit" class="btn btn-primary" name="update">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.ql-editor').html("<?= $data['isi']; ?>");
        $("#form").on("submit", function () {
            var hvalue = $('#form .ql-editor').html();
            $(this).append("<textarea name='isi' style='display:none'>"+hvalue+"</textarea>");
        });
    });
</script>
<?php include(__DIR__ . '/../layouts/footer.php'); ?>