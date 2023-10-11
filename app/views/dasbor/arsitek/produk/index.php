<?php include(__DIR__ . '/../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Produk</li>
                    </ol>
                </nav>
                <h1 class="m-0">Produk</h1>
            </div>
            <a href="#" class="btn btn-success ml-3" data-toggle="modal" data-target="#modal-large">Tambah Produk</a>
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
                                    <th>Judul</th>
                                    <th>Harga Jasa</th>
                                    <th align="center">Penilaian</th>
                                    <th align="center">Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list" id="staff02">
                                <?php foreach($data['produks'] as $produk) { ?>
                                <tr>
                                    <td><?= $produk['judul']; ?></td>
                                    <td>Rp <?= number_format($produk['harga'], 0, ',', '.'); ?></td>
                                    <td><a href="rating_produk/<?= $produk['id_produk']; ?>"><span class="badge badge-warning"><?= number_format($produk['rating'], 1); ?></span></a></td>
                                    <td align="center">
                                        <?php if($produk['status'] == 1 ) { ?>
                                            <span class="badge badge-success">AKTIF</span>
                                        <?php } else { ?>
                                            <span class="badge badge-danger">NONAKTIF</span>
                                        <?php } ?>
                                    </td>
                                    <td style="white-space: nowrap;" align="right">
                                        <a href="detail_produk/<?= $produk['id_produk']; ?>" class="text-muted"><i class="material-icons">visibility</i> Lihat</a>
                                        <a href="rating_produk/<?= $produk['id_produk']; ?>" class="text-warning"><i class="material-icons">star</i> Penilaian</a>
                                        <?php if($produk['status'] == 1 ) { ?>
                                            <a href="nonaktifkan_produk/<?= $produk['id_produk']; ?>" class="text-danger"><i class="material-icons">block</i> Nonaktifkan</a>
                                        <?php } else { ?>
                                            <a href="aktifkan_produk/<?= $produk['id_produk']; ?>" class="text-success"><i class="material-icons">check</i> Aktifkan</a>
                                        <?php } ?>
                                        <a href="edit_produk/<?= $produk['id_produk']; ?>" class="text-info"><i class="material-icons">edit</i> Edit</a>
                                        <a onclick="deleteData()" href="#"
                                            data-value="<?= $produk['id_produk']; ?>" data-judul="<?= $produk['judul']; ?>"
                                            data-toggle="modal" data-target="#modal-delete" class="text-danger">
                                                <i class="material-icons">delete</i> Hapus
                                        </a>
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
    $(document).ready(function(){
        $("form").on("submit", function () {
            var hvalue = $('.ql-editor').html();
            $(this).append("<textarea name='deskripsi' style='display:none'>"+hvalue+"</textarea>");
        });
    });
</script>
<script>
    $(document).ready( function () {
        $('.table').DataTable({
            "columns": [
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
        var url = "<?= BASEURL;?>/arsitek/hapus_produk/"+postId;
        $('#delete-url').attr('href', url);

        $('#text-delete').html('Apakah kamu yakin ingin menghapus produk dengan judul: '+$(event.currentTarget).data('judul')+'?');
    }
</script>
<?php include(__DIR__ . '/../../layouts/footer.php'); ?>