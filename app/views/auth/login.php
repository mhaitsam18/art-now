<?php include('layouts/header.php'); ?>

<div class="layout-login-centered-boxed__form card">
    <div class="d-flex flex-column justify-content-center align-items-center mt-2 mb-5 navbar-light">
        <a href="<?= BASEURL; ?>/index" class="navbar-brand flex-column mb-2 align-items-center mr-0" style="min-width: 0">
            <img class="navbar-brand-icon mr-0 mb-2" src="<?= BASEURL; ?>/assets-user/images/logo.png" width="100%" alt="ArtNow">
        </a>
        <p class="m-0">Masuk untuk mengakses lebih banyak menu</p>
    </div>
    
    <?php if($data){ ?>
    <div class="alert alert-soft-<?= $data['type']; ?> d-flex" role="alert">
        <div class="text-body"><?= $data['desc']; ?></div>
    </div>
    <?php } ?>

    <form action="<?= BASEURL; ?>/auth/login" method="POST">
        <div class="form-group">
            <label class="text-label" for="email_2">Email:</label>
            <div class="input-group input-group-merge">
                <input id="email_2" type="email" required="" name="email" class="form-control form-control-prepended" placeholder="john@doe.com">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="far fa-envelope"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="text-label" for="password_2">Kata Sandi:</label>
            <div class="input-group input-group-merge">
                <input id="password_2" type="password" name="password" required="" class="form-control form-control-prepended" placeholder="Masukkan Kata Sandi">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="fa fa-key"></span>
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
            <button class="btn btn-block btn-primary" type="submit">Masuk</button>
        </div>
        <div class="form-group text-center">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="remember" checked="" id="remember">
                <label class="custom-control-label" for="remember">Ingatkan saya</label>
            </div>
        </div>
        <div class="form-group text-center">
            <a href="<?= BASEURL; ?>/auth/lupa_sandi">Lupa kata sandi?</a> <br>
            belum memiliki akun? <a class="text-body text-underline" href="<?= BASEURL;?>/auth/register">Daftar!</a>
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