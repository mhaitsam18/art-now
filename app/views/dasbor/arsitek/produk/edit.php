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
                <h1 class="m-0">Edit - <?= $data['judul'] ?></h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-12 card-form__body card-body">
                    <form method="POST" id="form" action="<?= BASEURL.'/arsitek/update_produk/'.$data['id_produk']; ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="judul">Judul:</label>
                            <input type="text" name="judul" class="form-control" id="judul" placeholder="Masukkan Judul..." value="<?= $data['judul']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar<sup>(pilih gambar untuk mengganti)</sup>:</label>
                            <input type="file" name="gambar[]" class="form-control" id="gambar" accept="image/png, image/jpeg">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga Jasa:</label>
                            <input type="number" name="harga" class="form-control" id="harga" min="5000000" value="<?= $data['harga']; ?>" placeholder="Masukkan Harga Jasa..." required readonly>
                        </div>
                        <div class="form-group">
                            <label for="dokumen">Desain<sup>(pilih dokumen untuk mengganti)</sup>:</label>
                            <input type="file" name="dokumen[]" class="form-control" id="dokumen" accept="application/pdf">
                        </div>
                        <div class="form-group">
                            <label for="tautan_video">Tautan Video<sup>(Boleh kosong)</sup> :</label>
                            <input type="text" name="tautan_video" class="form-control" id="tautan_video" value="<?= $data['tautan_video']; ?>" placeholder="https://www.youtube.com/embed/contohlinkvideo">
                            <p class="text-muted">*Tautan video dimasukkan harus berupa penyematan tautan YouTube.</p>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori:</label>
                            <select name="kategori" id="kategori" class="form-control" required>
                                <option value="1" <?= $data['kategori'] == "1" ? "selected":""; ?>>Desain Rumah Terbaru</option>
                                <option value="2" <?= $data['kategori'] == "2" ? "selected":""; ?>>Desain Rumah Minimalis</option>
                                <option value="3" <?= $data['kategori'] == "3" ? "selected":""; ?>>Desain Rumah Mewah</option>
                                <option value="4" <?= $data['kategori'] == "4" ? "selected":""; ?>>Desain Interior</option>
                                <option value="0" <?= $data['kategori'] == "0" ? "selected":""; ?>>Desain Bangunan Lainnya</option>
                            </select>
                        </div>
                        <label>Deskripsi</label>
                        <div style="height: 150px;" data-toggle="quill" id="deskripsi" data-quill-placeholder="Deskripsi Produk...">
                            
                        </div>
                        <p class="text-muted"><i>*Penting: Mohon untuk tidak melakukan plagiat atas karya, gambar, maupun deskripsi produk Arsitek lain. Jika Anda terbukti melanggar, kami terpaksa melakukan ban permanen terhadap akun Anda.</i></p>
                        <button type="submit" class="btn btn-primary" name="update">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.ql-editor').html("<?= $data['deskripsi']; ?>");
        $("#form").on("submit", function () {
            var hvalue = $('#form .ql-editor').html();
            $(this).append("<textarea name='deskripsi' style='display:none'>"+hvalue+"</textarea>");
        });
    });
</script>
<?php include(__DIR__ . '/../../layouts/footer.php'); ?>