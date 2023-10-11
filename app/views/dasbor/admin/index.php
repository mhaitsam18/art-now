<?php include(__DIR__ . '/../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Dasbor</li>
                    </ol>
                </nav>
                <h1 class="m-0">Dasbor</h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <div class="row card-group-row">
            <div class="col-lg-8 col-md-8 card-group-row__col">
                <div class="card card-group-row__card card-body card-body-x-lg flex-row align-items-center">
                    <div class="flex">
                        <div class="card-header__title text-muted mb-2">Semua Pengguna</div>
                        <div class="text-amount"><?= $data['total_user']; ?></div>
                    </div>
                    <div><i class="material-icons icon-muted icon-40pt ml-3">perm_identity</i></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 card-group-row__col">
                <div class="card card-group-row__card card-body card-body-x-lg flex-row align-items-center">
                    <div class="flex">
                        <div class="card-header__title text-muted mb-2">Total Admin</div>
                        <div class="text-amount"><?= $data['total_admin']; ?></div>
                    </div>
                    <div><i class="material-icons icon-muted icon-40pt ml-3">perm_identity</i></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 card-group-row__col">
                <div class="card card-group-row__card card-body card-body-x-lg flex-row align-items-center">
                    <div class="flex">
                        <div class="card-header__title text-muted mb-2">Total Pelanggan</div>
                        <div class="text-amount"><?= $data['total_pengguna']; ?></div>
                    </div>
                    <div><i class="material-icons icon-muted icon-40pt ml-3">perm_identity</i></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 card-group-row__col">
                <div class="card card-group-row__card card-body card-body-x-lg flex-row align-items-center">
                    <div class="flex">
                        <div class="card-header__title text-muted mb-2">Total Arsitek</div>
                        <div class="text-amount"><?= $data['total_arsitek']; ?></div>
                    </div>
                    <div><i class="material-icons icon-muted icon-40pt ml-3">perm_identity</i></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 card-group-row__col">
                <div class="card card-group-row__card card-body card-body-x-lg flex-row align-items-center">
                    <div class="flex">
                        <div class="card-header__title text-muted mb-2">Total Calon Arsitek</div>
                        <div class="text-amount"><?= $data['total_calon_arsitek']; ?></div>
                    </div>
                    <div><i class="material-icons icon-muted icon-40pt ml-3">perm_identity</i></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <div class="card">
                    <div class="card-header card-header-large bg-white d-flex align-items-center">
                        <h4 class="card-header__title flex m-0">Arsitek yang Memiliki Pendapatan Paling Banyak</h4>
                    </div>
                    <div class="list-group tab-content list-group-flush">
                        <div class="tab-pane active show fade" id="activity_all">
                            <?php
                                $no = 1; 
                                foreach($data['top3_pembayaran'] as $top3) {
                            ?>
                            <div class="list-group-item list-group-item-action d-flex align-items-center ">
                                <div class="avatar avatar-xs mr-3">
                                    <?php if($no == 1) { ?>
                                        <span class="avatar-title rounded-circle bg-warning" style="font-size: 18pt"><?= $no ?></span>
                                    <?php } else if($no == 2) { ?>
                                        <span class="avatar-title rounded-circle bg-info" style="font-size: 18pt"><?= $no ?></span>
                                    <?php } else { ?>
                                        <span class="avatar-title rounded-circle bg-grey" style="font-size: 18pt"><?= $no ?></span>
                                    <?php } ?>
                                </div>
                                <div class="flex">
                                    <div class="d-flex align-items-middle">
                                        <strong class="text-15pt mr-1"><?= $top3['nama_lengkap'] ?></strong>
                                    </div>
                                    <small class="text-muted"><?= number_format($top3['rating'],1) ?>/5 bintang dari <?= $top3['total_rating'] ?> penilaian</small>
                                </div>
                                <div>Rp <?= number_format($top3['total_pendapatan'],0,',','.') ?></div>
                                <a href="../user/profile_arsitek/<?= $top3['id_user']; ?>"><i class="material-icons icon-muted ml-3">arrow_forward</i></a>
                            </div>
                            <?php $no++;} ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card">
                    <div class="card-header card-header-large bg-white d-flex align-items-center">
                        <h4 class="card-header__title flex m-0">Arsitek yang Memiliki Pesanan Paling Banyak</h4>
                    </div>
                    <div class="list-group tab-content list-group-flush">
                        <div class="tab-pane active show fade" id="activity_all">
                            <?php
                                $no = 1; 
                                foreach($data['top3_pesanan'] as $top3) {
                            ?>
                            <div class="list-group-item list-group-item-action d-flex align-items-center ">
                                <div class="avatar avatar-xs mr-3">
                                    <?php if($no == 1) { ?>
                                        <span class="avatar-title rounded-circle bg-warning" style="font-size: 18pt"><?= $no ?></span>
                                    <?php } else if($no == 2) { ?>
                                        <span class="avatar-title rounded-circle bg-info" style="font-size: 18pt"><?= $no ?></span>
                                    <?php } else { ?>
                                        <span class="avatar-title rounded-circle bg-grey" style="font-size: 18pt"><?= $no ?></span>
                                    <?php } ?>
                                </div>
                                <div class="flex">
                                    <div class="d-flex align-items-middle">
                                        <strong class="text-15pt mr-1"><?= $top3['nama_lengkap'] ?></strong>
                                    </div>
                                    <small class="text-muted"><?= number_format($top3['rating'],1) ?>/5 bintang dari <?= $top3['total_rating'] ?> penilaian</small>
                                </div>
                                <div><?= $top3['total_pesanan'] ?></div>
                                <a href="../user/profile_arsitek/<?= $top3['id_user']; ?>"><i class="material-icons icon-muted ml-3">arrow_forward</i></a>
                            </div>
                            <?php $no++;} ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h3>Grafik Pendapatan Seluruh Arsitek Dalam 12 Bulan Terakhir</h3>
            <canvas id="tahunan_semua_pembayaran" width="300" height="110"></canvas>
            <br><br>
            <h3>Grafik Total Pesanan Seluruh Arsitek Dalam 12 Bulan Terakhir</h3>
            <canvas id="tahunan_semua_pesanan" width="300" height="110"></canvas>
        </div>
    </div>
</div>
<!-- Global Settings -->
<script src="<?= BASEURL; ?>/assets-admin/js/settings.js"></script>
<!-- Chart.js -->
<script src="<?= BASEURL; ?>/assets-admin/vendor/Chart.min.js"></script>

<!-- App Charts JS -->
<script src="<?= BASEURL; ?>/assets-admin/js/charts.js"></script>
<script>
    var tahunan_semua_pembayaran = document.getElementById("tahunan_semua_pembayaran");
    var PembayaranChart = new Chart(tahunan_semua_pembayaran, {
        type: 'line',
        data: {
            labels: ["<?php for($i = 11; $i >= 0; $i--) { echo $data['nama_bulan'][$i].' '.$data['tahun'][$i].'", "'; }?>"],
            datasets: [{
                label: '',
                data: [<?=implode(',', $data['tahunan_semua_pembayaran'])?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(value, index, values) {
                            // Convert the number to a string and splite the string every 3 charaters from the end
                            value = value.toString();
                            value = value.split(/(?=(?:...)*$)/);
                            // Convert the array to a string and format the output
                            value = value.join('.');
                            return 'Rp ' + value;
                        }
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                            // Convert the number to a string and splite the string every 3 charaters from the end
                            value = tooltipItem.yLabel.toString();
                            value = value.split(/(?=(?:...)*$)/);
                            // Convert the array to a string and format the output
                            value = value.join('.');
                            return 'Rp ' + value;
                    }
                }
            }
        }
    });
    var tahunan_semua_pesanan = document.getElementById("tahunan_semua_pesanan");
    var PesananChart = new Chart(tahunan_semua_pesanan, {
        type: 'line',
        data: {
            labels: ["<?php for($i = 11; $i >= 0; $i--) { echo $data['nama_bulan'][$i].' '.$data['tahun'][$i].'", "'; }?>"],
            datasets: [{
                label: '',
                data: [<?=implode(',', $data['tahunan_semua_pesanan'])?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(value, index, values) {
                            // Convert the number to a string and splite the string every 3 charaters from the end
                            value = value.toString();
                            value = value.split(/(?=(?:...)*$)/);
                            // Convert the array to a string and format the output
                            value = value.join('.');
                            return value;
                        }
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                            // Convert the number to a string and splite the string every 3 charaters from the end
                            value = tooltipItem.yLabel.toString();
                            value = value.split(/(?=(?:...)*$)/);
                            // Convert the array to a string and format the output
                            value = value.join('.');
                            return value;
                    }
                }
            }
        }
    });
</script>
<?php include(__DIR__ . '/../layouts/footer.php'); ?>