<?php
    include(__DIR__ . '/../layouts/header.php'); 
    function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}
?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Pembayaran Kedua Pesanan</li>
                    </ol>
                </nav>
                <h1 class="m-0"><?= $data['judul'] ?></h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-4 card-body">
                    <p><strong class="headings-color">Transfer Ke</strong></p>
                    <p class="text-muted mb-0">Silakan lakukan pembayaran ke salah satu rekening bank berikut dengan nominal yang tertera dan unggah bukti pembayaran.</p>
                </div>
                <div class="col-lg-8 card-form__body card-body">
                    <div class="row">
                        <?php $jr = count($data['rekening']); $i = 1; foreach($data['rekening'] as $rekening) { ?>
                        <div class="<?= ($jr < 2) ? "col-12":"col-6" ?>">
                            <div class="form-group d-flex flex-column">
                                <img alt="PayPal Logo" src="<?= BASEURL."/image/logo-rekening/".$rekening['logo'];?>" style="display: block; margin-left: auto; margin-right: auto; width: 140px; height: 57px; object-fit: contain;">
                                <div>
                                    <?=$rekening['nama']?>, <?=$rekening['nomor']?> A/N <?=$rekening['pemegang']?>
                                </div>
                            </div>
                        </div>
                        <?php if ($jr > 6 && $i == 4) { ?>
                            </div><hr>
                            <div class="collapse" id="banyakRekening">
                                <div class="row">
                        <?php } else if ($i % 2 == 0) { ?>
                            </div><hr>
                            <div class="row">
                        <?php }?>
                        <?php if ($jr > 6 && $jr == $i) { ?>
                            </div>
                        <?php } $i++;?>
                        <?php } ?>
                    </div>
                    <?php if ($jr > 6) { ?>
                    <button class="btn btn-light col-12" id="banyak-rekening" type="button" data-toggle="collapse" data-target="#banyakRekening" aria-expanded="false" aria-controls="banyakRekening">Tampilkan lebih banyak</button>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-12 card-form__body card-body">
                    <h3>
                        Pengunggahan Bukti Pembayaran <?= ($data['pembayaran'] == NULL) ? 'dan Ulasan':'' ?>
                    </h3>
                    <form method="POST" id="form" action="<?= BASEURL . '/pengguna/kirim_pembayaran_pesanan/' . $data['id_pesanan']; ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="total_dibayar">Total Pembayaran:</label>
                            <input type="text" id="total_dibayar" value="Rp <?= number_format($data['tawaran_harga']-2000000, 0, ",", ".") ?>" class="form-control" disabled/>
                        </div>
                        <div class="form-group">
                            <label for="total_terbilang">Terbilang:</label>
                            <input type="text" id="total_terbilang" value="<?= ucfirst(terbilang($data['tawaran_harga']-2000000)) ?> rupiah" class="form-control" disabled/>
                        </div>
                        <div class="form-group">
                            <label for="bukti_pembayaran">Bukti Pembayaran:</label>
                            <input type="file" name="bukti_pembayaran[]" id="bukti_pembayaran" class="form-control" accept="image/png, image/jpeg" required />
                        </div>
                        <?php if($data['pembayaran'] == NULL){ ?>
                        <div class="form-group">
                            <label for="rating">Penilaian:</label>
                            <select name="rating" id="rating" class="form-control" required>
                                <option value="5">5 Bintang - Bagus Sekali</option>
                                <option value="4">4 Bintang - Bagus</option>
                                <option value="3">3 Bintang - Cukup</option>
                                <option value="2">2 Bintang - Jelek</option>
                                <option value="1">1 Bintang - Jelek Sekali</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="komen">Komentari Layanan:</label>
                            <textarea type="text" name="komen" id="komen" class="form-control" required></textarea>
                        </div>
                        <?php } ?>
                        <button type="submit" class="btn btn-primary" name="kirim">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#banyak-rekening').html('Tampilkan lebih banyak');
    $(document).ready(function(){
        $('#banyak-rekening').click(function(){
            if($('#banyak-rekening').html() == 'Tampilkan lebih banyak'){
                $('#banyak-rekening').html('Tampilkan lebih sedikit');
            } else {
                $('#banyak-rekening').html('Tampilkan lebih banyak');
            }
        });
    })
</script>
<?php include(__DIR__ . '/../layouts/footer.php'); ?>