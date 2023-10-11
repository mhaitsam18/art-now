<?php include(__DIR__ . '/../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Laporan Saldo Arsitek</li>
                    </ol>
                </nav>
                <h1 class="m-0">Laporan Saldo Arsitek</h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-12 card-body">
                    <form action="<?= BASEURL ?>/admin/export_saldo" method="post">
                        <div class="card-body">
                            <button type="submit" class="btn btn-info form-control col-md-12">Ekspor Laporan</button>
                        </div>
                    </form>
                    <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>
                        <table class="table mb-0 thead-border-top-0">
                            <thead>
                                <tr>
                                    <th>Nama Arsitek</th>
                                    <th>Email Arsitek</th>
                                    <th>Total Pendapatan <sup>(bruto)</sup></th>
                                    <th>Saldo Sekarang <sup>(neto)</sup></th>
                                    <th>Saldo Sudah Ditarik <sup>(neto)</sup></th>
                                    <th>Jumlah Penarikan</th>
                                    <th>Pemasukan Kotor Perusahaan</th>
                                </tr>
                            </thead>
                            <tbody class="list" id="staff02">
                                <?php $t = 0; foreach($data['saldos'] as $saldo) { ?>
                                <tr>
                                    <td><?= $saldo['nama_lengkap']; ?></td>
                                    <td><?= $saldo['email']; ?></td>
                                    <td>Rp <?= number_format($saldo['saldo']+$saldo['total_penarikan']+$saldo['biaya_admin'], 0, ',', '.'); ?></td>
                                    <td>Rp <?= number_format($saldo['saldo'], 0, ',', '.'); ?></td>
                                    <td>Rp <?= number_format($saldo['total_penarikan'], 0, ',', '.'); ?></td>
                                    <td><?= $saldo['jumlah_penarikan']; ?></td>
                                    <td>Rp <?= number_format($saldo['biaya_admin'], 0, ',', '.'); ?></td>
                                </tr>
                                <?php $t += $saldo['biaya_admin'];} ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="6" align="center" class="text-center">Total Pemasukan Kotor Perusahaan</th>
                                    <th>Rp <?= number_format($t, 0, ',', '.') ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
        $('.table').DataTable({
            "searching":false,
            'aaSorting': [],
            'order': [],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json"
            }
        });
    } );
</script>
<?php include(__DIR__ . '/../../layouts/footer.php'); ?>