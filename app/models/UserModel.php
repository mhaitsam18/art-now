<?php

class UserModel{
  
    private $table = 'user';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Untuk dashboard admin
    public function semua_user($level = null){
        if ($level == null){
            $this->db->query("SELECT * FROM user");
        } else {
            $this->db->query("SELECT * FROM user WHERE level = ".$level);
        }
        return $this->db->resultSet();
    }

    // Untuk admin
    public function semua_calon_arsitek(){
        $this->db->query("SELECT user.*, (SELECT produk.status from produk WHERE produk.id_user = user.id_user ORDER BY dibuat_pada DESC LIMIT 1) AS status_produk, arsitek.ktp, arsitek.ijazah, arsitek.sertifikasi_arsitek FROM user LEFT JOIN arsitek ON arsitek.id_user = user.id_user WHERE level = -1 HAVING status_produk > -1 AND ktp IS NOT NULL AND ijazah IS NOT NULL AND sertifikasi_arsitek IS NOT NULL");
        return $this->db->resultSet();
    }
    public function cek_user($id_user, $level = null){
        if ($level == null){
            $this->db->query("SELECT * FROM user WHERE id_user = ".$id_user);
        } else {
            $this->db->query("SELECT * FROM user WHERE id_user = ".$id_user." AND level = ".$level);
        }
        return $this->db->single();
    }
        // data user
    public function semua_tanpa_owner($tanggal_awal, $tanggal_akhir, $status, $level){
        $status_query = $level_query = '';
        if($status != -10){
            $status_query = " AND status = '$status'";
        }
        if($level != -10){
            $level_query = " AND level = '$level'";
        }
        $this->db->query("SELECT * FROM user WHERE NOT id_user = 1 AND DATE(dibuat_pada) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'".$status_query.$level_query);
        return $this->db->resultSet();
    }
    public function semua_admin(){
        $this->db->query("SELECT * FROM user WHERE level = 2 AND NOT id_user = 1 AND NOT id_user = ".$this->logined_user()['id_user']);
        return $this->db->resultSet();
    }
    public function semua_arsitek(){
        $this->db->query("SELECT * FROM user WHERE level = 1");
        return $this->db->resultSet();
    }
    public function semua_pengguna(){
        $this->db->query("SELECT * FROM user WHERE level = 0");
        return $this->db->resultSet();
    }
        // Update user
    public function update_user($data)
    {
        if($data['password'] != null)
        {
            $this->db->query('UPDATE user SET nama_lengkap= :nama_lengkap, password = :password, email = :email, telepon = :telepon, diperbaharui_pada = :diperbaharui_pada WHERE id_user = '.$data['id_user']);
            $this->db->bind('password',md5($data['password']));
        }
        else
        {
            $this->db->query('UPDATE user SET nama_lengkap= :nama_lengkap, email = :email, telepon = :telepon, diperbaharui_pada = :diperbaharui_pada WHERE id_user = '.$data['id_user']);
        }
        $this->db->bind('nama_lengkap',$data['nama_lengkap']);
        $this->db->bind('email',$data['email']);
        $this->db->bind('telepon',$data['telepon']);
        $this->db->bind('diperbaharui_pada',date("Y-m-d H:i:s"));
        $this->db->execute();
    }
    public function update_level_byadmin($id_user, $level){
        $this->db->query("UPDATE user SET level = ".$level." WHERE id_user = '".$id_user."'");
        return $this->db->execute();
    }
    public function update_status_byadmin($id_user, $status){
        $this->db->query("UPDATE user SET status = ".$status." WHERE id_user = '".$id_user."'");
        return $this->db->execute();
    }
    // Delete user
    public function hapus_user($id_user){
        $this->db->query("DELETE FROM user WHERE id_user = '".$id_user."'");
        return $this->db->execute();
    }

    // Delete arsitek
    public function hapus_arsitek($id_user){
    $this->db->query("DELETE FROM arsitek WHERE id_user = '".$id_user."'");
    return $this->db->execute();
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO '.$this->table.' (email, password, nama_lengkap, telepon, foto, status, level, dibuat_pada, diperbaharui_pada) VALUES(:email, :password, :nama_lengkap, :telepon, :foto, :status, :level, :dibuat_pada, :diperbaharui_pada)');
        $this->db->bind('email',$data['email']);
        $this->db->bind('password',md5($data['password']));
        $this->db->bind('nama_lengkap',$data['nama_lengkap']);
        $this->db->bind('telepon',$data['telepon']);
        $this->db->bind('foto',null);
        $this->db->bind('status',1);
        $this->db->bind('level',$data['level']);
        $this->db->bind('dibuat_pada',date("Y-m-d H:i:s"));
        $this->db->bind('diperbaharui_pada',date("Y-m-d H:i:s"));
        $this->db->execute();
    }

