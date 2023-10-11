<?php

class alert
{
    public function message($judul, $deksripsi)
    {
        $data = [
            'judul' => $judul,
            'deskripsi' => $deksripsi
        ];
        require_once '../app/views/alert/message.php';
    }
}
