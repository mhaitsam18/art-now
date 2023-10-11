<?php

class ArtikelModel{
  
    private $table = 'artikel';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function semua(){
        $this->db->query("SELECT * FROM artikel ORDER BY diperbaharui_pada DESC");
        return $this->db->resultSet();
    }
    
    public function artikel($id_artikel){
        $this->db->query("SELECT * FROM artikel WHERE id_artikel = ".$id_artikel);
        return $this->db->single();
    }
    
    public function tambah($data)
    {
        $user = $this->cek_user();
        $this->db->query('INSERT INTO '.$this->table.' (judul, gambar, isi, dibuat_pada, diperbaharui_pada) VALUES(:judul, :gambar, :isi, :dibuat_pada, :diperbaharui_pada)');
        $this->db->bind('judul',$data['judul']);
        $this->db->bind('gambar',$data['gambar']);
        $this->db->bind('isi',$data['isi']);
        $this->db->bind('dibuat_pada',date("Y-m-d H:i:s"));
        $this->db->bind('diperbaharui_pada',date("Y-m-d H:i:s"));
        $this->db->execute();
    }

    public function update($data)
    {
        if($data['gambar'] != null)
        {
            $this->db->query('UPDATE '.$this->table.' SET judul= :judul, gambar = :gambar, isi = :isi, diperbaharui_pada = :diperbaharui_pada WHERE id_artikel = '.$data['id_artikel']);
            $this->db->bind('gambar',$data['gambar']);
        }
        else
        {
            $this->db->query('UPDATE '.$this->table.' SET judul= :judul, isi = :isi, diperbaharui_pada = :diperbaharui_pada WHERE id_artikel = '.$data['id_artikel']);
        }
        $this->db->bind('judul',$data['judul']);
        $this->db->bind('isi',$data['isi']);
        $this->db->bind('diperbaharui_pada',date("Y-m-d H:i:s"));
        $this->db->execute();
    }
    
    public function hapus($id_artikel){
        $this->db->query("DELETE FROM artikel WHERE id_artikel = '".$id_artikel."'");
        return $this->db->execute();
    }
    
    // User cek
    public function cek_user(){
        $this->db->query("SELECT * FROM user WHERE email = '".$_SESSION['email']."'");
        return $this->db->single();
    }
}