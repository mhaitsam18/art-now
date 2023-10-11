<?php

class artikel extends Controller
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
        else if ($_SESSION['level'] != 2 && $_SESSION['level'] != 0) 
        {
            $this->controller('alert')->message('Forbidden', '403 | Forbidden');
            exit();
        }
    }

    // CRUD
    public function index()
    {
        $data = [
            'artikels' => $this->model('ArtikelModel')->semua()
        ];
        $this->view('dasbor/artikel/index', $data);
    }

    public function tambah()
    {
        if ($_SESSION['level'] != 2) 
        {
            $this->controller('alert')->message('Forbidden', '403 | Forbidden');
            exit();
        }

        if (isset($_POST['tambah']))
        {
            $output_dir = dirname(getcwd())."/public/image/artikel/";
            $RandomNum  = time();
            $ImageName  = str_replace(' ','-',strtolower($_FILES['gambar']['name'][0]));
            $ImageType  = $_FILES['gambar']['type'][0];
        
            $ImageExt   = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt   = str_replace('.','',$ImageExt);
            $ImageName  = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
            $ret[$NewImageName] = $output_dir.$NewImageName;

            if (!file_exists($output_dir))
            {
                @mkdir($output_dir, 0777);
            }     

            move_uploaded_file($_FILES["gambar"]["tmp_name"][0], $output_dir.$NewImageName );

            $data = [
                'judul'     => $_POST['judul'],
                'gambar'    => $NewImageName,
                'isi' => $_POST['isi']
            ];
            $this->model('ArtikelModel')->tambah($data);
            $this->alert('Artikel berhasil ditambahkan.', 'artikel/index');
            exit();
        }
    }

    public function detail($id_artikel)
    {
        if($this->model('ArtikelModel')->artikel($id_artikel) != null){
            $data = $this->model('ArtikelModel')->artikel($id_artikel);
            $data['komens'] = $this->model('KomenArtikelModel')->semua($id_artikel);    
            $data['reply_komens'] = $this->model('KomenArtikelModel')->semua($id_artikel, 1);
            $this->view('dasbor/artikel/detail', $data);
        }else{
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }

    public function edit($id_artikel)
    {
        if ($_SESSION['level'] != 2) 
        {
            $this->controller('alert')->message('Forbidden', '403 | Forbidden');
            exit();
        }
        
        if($this->model('ArtikelModel')->artikel($id_artikel) != null){
            $data = $this->model('ArtikelModel')->artikel($id_artikel);
            $this->view('dasbor/artikel/edit', $data);
        }else{
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }

    public function update($id_artikel)
    {
        if ($_SESSION['level'] != 2) 
        {
            $this->controller('alert')->message('Forbidden', '403 | Forbidden');
            exit();
        }
        
        if($this->model('ArtikelModel')->artikel($id_artikel) != null){
            if (isset($_POST['update']))
            {
                if($_FILES['gambar']["name"][0]){
                    // Memasukkan Gambar Baru
                    $output_dir = dirname(getcwd())."/public/image/artikel/";
                    $RandomNum  = time();
                    $ImageName  = str_replace(' ','-',strtolower($_FILES['gambar']['name'][0]));
                    $ImageType  = $_FILES['gambar']['type'][0];
                
                    $ImageExt   = substr($ImageName, strrpos($ImageName, '.'));
                    $ImageExt   = str_replace('.','',$ImageExt);
                    $ImageName  = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                    $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
                    $ret[$NewImageName] = $output_dir.$NewImageName;
        
                    if (!file_exists($output_dir))
                    {
                        @mkdir($output_dir, 0777);
                    }     
        
                    move_uploaded_file($_FILES["gambar"]["tmp_name"][0], $output_dir.$NewImageName );

                    $data['gambar'] = $NewImageName;

                    // Penghapusan Gambar
                    $gambar = dirname(getcwd())."/public/image/artikel/".$this->model('ArtikelModel')->artikel($id_artikel)['gambar'];
                    if(file_exists($gambar)){
                        unlink($gambar);
                    }
                }else{
                    $data['gambar'] = null;
                }
    
                $data += [
                    'id_artikel' => $id_artikel,
                    'judul'     => $_POST['judul'],
                    'isi'     => $_POST['isi']
                ];
                $this->model('ArtikelModel')->update($data);
                $this->alert('Artikel berhasil diubah.', 'artikel/index');
                exit();
            }else{
                $this->controller('alert')->message('Not Found', '404 | Not Found');
            }
        }else{
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }

    public function hapus($id_artikel)
    {
        if ($_SESSION['level'] != 2) 
        {
            $this->controller('alert')->message('Forbidden', '403 | Forbidden');
            exit();
        }
        
        if($this->model('ArtikelModel')->artikel($id_artikel) != null){
            $data = $this->model('ArtikelModel')->artikel($id_artikel);
            try {
                $gambar = $this->model('ArtikelModel')->artikel($id_artikel)['gambar'];
                $this->model('ArtikelModel')->hapus($id_artikel);
                $path = dirname(getcwd())."/public/image/artikel/".$gambar;
                
                if(file_exists($path)){
                    unlink($path);
                }
                $this->alert('Artikel berhasil dihapus.', 'artikel/index');
            } catch (\Throwable $th) {
                $this->alert('Artikel gagal dihapus.', 'artikel/index');
            }
        }else{
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }

    // Komentar
    public function komen()
    {
        $komen = ($_POST['id_reply_komen'] == 'NULL') ? NULL:$_POST['id_reply_komen'];
        $data = [
            'id_artikel' => $_POST['id_artikel'],
            'id_reply_komen' => $komen,
            'komen' => $_POST['komen']
        ];
        $this->model('KomenArtikelModel')->tambah($data);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    public function hapus_komen($id_komen)
    {
        $this->model('KomenArtikelModel')->hapus($id_komen);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
