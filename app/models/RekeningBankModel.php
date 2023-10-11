<?php

class RekeningBankModel{
  
    private $table = 'rekening_bank';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function semua(){
        $this->db->query("SELECT * FROM rekening_bank ORDER BY dibuat_pada DESC");
        return $this->db->resultSet();
    }
    public function rekening($id_rekening){
        $this->db->query("SELECT * FROM rekening_bank WHERE id_rekening = ".$id_rekening);
        return $this->db->single();
    }
    public function tambah($data)
    {
        $this->db->query('INSERT INTO '.$this->table.' (logo, nama, nomor, pemegang, dibuat_pada, diperbaharui_pada) VALUES(:logo, :nama, :nomor, :pemegang, :dibuat_pada, :diperbaharui_pada)');
        $this->db->bind('logo',$data['logo']);
        $this->db->bind('nama',$data['nama']);
        $this->db->bind('nomor',$data['nomor']);
        $this->db->bind('pemegang',$data['pemegang']);
        $this->db->bind('dibuat_pada',date("Y-m-d H:i:s"));
        $this->db->bind('diperbaharui_pada',date("Y-m-d H:i:s"));
        $this->db->execute();
    }
    
    public function update($data)
    {
        $this->db->query('UPDATE rekening_bank SET logo= :logo, nama= :nama, nomor = :nomor, pemegang = :pemegang, diperbaharui_pada = :diperbaharui_pada WHERE id_rekening = '.$data['id_rekening']);
        $this->db->bind('logo',$data['logo']);
        $this->db->bind('nama',$data['nama']);
        $this->db->bind('nomor',$data['nomor']);
        $this->db->bind('pemegang',$data['pemegang']);
        $this->db->bind('diperbaharui_pada',date("Y-m-d H:i:s"));
        $this->db->execute();
    }
    
    public function hapus($id_rekening){
        $this->db->query("DELETE FROM rekening_bank WHERE id_rekening = '".$id_rekening."'");
        return $this->db->execute();
    }
}