<?php

class auth extends Controller
{
    public function __construct()
    {
        session_start();
        if(isset($_SESSION['login'])){$this->route('index');}
    }

    public function register()
    {
        if(isset($_POST['email']) && isset($_POST['password'])){
            if($this->model('UserModel')->cek() != null){
                $data['type'] = 'danger';
                $data['desc'] = 'Email / telepon sudah terdaftar.';
                $this->view('auth/register', $data);
                exit();
            }
            $data = [
                'nama_lengkap'  => $_POST['nama_lengkap'],
                'email'         => $_POST['email'],
                'password'      => $_POST['password'],
                'telepon'       => $_POST['telepon'],
                'level'         => $_POST['level']
            ];
            $this->model('UserModel')->register($data);
            $this->login();
        }
        $this->view('auth/register');
    }

    public function login()
    {
        if(isset($_POST['email']) && isset($_POST['password'])){
            $data = $this->model('UserModel')->login();
            if ($data) {
                if($data['status'] == 0)
                {
                    session_destroy();
                    $data['type'] = 'info';
                    $data['desc'] = 'Akun anda sedang dicek admin, mohon cek berkala untuk melihat apakah akun anda sudah bisa dipakai. Terimakasih';
                    $this->view('auth/login', $data);
                }
                else if ($data['status'] == -1)
                {
                    session_destroy();
                    $data['type'] = 'danger';
                    $data['desc'] = 'Akun anda diban sementara! Akun anda diduga melakukan beberapa pelanggaran Syarat dan Ketentuan website.';
                    $this->view('auth/login', $data);
                }else{
                    $_SESSION['login']          = TRUE;
                    $_SESSION['id_user']        = $data['id_user'];
                    $_SESSION['email']          = $data['email'];
                    $_SESSION['level']          = $data['level'];
                    $_SESSION['nama_lengkap']   = $data['nama_lengkap'];
                    $_SESSION['foto']           = $data['foto'];
                    $_SESSION['status']         = $data['status'];

                    if(!isset($_POST['remember'])){
                        setcookie('login', $data['nama_lengkap'], time() - 60);
                    }
                    header('location: '.BASEURL.'/index');
                }
            }
            else
            {
                session_destroy();
                $data['type'] = 'danger';
                $data['desc'] = 'Email tidak ditemukan atau kata sandi yang ada masukkan salah.';
                $this->view('auth/login', $data);
            }
        }
        $this->view('auth/login');
    }

    public function lupa_sandi()
    {
        if(isset($_POST['email'])){
            $user = $this->model('UserModel')->lupa_password($_POST['email']);
            if($user)
            {
                header('location: '.BASEURL.'/auth/reset_sandi?email='.$user['email'].'&token='.$user['password']);
            }else{
                $data['type'] = 'danger';
                $data['desc'] = 'Email tidak ditemukan';
                $this->view('auth/lupa_sandi', $data);
            }
        }
        $this->view('auth/lupa_sandi');
    }

    public function reset_sandi(){
        if(isset($_POST['email'])){
            if($_POST['npw'] === $_POST['cpw']){
                $this->model('UserModel')->reset($_POST['email'], $_POST['cpw']);
                $this->alert('Kata Sandi berhasil diubah.', 'auth/login');
            }else{
                $data['type'] = 'danger';
                $data['desc'] = 'Kata Sandi tidak cocok';
                $this->view('auth/lupa_sandi?email='.$_POST['email'].'&token='.$_POST['token'], $data);
            }
        }
        
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $components = parse_url($actual_link);
        parse_str($components['query'], $results);
        
        $user = $this->model('UserModel')->cek_reset($results['email'], $results['token']);
        if($user){
            $data = $user;
            
            $this->view('auth/reset_sandi', $data);
        }else{
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }
}
