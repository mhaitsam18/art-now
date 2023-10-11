<?php include('layouts/header.php'); ?>
<div class="blog_banner_slider wrapper banner_style2">
	<div class="blog_banner_slider_left_vertical">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php foreach ($data['produks_desc'] as $produk) { ?>
					<div class="swiper-slide">
						<div class="blog_post_slider_wrapper">
							<a href="<?= BASEURL . '/home/produk/' . $produk['id_produk'] ?>" class="blog_post_slider_img">
								<?php if ($produk['gambar'] != null) { ?>
									<img src="<?= BASEURL . '/image/produk/' . $produk['gambar'] ?>" alt="" style="height: 252px; width: 100%;">
								<?php } else { ?>
									<img src="https://via.placeholder.com/388x252/ffc0cb" alt="">
								<?php } ?>
							</a>
							<div class="blog_post_slider_content">
								<p><span class="blog_bg_pink"><a href="#" class="blog_category">Top</a></span></p>
								<h2><a href="<?= BASEURL . '/home/produk/' . $produk['id_produk'] ?>"><?= $produk['judul'] ?></a></h2>
								<div class="blog_author_data"><a href="<?= BASEURL . '/home/arsitek/' . $produk['id_user'] ?>"><img src="<?= ($produk['foto'] != NULL ? BASEURL . '/image/profile/' . $produk['foto'] : 'https://via.placeholder.com/34x34') ?>" class="img-fluid" alt="" style="width: 34px; height: 34px; object-fit: cover;"> <?= $produk['nama_lengkap'] ?></a></div>
								<ul class="blog_meta_tags">
									<li>
										<span class="blog_bg_blue" height="25px">
											<i class="fa fa-star mx-4"></i>
											<?= number_format($produk['rating'], 1) . '/5' ?>
										</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="blog_banner_slider_center">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<div class="blog_post_slider_wrapper">
						<a href="#" class="blog_post_slider_img">
							<img src="<?= BASEURL; ?>/assets-user/images/bg-1.jpg" class="img-fluid" alt="">
						</a>
						<div class="blog_post_slider_content">
							<h2><a href="#">Temukan Arsitek Terbaik untuk bangunanmu</a></h2>
							<h6>selanjutnya</h6>
						</div>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="blog_post_slider_wrapper">
						<a href="#" class="blog_post_slider_img">
							<img src="<?= BASEURL; ?>/assets-user/images/bg-1.jpg" class="img-fluid" alt="">
						</a>
						<div class="blog_post_slider_content">
							<h2><a href="#">Pesan Produk Arsitek, selesaikan proyek, dan bayar. Mudah bukan?</a></h2>
							<h6>selanjutnya</h6>
						</div>
					</div>
				</div>
			</div>
			<!-- Add Arrows -->
			<div class="swiper-button-next"><svg xmlns="http://www.w3.org/2000/svg" width="8px" height="13px">
					<path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M7.782,5.992 L1.722,0.206 C1.582,0.073 1.395,-0.001 1.196,-0.001 C0.996,-0.001 0.809,0.073 0.669,0.206 L0.223,0.633 C-0.068,0.910 -0.068,1.361 0.223,1.639 L5.311,6.496 L0.217,11.360 C0.077,11.494 -0.001,11.672 -0.001,11.863 C-0.001,12.053 0.077,12.231 0.217,12.366 L0.663,12.791 C0.804,12.925 0.991,12.999 1.190,12.999 C1.390,12.999 1.577,12.925 1.717,12.791 L7.782,7.001 C7.923,6.867 8.000,6.688 8.000,6.497 C8.000,6.305 7.923,6.126 7.782,5.992 Z" />
				</svg></div>
			<div class="swiper-button-prev"><svg xmlns:xlink="http://www.w3.org/1999/xlink" width="8px" height="13px">
					<path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M0.218,5.992 L6.277,0.206 C6.418,0.073 6.605,-0.001 6.804,-0.001 C7.004,-0.001 7.191,0.073 7.331,0.206 L7.777,0.633 C8.068,0.910 8.068,1.361 7.777,1.639 L2.689,6.496 L7.783,11.360 C7.923,11.494 8.000,11.672 8.000,11.863 C8.000,12.053 7.923,12.231 7.783,12.366 L7.337,12.791 C7.196,12.925 7.009,12.999 6.810,12.999 C6.610,12.999 6.423,12.925 6.283,12.791 L0.218,7.001 C0.077,6.867 -0.000,6.688 0.000,6.497 C-0.000,6.305 0.077,6.126 0.218,5.992 Z" />
				</svg></div>
		</div>
	</div>
	<div class="blog_banner_slider_right_vertical">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php foreach ($data['produks_asc'] as $produk) { ?>
					<div class="swiper-slide">
						<div class="blog_post_slider_wrapper">
							<a href="<?= BASEURL . '/home/produk/' . $produk['id_produk'] ?>" class="blog_post_slider_img">
								<?php if ($produk['gambar'] != null) { ?>
									<img src="<?= BASEURL . '/image/produk/' . $produk['gambar'] ?>" alt="" style="height: 252px; width: 100%;">
								<?php } else { ?>
									<img src="https://via.placeholder.com/388x252/ffc0cb" alt="">
								<?php } ?>
							</a>
							<div class="blog_post_slider_content">
								<p><span class="blog_bg_lightblue"><a href="#" class="blog_category">Baru</a></span></p>
								<h2><a href="<?= BASEURL . '/home/produk/' . $produk['id_produk'] ?>"><?= $produk['judul'] ?></a></h2>
								<div class="blog_author_data"><a href="<?= BASEURL . '/home/arsitek/' . $produk['id_user'] ?>"><img src="<?= ($produk['foto'] != NULL ? BASEURL . '/image/profile/' . $produk['foto'] : 'https://via.placeholder.com/34x34') ?>" class="img-fluid" alt="" style="width: 34px; height: 34px; object-fit: cover;"> <?= $produk['nama_lengkap'] ?></a></div>
								<ul class="blog_meta_tags">
									<li>
										<span class="blog_bg_blue" height="25px">
											<i class="fa fa-star mx-4"></i>
											<?= number_format($produk['rating'], 1) . '/5' ?>
										</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<div class="blog_fullwidth_multislide_slider">
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<?php foreach ($data['arsiteks'] as $arsitek) { ?>
				<div class="swiper-slide">
					<div class="blog_post_slider_wrapper">
						<a href="<?= BASEURL . '/home/arsitek/' . $arsitek['id_user'] ?>" class="blog_post_slider_img">
							<?php if ($arsitek['foto'] != null) { ?>
								<img src="<?= BASEURL . '/image/profile/' . $arsitek['foto'] ?>" class="img-fluid" alt="" style="height: 460px;">
							<?php } else { ?>
								<img src="https://via.placeholder.com/301x460" class="img-fluid" alt="" style="height: 460px;">
							<?php } ?>
						</a>
						<div class="blog_post_slider_content">
							<div class="blog_post_slider_content_inner">
								<h2><a href="<?= BASEURL . '/home/arsitek/' . $arsitek['id_user'] ?>">Arsitek</a></h2>
								<div class="blog_author_data"><a href="<?= BASEURL . '/home/arsitek/' . $arsitek['id_user'] ?>"><img src="<?= ($arsitek['foto'] != NULL ? BASEURL . '/image/profile/' . $arsitek['foto'] : 'https://via.placeholder.com/34x34') ?>" class="img-fluid" alt="" style="width: 34px; height: 34px; object-fit: cover;"> <?= $arsitek['nama_lengkap'] ?></a></div>
								<ul class="blog_meta_tags">
									<li>
										<span class="blog_bg_blue" height="25px">
											<i class="fa fa-star mx-4"></i>
											<?= number_format($arsitek['rating'], 1) . '/5' ?>
										</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php include('layouts/footer.php'); ?>