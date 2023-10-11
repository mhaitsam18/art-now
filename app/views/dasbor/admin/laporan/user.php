<?php include(__DIR__ . '/../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Laporan Pengguna</li>
                    </ol>
                </nav>
                <h1 class="m-0">Laporan Pengguna</h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-12 card-body">
                    <form action="<?= BASEURL ?>/admin/export_user" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Filter Berdasarkan Tanggal</label>
                                <input type="text" class="form-control pull-right" name="rentang_tanggal" id="rentang-tanggal" required="" placeholder="Date range" value=""> 
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <select id="statusFilter" name="status" class="form-control">
                                        <option value="-10">Semua Status</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Nonaktif</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select id="levelFilter" name="level" class="form-control">
                                        <option value="-10">Semua Level</option>
                                        <option value="-1">Calon Arsitek</option>
                                        <option value="0">Pelanggan</option>
                                        <option value="1">Arsitek</option>
                                        <option value="2">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info form-control col-md-12">Ekspor Laporan</button>
                        </div>
                    </form>
                    <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>
                        <table class="table mb-0 thead-border-top-0 datatables">
                            <thead>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th align="center">Status</th>
                                    <th align="center">Level</th>
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
        $('#statusFilter').on('change',function(){
            datatables($('#rentang-tanggal').val());
        });
        $('#levelFilter').on('change',function(){
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
            console.log("<?=BASEURL?>/admin/data_laporan_user/"+awal+"/"+akhir+"/"+$('#statusFilter').val()+"/"+$('#levelFilter').val());
            // else {
                table = $('.datatables').DataTable({
                    "ajax": {
                        "url": "<?=BASEURL?>/admin/data_laporan_user/"+awal+"/"+akhir+"/"+$('#statusFilter').val()+"/"+$('#levelFilter').val(),
                        method:"GET",
                    },
                    "columns": [
                        {data : 'nama_lengkap'},
                        {data : 'email'},
                        {data : 'telepon'},
                        {data : 'status', render: function ( data, type, row ) {
                            var status = '';
                            if(row.status == 1) {
                                status = '<span class="badge badge-success">AKTIF</span>';
                            } else {
                                status = '<span class="badge badge-danger">NONAKTIF</span>';
                            }
                            return status;
                        }},
                        {data : 'level', render: function ( data, type, row ) {
                            var level = '';
                            if(row.level == -1 ) {
                                level = '<span class="badge badge-light">CALON ARSITEK</span>';
                            } else if(row.level == 0 ) {
                                level = '<span class="badge badge-info">PELANGGAN</span>';
                            } else if(row.level == 1 ) {
                                level = '<span class="badge badge-warning">ARSITEK</span>';
                            } else {
                                level = '<span class="badge badge-success">ADMIN</span>';
                            }
                            return level;
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