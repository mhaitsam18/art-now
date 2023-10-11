<?php

class RatingModel{
  
    private $table = 'rating';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    
    public function tambah($data)
    {
        $user = $this->cek_user()['id_user'];
        $this->db->query('INSERT INTO rating (id_rating, id_user, id_produk, rating, komen) VALUES(NULL, :id_user, :id_produk, :rating, :komen)');
        $this->db->bind('id_user',$user);
        $this->db->bind('id_produk',$data['id_produk']);
        $this->db->bind('rating',$data['rating']);
        $this->db->bind('komen',$data['komen']);
        $this->db->execute();
        
    }

    // Arsitek cek
    public function cek_user(){
        $this->db->query("SELECT * FROM user WHERE email = '".$_SESSION['email']."'");
        return $this->db->single();
    }
}