    public function cek()
    {
		$email      = $_POST['email'];
		$telepon    = $_POST['telepon'];
		
		$res = $this->db->query("SELECT * FROM ".$this->table." WHERE email = '".$email."' OR telepon = '".$telepon."'");
        return $this->db->single();
    }
    
    public function profile()
    {
		$res = $this->db->query("SELECT user.*, arsitek.*, user.id_user as id_user FROM ".$this->table." LEFT JOIN arsitek ON user.id_user = arsitek.id_user WHERE email = '".$_SESSION['email']."'");
        return $this->db->single();
    }
    
    public function update_profile($data)
    {
        $user = $this->profile();
        if (isset($_POST['update_profile'])){
            if($data['foto'] != null)
            {
                $this->db->query('UPDATE user SET nama_lengkap= :nama_lengkap, email = :email, telepon = :telepon, foto = :foto, diperbaharui_pada = :diperbaharui_pada WHERE id_user = '.$user['id_user']);
                $this->db->bind('foto',$data['foto']);
            }
            else
            {
                $this->db->query('UPDATE user SET nama_lengkap= :nama_lengkap, email = :email, telepon = :telepon, diperbaharui_pada = :diperbaharui_pada WHERE id_user = '.$user['id_user']);
            }
            $this->db->bind('nama_lengkap',$data['nama_lengkap']);
            $this->db->bind('email',$data['email']);
            $this->db->bind('telepon',$data['telepon']);
            $this->db->bind('diperbaharui_pada',date("Y-m-d H:i:s"));
            $this->db->execute();
        }
        if (isset($_POST['update_lanjutan'])){
            $this->db->query('UPDATE arsitek SET alamat= :alamat, deskripsi = :deskripsi, diperbaharui_pada = :diperbaharui_pada WHERE id_user = '.$user['id_user']);
            $this->db->bind('alamat',$data['alamat']);
            $this->db->bind('deskripsi',$data['deskripsi']);
            $this->db->bind('diperbaharui_pada',date("Y-m-d H:i:s"));
            $this->db->execute();

        }
        if (isset($_POST['update_password'])){
            $this->db->query('UPDATE user SET password= :password, diperbaharui_pada = :diperbaharui_pada WHERE id_user = '.$user['id_user']);
            $this->db->bind('password',md5($data['password']));
            $this->db->bind('diperbaharui_pada',date("Y-m-d H:i:s"));
            $this->db->execute();
        }
    }

    public function profile_pengguna($id_user)
    {
		$res = $this->db->query("SELECT * FROM user WHERE id_user = '".$id_user."'");
        return $this->db->single();
    }
    
    public function profile_arsitek($id_user)
    {
		$res = $this->db->query("SELECT user.*, arsitek.id_arsitek, arsitek.deskripsi, arsitek.alamat, arsitek.bank, arsitek.nomor_rekening, (SELECT avg(rating) FROM rating LEFT JOIN produk on rating.id_produk = produk.id_produk WHERE produk.id_user = user.id_user) AS rating, (SELECT count(rating) FROM rating LEFT JOIN produk on rating.id_produk = produk.id_produk WHERE produk.id_user = user.id_user) AS total_rating, arsitek.ktp, arsitek.ijazah, arsitek.sertifikasi_arsitek FROM user LEFT JOIN arsitek ON user.id_user = arsitek.id_user WHERE user.id_user = '".$id_user."'");
        return $this->db->single();
    }
    
    
    public function login()
    {
		$email      = $_POST['email'];
		$password   = md5($_POST['password']);
		
		$res = $this->db->query("SELECT * FROM ".$this->table." WHERE email = '".$email."' AND password = '".$password."'");
        return $this->db->single();
    }

    // Arsitek cek
    public function cek_deskripsi(){
        $this->db->query("SELECT deskripsi FROM user LEFT JOIN `arsitek` ON user.id_user = arsitek.id_user WHERE email = '".$_SESSION['email']."' ORDER BY user.id_user");
        return $this->db->single();
    }

    // Logined cek
    public function logined_user(){
        $this->db->query("SELECT * FROM user WHERE email = '".$_SESSION['email']."'");
        return $this->db->single();
    }
    
    public function lupa_password($email){
        $this->db->query("SELECT * FROM user WHERE email = '".$email."'");
        return $this->db->single();
    }

    public function cek_reset($email, $password){
        $this->db->query("SELECT * FROM user WHERE email = '".$email."' AND password='".$password."'");
        return $this->db->single();
    }

    public function reset($email, $password){
        $this->db->query("UPDATE user SET password = '".md5($password)."' WHERE email = '".$email."'");
        return $this->db->execute();
    }
}