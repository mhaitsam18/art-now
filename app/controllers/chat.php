<?php

class chat extends Controller
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['email']))
        {
            $this->route('auth/login');
        }
        else if ($_SESSION['level'] == 1) 
        {
            $this->controller('arsitek')->__construct();
        }
    }
    
    public function index()
    {
        try {
            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $url_components = parse_url($actual_link);
            if(array_key_exists('query', $url_components)){
                parse_str($url_components['query'], $params);
                if(array_key_exists('ke', $params)){
                    $id_user = $this->model('UserModel')->profile_pengguna(preg_replace('/[^0-9]/', '', $params['ke']));
                    if($id_user == null){
                        $this->alert('User tidak ditemukan', 'chat/index');
                        return;
                    }
                    if($id_user['id_user'] == $_SESSION['id_user']){
                        $this->alert('Tidak bisa mengirimkan pesan kepada diri sendiri', 'chat/index');
                        return;
                    }
                    if($_SESSION['level'] == 0){
                        if($id_user['level'] != 1){
                            $this->alert('User tidak ditemukan', 'chat/index');
                            return;
                        }
                    }else if($_SESSION['level'] == 1){
                        if($id_user['level'] != 0){
                            $this->alert('User tidak ditemukan', 'chat/index');
                            return;
                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            //Tidak ada yang perlu dilakukan;
        }
        $this->view('dasbor/chat/index');
    }

    public function riwayat_chat($cari)
    {
        $all_users = [];
        $riwayat_chat = $this->model('ChatModel')->riwayat_chat($cari);

        foreach($riwayat_chat as $data){
            if($data['id_user_kepada'] == $_SESSION['id_user']){
                $all_users[] = $data['id_user_dari'];
            }
        }

        $riwayat = '';
        foreach($riwayat_chat as $data){
            if($data['id_user_kepada'] == $_SESSION['id_user']){
                $riwayat .= '<div class="list-group-item d-flex media align-items-center">'.
                    '<a href="javascript:void(0)" class="avatar avatar-sm media-left mr-3">'.
                        '<img src="'.(($data['foto_pengirim'] == NULL) ? 'https://via.placeholder.com/40x40':BASEURL.'/image/profile/'.$data['foto_pengirim']).'" alt="Avatar" class="avatar-img rounded-circle">'.
                    '</a>'.
                    '<div class="media-body">'.
                        '<p class="m-0">'.
                            '<a href="javascript:void(0)" class="text-body mulai-chat" data-id="'.$data['id_user_dari'].'"><strong>'.$data['nama_pengirim'].'</strong></a>'.(($data['jumlah_belum_dibaca'] > 0) ? ' <span class="badge badge-info rounded-circle">'.$data['jumlah_belum_dibaca'].'</span>':'').'<br>'.
                            '<span class="text-muted">'.(($data['level_pengirim'] == 0) ?'Pelanggan':'' ).(($data['level_pengirim'] == 1) ?'Arsitek':'' ).(($data['level_pengirim'] == -1) ?'Calon Arsitek':'' ).(($data['level_pengirim'] == 2) ?'Admin':'' ).'</span>'.
                        '</p>'.
                    '</div>'.
                '</div>';
            }else if($data['id_user_dari'] == $_SESSION['id_user']){
                if(!in_array($data['id_user_kepada'],$all_users)){
                    $riwayat .= '<div class="list-group-item d-flex media align-items-center">'.
                        '<a href="javascript:void(0)" class="avatar avatar-sm media-left mr-3">'.
                            '<img src="'.(($data['foto_penerima'] == NULL) ? 'https://via.placeholder.com/40x40':BASEURL.'/image/profile/'.$data['foto_penerima']).'" alt="Avatar" class="avatar-img rounded-circle">'.
                        '</a>'.
                        '<div class="media-body">'.
                            '<p class="m-0">'.
                                '<a href="javascript:void(0)" class="text-body mulai-chat" data-id="'.$data['id_user_kepada'].'"><strong>'.$data['nama_penerima'].'</strong></a>'.(($data['jumlah_belum_dibaca'] > 0) ? ' <span class="badge badge-info rounded-circle">'.$data['jumlah_belum_dibaca'].'</span>':'').'<br>'.
                                '<span class="text-muted">'.(($data['level_penerima'] == 0) ?'Pelanggan':'' ).(($data['level_penerima'] == 1) ?'Arsitek':'' ).(($data['level_penerima'] == -1) ?'Calon Arsitek':'' ).(($data['level_penerima'] == 2) ?'Admin':'' ).'</span>'.
                            '</p>'.
                        '</div>'.
                    '</div>';
                }
            }
        }

        echo $riwayat;
    }

    public function chat($id_user_with)
    {
        // set status to read
        $this->model('ChatModel')->update_status(preg_replace('/[^0-9]/', '', $id_user_with), 2);

        $chats = $this->model('ChatModel')->chat($id_user_with);
        $chat['user'] = $this->model('UserModel')->profile_pengguna(preg_replace('/[^0-9]/', '', $id_user_with));
        $chat['chat'] = '';
        foreach($chats as $data){
            if ($_SESSION['id_user'] == $data['id_user_dari']) {
                $chat['chat'] .= 
                    '<div class="media border-bottom py-3">'.
                        '<div class="media-body">'.
                            '<div class="d-flex align-items-center">'.
                                '<div class="flex">'.
                                    '<a href="#" class="text-body bold">'.(($_SESSION['id_user'] == $data['id_user_dari']) ? '<i>Kamu</i>':$data['nama_pengirim'] ).'</a>'.
                                '</div>'.
                            '</div>';

                if($data['tipe'] != 2){
                    $chat['chat'] .=
                            '<div>'.$data['pesan'].'</div>';
                }else{
                    if(in_array(pathinfo($data['pesan'], PATHINFO_EXTENSION), ['png','jpg','jpeg','gif'])){
                        $chat['chat'] .=
                            '<a href="'.BASEURL.'/dokumen/chat/'.$data['pesan'].'" class="avatar avatar-xxl avatar-4by3 mt-2" download>'.
                                '<img src="'.BASEURL.'/dokumen/chat/'.$data['pesan'].'" alt="image" class="avatar-img rounded">'.
                            '</a><br/>';
                    }else{
                        $chat['chat'] .=
                            '<a href="'.BASEURL.'/dokumen/chat/'.$data['pesan'].'" class="media align-items-center mt-2 text-underline-0 bg-white p-2" download>
                            <span class="avatar avatar-xs mr-2">
                                <span class="avatar-title rounded-circle">
                                    <i class="material-icons">attach_file</i>
                                </span>
                            </span>
                            <span class="media-body" style="line-height: 1.5">
                                <span class="text-primary">'.$data['pesan'].'</span><br>
                            </span>
                        </a>';
                    }
                }
                            
                $chat['chat'] .=
                        '<small class="text-muted">'.date('d-m-Y H:i', strtotime($data['dibuat_pada'])).'</small>'.
                        '</div>'.
                    '</div>';
            } else {
                $chat['chat'] .= 
                    '<div class="media border-bottom py-3">'.
                        '<div class="media-body text-right">'.
                            '<div class="d-flex align-items-center">'.
                                '<div class="flex">'.
                                    '<a href="#" class="text-body bold">'.(($_SESSION['id_user'] == $data['id_user_dari']) ? '<i>Kamu</i>':$data['nama_pengirim'] ).'</a>'.
                                '</div>'.
                            '</div>';

                if($data['tipe'] != 2){
                    $chat['chat'] .=
                            '<div>'.$data['pesan'].'</div>';
                }else{
                    if(in_array(pathinfo($data['pesan'], PATHINFO_EXTENSION), ['png','jpg','jpeg','gif'])){
                        $chat['chat'] .=
                            '<a href="'.BASEURL.'/dokumen/chat/'.$data['pesan'].'" class="avatar avatar-xxl avatar-4by3 mt-2" download>'.
                                '<img src="'.BASEURL.'/dokumen/chat/'.$data['pesan'].'" alt="image" class="avatar-img rounded">'.
                            '</a><br/>';
                    }else{
                        $chat['chat'] .=
                            '<a href="'.BASEURL.'/dokumen/chat/'.$data['pesan'].'" class="media align-items-center mt-2 text-underline-0 bg-white p-2" download>
                            <span class="media-body" style="line-height: 1.5">
                                <span class="text-primary">'.$data['pesan'].'</span><br>
                            </span>
                            <span class="avatar avatar-xs ml-2">
                                <span class="avatar-title rounded-circle">
                                    <i class="material-icons">attach_file</i>
                                </span>
                            </span>
                        </a>';
                    }
                }
                            
                $chat['chat'] .=
                        '<small class="text-muted">'.date('d-m-Y H:i', strtotime($data['dibuat_pada'])).'</small>'.
                        '</div>'.
                    '</div>';
            }
        }

        echo json_encode($chat);
    }
    
    public function kirim_chat()
    {
        try {
            $data = [
                'id_user_kepada'=> $_POST['id_user'],
                'tipe'      => 1,
                'pesan'     => $_POST['pesan'],
            ];
            $this->model('ChatModel')->kirim_chat($data);
            echo "success";
        } catch (\Throwable $th) {
            echo "failed";
        }
    }

    public function kirim_dokumen()
    {
        try {
            if($_FILES['pesan']["name"]){
                // Memasukkan Gambar Baru
                $output_dir = dirname(getcwd())."/public/dokumen/chat/";
                $RandomNum  = time();
                $DocumentName  = str_replace(' ','-',strtolower($_FILES['pesan']['name']));
                $DocumentType  = $_FILES['pesan']['type'];
            
                $DocumentExt   = substr($DocumentName, strrpos($DocumentName, '.'));
                $DocumentExt   = str_replace('.','',$DocumentExt);
                $DocumentName  = preg_replace("/\.[^.\s]{3,4}$/", "", $DocumentName);
                $NewDocumentName = $DocumentName.'-'.$RandomNum.'.'.$DocumentExt;
                $ret[$NewDocumentName] = $output_dir.$NewDocumentName;
    
                if (!file_exists($output_dir))
                {
                    @mkdir($output_dir, 0777);
                }     
    
                move_uploaded_file($_FILES["pesan"]["tmp_name"], $output_dir.$NewDocumentName );

                $data = [
                    'id_user_kepada'=> $_POST['id_user'],
                    'tipe'      => 2,
                    'pesan'     => $NewDocumentName,
                ];
                $this->model('ChatModel')->kirim_chat($data);
                echo "success";
            }
            echo "failed";
        } catch (\Throwable $th) {
            echo "failed";
        }
    }

    private function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'tahun',
            'm' => 'bulan',
            'w' => 'minggu',
            'd' => 'hari',
            'h' => 'jam',
            'i' => 'menit',
            's' => 'detik',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' yang lalu' : 'sekarang';
    }
}