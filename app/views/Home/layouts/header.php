<!DOCTYPE html>
<html lang="id">
<head>
    <title>ArtNow</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="Blog">
    <meta name="keywords" content="">
    <meta name="author" content="kamleshyadav">
    <meta name="MobileOptimized" content="320">
   <!--Start Style -->
    <link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/assets-user/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/assets-user/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/assets-user/js/plugins/swiper/swiper.css">
    <link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/assets-user/js/plugins/magnific/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/assets-user/css/style.css">
    <!-- Font Awesome FREE Icons -->
    <link type="text/css" href="<?= BASEURL; ?>/assets-admin/css/vendor-fontawesome-free.css" rel="stylesheet">
    <link type="text/css" href="<?= BASEURL; ?>/assets-admin/css/vendor-fontawesome-free.rtl.css" rel="stylesheet">

    <!-- Favicon Link -->
    <link rel="shortcut icon" type="image/png" href="<?= BASEURL; ?>/assets-user/images/favicon.png">
</head>
<body class="homepage2">
<div id="blog_preloader_wrapper">
     <div id="blog_preloader_box">
          <div class="blog_loader">
              <div></div>
              <div></div>
          </div>
     </div>
</div>
<div class="blog_main_wrapper">
	<div class="blog_header_style2">
		<div class="blog_top_header_wrapper">
			<div class="blog_date_div"></div>
			<div class="blog_temperature_div"></div>
			<div class="blog_logo">
				<a href="<?=BASEURL?>"><img src="<?= BASEURL; ?>/assets-user/images/logo.png" class="img-fluid" alt="logo"></a>
				<div class="blog_menu_toggle">
					<span>
						<i class="fa fa-bars" aria-hidden="true"></i>
					</span>
				</div>
			</div>
			<div class="blog_user_div">
				<?php if($_SESSION == null) { ?>
                <button onclick="window.location.href='<?= BASEURL;?>/auth/login'" class="btn btn-primary">Masuk</button>
                <button onclick="window.location.href='<?= BASEURL;?>/auth/register'" class="btn btn-dark">Daftar</button>
				<?php } else { ?>
				<a href="#">
					<?php if($_SESSION['foto'] == null) { ?>
					<img src="https://via.placeholder.com/34x34" class="rounded-circle" alt="">
					<?php } else { ?>
					<img src="<?= BASEURL.'/image/profile/'.$_SESSION['foto'];?>" width="34px" class="rounded-circle" height="34px" style="object-fit: cover;" alt="">
					<?php }?>
					<?= $_SESSION['nama_lengkap'];?> <i class="fa fa-angle-down" aria-hidden="true"></i>
				</a>
				<div class="blog_profile_div">
					<ul>
						<li>
							<a href="<?= BASEURL;?>/user/profile"><svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 350 350"><path fill="rgb(112, 112, 112)" d="M175,171.173c38.914,0,70.463-38.318,70.463-85.586C245.463,38.318,235.105,0,175,0s-70.465,38.318-70.465,85.587 C104.535,132.855,136.084,171.173,175,171.173z"/> <path fill="rgb(112, 112, 112)" d="M41.909,301.853C41.897,298.971,41.885,301.041,41.909,301.853L41.909,301.853z"/> <path fill="rgb(112, 112, 112)" d="M308.085,304.104C308.123,303.315,308.098,298.63,308.085,304.104L308.085,304.104z"/> <path fill="rgb(112, 112, 112)" d="M307.935,298.397c-1.305-82.342-12.059-105.805-94.352-120.657c0,0-11.584,14.761-38.584,14.761 s-38.586-14.761-38.586-14.761c-81.395,14.69-92.803,37.805-94.303,117.982c-0.123,6.547-0.18,6.891-0.202,6.131 c0.005,1.424,0.011,4.058,0.011,8.651c0,0,19.592,39.496,133.08,39.496c113.486,0,133.08-39.496,133.08-39.496 c0-2.951,0.002-5.003,0.005-6.399C308.062,304.575,308.018,303.664,307.935,298.397z"/>
						</svg>Profil</a>
						</li>
						<li><a href="<?= BASEURL;?>/user/logout"><svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 447.674 447.674"><path fill="rgb(112, 112, 112)" d="M182.725,379.151c-0.572-1.522-0.769-2.816-0.575-3.863c0.193-1.04-0.472-1.902-1.997-2.566 c-1.525-0.664-2.286-1.191-2.286-1.567c0-0.38-1.093-0.667-3.284-0.855c-2.19-0.191-3.283-0.288-3.283-0.288h-3.71h-3.14H82.224 c-12.562,0-23.317-4.469-32.264-13.421c-8.945-8.946-13.417-19.698-13.417-32.258V123.335c0-12.562,4.471-23.313,13.417-32.259 c8.947-8.947,19.702-13.422,32.264-13.422h91.361c2.475,0,4.421-0.614,5.852-1.854c1.425-1.237,2.375-3.094,2.853-5.568 c0.476-2.474,0.763-4.708,0.859-6.707c0.094-1.997,0.048-4.521-0.144-7.566c-0.189-3.044-0.284-4.947-0.284-5.712 c0-2.474-0.905-4.611-2.712-6.423c-1.809-1.804-3.949-2.709-6.423-2.709H82.224c-22.648,0-42.016,8.042-58.101,24.125 C8.042,81.323,0,100.688,0,123.338v200.994c0,22.648,8.042,42.018,24.123,58.095c16.085,16.091,35.453,24.133,58.101,24.133 h91.365c2.475,0,4.422-0.622,5.852-1.854c1.425-1.239,2.375-3.094,2.853-5.571c0.476-2.471,0.763-4.716,0.859-6.707 c0.094-1.999,0.048-4.518-0.144-7.563C182.818,381.817,182.725,379.915,182.725,379.151z"/>		<path fill="rgb(112, 112, 112)" d="M442.249,210.989L286.935,55.67c-3.614-3.612-7.898-5.424-12.847-5.424c-4.949,0-9.233,1.812-12.851,5.424 c-3.617,3.617-5.424,7.904-5.424,12.85v82.226H127.907c-4.952,0-9.233,1.812-12.85,5.424c-3.617,3.617-5.424,7.901-5.424,12.85 v109.636c0,4.948,1.807,9.232,5.424,12.847c3.621,3.61,7.901,5.427,12.85,5.427h127.907v82.225c0,4.945,1.807,9.233,5.424,12.847 c3.617,3.617,7.901,5.428,12.851,5.428c4.948,0,9.232-1.811,12.847-5.428L442.249,236.69c3.617-3.62,5.425-7.898,5.425-12.848 C447.674,218.894,445.866,214.606,442.249,210.989z"/></svg>Keluar</a></li>
					</ul>
				</div>
				<?php } ?>
			</div>	
		</div>
		<div class="blog_main_header">
			<div class="blog_main_menu">
				<div class="blog_main_menu_innerdiv">
					<ul>
						<?php if(isset($_SESSION['login'])) { if($_SESSION['level'] == 0) { ?>
						<li><a href="<?= BASEURL; ?>/pengguna/index">Dasbor</a></li>
						<?php } else if($_SESSION['level'] == 2) { ?>
						<li><a href="<?= BASEURL; ?>/admin/index">Dasbor</a></li>
						<?php } else { ?>
						<li><a href="<?= BASEURL; ?>/arsitek/index">Dasbor</a></li>
						<?php } } ?>
					</ul>
				</div>
			</div>
			<div class="blog_top_search">
				<ul>
					<li class="blog_search">
						<a href="javascript:;"><svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"><path fill-rule="evenodd"  fill="#000000" d="M15.750,14.573 L11.807,10.612 C12.821,9.449 13.376,7.984 13.376,6.459 C13.376,2.898 10.376,-0.000 6.687,-0.000 C2.999,-0.000 -0.002,2.898 -0.002,6.459 C-0.002,10.021 2.999,12.919 6.687,12.919 C8.072,12.919 9.391,12.516 10.520,11.750 L14.493,15.741 C14.659,15.907 14.882,15.999 15.121,15.999 C15.348,15.999 15.563,15.916 15.726,15.764 C16.073,15.442 16.084,14.908 15.750,14.573 ZM6.687,1.685 C9.414,1.685 11.631,3.827 11.631,6.459 C11.631,9.092 9.414,11.234 6.687,11.234 C3.961,11.234 1.743,9.092 1.743,6.459 C1.743,3.827 3.961,1.685 6.687,1.685 Z"/></svg></a>
						<div class="blog_search_popup">
							<a class="search_close"></a>
							<form class="form-inline" method="GET" action="<?= BASEURL?>/home/cari">
								<h3>Masukkan kata kunci yang ingin kamu cari...</h3>
								<div class="blog_form_group">
									<input type="text" name="cari" class="form-control" placeholder="Cari disini...">
									<button type="submit" class="blog_header_search">Cari</button>
								</div>
							</form>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>