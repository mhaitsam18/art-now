<?php include('layouts/header.php'); ?>
    
	<div class="blog_main_wrapper blog_toppadder60 blog_bottompadder40">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="blog_food_health blog_topheading_slider_nav blog_topheading_style2 blog_innerpages">
                        <?php
                            $params = [];
                            if(isset(parse_url(NOWURL)['query'])){
                                parse_str(parse_url(NOWURL)['query'], $params);
                                $cari = isset($params['cari']) ? $params['cari']:'';
                                $kategori = isset($params['kategori']) ? $params['kategori']:'';
                                $bintang = isset($params['bintang']) ? $params['bintang']:'';
                            }
                        ?>
                        <div class="card">
                            <div class="card-header mb-4">
                                <h4>Cari dan Filter</h4>
                            </div>
                            <div class="card-body mt-4">
                                <div class="form">
							        <form method="GET" action="<?= BASEURL?>/home/cari">
                                        <div class="form-group">
                                            <label for="">Kata Kunci :</label>
                                            <input type="text" name="cari" class="form-control" value="<?= $cari ?>">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Kategori</label>
                                                    <select name="kategori" class="form-control">
                                                        <option value="-1">Semua</option>
                                                        <option value="1" <?= $kategori == 1 ? 'selected':'' ?>>Desain Rumah Terbaru</option>
                                                        <option value="2" <?= $kategori == 2 ? 'selected':'' ?>>Desain Rumah Minimalis</option>
                                                        <option value="3" <?= $kategori == 3 ? 'selected':'' ?>>Desain Rumah Mewah</option>
                                                        <option value="4" <?= $kategori == 4 ? 'selected':'' ?>>Desain Interior</option>
                                                        <option value="0" <?= $kategori == 0 ? 'selected':'' ?>>Desain Bangunan Lainnya</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Bintang</label>
                                                    <select name="bintang" class="form-control">
                                                        <option value="0">Semua</option>
                                                        <option value="4" <?= $bintang == 4 ? 'selected':'' ?>>4 bintang ke atas</option>
                                                        <option value="3" <?= $bintang == 3 ? 'selected':'' ?>>3 bintang ke atas</option>
                                                        <option value="2" <?= $bintang == 2 ? 'selected':'' ?>>2 bintang ke atas</option>
                                                        <option value="1" <?= $bintang == 1 ? 'selected':'' ?>>1 bintang ke atas</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success col-md-12">Cari dan Filter</button>
                                    </form>
                                </div>
                            </div>
                        </div>
						<div class="blog_technology_slider">
                            <?php foreach($data as $produk) { ?>
                                <div class="blog_post_style2 wow fadeInUp">
                                    <div class="blog_post_style2_img">
                                        <?php if ($produk['gambar'] != null) { ?>
                                            <img src="<?= BASEURL.'/image/produk/'.$produk['gambar']?>" class="img-fluid" alt="">
                                        <?php } else { ?>
                                            <img src="https://via.placeholder.com/180x200" class="img-fluid" alt="">
                                        <?php } ?>
                                    </div>
                                    <div class="blog_post_style2_content">
                                        <h3><a href="<?= BASEURL.'/home/produk/'.$produk['id_produk']?>"><?=$produk['judul']?></a></h3>
									    <div class="blog_author_data"><a href="<?= BASEURL.'/home/arsitek/'.$produk['id_user']?>"><img src="<?= $produk['foto'] == null ? 'https://via.placeholder.com/34x34':BASEURL.'/image/profile/'.$produk['foto']?>" class="img-fluid" alt="" style="width: 34px; height: 34px; object-fit: cover;"> <?= $produk['nama_lengkap'] ?></a></div> 
                                            <ul class="blog_meta_tags">
                                                <li>
                                                    <span class="blog_bg_blue" height="25px">
                                                        <i class="fa fa-star mx-4"></i>
                                                        <?= number_format($produk['rating'], 1).'/5'?>
                                                    </span>
                                                </li>
                                            </ul>
                                            <p><?= substr($produk['deskripsi'],0,100)?>...</p>
                                    </div>
                                </div>
                            <?php } if (count($data) == 0) { ?>
                                <div class="blog_post_style2 wow fadeInUp" style="margin-bottom: 190px;">
                                    <div class="blog_post_style2_content">
                                        <h3 align="center">Tidak menemukan pencarian yang cocok</h3>
                                    </div>
                                </div>
                            <?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include('layouts/footer.php'); ?>