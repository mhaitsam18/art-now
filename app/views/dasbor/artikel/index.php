<?php include(__DIR__ . '/../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Artikel</li>
                    </ol>
                </nav>
                <h1 class="m-0">Artikel</h1>
            </div>
            <?php if ($_SESSION['level'] == 2) { ?><a href="#" class="btn btn-success ml-3" data-toggle="modal" data-target="#modal-tambah-artikel">Tambah Artikel</a><?php } ?>
        </div>
    </div>
    <div class="container page__container">
        <?php if ($_SESSION['level'] == 2) { ?>
        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-12 card-body">

                    <div class="table-responsive border-bottom" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>
                        <table class="table mb-0 thead-border-top-0">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list" id="staff02">
                                <?php foreach ($data['artikels'] as $artikel) { ?>
                                    <tr>
                                        <td><?= $artikel['judul']; ?></td>
                                        <td style="white-space: nowrap;" align="right">
                                            <a href="detail/<?= $artikel['id_artikel']; ?>" class="text-muted"><i class="material-icons">visibility</i> Lihat</a>
                                            <a href="edit/<?= $artikel['id_artikel']; ?>" class="text-info"><i class="material-icons">edit</i> Edit</a>
                                            <a onclick="deleteData()" href="#" data-value="<?= $artikel['id_artikel']; ?>" data-judul="<?= $artikel['judul']; ?>" data-toggle="modal" data-target="#modal-delete" class="text-danger">
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

        <?php } else { ?>
        <div class="row card-group-row  pt-2">
            <?php foreach ($data['artikels'] as $artikel) { ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card card-group-row__card pricing__card">
                        <div class="card-body d-flex flex-column">
                            <div class="text-center">
                                <h4 class="pricing__title mb-0"><?= $artikel['judul']; ?></h4>
                                <div class="d-flex align-items-center justify-content-center border-bottom-2 flex pb-3">
                                    <a href="#" class="dp-preview card mb-4">
                                        <img src="<?= BASEURL."/image/artikel/".$artikel['gambar'];?>" alt="gambar <?= $artikel['judul']; ?>" class="img-fluid">
                                    </a>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <a href="detail/<?= $artikel['id_artikel']; ?>" class="btn btn-success mt-auto">Baca selengkapnya...</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("form").on("submit", function() {
            var hvalue = $('.ql-artikel .ql-editor').html();
            $(this).append("<textarea name='isi' style='display:none'>" + hvalue + "</textarea>");
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.table').DataTable({
            "columns": [
                null,
                {
                    "searchable": false,
                    "orderable": false
                },
            ],
            'aaSorting': [],
            'order': [],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json"
            }
        });
    });

    function deleteData() {
        var postId = $(event.currentTarget).data('value');
        var url = "<?= BASEURL; ?>/artikel/hapus/" + postId;
        $('#delete-url').attr('href', url);

        $('#text-delete').html('Apakah kamu yakin ingin menghapus artikel dengan judul: ' + $(event.currentTarget).data('judul') + '?');
    }
</script>
<?php include(__DIR__ . '/../layouts/footer.php'); ?>