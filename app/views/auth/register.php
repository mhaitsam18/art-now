<?php include('layouts/header.php'); ?>
<div class="layout-login-centered-boxed__form card">
    <div class="d-flex flex-column justify-content-center align-items-center mt-2 mb-5 navbar-light">
        <a href="<?= BASEURL; ?>/index" class="navbar-brand flex-column mb-2 align-items-center mr-0" style="min-width: 0">
            <img class="navbar-brand-icon mr-0 mb-2" src="<?= BASEURL; ?>/assets-user/images/logo.png" width="100%" alt="ArtNow">
        </a>
        <p class="m-0">Daftarkan Akun</p>
    </div>

    <?php if($data){ ?>
    <div class="alert alert-soft-<?= $data['type']; ?> d-flex" role="alert">
        <div class="text-body"><?= $data['desc']; ?></div>
    </div>
    <?php } ?>
    
    <form action="<?= BASEURL; ?>/auth/register" method="POST">
        <div class="form-group">
            <label class="text-label" for="name_2">Nama:</label>
            <div class="input-group input-group-merge">
                <input id="name_2" name="nama_lengkap" type="text" required="" class="form-control form-control-prepended" placeholder="John Doe">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="far fa-user"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="text-label" for="email_2">Email:</label>
            <div class="input-group input-group-merge">
                <input id="email_2" name="email" type="email" required="" class="form-control form-control-prepended" placeholder="john@doe.com">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="far fa-envelope"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="text-label" for="telepon_2">Telepon:</label>
            <div class="input-group input-group-merge">
                <input id="telepon_2" name="telepon" type="number" required="" class="form-control form-control-prepended" placeholder="085xxx">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="far fa-phone"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="text-label" for="password_2">Kata Sandi:</label>
            <div class="input-group input-group-merge">
                <input id="password_2" name="password" type="password" required="" class="form-control form-control-prepended" placeholder="Masukkan Kata Sandi">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="far fa-key"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" onclick="myFunction()" id="show" checked>
                <label class="custom-control-label" for="show">Sembunyikan Kata Sandi</label>
            </div>
        </div>
        <div class="form-group">
            <label class="text-label" for="level_2">Mendaftar Sebagai:</label>
            <div class="input-group input-group-merge">
                <select name="level" id="level_2" class="form-control form-control-prepended">
                    <option value="0">Pelanggan</option>
                    <option value="-1">Arsitek</option>
                </select>
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="far fa-grip-lines"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group mb-5">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" checked="" class="custom-control-input" id="terms" required/>
                <label class="custom-control-label" for="terms">Saya bersedia menerima <a href="<?= BASEURL ?>/syarat_dan_ketentuan">Syarat dan Ketentuan</a></label>
            </div>
        </div>
        <div class="form-group text-center">
            <button class="btn btn-primary mb-2" type="submit">Daftar</button><br>
            <a class="text-body text-underline" href="<?= BASEURL; ?>/auth/login">Sudah memiliki akun? Masuk</a>
        </div>
    </form>
</div>
<script>
    function myFunction() {
        var x = document.getElementById("password_2");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<?php include('layouts/footer.php'); ?>