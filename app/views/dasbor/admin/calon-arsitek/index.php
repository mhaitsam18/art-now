<?php include(__DIR__ . '/../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Calon Arsitek</li>
                    </ol>
                </nav>
                <h1 class="m-0">Calon Arsitek</h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-12 card-body">

                    <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>
                        <table class="table mb-0 thead-border-top-0">
                            <thead>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th align="center">Status</th>
                                    <th align="center">KTP</th>
                                    <th align="center">Ijazah Terakhir</th>
                                    <th align="center">Sertifikasi Arsitek</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list" id="staff02">
                                <?php foreach($data['calon_arsiteks'] as $calon_arsitek) { ?>
                                <tr>
                                    <td><?= $calon_arsitek['nama_lengkap']; ?></td>
                                    <td><?= $calon_arsitek['email']; ?></td>
                                    <td><?= $calon_arsitek['telepon']; ?></td>
                                    <td align="center">
                                        <?php if(isset($calon_arsitek['status_produk'])) { ?>
                                        <?php if($calon_arsitek['status_produk'] == -1) { ?>
                                            <span class="badge badge-danger">DITOLAK</span>
                                        <?php } else { ?>
                                            <span class="badge badge-info">MENUNGGU</span>
                                        <?php } } else { ?>
                                            <span class="badge badge-warning">PRODUK BELUM DITEMUKAN</span>
                                        <?php } ?>
                                    </td>
                                    <td align="center">
                                        <?php if ($calon_arsitek['ktp'] != null) {?>
                                            <a class="badge badge-success" href="<?= BASEURL.'/dokumen/'.$calon_arsitek['ktp']; ?>" download="<?= 'CALON ARSITEK-'.$calon_arsitek['nama_lengkap'].'-KTP-'.$calon_arsitek['ktp'];?>">ADA</a>
                                        <?php } else { ?>
                                            <span class="badge badge-danger">BELUM ADA</span>
                                        <?php } ?>
                                    </td>
                                    <td align="center">
                                        <?php if ($calon_arsitek['ijazah'] != null) {?>
                                            <a class="badge badge-success" href="<?= BASEURL.'/dokumen/'.$calon_arsitek['ijazah']; ?>" download="<?= 'CALON ARSITEK-'.$calon_arsitek['nama_lengkap'].'-Ijazah-'.$calon_arsitek['ijazah'];?>">ADA</a>
                                        <?php } else { ?>
                                            <span class="badge badge-danger">BELUM ADA</span>
                                        <?php } ?>
                                    </td>
                                    <td align="center">
                                        <?php if ($calon_arsitek['sertifikasi_arsitek'] != null) {?>
                                            <a class="badge badge-success" href="<?= BASEURL.'/dokumen/'.$calon_arsitek['sertifikasi_arsitek']; ?>" download="<?= 'CALON ARSITEK-'.$calon_arsitek['nama_lengkap'].'-Sertifikasi Arsitek-'.$calon_arsitek['sertifikasi_arsitek'];?>">ADA</a>
                                        <?php } else { ?>
                                            <span class="badge badge-danger">BELUM ADA</span>
                                        <?php } ?>
                                    </td>
                                    <td align="right" style="white-space: nowrap;">
                                        <?php if(isset($calon_arsitek['status_produk'])) { ?>
                                            <a href="detail_calon_arsitek/<?= $calon_arsitek['id_user']; ?>" class="text-muted"><i class="material-icons">receipt</i> Detail</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
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
            "columns": [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                { "searchable": false, "orderable": false},
            ],
            'aaSorting': [],
            'order': [],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json"
            }
        });
    } );
    
    function deleteData(){
        var postId = $(event.currentTarget).data('value');
        var url = "<?= BASEURL;?>/arsitek/tolak_arsitek/"+postId;
        $('#delete-url').attr('href', url);

        $('#text-delete').html('Apakah kamu yakin menolak arsitek '+$(event.currentTarget).data('nama_lengkap')+'?');
    }
</script>
<?php include(__DIR__ . '/../../layouts/footer.php'); ?>