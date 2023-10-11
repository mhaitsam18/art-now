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
            <div class="col-lg-6 col-md-6 card-group-row__col">
                <div class="card card-group-row__card card-body card-body-x-lg flex-row align-items-center">
                    <div class="flex">
                        <div class="card-header__title text-muted mb-2">Total Pendapatan</div>
                        <div class="text-amount">Rp <?= number_format($data['total_pembayaran'], 0, ",", "."); ?></div>
                    </div>
                    <div><i class="material-icons icon-muted icon-40pt ml-3">monetization_on</i></div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 card-group-row__col">
                <div class="card card-group-row__card card-body card-body-x-lg flex-row align-items-center">
                    <div class="flex">
                        <div class="card-header__title text-muted mb-2">Total Pesanan</div>
                        <div class="text-amount"><?= $data['total_pesanan']; ?></div>
                    </div>
                    <div><i class="material-icons icon-muted icon-40pt ml-3">perm_identity</i></div>
                </div>
            </div>
        </div>
        <div>
            <h3>Grafik Pendapatan Dalam 12 Bulan Terakhir</h3>
            <canvas id="tahunan_pembayaran" width="300" height="110"></canvas>
            <br><br>
            <h3>Grafik Total Pesanan Dalam 12 Bulan Terakhir</h3>
            <canvas id="tahunan_pesanan" width="300" height="110"></canvas>
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
    var tahunan_pembayaran = document.getElementById("tahunan_pembayaran");
    var PembayaranChart = new Chart(tahunan_pembayaran, {
        type: 'line',
        data: {
            labels: ["<?php for($i = 11; $i >= 0; $i--) { echo $data['nama_bulan'][$i].' '.$data['tahun'][$i].'", "'; }?>"],
            datasets: [{
                label: '',
                data: [<?=implode(',', $data['tahunan_pembayaran'])?>],
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
    var tahunan_pesanan = document.getElementById("tahunan_pesanan");
    var PesananChart = new Chart(tahunan_pesanan, {
        type: 'line',
        data: {
            labels: ["<?php for($i = 11; $i >= 0; $i--) { echo $data['nama_bulan'][$i].' '.$data['tahun'][$i].'", "'; }?>"],
            datasets: [{
                label: '',
                data: [<?=implode(',', $data['tahunan_pesanan'])?>],
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