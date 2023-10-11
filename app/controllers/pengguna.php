<?php

class pengguna extends Controller
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['email'])) {
            $this->route('auth/login');
        } else if ($_SESSION['level'] != 0) {
            $this->controller('alert')->message('Forbidden', '403 | Forbidden');
            exit();
        }
    }

    public function index()
    {
        $data['pesanans'] = $this->model('PesananModel')->semua_bypengguna();
        $this->view('dasbor/pengguna/index', $data);
    }

    public function pesan($id_produk)
    {
        $produk = $this->model('ProdukModel')->single_byguest($id_produk);
        if ($produk) {
            $pesanan = $this->model('PesananModel')->sedang_bypengguna();

            $status = true;
            foreach ($pesanan as $data) {
                if ($data['id_arsitek'] == $produk['id_user']) {
                    $status = false;
                }
            }

            if (count($pesanan) >= 2 || $status == false) {
                $this->alert('Batasan Proyek yang dikerjakan serta jumlah pemesanan adalah 2 Proyek dengan 2 Arsitek yang berbeda. Anda bisa menyelesaikan proyek saat ini atau membatalkan pesanan yang memiliki status menunggu. cek pesanan di dasbor!', null);
                echo "<script>window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
            } else {
                $data = [
                    'id_user' => $_SESSION['id_user'],
                    'id_produk' => $id_produk,
                    'lokasi' => $_POST['lokasi'],
                    'luas_tanah' => $_POST['luas_tanah'],
                    'detail' => $_POST['detail'],
                    'status' => 0
                ];
                $this->model('PesananModel')->tambah($data);
                $pesan = [
                    'id_user' => $produk['id_user'],
                    'judul' => 'Anda memiliki pesanan baru',
                    'keterangan' => 'Anda baru saja memiliki pesanan baru. <a href="' . BASEURL . '/arsitek/pesanan">Klik di sini untuk melihat.</a>.',
                    'link' => 'arsitek/pesanan'
                ];
                $this->model('NotifikasiModel')->notifikasi($pesan);
                $this->alert('Berhasil memesan, harap tunggu konfirmasi dari arsitek.', 'pengguna/index');
            }
        } else {
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }

    public function detail_pesanan($id_pesanan)
    {
        $data = $this->model('PesananModel')->pesanan_bypengguna($id_pesanan);
        $this->view('dasbor/pengguna/detail_pesanan', $data);
    }

    public function terima_pesanan($id_pesanan)
    {
        $pesanan = $this->model('PesananModel')->pesanan_bypengguna($id_pesanan);
        if ($pesanan != null) {
            if ($this->model('PesananModel')->cek_pesanan(1) == null) {
                $this->model('PesananModel')->update_status($id_pesanan, 1);

                $pesan = [
                    'id_user' => $pesanan['id_arsitek'],
                    'judul' => 'Tawaran Pesananan Diterima Pelanggan',
                    'keterangan' => 'Tawaran pesanan dengan Produk <a href="' . BASEURL . '/arsitek/detail_produk/' . $pesanan['id_produk'] . '">' . $pesanan['judul'] . '</a> diterima pelanggan. Cek menu pesanan sekarang dan lakukan aksi selanjutnya!',
                    'link' => '/arsitek/pesanan'
                ];
                $this->model('NotifikasiModel')->notifikasi($pesan);
                $this->route('pengguna/index');
            } else {
                $this->alert('Anda hanya bisa memiliki 1 pesanan yang bisa diproses.', 'pengguna/index');
            }
        } else {
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }

    public function tolak_pesanan($id_pesanan)
    {
        $pesanan = $this->model('PesananModel')->pesanan_bypengguna($id_pesanan);
        if ($pesanan != null) {
            $this->model('PesananModel')->update_status($id_pesanan, -2);

            $pesan = [
                'id_user' => $pesanan['id_arsitek'],
                'judul' => 'Tawaran Dibatalkan Pelanggan',
                'keterangan' => 'Tawaran pesanan dengan Produk <a href="' . BASEURL . '/arsitek/detail_produk/' . $pesanan['id_produk'] . '">' . $pesanan['judul'] . '</a> dibatalkan pelanggan.',
                'link' => 'arsitek/pesanan'
            ];
            $this->model('NotifikasiModel')->notifikasi($pesan);
            $this->route('pengguna/index');
        } else {
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }

    public function desain_pesanan($id_pesanan)
    {
        $data = [
            'desains' => $this->model('DesainModel')->semua($id_pesanan),
            'pesanan' => $this->model('PesananModel')->detail($id_pesanan)
        ];
        $this->view('dasbor/pengguna/desain_pesanan', $data);
    }

    public function revisi_desain($id_desain)
    {
        $this->model('DesainModel')->revisi($id_desain, $_POST['catatan_revisi']);
        $desain = $this->model('DesainModel')->desain($id_desain);
        $this->controller('pengguna')->desain_pesanan($desain['id_pesanan']);
    }

    public function selesaikan_pesanan($id_pesanan)
    {
        $data = $this->model('PesananModel')->update_status($id_pesanan, 2);
        $this->alert('Pesanan berhasil diselesaikan, harap lakukan pembayaran secepatnya.', 'pengguna/index');
    }

    public function pembayaran_dp($id_pesanan)
    {
        $data = $this->model('PesananModel')->pesanan_bypengguna($id_pesanan);
        if ($data != null) {
            $data['rekening'] = $this->model('RekeningBankModel')->semua();
            $this->view('dasbor/pengguna/pembayaran_dp', $data);
        } else {
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }
    public function kirim_pembayaran_dp($id_pesanan)
    {
        if (isset($_POST['kirim'])) {
            $cek_dp = $this->model('PembayaranModel')->cek_pembayaran($id_pesanan, -1);

            // Memasukkan BuktiPembayaran Baru
            $output_dir = dirname(getcwd()) . "/public/image/bukti-pembayaran/";
            $RandomNum  = time();

            // BuktiPembayaran
            $BuktiPembayaranName  = str_replace(' ', '-', strtolower($_FILES['bukti_pembayaran']['name'][0]));
            $BuktiPembayaranType  = $_FILES['bukti_pembayaran']['type'][0];

            // Nama BuktiPembayaran Baru
            $BuktiPembayaranExt   = substr($BuktiPembayaranName, strrpos($BuktiPembayaranName, '.'));
            $BuktiPembayaranExt   = str_replace('.', '', $BuktiPembayaranExt);
            $NewBuktiPembayaranName = rand(100, 999) . $RandomNum . '.' . $BuktiPembayaranExt;
            $ret[$NewBuktiPembayaranName] = $output_dir . $NewBuktiPembayaranName;

            if (!file_exists($output_dir)) {
                @mkdir($output_dir, 0777);
            }

            move_uploaded_file($_FILES["bukti_pembayaran"]["tmp_name"][0], $output_dir . $NewBuktiPembayaranName);
            $data['bukti_pembayaran'] = $NewBuktiPembayaranName;

            if ($cek_dp != null) {
                // Penghapusan Gambar
                $logo = $output_dir . $cek_dp['bukti_pembayaran'];
                if (file_exists($logo)) {
                    unlink($logo);
                }
                $data += [
                    'id_pembayaran' => $cek_dp['id_pembayaran'],
                    'status' => 0,
                ];
                $this->model('PembayaranModel')->update($data);
            } else {
                $data += [
                    'id_pesanan' => $id_pesanan,
                    'total_dibayar' => 2000000,
                    'pembayaran' => -1,
                    'status' => 0,
                ];
                $this->model('PembayaranModel')->tambah($data);
            }

            $this->alert('Pembayaran DP berhasil dilakukan.', 'pengguna/index');
            exit();
        } else {
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }
    public function pembayaran_pesanan($id_pesanan)
    {
        $data = $this->model('PesananModel')->pesanan_bypengguna($id_pesanan);
        if ($data != null) {
            $data['rekening'] = $this->model('RekeningBankModel')->semua();
            $data['pembayaran'] = $this->model('PembayaranModel')->cek_pembayaran($id_pesanan, 1);
            $this->view('dasbor/pengguna/pembayaran_pesanan', $data);
        } else {
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }
    public function kirim_pembayaran_pesanan($id_pesanan)
    {
        if (isset($_POST['kirim'])) {
            $cek_pembayaran = $this->model('PembayaranModel')->cek_pembayaran($id_pesanan, 1);

            // Memasukkan BuktiPembayaran Baru
            $output_dir = dirname(getcwd()) . "/public/image/bukti-pembayaran/";
            $RandomNum  = time();

            // BuktiPembayaran
            $BuktiPembayaranName  = str_replace(' ', '-', strtolower($_FILES['bukti_pembayaran']['name'][0]));
            $BuktiPembayaranType  = $_FILES['bukti_pembayaran']['type'][0];

            // Nama BuktiPembayaran Baru
            $BuktiPembayaranExt   = substr($BuktiPembayaranName, strrpos($BuktiPembayaranName, '.'));
            $BuktiPembayaranExt   = str_replace('.', '', $BuktiPembayaranExt);
            $NewBuktiPembayaranName = rand(100, 999) . $RandomNum . '.' . $BuktiPembayaranExt;
            $ret[$NewBuktiPembayaranName] = $output_dir . $NewBuktiPembayaranName;

            if (!file_exists($output_dir)) {
                @mkdir($output_dir, 0777);
            }

            move_uploaded_file($_FILES["bukti_pembayaran"]["tmp_name"][0], $output_dir . $NewBuktiPembayaranName);
            $data['bukti_pembayaran'] = $NewBuktiPembayaranName;

            if ($cek_pembayaran != null) {
                // Penghapusan Gambar
                $logo = $output_dir . $cek_pembayaran['bukti_pembayaran'];
                if (file_exists($logo)) {
                    unlink($logo);
                }

                $data += [
                    'id_pembayaran' => $cek_pembayaran['id_pembayaran'],
                    'status' => 0,
                ];
                $this->model('PembayaranModel')->update($data);
            } else {
                $data += [
                    'id_pesanan' => $id_pesanan,
                    'total_dibayar' => $this->model('PesananModel')->pesanan_bypengguna($id_pesanan)['tawaran_harga'] - 2000000,
                    'pembayaran' => 1,
                    'status' => 0,
                ];
                $this->model('PembayaranModel')->tambah($data);
                $this->add_rating($id_pesanan);
            }
            $this->alert('Pembayaran berhasil dilakukan.', 'pengguna/index');
            exit();
        } else {
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }
    private function add_rating($id_pesanan)
    {
        $produk = $this->model('PesananModel')->pesanan_bypengguna($id_pesanan);
        $data = [
            'id_produk' => $produk['id_produk'],
            'rating' => $_POST['rating'],
            'komen' => $_POST['komen'],
        ];
        $this->model('RatingModel')->tambah($data);
    }

    public function hapus_pesanan($id_pesanan)
    {
        $data = $this->model('PesananModel')->pesanan_bypengguna($id_pesanan);
        if ($data != null) {
            $this->model('PesananModel')->hapus($id_pesanan);
            $this->alert('Data pesanan berhasil dihapus.', 'pengguna/index');
        } else {
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }
}
