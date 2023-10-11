        <!-- drawer -->
        <div class="mdk-drawer  js-mdk-drawer" id="default-drawer" data-align="start">
            <div class="mdk-drawer__content">

                <div class="sidebar sidebar-light sidebar-left simplebar" data-simplebar>
                    <div class="sidebar-heading sidebar-m-t">Menu</div>
                    <ul class="sidebar-menu" id="sidebar-mini-tabs">
                        <?php if ($_SESSION['level'] == 0) { ?>
                            <li class="sidebar-menu-item <?= NOWURL == BASEURL.'/pengguna/index' ? 'active':''; ?>">
                                <a class="sidebar-menu-button" href="<?= BASEURL.'/pengguna/index'; ?>">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">receipt</i>
                                    <span class="sidebar-menu-text">Pesanan</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?= NOWURL == BASEURL.'/chat/index' ? 'active':''; ?>">
                                <a class="sidebar-menu-button" href="<?= BASEURL.'/chat/index'; ?>">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">chat</i>
                                    <span class="sidebar-menu-text">Pesan</span>
                                </a>
                            </li>
                        <?php } else if ($_SESSION['level'] == 2) { ?>
                            <li class="sidebar-menu-item <?= NOWURL == BASEURL.'/admin/index' ? 'active':''; ?>">
                                <a class="sidebar-menu-button" href="<?= BASEURL.'/admin/index'; ?>">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                                    <span class="sidebar-menu-text">Dasbor</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?= NOWURL == BASEURL.'/admin/calon_arsitek' ? 'active':''; ?>">
                                <a class="sidebar-menu-button" href="<?= BASEURL.'/admin/calon_arsitek'; ?>">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">assignment_ind</i>
                                    <span class="sidebar-menu-text">Calon Arsitek</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?= NOWURL == BASEURL.'/admin/validasi_pembayaran_pengguna' ? 'active':''; ?>">
                                <a class="sidebar-menu-button" href="<?= BASEURL.'/admin/validasi_pembayaran_pengguna'; ?>">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">assignment</i>
                                    <span class="sidebar-menu-text">Validasi Pembayaran Pelanggan</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?= NOWURL == BASEURL.'/admin/permintaan_penarikan' ? 'active':''; ?>">
                                <a class="sidebar-menu-button" href="<?= BASEURL.'/admin/permintaan_penarikan'; ?>">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">account_balance_wallet</i>
                                    <span class="sidebar-menu-text">Permintaan Penarikan Saldo</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?= NOWURL == BASEURL.'/admin/pesanan_arsitek' ? 'active':''; ?>">
                                <a class="sidebar-menu-button" href="<?= BASEURL.'/admin/pesanan_arsitek'; ?>">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">playlist_add_check</i>
                                    <span class="sidebar-menu-text">Pesanan Arsitek</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?= in_array(NOWURL, [BASEURL.'/admin/data_admin',BASEURL.'/admin/data_arsitek',BASEURL.'/admin/data_pengguna']) ? 'open active':'' ?> ">
                                <a class="sidebar-menu-button" data-toggle="collapse" href="#menu_pengguna">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">group</i>
                                    <span class="sidebar-menu-text">Pengguna</span>
                                    <span class="ml-auto sidebar-menu-toggle-icon"></span>
                                </a>
                                <ul class="sidebar-submenu collapse <?= in_array(NOWURL, [BASEURL.'/admin/data_admin',BASEURL.'/admin/data_arsitek',BASEURL.'/admin/data_pengguna']) ? 'show':'' ?> " id="menu_pengguna">
                                    <?php if($_SESSION['id_user'] == 1){ ?>
                                        <li class="sidebar-menu-item <?= NOWURL == BASEURL.'/admin/data_admin' ? 'active':'' ?>">
                                            <a class="sidebar-menu-button" href="<?= BASEURL.'/admin/data_admin'; ?>">
                                                <span class="sidebar-menu-text">Admin</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <li class="sidebar-menu-item <?= NOWURL == BASEURL.'/admin/data_arsitek' ? 'active':'' ?>">
                                        <a class="sidebar-menu-button" href="<?= BASEURL.'/admin/data_arsitek'; ?>">
                                            <span class="sidebar-menu-text">Arsitek</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-menu-item <?= NOWURL == BASEURL.'/admin/data_pengguna' ? 'active':'' ?>">
                                        <a class="sidebar-menu-button" href="<?= BASEURL.'/admin/data_pengguna'; ?>">
                                            <span class="sidebar-menu-text">Pelanggan</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php if($_SESSION['id_user'] == 1){ ?>
                                <li class="sidebar-menu-item <?= NOWURL == BASEURL.'/admin/rekening_bank' ? 'active':''; ?>">
                                    <a class="sidebar-menu-button" href="<?= BASEURL.'/admin/rekening_bank'; ?>">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">account_balance</i>
                                        <span class="sidebar-menu-text">Rekening Bank</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="sidebar-menu-item <?= in_array(NOWURL, [BASEURL.'/admin/laporan_user',BASEURL.'/admin/laporan_produk',BASEURL.'/admin/laporan_transaksi',BASEURL.'/admin/laporan_keuangan',BASEURL.'/admin/laporan_saldo']) ? 'open active':'' ?> ">
                                <a class="sidebar-menu-button" data-toggle="collapse" href="#menu_laporan">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">library_books</i>
                                    <span class="sidebar-menu-text">Laporan</span>
                                    <span class="ml-auto sidebar-menu-toggle-icon"></span>
                                </a>
                                <ul class="sidebar-submenu collapse <?= in_array(NOWURL, [BASEURL.'/admin/laporan_user',BASEURL.'/admin/laporan_produk',BASEURL.'/admin/laporan_transaksi',BASEURL.'/admin/laporan_keuangan',BASEURL.'/admin/laporan_saldo']) ? 'show':'' ?> " id="menu_laporan">
                                    <?php if($_SESSION['id_user'] == 1){ ?>
                                        <li class="sidebar-menu-item <?= NOWURL == BASEURL.'/admin/laporan_user' ? 'active':'' ?>">
                                            <a class="sidebar-menu-button" href="<?= BASEURL.'/admin/laporan_user'; ?>">
                                                <span class="sidebar-menu-text">Pengguna</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <li class="sidebar-menu-item <?= NOWURL == BASEURL.'/admin/laporan_produk' ? 'active':'' ?>">
                                        <a class="sidebar-menu-button" href="<?= BASEURL.'/admin/laporan_produk'; ?>">
                                            <span class="sidebar-menu-text">Produk</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-menu-item <?= NOWURL == BASEURL.'/admin/laporan_transaksi' ? 'active':'' ?>">
                                        <a class="sidebar-menu-button" href="<?= BASEURL.'/admin/laporan_transaksi'; ?>">
                                            <span class="sidebar-menu-text">Transaksi</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-menu-item <?= NOWURL == BASEURL.'/admin/laporan_keuangan' ? 'active':'' ?>">
                                        <a class="sidebar-menu-button" href="<?= BASEURL.'/admin/laporan_keuangan'; ?>">
                                            <span class="sidebar-menu-text">Keuangan</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-menu-item <?= NOWURL == BASEURL.'/admin/laporan_saldo' ? 'active':'' ?>">
                                        <a class="sidebar-menu-button" href="<?= BASEURL.'/admin/laporan_saldo'; ?>">
                                            <span class="sidebar-menu-text">Saldo</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-menu-item <?= NOWURL == BASEURL.'/artikel/index' ? 'active':''; ?>">
                                <a class="sidebar-menu-button" href="<?= BASEURL.'/artikel/index'; ?>">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">web</i>
                                    <span class="sidebar-menu-text">Artikel</span>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="sidebar-menu-item <?= NOWURL == BASEURL.'/arsitek/index' ? 'active':''; ?>">
                                <a class="sidebar-menu-button" href="<?= BASEURL.'/arsitek/index'; ?>">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                                    <span class="sidebar-menu-text">Dasbor</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?= NOWURL == BASEURL.'/arsitek/produk' ? 'active':''; ?>">
                                <a class="sidebar-menu-button" href="<?= BASEURL.'/arsitek/produk'; ?>">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">list</i>
                                    <span class="sidebar-menu-text">Produk</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?= NOWURL == BASEURL.'/arsitek/pesanan' ? 'active':''; ?>">
                                <a class="sidebar-menu-button" href="<?= BASEURL.'/arsitek/pesanan'; ?>">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">receipt</i>
                                    <span class="sidebar-menu-text">Pesanan</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?= NOWURL == BASEURL.'/chat/index' ? 'active':''; ?>">
                                <a class="sidebar-menu-button" href="<?= BASEURL.'/chat/index'; ?>">
                                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">chat</i>
                                    <span class="sidebar-menu-text">Pesan</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- // END drawer -->
    </div>
    <!-- // END drawer-layout -->

</div>
<!-- // END header-layout__content -->

</div>
<!-- // END header-layout -->

<!-- App Settings FAB -->
<div id="app-settings">
    <app-settings layout-active="mini" :layout-location="{
      'default': 'index.html',
      'fixed': 'fixed-dashboard.html',
      'fluid': 'fluid-dashboard.html',
      'mini': 'mini-dashboard.html'
    }"></app-settings>
</div>

<!-- jQuery -->
<script src="<?= BASEURL; ?>/assets-admin/vendor/jquery.min.js"></script>

<!-- Bootstrap -->
<script src="<?= BASEURL; ?>/assets-admin/vendor/popper.min.js"></script>
<script src="<?= BASEURL; ?>/assets-admin/vendor/bootstrap.min.js"></script>

<!-- Simplebar -->
<script src="<?= BASEURL; ?>/assets-admin/vendor/simplebar.min.js"></script>

<!-- DOM Factory -->
<script src="<?= BASEURL; ?>/assets-admin/vendor/dom-factory.js"></script>

<!-- MDK -->
<script src="<?= BASEURL; ?>/assets-admin/vendor/material-design-kit.js"></script>

<!-- App -->
<script src="<?= BASEURL; ?>/assets-admin/js/toggle-check-all.js"></script>
<script src="<?= BASEURL; ?>/assets-admin/js/check-selected-row.js"></script>
<script src="<?= BASEURL; ?>/assets-admin/js/dropdown.js"></script>
<script src="<?= BASEURL; ?>/assets-admin/js/sidebar-mini.js"></script>
<script src="<?= BASEURL; ?>/assets-admin/js/app.js"></script>

<!-- App Settings (safe to remove) -->
<!-- <script src="<?= BASEURL; ?>/assets-admin/js/app-settings.js"></script> -->

<!-- Quill -->
<script src="<?= BASEURL; ?>/assets-admin/vendor/quill.min.js"></script>
<script src="<?= BASEURL; ?>/assets-admin/js/quill.js"></script>

<!-- Flatpickr -->
<script src="<?= BASEURL; ?>/assets-admin/vendor/flatpickr/flatpickr.min.js"></script>
<script src="<?= BASEURL; ?>/assets-admin/js/flatpickr.js"></script>

<!-- Global Settings -->
<script src="<?= BASEURL; ?>/assets-admin/js/settings.js"></script>

<!-- Chart.js -->
<script src="<?= BASEURL; ?>/assets-admin/vendor/Chart.min.js"></script>

<!-- App Charts JS -->
<script src="<?= BASEURL; ?>/assets-admin/js/charts.js"></script>

<!-- Chart Samples -->
<script src="<?= BASEURL; ?>/assets-admin/js/page.dashboard.js"></script>

<!-- Vector Maps -->
<script src="<?= BASEURL; ?>/assets-admin/vendor/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= BASEURL; ?>/assets-admin/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
<script src="<?= BASEURL; ?>/assets-admin/js/vector-maps.js"></script>
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    $(function() {
        // Alasan Penolakan
        $('#alasan-tolak-calon-arsitek').val('deskripsi').change();
        $('#alasan-tolak-calon-arsitek').on('change', function(){
            var alasan = $('#alasan-tolak-calon-arsitek').val();
            if(alasan == 'deskripsi') {
                $('#notifikasi-tolak-calon-arsitek').val('Deskripsi dan Dokumen yang dimasukkan tidak memenuhi persyaratan.');
            }else if(alasan == 'produk') {
                $('#notifikasi-tolak-calon-arsitek').val('Produk yang dimasukkan tidak memenuhi persyaratan.');
            }
            if(alasan == 'semua') {
                $('#notifikasi-tolak-calon-arsitek').val('Deskripsi, Dokumen, dan Produk yang dimasukkan tidak memenuhi persyaratan.');
            }
        });

        // datepicker
        var hari_ini = new Date();
        var tanggal_sekarang = ("0" + hari_ini.getDate()).slice(-2)+'/'+("0" + (hari_ini.getMonth()+1)).slice(-2)+'/'+hari_ini.getFullYear();
        var setahun_lalu = ("0" + hari_ini.getDate()).slice(-2)+'/'+("0" + (hari_ini.getMonth()+1)).slice(-2)+'/'+(hari_ini.getFullYear()-1);
        $('input[name="rentang_tanggal"]').daterangepicker({
            "startDate": setahun_lalu,
            "endDate": tanggal_sekarang,
            "opens": "center",
            "locale": {
                "format": "DD/MM/YYYY",
                "separator": " - ",
                "applyLabel": "Selesai",
                "cancelLabel": "Batal",
                "fromLabel": "Dari",
                "toLabel": "Ke",
                "customRangeLabel": "Kustomisasi",
                "daysOfWeek": [
                    "Min",
                    "Sen",
                    "Sel",
                    "Rab",
                    "Kam",
                    "Jum",
                    "Sab"
                ],
                "monthNames": [
                    "Januari",
                    "Februari",
                    "Maret",
                    "April",
                    "Mei",
                    "Juni",
                    "Juli",
                    "Agustus",
                    "September",
                    "Oktober",
                    "November",
                    "Desember"
                ],
                "firstDay": 1
            }
        });
        // ENABLE sidebar menu tabs
        $('#sidebar-mini-tabs [data-toggle="tab"]').on('click', function(e) {
            e.preventDefault()
            $(this).tab('show')
        });
    })()
</script>
<script>
    function load_notification(view = '')
    {
        $.ajax({
            url:"<?=BASEURL?>/user/notifikasi",
            method:"POST",
            data:{view:view},
            dataType:"json",
            success:function(data)
            {
                $('.notifikasi-div').html(data.notifikasi);
                if(data.belum_dilihat > 0)
                {
                    $('#indikator').addClass("navbar-notifications-indicator");
                }
            }
        });
    }
    $(document).ready(function(){
        load_notification();
    });
    function lihat(view = ''){
        $.ajax({
            url:"<?=BASEURL?>/user/lihat_notifikasi",
            method:"POST",
            data:{view:view},
            dataType:"json",
            success:function(data)
            {
                $('#indikator').removeClass("navbar-notifications-indicator");
            }
        });
    }
    function bersihkan(view = ''){
        $.ajax({
            url:"<?=BASEURL?>/user/bersihkan_notifikasi",
            method:"POST",
            data:{view:view},
            dataType:"json",
            success:function(data)
            {
                load_notification();
            }
        });
    }
</script>

</body>

</html>