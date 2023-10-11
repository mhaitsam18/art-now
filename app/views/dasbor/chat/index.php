<?php include(__DIR__ . '/../layouts/header.php'); ?>
<style>
    #chat-area {
        height: 400px;
        max-height: 400px;
        overflow-y: scroll;
    }
    #user-area {
        height: 400px;
        max-height: 400px;
        overflow-y: scroll;
    }
</style>
<div class="mdk-drawer-layout__content page">
    <div class="container page__container">
        <div class="app-chat-container">
            <div class="row h-100 m-0">
                <div class="col-lg-8 py-3 d-flex flex-column h-100">
                    <div class="input-group input-group-merge">
                        <form id="form-chat" class="input-group input-group-merge" action="javascript:void(0)" method="post">
                            <input type="text" name="pesan" class="form-control form-control-appended" id="name-pesan" required="" placeholder="Masukkan Pesan...">
                            <input type="hidden" name="id_user_to" id="name-id-user-to" value="1" required>
                            <input type="hidden" name="tipe" id="name-tipe" value="1" required>
                            <div class="input-group-append">
                                <div class="input-group-text pr-2">
                                    <div class="custom-file custom-file-naked d-flex" style="width: 24px">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" style="color: inherit;" for="customFile">
                                            <i class="material-icons">attach_file</i>
                                        </label>
                                    </div>
                                </div>
                                <div class="input-group-text pl-0">
                                    <button class="btn btn-primary btn-sm" type="submit" id="kirim-chat"> Kirim <i class="material-icons">send</i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="flex p-3 d-flex flex-column">
                        <div data-simplebar class="h-100" id="area-chat">
                            <div class="media border-bottom py-3">
                                <div class="media-body">
                                    <div class="text-muted text-center">Klik nama sebelum memulai pesan.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 py-3 px-0 bg-white border-left d-flex flex-column">
                    <div class="form-group px-3">
                        <div class="input-group input-group-merge input-group-rounded">
                            <input type="text" class="form-control form-control-prepended" id="cari" placeholder="Cari...">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="material-icons">filter_list</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex d-flex flex-column">
                        <div data-simplebar class="h-100">
                            <div class="list-group list-group-flush" style="position: relative; z-index: 0;" id="riwayat-chat">
                                <!-- Ajax riwayat_chat() -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function(){
        // ID User yang disimpan secara global
        id_user = '';
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);

        reset_chat();

        riwayat_chat();

        if(urlParams.get('ke')){
            reset_chat();
            id_user_with = urlParams.get('ke');
            id_user = id_user_with;
            chat(id_user_with);
        }
        setInterval(function() {
            riwayat_chat();
            if(id_user != ''){
                chat(id_user);
            }
            // update_chat_history_data();
        }, 5000);

        $('#cari').on('input', function(){
            riwayat_chat();
        })

        function riwayat_chat() {
            url = "riwayat_chat/!";
            if($('#cari').val() != ''){
                url = 'riwayat_chat/'+$('#cari').val();
            }
            $.ajax({
                url: url,
                method: "POST",
                success: function(data) {
                    $('#riwayat-chat').html(data);
                }
            })
        }

        $('#riwayat-chat').on('click', '.mulai-chat', function(event){
            reset_chat();
            id_user_with = $(this).data('id');
            id_user = id_user_with;
            chat(id_user_with);
        })

        function chat(id_user_with){
            $.ajax({
                url: 'chat/'+id_user_with,
                method: "POST",
                success: function(data) {
                    data = JSON.parse(data);
                    $('#name-pesan').attr('placeholder', 'Kirimkan pesan kepada '+data.user.nama_lengkap+'...');
                    $('#name-pesan').prop('disabled', false);
                    $('#customFile').prop('disabled', false);
                    $('#kirim-chat').prop('disabled', false);
                    $('#area-chat').html(data.chat);
                }
            })
        }

        $('#kirim-chat').on('click', function(){
            if($('#name-pesan').val() != ''){
                $.ajax({
                    url: 'kirim_chat',
                    method: "POST",
                    data: {
                        id_user: id_user,
                        pesan: $('#name-pesan').val()
                    },
                    success: function(res) {
                        chat(id_user);
                        $('#name-pesan').val('');
                    }
                })
            }else{
                alert('input null');
            }
        })
        $('#customFile').on('change', function(){
            if($('#customFile').val() != null){
                var input = $('#customFile').val(),
                formdata = false;
                
                if (window.FormData) {
                    formdata = new FormData();
                    formdata.append('id_user',id_user);
                    formdata.append('pesan',$('#customFile')[0].files[0]);

                    $.ajax({
                        url: 'kirim_dokumen',
                        method: "POST",
                        data: formdata,
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            chat(id_user);
                            $('#name-pesan').val('');
                        }
                    })
                }else{
                    alert('Mesin pencarian yang anda gunakan tidak bisa mengirimkan file, gunakan versi terrbaru. Atau gunakan mesin pencarian yang lebih kompatibel.')
                }
                $('#customFile').val('');
            }
        })

        function reset_chat(){
            $('#name-pesan').val('');
            $('#name-pesan').attr('placeholder', 'Klik nama sebelum memulai pesan...');
            $('#name-pesan').prop('disabled', true);
            $('#customFile').prop('disabled', true);
            $('#kirim-chat').prop('disabled', true);
        }
    });
</script>
<?php include(__DIR__ . '/../layouts/footer.php'); ?>