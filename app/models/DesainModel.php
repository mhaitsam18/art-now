<?php

class DesainModel
{

    private $table = 'desain';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Arsitek
    public function semua($id_pesanan)
    {
        $this->db->query("SELECT * FROM desain WHERE id_pesanan = '" . $id_pesanan . "' ORDER BY dibuat_pada DESC");
        return $this->db->resultSet();
    }

    public function revisi($id_desain, $catatan_revisi)
    {
        $this->db->query("UPDATE desain SET catatan_revisi = '$catatan_revisi' WHERE id_desain = '$id_desain'");
        return $this->db->resultSet();
    }
    public function konfirmasi_revisi($id_desain, $konfirmasi)
    {
        $this->db->query("UPDATE desain SET konfirmasi_revisi = '$konfirmasi' WHERE id_desain = '$id_desain'");
        return $this->db->resultSet();
    }
    public function desain($id_desain)
    {
        $this->db->query("SELECT * FROM desain WHERE id_desain = '" . $id_desain . "' ORDER BY dibuat_pada DESC");
        return $this->db->single();
    }

    public function tambah($data)
    {
        $this->db->query('INSERT INTO ' . $this->table . ' (id_pesanan, dokumen, tautan) VALUES(:id_pesanan, :dokumen, :tautan)');
        $this->db->bind('id_pesanan', $data['id_pesanan']);
        $this->db->bind('dokumen', $data['dokumen']);
        $this->db->bind('tautan', $data['tautan']);
        $this->db->execute();
    }

    public function hapus($id_desain)
    {
        $this->db->query("DELETE FROM desain WHERE id_desain = '" . $id_desain . "'");
        return $this->db->execute();
    }

    // Arsitek cek
    public function cek_user()
    {
        $this->db->query("SELECT * FROM user WHERE email = '" . $_SESSION['email'] . "'");
        return $this->db->single();
    }
}
