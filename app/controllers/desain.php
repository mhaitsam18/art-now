<?php

class desain extends arsitek
{
    // CRUD
    public function index_desain($id_pesanan)
    {
        $data = [
            'desains' => $this->model('DesainModel')->semua($id_pesanan),
            'pesanan' => $this->model('PesananModel')->detail($id_pesanan),
            'id_pesanan' => $id_pesanan
        ];
        $this->view('dasbor/arsitek/pesanan/desain', $data);
    }

    public function create_desain($id_pesanan)
    {
        $data = [
            'desains' => $this->model('DesainModel')->semua($id_pesanan),
            'pesanan' => $this->model('PesananModel')->detail($id_pesanan),
            'id_pesanan' => $id_pesanan
        ];
        $this->view('dasbor/arsitek/pesanan/create', $data);
    }

    public function tambah_desain()
    {
        $output_dir = dirname(getcwd()) . "/public/dokumen/desain/";
        $RandomNum  = time();
        $DokumenName  = str_replace(' ', '-', strtolower($_FILES['dokumen']['name'][0]));
        $DokumenType  = $_FILES['dokumen']['type'][0];

        $DokumenExt   = substr($DokumenName, strrpos($DokumenName, '.'));
        $DokumenExt   = str_replace('.', '', $DokumenExt);
        $DokumenName  = preg_replace("/\.[^.\s]{3,4}$/", "", $DokumenName);
        $NewDokumenName = $DokumenName . '-' . $RandomNum . '.' . $DokumenExt;
        $ret[$NewDokumenName] = $output_dir . $NewDokumenName;

        if (!file_exists($output_dir)) {
            @mkdir($output_dir, 0777);
        }

        move_uploaded_file($_FILES["dokumen"]["tmp_name"][0], $output_dir . $NewDokumenName);

        $data = [
            'id_pesanan'    => $_POST['id_pesanan'],
            'dokumen'       => $NewDokumenName,
            'tautan'        => $_POST['tautan']
        ];
        $this->model('DesainModel')->tambah($data);
        $this->alert('Desain berhasil ditambahkan.', 'arsitek/desain_pesanan/' . $_POST['id_pesanan']);
        exit();
    }

    public function hapus_desain($id_pesanan, $id_desain)
    {
        if ($this->model('DesainModel')->desain($id_desain) != null) {
            $data = $this->model('DesainModel')->desain($id_desain);
            try {
                $dokumen = $this->model('DesainModel')->desain($id_desain)['dokumen'];
                $this->model('DesainModel')->hapus($id_desain);
                $path = dirname(getcwd()) . "/public/dokumen/desain/" . $dokumen;

                if (file_exists($path)) {
                    unlink($path);
                }
                $this->alert('Desain berhasil dihapus.', 'arsitek/desain_pesanan/' . $id_pesanan);
            } catch (\Throwable $th) {
                $this->alert('Desain gagal dihapus.', 'arsitek/desain_pesanan/' . $id_pesanan);
            }
        } else {
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }
}
