<?php include(__DIR__ . '/../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Laporan Keuangan</li>
                    </ol>
                </nav>
                <h1 class="m-0">Laporan Keuangan</h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-12 card-body">
                    <form action="<?= BASEURL ?>/admin/export_keuangan" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Filter Berdasarkan Tanggal</label>
                                <input type="text" class="form-control pull-right" name="rentang_tanggal" id="rentang-tanggal" required="" placeholder="Date range" value=""> 
                            </div>
                            <button type="submit" class="btn btn-info form-control col-md-12">Ekspor Laporan</button>
                        </div>
                    </form>
                    <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>
                        <table class="table mb-0 thead-border-top-0 datatables">
                            <thead>
                                <tr>
                                    <th>Arsitek</th>
                                    <th>Keterangan</th>
                                    <th>Nominal</th>
                                    <th>status</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody class="list" id="staff02"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
        var hari_ini = new Date();
        var tanggal_sekarang = ("0" + hari_ini.getDate()).slice(-2)+'/'+("0" + (hari_ini.getMonth()+1)).slice(-2)+'/'+hari_ini.getFullYear();
        var setahun_lalu = ("0" + hari_ini.getDate()).slice(-2)+'/'+("0" + (hari_ini.getMonth()+1)).slice(-2)+'/'+(hari_ini.getFullYear()-1);
        datatables(setahun_lalu+' - '+tanggal_sekarang);

        $('#rentang-tanggal').on('change',function(){
            datatables($('#rentang-tanggal').val());
        });
        function datatables(rentang) {
            var rentang = rentang.split(" - ");
            var awal = rentang[0].substring(6, 10)+"-"+rentang[0].substring(3, 5)+"-"+rentang[0].substring(0, 2);
            var akhir = rentang[1].substring(6, 10)+"-"+rentang[1].substring(3, 5)+"-"+rentang[1].substring(0, 2);
            console.log(awal);
            console.log(akhir);
            if ( $.fn.dataTable.isDataTable( '.datatables' ) ) {
                $('.datatables').dataTable().fnClearTable();
                $('.datatables').dataTable().fnDestroy();
            }
            // else {
                table = $('.datatables').DataTable({
                    "ajax": {
                        "url": "<?=BASEURL?>/admin/data_laporan_keuangan/"+awal+"/"+akhir,
                        method:"GET",
                    },
                    "columns": [
                        {data : 'nama_lengkap', render: function ( data, type, row ) {
                            return '<a href="../user/profile_arsitek/'+row.id_user+'" target="_BLANk">'+row.nama_lengkap+'</a>';
                        }},
                        {data : 'keterangan'},
                        {data : 'nominal', render: function ( data, type, row ) {
                            var nominal = '';
                            if(row.nominal > 0) {
                                nominal = '<p class="text-success">+'+(row.nominal).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".")+'</p>';
                            } else { 
                                if(row.keterangan == "Biaya admin penarikan saldo") {
                                    nominal = '<p class="text-muted">='+(row.nominal*-1).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".")+'</p>';
                                } else { 
                                    nominal = '<p class="text-danger">'+(row.nominal).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".")+'</p>';
                                }
                            }
                            return nominal;
                        }},
                        {data : 'nominal', render: function ( data, type, row ) {
                            var nominal = '';
                            if(row.nominal > 0) {
                                nominal = 'Uang Masuk';
                            } else { 
                                if(row.keterangan == "Biaya admin penarikan saldo") {
                                    nominal = 'Uang Tetap';
                                } else { 
                                    nominal = 'Uang Keluar';
                                }
                            }
                            return nominal;
                        }},
                        {data : 'dibuat_pada'},
                    ],
                    'aaSorting': [],
                    'order': [],
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json"
                    }
                });
            // }
        }
    } );
</script>
<?php include(__DIR__ . '/../../layouts/footer.php'); ?>