<?php

class home extends Controller
{
    public function __construct()
    {
        session_start();
    }

    public function index()
    {
        $data['title'] = 'Halaman Home';
        $data['produks_asc'] = $this->model('ProdukModel')->index_byguest('ASC');
        $data['produks_desc'] = $this->model('ProdukModel')->index_byguest();
        $data['arsiteks'] = $this->model('ArsitekModel')->semua_arsitek();
        $this->view('Home/index', $data);
    }

    public function arsitek($id_user)
    {
        $data = $this->model('ArsitekModel')->profile_arsitek($id_user);
        if($data){
            $data['produks'] = $this->model('ProdukModel')->semua_byguest($id_user);
            $this->view('Home/arsitek', $data);
        }else{
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }

    public function produk($id_produk)
    {
        $data = $this->model('ProdukModel')->single_byguest($id_produk);
        $data['komens'] = $this->model('KomenModel')->semua($id_produk);    
        $data['reply_komens'] = $this->model('KomenModel')->semua($id_produk, 1);
        if($data){
            $this->view('Home/produk', $data);
        }else{
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }

    public function cari()
    {
        $data = [];
        if(isset(parse_url(NOWURL)['query'])) {
            parse_str(parse_url(NOWURL)['query'], $params);
            $cari = isset($params['cari']) ? $params['cari']:'';
            $kategori = isset($params['kategori']) ? $params['kategori']:'';
            $bintang = isset($params['bintang']) ? $params['bintang']:'';
            $data = $this->model('ProdukModel')->cari_byguest($cari, $kategori, $bintang);
        }
        $this->view('Home/cari', $data);
    }

    // Komentar
    public function komen()
    {
        $komen = ($_POST['id_reply_komen'] == 'NULL') ? NULL:$_POST['id_reply_komen'];
        $data = [
            'id_produk' => $_POST['id_produk'],
            'id_reply_komen' => $komen,
            'komen' => $_POST['komen']
        ];
        $this->model('KomenModel')->tambah($data);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    public function hapus_komen($id_komen)
    {
        $this->model('KomenModel')->hapus($id_komen);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
