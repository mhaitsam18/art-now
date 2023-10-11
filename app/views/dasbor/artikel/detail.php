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
                <h1 class="m-0"><?= $data['judul'] ?></h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <div class="row">
            <div class="col-lg-12">
                <a href="#" class="dp-preview card mb-4">
                    <img src="<?= BASEURL."/image/artikel/".$data['gambar'];?>" alt="digital product" class="img-fluid">
                </a>
                <div>
                    <?= $data['isi']; ?>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <h3>Komentar <span>(<?= count($data['komens'])+count($data['reply_komens'])?>)</span></h3>
                <?php foreach($data['komens'] as $komen){ ?>
                    <div class="card mb-2">
                        <div class="media border-bottom py-3 card-body">
                            <a href="#" class="avatar avatar-sm mr-3">
                                <?php if($komen['foto'] != null) {?>
                                    <img src="<?=BASEURL.'/image/profile/'.$komen['foto']?>" class="avatar-img rounded-circle" width="40px" height="40px" style="width: 40px; height: 40px; object-fit: cover;" alt="">
                                <?php } else { ?>
                                    <img src="https://via.placeholder.com/40x40" class="avatar-img rounded-circle" alt="">
                                <?php } ?>
                            </a>
                            <div class="media-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex">
                                        <a href="#" class="text-body bold"><?php if(isset($_SESSION['email'])) { ?><?=($komen['email'] == $_SESSION['email']) ? '<i>Kamu</i>':$komen['nama_lengkap']?><?php } else { echo $komen['nama_lengkap']; } ?><?=($komen['level'] == 2) ? ' <sup>[Admin]</sup>':''?></a>
                                    </div>
                                    <small class="text-muted"><?=date('d-m-Y H:i', strtotime($komen['dibuat_pada']))?></small>
                                </div>
                                <div><?=$komen['komen']?></div>
                                <hr class="my-1">
                                <div>
                                    <a class="reply flex" data-value="<?=$komen['id_komen']?>" href="javascript:;"><i class="fa fa-reply"></i></a>
                                    <?php if(isset($_SESSION['email'])) { if($komen['email'] == $_SESSION['email']){ ?>
                                        <a href="<?=BASEURL.'/artikel/hapus_komen/'.$komen['id_komen']?>" class="float-right"><i class="fa fa-trash" style="color:red;"></i></a>
                                    <?php } }?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php foreach($data['reply_komens'] as $reply_komen) { if($reply_komen['id_reply_komen'] == $komen['id_komen']) { ?>
                        <div class="pl-5">
                            <div class="card mb-2">
                                <div class="media border-bottom py-3 card-body">
                                    <a href="#" class="avatar avatar-sm mr-3">
                                        <?php if($reply_komen['foto'] != null) {?>
                                            <img src="<?=BASEURL.'/image/profile/'.$reply_komen['foto']?>" class="avatar-img rounded-circle" width="40px" height="40px" style="width: 40px; height: 40px; object-fit: cover;" alt="">
                                        <?php } else { ?>
                                            <img src="https://via.placeholder.com/40x40" class="avatar-img rounded-circle" alt="">
                                        <?php } ?>
                                    </a>
                                    <div class="media-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex">
                                                <a href="#" class="text-body bold"><?php if(isset($_SESSION['email'])) { ?><?=($reply_komen['email'] == $_SESSION['email']) ? '<i>Kamu</i>':$reply_komen['nama_lengkap']?><?php } else { echo $reply_komen['nama_lengkap']; } ?><?=($reply_komen['level'] == 2) ? ' <sup>[Admin]</sup>':''?></a>
                                            </div>
                                            <small class="text-muted"><?=date('d-m-Y H:i', strtotime($reply_komen['dibuat_pada']))?></small>
                                        </div>
                                        <div><?=$reply_komen['komen']?></div>
                                        <hr class="my-1">
                                        <div>
                                            <a class="reply flex" data-value="<?=$komen['id_komen']?>" href="javascript:;"><i class="fa fa-reply"></i></a>
                                            <?php if(isset($_SESSION['email'])) { if($reply_komen['email'] == $_SESSION['email']){ ?>
                                                <a href="<?=BASEURL.'/artikel/hapus_komen/'.$reply_komen['id_komen']?>" class="float-right"><i class="fa fa-trash" style="color:red;"></i></a>
                                            <?php } }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } } ?>
                <?php } ?>
            </div>
            <div class="col-lg-12 mt-3">
                <h3>Tinggalkan Komentar</h3>
                <form class="comment-form" id="comment-form" method="POST" action="<?=BASEURL?>/artikel/komen">
                    <?php if(isset($_SESSION['email'])) { ?>
                        <input type="hidden" name="id_artikel" value="<?=$data['id_artikel']?>"/>
                        <input type="hidden" name="id_reply_komen" id="id_reply_komen" value="NULL"/>
                        <div class="form-group mt-2">
                            <a href="javascript:;" class="btn btn-danger col-md-12" id="reply_button" hidden>Batalkan Reply</a>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Komentar" name="komen" required rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info col-md-12">Kirim</button>
                        </div>
                    <?php } else {?>
                        <div class="form-group">
                            <a href="<?= BASEURL?>/auth/login" class="btn btn-info col-md-12">Masuk Untuk Meninggalkan Komentar</a>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASEURL; ?>/assets-admin/js/jquery.js"></script>
    <script>
        $('.reply').on('click', function(){
            document.getElementById('comment-form').scrollIntoView();

            $('#id_reply_komen').val($(this).data("value"));

            $('#reply_button').attr('hidden', false);
        });
        $('#reply_button').on('click', function(){
            $('#id_reply_komen').val('NULL');
            $('#reply_button').attr('hidden', true);
        });
    </script>
<?php include(__DIR__ . '/../layouts/footer.php'); ?>