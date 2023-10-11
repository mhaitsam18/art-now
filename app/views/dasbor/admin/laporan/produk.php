<?php include(__DIR__ . '/../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Laporan Produk Arsitek</li>
                    </ol>
                </nav>
                <h1 class="m-0">Laporan Produk Arsitek</h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-12 card-body">
                    <form action="<?= BASEURL ?>/admin/export_produk" method="post">
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
                                    <th>Judul Produk</th>
                                    <th>Harga Jasa</th>
                                    <th>Penilaian</th>
                                    <th>Tautan Video</th>
                                    <th>Kategori</th>
                                    <th align="center">Status Produk</th>
                                    <th>Nama Arsitek</th>
                                    <th>Dibuat Pada</th>
                                    <th>Diperbaharui Pada</th>
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
                        "url": "<?=BASEURL?>/admin/data_laporan_produk/"+awal+"/"+akhir,
                        method:"GET",
                    },
                    "columns": [
                        {data : 'judul'},
                        {data : 'harga', render: function ( data, type, row ) {
                            return 'Rp '+(row.harga).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
                        }},
                        {data : 'rating', render: function ( data, type, row ) {
                            if(row.rating) {
                                return '<span class="badge badge-warning">'+parseFloat((row.rating)).toFixed(1)+'</span>'
                            }
                            return '<span class="badge badge-warning">0.0</span>';
                        }},
                        {data : 'tautan_video'},
                        {data : 'kategori', render: function ( data, type, row ) {
                            var kategori = '';
                            if(row.kategori == "1") {
                                kategori = 'Desain Rumah Terbaru';
                            } else if(row.kategori == "2") {
                                kategori = 'Desain Rumah Minimalis';
                            } else if(row.kategori == "3") {
                                kategori = 'Desain Rumah Mewah';
                            } else if(row.kategori == "4") {
                                kategori = 'Desain Interior';
                            } else if(row.kategori == "0") {
                                kategori = 'Desain Bangunan Lainnya';
                            } else {

                            }
                            return kategori;
                        }},
                        {data : 'status', render: function ( data, type, row ) {
                            var status = '';
                            if(row.status == 1 ) {
                                status = '<span class="badge badge-success">AKTIF</span>';
                            } else {
                                status = '<span class="badge badge-danger">NONAKTIF</span>';
                            }
                            return status;
                        }},
                        {data : 'nama_lengkap', render: function ( data, type, row ) {
                            return '<a href="../user/profile_arsitek/'+row.id_user+'" target="_BLANk">'+row.nama_lengkap+'</a>';
                        }},
                        {data : 'dibuat_pada'},
                        {data : 'diperbaharui_pada'},
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