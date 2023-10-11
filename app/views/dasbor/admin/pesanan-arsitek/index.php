<?php include(__DIR__ . '/../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Data Pesanan Arsitek</li>
                    </ol>
                </nav>
                <h1 class="m-0">Data Pesanan Arsitek</h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-12 card-body">
                    <!-- DATE PICKER -->
                    <form action="javascript:void(0)" method="post">
                        <div class="form">
                            <div class="form-group">
                                <label>Filter Berdasarkan Tanggal</label>
                                <input type="text" class="form-control pull-right" name="rentang_tanggal" id="rentang-tanggal" required="" placeholder="Date range" value=""> 
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>
                        <table class="table mb-0 thead-border-top-0 datatables">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Nama Pengguna</th>
                                    <th>Nama Arsitek</th>
                                    <th>Judul Produk</th>
                                    <th>Total Dibayar</th>
                                    <th>Status Pembayaran</th>
                                    <th>Dipesan Pada</th>
                                    <th>Terakhir Diperbaharui</th>
                                    <!-- <th></th> -->
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
            datatables( $('#rentang-tanggal').val());
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
                        "url": "<?=BASEURL?>/admin/data_pesanan_arsitek/"+awal+"/"+akhir,
                        method:"GET",
                    },
                    "columns": [
                        {data : 'status', render: function ( data, type, row ) {
                            var status = '';
                            if(row.status == -2) {
                                status = '<span class="badge badge-danger">PESANAN DIBATALKAN PELANGGAN</span>';
                            }else if(row.status == -1) {
                                status = '<span class="badge badge-danger">PERMINTAAN PESANAN DITOLAK ARSITEK</span>';
                            } else if(row.status == 0) {
                                status = '<span class="badge badge-info">MENUNGGU KONFRIMASI PERMINTAAN OLEH ARSITEK</span>';
                            } else if(row.status == 1) {
                                status = '<span class="badge badge-warning">PROYEK/PESANAN SEDANG DIKERJAKAN</span>';
                            } else if(row.status == 2) {
                                status = '<span class="badge badge-warning">MENUNGGU PEMBAYARAN DARI PELANGGAN</span>';
                            } else if(row.status == 3) {
                                status = '<span class="badge badge-success">SELESAI</span>';
                            }
                            return status;
                        }},
                        {data : 'nama_lengkap_pengguna', render: function ( data, type, row ) {
                            return '<a href="../user/profile_pengguna/'+row.id_pengguna+'" target="_blank">'+row.nama_lengkap_pengguna+'</a>';
                        }},
                        {data : 'nama_lengkap_arsitek', render: function ( data, type, row ) {
                            return '<a href="../user/profile_arsitek/'+row.id_arsitek+'" target="_blank">'+row.nama_lengkap_arsitek+'</a>';
                        }},
                        {data : 'judul', render: function ( data, type, row ) {
                            return '<a href="../home/produk/'+row.id_produk+'" target="_blank">'+row.judul+'</a>';
                        }},
                        {data : 'total_dibayar', render: function ( data, type, row ) {
                            if(row.status == -1){
                                return "-";
                            }
                            return 'Rp '+(Intl.NumberFormat('id-ID').format(row.total_dibayar));
                        }},
                        {data : 'status_pembayaran', render: function ( data, type, row ) {
                            var status_pembayaran = '';
                            if(row.status_pembayaran == 1) {
                                status_pembayaran = 'Belum Penuh';
                            } else if(row.status_pembayaran == 2) {
                                status_pembayaran = 'Penuh';
                            } else {
                                status_pembayaran = '-';
                            }
                            return status_pembayaran;
                        }},
                        {data : 'dibuat_pada'},
                        {data : 'diperbaharui_pada'},
                        // {data : 'id_pesanan', render: function ( data, type, row ) {
                        //     return '<a href="riwayat_pembayaran_pengguna/'+row.id_pesanan+'" class="text-muted"><i class="material-icons">assignment_turned_in</i> Riwayat Pembayaran</a>';
                        // }, className: 'text-right nowrap', "searchable": false, "orderable": false},
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