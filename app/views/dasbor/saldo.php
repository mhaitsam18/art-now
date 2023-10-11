<?php include('layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Saldo</li>
                    </ol>
                </nav>
                <h1 class="m-0">Saldo</h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <?php if ($_SESSION['level'] == 1 && $data['user']['nomor_rekening'] != NULL) { ?>
        <div class="card card-form bg-white">
            <div class="row no-gutters">
                <div class="col-lg-4 card-body">
                    <p><strong class="headings-color">Saldo</strong></p>
                    <h4>Rp <?=number_format($data['user']['saldo'], 0, ',', '.')?></h4>
                    <?php if($data['permintaan_penarikan'] == NULL && $data['user']['saldo'] >= 1000000) { ?>
                    <a href="<?=BASEURL?>/arsitek/tarik_saldo" class="btn btn-secondary col-12 mb-2">Tarik Saldo</a>
                    <?php } else if($data['user']['saldo'] < 1000000) { ?>
                    <a href="<?=BASEURL?>/arsitek/tarik_saldo" class="btn btn-secondary col-12 mb-2">Saldo Belum Mencukupi</a>
                    <?php } else { ?>
                    <a href="#" class="btn btn-secondary col-12 mb-2 disabled">Dalam Proses Penarikan</a>
                    <?php } ?>
                    <p class="text-muted">Saldo bisa ditarik jika lebih dari 1 juta rupiah. Proses penarikan membutuhkan <u>7 hari kerja</u> ke rekening yang telah didaftarkan. Jika dalam 14 hari kerja masih belum dikirimkan, silahkan hubungi <a href="mailto:cust@artnow.co.id">Layanan Pengguna</a> ArtNow. Saldo yang Anda terima hanya sebesar 97.5% dari saldo yang ditarik, 2.5% akan menjadi biaya admin.</p>
                </div>
                <div class="col-lg-8 card-form__body card-body">
                    <h3>Riwayat Saldo</h3>
                    <?php if(count($data['saldo']) < 1) { ?>
                    <div class="media border-bottom py-3">
                        <div class="media-body">
                            <div class="text-muted text-center">Tidak ada riwayat</div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php $jr = count($data['saldo']); $i = 1;  foreach($data['saldo'] as $saldo) { ?>
                    <?php if ($jr > 6 && $i == 7) { ?>
                        <div class="collapse" id="riwayatSaldo">
                    <?php } ?>
                                <div class="media border-bottom py-3">
                                    <div class="media-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex">
                                                <?php if($saldo['nominal'] > 0) { ?>
                                                <i class="text-success">+<?= number_format($saldo['nominal'], 0, ',', '.') ?></i>
                                                <?php } else { ?>
                                                <i class="text-danger"><?= number_format($saldo['nominal'], 0, ',', '.') ?></i>
                                                <?php } ?>
                                            </div>
                                            <small class="text-muted">
                                                <?= date('d-m-Y H:i', strtotime($saldo['dibuat_pada'])) ?>
                                            </small>
                                        </div>
                                        <div><?= $saldo['keterangan'] ?></div>
                                        <div>
                                            <?php if($saldo['bukti']) { ?>
                                                <a href="<?= BASEURL ?>/dokumen/bukti/<?= $saldo['bukti'] ?>" target="_BlANK">lihat bukti transfer</a> 
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                    <?php if ($jr > 6 && $jr == $i) { ?>
                        </div>
                    <?php } $i++; } ?>
                    <?php if ($jr > 6) { ?>
                    <button class="btn btn-light col-12" id="riwayat-saldo" type="button" data-toggle="collapse" data-target="#riwayatSaldo" aria-expanded="false" aria-controls="riwayatSaldo">Tampilkan lebih banyak</button>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<script>
    $('#riwayat-saldo').html('Tampilkan lebih banyak');
    $(document).ready(function(){
        $('#riwayat-saldo').click(function(){
            if($('#riwayat-saldo').html() == 'Tampilkan lebih banyak'){
                $('#riwayat-saldo').html('Tampilkan lebih sedikit');
            } else {
                $('#riwayat-saldo').html('Tampilkan lebih banyak');
            }
        });
    })
</script>
<?php include('layouts/footer.php'); ?>