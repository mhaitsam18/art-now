<?php include(__DIR__ . '/../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Deskripsi</li>
                    </ol>
                </nav>
                <h1 class="m-0">Deskripsi</h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <div class="alert alert-soft-info d-flex align-items-center card-margin" role="alert">
            <i class="material-icons mr-3">error_outline</i>
            <div class="text-body"><strong>Tuliskan deskripsi tentangmu dan arsitekturmu.</strong> Saat ini kamu masih belum bisa mengakses menu lain. Harap isi form berikut sesuai dengan keahlianmu yang sebenarnya, agar dapat lanjut ke tahap berikutnya.</div>
        </div>


        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-12 card-form__body card-body">
                    <form id="form-arsitek" method="POST" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat..." required></textarea>
                        </div>
                        <label>Deskripsi</label>
                        <div style="height: 150px;" data-toggle="quill" id="deskripsi" data-quill-placeholder="Deskripsi..."></div>
                        <div class="form-group">
                            <label for="ktp">KTP<sup>(gambar/pdf/word)</sup>:</label>
                            <input type="file" name="ktp[]" class="form-control" id="ktp" accept="application/msword, application/pdf, image/jpg, image/jpeg, image/png" required>
                        </div>
                        <div class="form-group">
                            <label for="ijazah">Ijazah Terakhir<sup>(gambar/pdf/word)</sup>:</label>
                            <input type="file" name="ijazah[]" class="form-control" id="ijazah" accept="application/msword, application/pdf, image/jpg, image/jpeg, image/png" required>
                        </div>
                        <div class="form-group">
                            <label for="sertifikasi_arsitek">Sertifikasi Arsitek<sup>(gambar/pdf/word)</sup>:</label>
                            <input type="file" name="sertifikasi_arsitek[]" class="form-control" id="sertifikasi_arsitek" accept="application/msword, application/pdf, image/jpg, image/jpeg, image/png" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("form").on("submit", function () {
            var hvalue = $('#form-arsitek .ql-editor').html();
            $(this).append("<textarea name='deskripsi' style='display:none'>"+hvalue+"</textarea>");
        });
    });
</script>
<?php include(__DIR__ . '/../layouts/footer.php'); ?>