<?php include('layouts/header.php'); ?>
<div class="blog_main_wrapper blog_toppadder60 blog_bottompadder60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="blog_post_style2 blog_single_div">
                    <h1><?= $data['judul'] ?></h1>
                    <p class="text-muted">
                        <?php if ($data['kategori'] == "1") { ?>
                            Desain Rumah Terbaru
                        <?php } else if ($data['kategori'] == "2") { ?>
                            Desain Rumah Minimalis
                        <?php } else if ($data['kategori'] == "3") { ?>
                            Desain Rumah Mewah
                        <?php } else if ($data['kategori'] == "4") { ?>
                            Desain Interior
                        <?php } else if ($data['kategori'] == "0") { ?>
                            Desain Bangunan Lainnya
                        <?php } else { ?>

                        <?php } ?>
                    </p>
                    <div class="blog_post_style2_img wow fadeInUp">
                        <?php if ($data['gambar'] != null) { ?>
                            <img src="<?= BASEURL . '/image/produk/' . $data['gambar'] ?>" class="img-fluid col-12" alt="" style="">
                        <?php } else { ?>
                            <img src="https://via.placeholder.com/1170x560/ffc0cb" class="img-fluid" alt="">
                        <?php } ?>
                    </div>
                    <div class="blog_post_style2_content wow fadeInUp">
                        <p class="text-muted"><i>*Mohon untuk tidak mengunduh, menyalahgunakan, dan menyebarluaskan gambar maupun karya orang lain.</i></p>
                        <?php if ($data['tautan_video']) { ?>
                            <iframe width="560" height="315" src="<?= $data['tautan_video'] ?>" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <?php } ?>
                        <?= $data['deskripsi'] ?>
                        <br />
                        <p>- Harga Jasa: mulai dari Rp <?= number_format($data['harga'], 0, ',', '.') ?></p>
                        <div class="mb-4">
                            <?php if ($data['rating'] >= 1.0) { ?>
                                <i class="fa fa-star fa-2x" aria-hidden="true" style="color: yellow;"></i>
                            <?php } else if ($data['rating'] >= 0.1) { ?>
                                <i class="fa fa-star-half-o fa-2x" aria-hidden="true" style="color: yellow;"></i>
                            <?php } else { ?>
                                <i class="fa fa-star-o fa-2x" aria-hidden="true" style="color: yellow;"></i>
                            <?php }
                            if ($data['rating'] >= 2.0) { ?>
                                <i class="fa fa-star fa-2x" aria-hidden="true" style="color: yellow;"></i>
                            <?php } else if ($data['rating'] >= 1.1) { ?>
                                <i class="fa fa-star-half-o fa-2x" aria-hidden="true" style="color: yellow;"></i>
                            <?php } else { ?>
                                <i class="fa fa-star-o fa-2x" aria-hidden="true" style="color: yellow;"></i>
                            <?php }
                            if ($data['rating'] >= 3.0) { ?>
                                <i class="fa fa-star fa-2x" aria-hidden="true" style="color: yellow;"></i>
                            <?php } else if ($data['rating'] >= 2.1) { ?>
                                <i class="fa fa-star-half-o fa-2x" aria-hidden="true" style="color: yellow;"></i>
                            <?php } else { ?>
                                <i class="fa fa-star-o fa-2x" aria-hidden="true" style="color: yellow;"></i>
                            <?php }
                            if ($data['rating'] >= 4.0) { ?>
                                <i class="fa fa-star fa-2x" aria-hidden="true" style="color: yellow;"></i>
                            <?php } else if ($data['rating'] >= 3.1) { ?>
                                <i class="fa fa-star-half-o fa-2x" aria-hidden="true" style="color: yellow;"></i>
                            <?php } else { ?>
                                <i class="fa fa-star-o fa-2x" aria-hidden="true" style="color: yellow;"></i>
                            <?php }
                            if ($data['rating'] == 5) { ?>
                                <i class="fa fa-star fa-2x" aria-hidden="true" style="color: yellow;"></i>
                            <?php } else if ($data['rating'] >= 4.1) { ?>
                                <i class="fa fa-star-half-o fa-2x" aria-hidden="true" style="color: yellow;"></i>
                            <?php } else { ?>
                                <i class="fa fa-star-o fa-2x" aria-hidden="true" style="color: yellow;"></i>
                            <?php } ?>
                            <p><?= number_format($data['rating'], 1, '.', ',') ?>/5 dari total <?= $data['total_rating'] ?> penilaian.</p>
                        </div>
                        <div class="col-md-12">
                            <?php if (isset($_SESSION['email'])) {
                                if ($_SESSION['level'] == 0 && $data['status'] == 1) { ?>
                                    <a onclick="showForm()" href="javascript:void(0);" class="btn btn-primary col-md-12 btn-pesan" style="margin-bottom: 18px;">Pesan Sekarang</a>
                                    <div class="form-pesan card" style="margin-bottom: 18px;">
                                        <div class="card-body">
                                            <form action="<?= BASEURL . '/pengguna/pesan/' . $data['id_produk'] ?>" method="post">
                                                <h3>Formulir Pesanan</h3>
                                                <div class="form-group">
                                                    <label for="lokasi">Lokasi / Alamat</label>
                                                    <textarea name="lokasi" class="form-control" id="lokasi"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="luas-tanah">Luas Tanah</label>
                                                    <input type="number" name="luas_tanah" class="form-control" id="luas-tanah" placeholder="Masukkan luas tanah dalam ukuran meter persegi (m²)" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="detail">Detail</label>
                                                    <textarea name="detail" class="form-control" id="detail" rows="8" placeholder="Masukkan detail lingkungan dan desain yang Kamu inginkan secara jelas dan sedetail mungkin" required></textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <a onclick="hideForm()" href="javascript:void(0);" class="col-12 btn btn-light">Batalkan</a>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <button type="submit" class="col-12 btn btn-primary">Pesan</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <hr>
                                <?php }
                            }
                            if ($data['status'] == 0) { ?>
                                <a href="#" class="btn btn-danger col-md-12">Produk Tidak AKtif</a>
                            <?php } ?>
                            <a href="<?= BASEURL ?>/dokumen/produk/<?= $data['dokumen'] ?>" class="col-12 btn btn-secondary btn-block" target="_BLANK">Unduh Sampel Desain</a>
                        </div>
                    </div>
                </div>
                <div class="blog_author_div wow fadeInUp">
                    <div class="blog_author_img">
                        <?php if ($data['foto'] != null) { ?>
                            <img src="<?= BASEURL . '/image/profile/' . $data['foto'] ?>" class="img-fluid" alt="Arsitek" style="width: 122px; height: 122px; object-fit: cover;">
                        <?php } else { ?>
                            <img src="https://via.placeholder.com/122x122" class="img-fluid" alt="">
                        <?php } ?>
                    </div>
                    <div class="blog_author_content">
                        <a href="<?= BASEURL . '/home/arsitek/' . $data['id_user'] ?>">
                            <h3><?= $data['nama_lengkap'] ?></h3>
                        </a>
                        <p><?= $data['nama_lengkap'] ?> telah berkontribusi dan bekerja sama dengan ArtNow sejak <?= date('d F Y', strtotime($data['user_dibuat_pada'])) ?></p>
                        <?php if (isset($_SESSION['email'])) { ?>
                            <div class="col-md-12">
                                <table border='0'>
                                    <tr>
                                        <td>No Hp</td>
                                        <td>: <?= $data['telepon'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>: <?= $data['email'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>: <?= $data['alamat'] ?></td>
                                    </tr>
                                </table>
                                <?php if ($_SESSION['level'] == 0) { ?>
                                    <a href="<?= BASEURL . '/chat/index?ke=' . $data['id_user'] ?>" class="btn btn-warning col-md-12">Chat Arsitek</a>
                                <?php } ?>
                            </div>
                        <?php } else { ?>
                            <div class="col-md-12">
                                <a href="<?= BASEURL ?>/auth/login" class="btn btn-light col-md-12">Masuk untuk melihat kontak Arsitek</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="blog_comment_div">
                    <h3 class="wow fadeInUp">Komentar <span>(<?= count($data['komens']) + count($data['reply_komens']) ?>)</span></h3>
                    <ol class="comment-list">
                        <?php foreach ($data['komens'] as $komen) { ?>
                            <li class="wow fadeInUp">
                                <div class="blog_comment">
                                    <div class="blog_comment_img">
                                        <?php if ($komen['foto'] != null) { ?>
                                            <img src="<?= BASEURL . '/image/profile/' . $komen['foto'] ?>" class="img-fluid" width="70px" height="70px" style="width: 70px; height: 70px; object-fit: cover;" alt="">
                                        <?php } else { ?>
                                            <img src="https://via.placeholder.com/70x70" class="img-fluid" alt="">
                                        <?php } ?>
                                    </div>
                                    <div class="blog_comment_data">
                                        <h3><?php if (isset($_SESSION['email'])) { ?><?= ($komen['email'] == $_SESSION['email']) ? '<i>Kamu</i>' : $komen['nama_lengkap'] ?><?php } else {
                                                                                                                                                                            echo $komen['nama_lengkap'];
                                                                                                                                                                        } ?><?= ($komen['id_user'] == $data['id_user']) ? ' <sup>[Pemilik]</sup>' : '' ?> <span>- <?= date('d F Y', strtotime($komen['dibuat_pada'])) ?></span></h3>
                                        <p><?= $komen['komen'] ?></p>
                                    </div>
                                </div>
                                <div class="blog_comment_meta">
                                    <ul>
                                        <li>
                                            <a class="reply" data-value="<?= $komen['id_komen'] ?>" href="javascript:;"><svg xmlns="http://www.w3.org/2000/svg" width="21px" height="13px">
                                                    <path fill-rule="evenodd" fill="rgb(255, 54, 87)" d="M6.125,2.599 L6.125,-0.000 L-0.000,6.066 L6.125,12.132 L6.125,9.533 L2.625,6.066 L6.125,2.599 ZM11.375,3.466 L11.375,-0.000 L5.250,6.066 L11.375,12.132 L11.375,8.579 C15.750,8.579 18.812,9.966 21.000,12.999 C20.125,8.666 17.500,4.332 11.375,3.466 Z" />
                                                </svg></a>
                                        </li>
                                    </ul>
                                    <?php if (isset($_SESSION['email'])) {
                                        if ($komen['email'] == $_SESSION['email']) { ?>
                                            <div class="blog_comment_action">
                                                <span><i class="fa fa-ellipsis-v"></i></span>
                                            </div>
                                            <ul class="comment_action">
                                                <li><a href="<?= BASEURL . '/home/hapus_komen/' . $komen['id_komen'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="11px" height="16px">
                                                            <path fill-rule="evenodd" fill="rgb(112, 112, 112)" d="M9.485,4.765 L1.578,4.765 C0.746,4.765 0.072,5.413 0.072,6.214 L0.888,14.551 C0.888,15.351 1.563,16.000 2.395,16.000 L8.795,16.000 C9.627,16.000 10.302,15.351 10.302,14.551 L10.992,6.214 C10.991,5.413 10.317,4.765 9.485,4.765 ZM3.523,13.463 C3.523,13.863 3.186,14.186 2.771,14.186 C2.355,14.186 2.018,13.862 2.018,13.463 L2.018,6.939 C2.018,6.539 2.355,6.214 2.771,6.214 C3.186,6.214 3.523,6.539 3.523,6.939 L3.523,13.463 L3.523,13.463 ZM6.159,13.463 C6.159,13.863 5.822,14.186 5.406,14.186 C4.990,14.186 4.653,13.862 4.653,13.463 L4.653,6.939 C4.653,6.539 4.990,6.214 5.406,6.214 C5.822,6.214 6.159,6.539 6.159,6.939 L6.159,13.463 ZM8.795,13.463 C8.795,13.863 8.458,14.186 8.042,14.186 C7.626,14.186 7.289,13.862 7.289,13.463 L7.289,6.939 C7.289,6.539 7.626,6.214 8.042,6.214 C8.458,6.214 8.795,6.539 8.795,6.939 L8.795,13.463 ZM1.176,4.041 L10.292,1.784 C10.796,1.659 11.099,1.166 10.970,0.681 C10.840,0.197 10.327,-0.095 9.823,0.028 L7.021,0.722 C6.761,0.351 6.282,0.157 5.807,0.274 L4.713,0.546 C4.238,0.663 3.916,1.056 3.874,1.501 L0.707,2.286 C0.203,2.410 -0.099,2.904 0.030,3.389 C0.159,3.873 0.673,4.164 1.176,4.041 Z" />
                                                        </svg> Hapus</a></li>
                                            </ul>
                                    <?php }
                                    } ?>
                                </div>
                                <ul class="children">
                                    <?php foreach ($data['reply_komens'] as $reply_komen) {
                                        if ($reply_komen['id_reply_komen'] == $komen['id_komen']) { ?>
                                            <li>
                                                <div class="blog_comment">
                                                    <div class="blog_comment_img">
                                                        <?php if ($reply_komen['foto'] != null) { ?>
                                                            <img src="<?= BASEURL . '/image/profile/' . $reply_komen['foto'] ?>" class="img-fluid" width="70px" height="70px" style="width: 70px; height: 70px; object-fit: cover;" alt="">
                                                        <?php } else { ?>
                                                            <img src="https://via.placeholder.com/70x70" class="img-fluid" alt="">
                                                        <?php } ?>
                                                    </div>
                                                    <div class="blog_comment_data">
                                                        <h3><?php if (isset($_SESSION['email'])) { ?><?= ($reply_komen['email'] == $_SESSION['email']) ? '<i>Kamu</i>' : $reply_komen['nama_lengkap'] ?><?php } else {
                                                                                                                                                                                                        echo $reply_komen['nama_lengkap'];
                                                                                                                                                                                                    } ?><?= ($reply_komen['id_user'] == $data['id_user']) ? ' <sup>[Pemilik]</sup>' : '' ?> <span>- <?= date('d F Y', strtotime($reply_komen['dibuat_pada'])) ?></span></h3>
                                                        <p><?= $reply_komen['komen'] ?></p>
                                                    </div>
                                                </div>
                                                <div class="blog_comment_meta">
                                                    <ul>
                                                        <li>
                                                            <a class="reply" data-value="<?= $komen['id_komen'] ?>" href="javascript:;"><svg xmlns="http://www.w3.org/2000/svg" width="21px" height="13px">
                                                                    <path fill-rule="evenodd" fill="rgb(255, 54, 87)" d="M6.125,2.599 L6.125,-0.000 L-0.000,6.066 L6.125,12.132 L6.125,9.533 L2.625,6.066 L6.125,2.599 ZM11.375,3.466 L11.375,-0.000 L5.250,6.066 L11.375,12.132 L11.375,8.579 C15.750,8.579 18.812,9.966 21.000,12.999 C20.125,8.666 17.500,4.332 11.375,3.466 Z" />
                                                                </svg></a>
                                                        </li>
                                                    </ul>
                                                    <?php if (isset($_SESSION['email'])) {
                                                        if ($reply_komen['email'] == $_SESSION['email']) { ?>
                                                            <div class="blog_comment_action">
                                                                <span><i class="fa fa-ellipsis-v"></i></span>
                                                            </div>
                                                            <ul class="comment_action">
                                                                <li><a href="<?= BASEURL . '/home/hapus_komen/' . $reply_komen['id_komen'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="11px" height="16px">
                                                                            <path fill-rule="evenodd" fill="rgb(112, 112, 112)" d="M9.485,4.765 L1.578,4.765 C0.746,4.765 0.072,5.413 0.072,6.214 L0.888,14.551 C0.888,15.351 1.563,16.000 2.395,16.000 L8.795,16.000 C9.627,16.000 10.302,15.351 10.302,14.551 L10.992,6.214 C10.991,5.413 10.317,4.765 9.485,4.765 ZM3.523,13.463 C3.523,13.863 3.186,14.186 2.771,14.186 C2.355,14.186 2.018,13.862 2.018,13.463 L2.018,6.939 C2.018,6.539 2.355,6.214 2.771,6.214 C3.186,6.214 3.523,6.539 3.523,6.939 L3.523,13.463 L3.523,13.463 ZM6.159,13.463 C6.159,13.863 5.822,14.186 5.406,14.186 C4.990,14.186 4.653,13.862 4.653,13.463 L4.653,6.939 C4.653,6.539 4.990,6.214 5.406,6.214 C5.822,6.214 6.159,6.539 6.159,6.939 L6.159,13.463 ZM8.795,13.463 C8.795,13.863 8.458,14.186 8.042,14.186 C7.626,14.186 7.289,13.862 7.289,13.463 L7.289,6.939 C7.289,6.539 7.626,6.214 8.042,6.214 C8.458,6.214 8.795,6.539 8.795,6.939 L8.795,13.463 ZM1.176,4.041 L10.292,1.784 C10.796,1.659 11.099,1.166 10.970,0.681 C10.840,0.197 10.327,-0.095 9.823,0.028 L7.021,0.722 C6.761,0.351 6.282,0.157 5.807,0.274 L4.713,0.546 C4.238,0.663 3.916,1.056 3.874,1.501 L0.707,2.286 C0.203,2.410 -0.099,2.904 0.030,3.389 C0.159,3.873 0.673,4.164 1.176,4.041 Z" />
                                                                        </svg> Hapus</a></li>
                                                            </ul>
                                                    <?php }
                                                    } ?>
                                                </div>
                                            </li>
                                    <?php }
                                    } ?>
                                </ul>
                            </li>
                        <?php } ?>
                    </ol>
                </div>
                <div class="blog_comment_formdiv wow fadeInUp">
                    <h3>Tinggalkan Komentar</h3>
                    <form class="comment-form" id="comment-form" method="POST" action="<?= BASEURL ?>/home/komen">
                        <?php if (isset($_SESSION['email'])) { ?>
                            <input type="hidden" name="id_produk" value="<?= $data['id_produk'] ?>" />
                            <input type="hidden" name="id_reply_komen" id="id_reply_komen" value="NULL" />
                            <div class="blog_row">
                                <a href="javascript:;" class="btn btn-danger col-md-12" id="reply_button" hidden>Batalkan Reply</a>
                            </div><br />
                            <div class="blog_row">
                                <div class="blog_form_group">
                                    <textarea class="form-control" placeholder="Komentar" name="komen" required rows="5"></textarea>
                                </div>
                            </div>
                            <div class="blog_row">
                                <button type="submit" class="blog_btn blog_bg_pink col-md-12">Kirim</button>
                            </div>
                        <?php } else { ?>
                            <div class="blog_row">
                                <a href="<?= BASEURL ?>/auth/login" class="blog_btn blog_bg_pink col-md-12">Masuk Untuk Meninggalkan Komentar</a>
                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= BASEURL; ?>/assets-user/js/jquery.js"></script>
<script>
    $('.reply').on('click', function() {
        document.getElementById('comment-form').scrollIntoView();

        $('#id_reply_komen').val($(this).data("value"));

        $('#reply_button').attr('hidden', false);
    });
    $('#reply_button').on('click', function() {
        $('#id_reply_komen').val('NULL');
        $('#reply_button').attr('hidden', true);
    });
</script>
<?php include('layouts/footer.php'); ?>