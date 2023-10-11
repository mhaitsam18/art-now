<?php

class user extends Controller
{
    public function __construct()
    {
        session_start();
        if(!isset($_SESSION['login'])){$this->route('auth/login');}
    }

    public function profile()
    {
        $data = $this->model('UserModel')->profile();
        $this->view('dasbor/profile', $data);
    }

    public function update_profile()
    {
        if (isset($_POST['update_profile']))
        {
            if($_FILES['foto']["name"][0]){
                // Memasukkan Gambar Baru
                $output_dir = dirname(getcwd())."/public/image/profile/";
                $RandomNum  = time();
                $ImageName  = str_replace(' ','-',strtolower($_FILES['foto']['name'][0]));
                $ImageType  = $_FILES['foto']['type'][0];
            
                $ImageExt   = substr($ImageName, strrpos($ImageName, '.'));
                $ImageExt   = str_replace('.','',$ImageExt);
                $ImageName  = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
                $ret[$NewImageName] = $output_dir.$NewImageName;
    
                if (!file_exists($output_dir))
                {
                    @mkdir($output_dir, 0777);
                }     
    
                move_uploaded_file($_FILES["foto"]["tmp_name"][0], $output_dir.$NewImageName );

                $data['foto'] = $NewImageName;

                // Penghapusan Gambar
                $foto = dirname(getcwd())."/public/image/profile/".$this->model('UserModel')->profile()['foto'];
                if(file_exists($foto)){
                    unlink($foto);
                }
            }else{
                $data['foto'] = null;
            }

            $data += [
                'nama_lengkap'  => $_POST['nama_lengkap'],
                'email'         => $_POST['email'],
                'telepon'       => $_POST['telepon']
            ];
            $this->model('UserModel')->update_profile($data);
            
            $_SESSION['email']          = $data['email'];
            $user = $this->model('UserModel')->profile();
            $_SESSION['level']          = $user['level'];
            $_SESSION['nama_lengkap']   = $user['nama_lengkap'];
            $_SESSION['foto']           = $user['foto'];
            $_SESSION['status']         = $user['status'];

            $this->alert('Informasi dasar berhasil diubah', 'user/profile');
            exit();
        }
        if (isset($_POST['update_lanjutan']))
        {
            $data = [
                'alamat'        => $_POST['alamat'],
                'deskripsi'     => $_POST['deskripsi']
            ];
            $this->model('UserModel')->update_profile($data);
            $this->alert('Informasi lanjutan berhasil diubah', 'user/profile');
            exit();
        }
        if (isset($_POST['update_password']))
        {
            if($this->model('UserModel')->profile()['password'] == md5($_POST['opass']))
            {
                if($_POST['npass'] === $_POST['cpass']){
                    $data = [
                        'password'        => $_POST['npass']
                    ];
                    $this->model('UserModel')->update_profile($data);
                    $this->alert('Kata Sandi berhasil diubah', 'user/profile');
                    exit();
                } else {
                    $this->alert('Konfirmasi kata sandi tidak sesuai dengan kata sandi baru', 'user/profile');
                }
            }else{
                $this->alert('Kata Sandi Lama tidak cocok', 'user/profile');
            }
        }
    }

    public function profile_pengguna($id_pengguna){
        $data = $this->model('UserModel')->profile_pengguna($id_pengguna);
        if($data != null && $data['level'] == 0){
            $this->view('dasbor/profile_pengguna', $data);
        }else{
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }

    public function profile_arsitek($id_arsitek){
        $data = $this->model('UserModel')->profile_arsitek($id_arsitek);
        if($data != null && $data['level'] == 1){
            if($_SESSION['level'] == 2){
                $data['produks'] = $this->model('ProdukModel')->produk_arsitek_byadmin($id_arsitek);
            }
            $this->view('dasbor/profile_arsitek', $data);
        }else{
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }

    public function notifikasi(){
        $data = $this->model('NotifikasiModel')->semua();
        $output = '';
        foreach($data as $n){
            $output .=
            '<div class="dropdown-item d-flex">'.
                '<div class="flex">'.
                    $n['keterangan'].'<br>'.
                    '<small class="text-muted">'.date('d-m-Y H:i', strtotime($n['dibuat_pada'])).'</small>'.
                '</div>'.
            '</div>';
        }
        $belum_dilihat = $this->model('NotifikasiModel')->belum_dilihat();
        
        echo json_encode($data= [ 'notifikasi' => $output, 'belum_dilihat' => count($belum_dilihat)]);
    }

    public function lihat_notifikasi(){
        $this->model('NotifikasiModel')->lihat();
        echo json_encode($data = ['status'=>'sukses']);
    }

    public function bersihkan_notifikasi(){
        $this->model('NotifikasiModel')->bersihkan();
        echo json_encode($data = ['status'=>'sukses']);
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        // $this->route('auth/login');
    }
}
