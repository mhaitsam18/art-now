<?php include(__DIR__ . '/../../layouts/header.php'); ?>
<div class="mdk-drawer-layout__content page">
    <div class="container page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Data Rekening Bank</li>
                    </ol>
                </nav>
                <h1 class="m-0">Data Rekening Bank</h1>
            </div>
            <a href="#" class="btn btn-success ml-3" data-toggle="modal" data-target="#modal-tambah-rekening">Tambah Rekening Bank</a>
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
                                    <th>Nama</th>
                                    <th>Nomor</th>
                                    <th>Pemegang</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list" id="staff02">
                                <?php foreach($data['rekenings'] as $rekening) { ?>
                                <tr>
                                    <td><?= $rekening['nama']; ?></td>
                                    <td><?= $rekening['nomor']; ?></td>
                                    <td><?= $rekening['pemegang']; ?></td>
                                    <td style="white-space: nowrap;" align="right">
                                        <a href="edit_rekening_bank/<?= $rekening['id_rekening']; ?>" class="text-info"><i class="material-icons">edit</i> Edit</a>
                                        <a onclick="deleteData()" href="#"
                                            data-value="<?= $rekening['id_rekening']; ?>" data-nama="<?= $rekening['nama']; ?>" 
                                            data-nomor="<?= $rekening['nomor']; ?>" data-pemegang="<?= $rekening['pemegang']; ?>"
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
    $(document).ready( function () {
        $('.table').DataTable({
            "columns": [
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
        var url = "<?= BASEURL;?>/admin/hapus_rekening_bank/"+postId;
        $('#delete-url').attr('href', url);

        $('#text-delete').html('Apakah anda yakin ingin menghapus rekening bank dengan nama '+$(event.currentTarget).data('nama')+' dan nomor '+$(event.currentTarget).data('nomor')+' a/n '+$(event.currentTarget).data('pemegang')+'?');
    }
</script>
<?php include(__DIR__ . '/../../layouts/footer.php'); ?>