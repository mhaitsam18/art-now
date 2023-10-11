<?php

class arsitek extends Controller
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['email'])) {
            $this->route('auth/login');
        } else if (!($_SESSION['level'] == -1 || $_SESSION['level'] == 1)) {
            $this->controller('alert')->message('Forbidden', '403 | Forbidden');
            exit();
        }

        $this->cek_deskripsi();
    }

    public function cek_deskripsi()
    {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if ($this->model('UserModel')->cek_deskripsi()['deskripsi'] == null && $actual_link != BASEURL . '/arsitek/deskripsi') {
            $this->route('arsitek/deskripsi');
        } else if ($this->model('UserModel')->cek_deskripsi()['deskripsi'] != null && $actual_link == BASEURL . '/arsitek/deskripsi') {
            $this->route('arsitek/verifikasi');
        } else if ($actual_link != BASEURL . '/arsitek/deskripsi') {
            if ($this->model('ArsitekModel')->cek_user()['level'] == -1 && $actual_link != BASEURL . '/arsitek/verifikasi') {
                $this->route('arsitek/verifikasi');
            } else if ($this->model('ArsitekModel')->cek_user()['level'] != -1 && $actual_link == BASEURL . '/arsitek/verifikasi') {
                $this->route('arsitek/index');
            }
        }
    }

    public function deskripsi()
    {
        if (isset($_POST['deskripsi']) && isset($_POST['alamat'])) {
            // Memasukkan Dokumen Baru
            $output_dir = dirname(getcwd()) . "/public/dokumen/";
            $RandomNum  = time();

            // KTP, Ijazah, Sertifikasi Arsitek
            $KtpName  = str_replace(' ', '-', strtolower($_FILES['ktp']['name'][0]));
            $KtpType  = $_FILES['ktp']['type'][0];
            $IjazahName  = str_replace(' ', '-', strtolower($_FILES['ijazah']['name'][0]));
            $IjazahType  = $_FILES['ijazah']['type'][0];
            $SertifikasiArsitekName  = str_replace(' ', '-', strtolower($_FILES['sertifikasi_arsitek']['name'][0]));
            $SertifikasiArsitekType  = $_FILES['sertifikasi_arsitek']['type'][0];

            // KTP
            $KtpExt   = substr($KtpName, strrpos($KtpName, '.'));
            $KtpExt   = str_replace('.', '', $KtpExt);
            $NewKtpName = rand(100, 999) . $RandomNum . '.' . $KtpExt;
            $ret[$NewKtpName] = $output_dir . $NewKtpName;
            //Ijazah
            $IjazahExt   = substr($IjazahName, strrpos($IjazahName, '.'));
            $IjazahExt   = str_replace('.', '', $IjazahExt);
            $NewIjazahName = rand(100, 999) . $RandomNum . '.' . $IjazahExt;
            $ret[$NewIjazahName] = $output_dir . $NewIjazahName;
            //Arsitek
            $SertifikasiArsitekExt   = substr($SertifikasiArsitekName, strrpos($SertifikasiArsitekName, '.'));
            $SertifikasiArsitekExt   = str_replace('.', '', $SertifikasiArsitekExt);
            $NewSertifikasiArsitekName = rand(100, 999) . $RandomNum . '.' . $SertifikasiArsitekExt;
            $ret[$NewSertifikasiArsitekName] = $output_dir . $NewSertifikasiArsitekName;

            if (!file_exists($output_dir)) {
                @mkdir($output_dir, 0777);
            }

            move_uploaded_file($_FILES["ktp"]["tmp_name"][0], $output_dir . $NewKtpName);
            move_uploaded_file($_FILES["ijazah"]["tmp_name"][0], $output_dir . $NewIjazahName);
            move_uploaded_file($_FILES["sertifikasi_arsitek"]["tmp_name"][0], $output_dir . $NewSertifikasiArsitekName);

            $data = [
                'deskripsi' => $_POST['deskripsi'],
                'alamat'    => $_POST['alamat'],
                'ktp'       => $NewKtpName,
                'ijazah'    => $NewIjazahName,
                'sertifikasi_arsitek'   => $NewSertifikasiArsitekName
            ];
            $this->model('ArsitekModel')->tambah($data);
            $this->route('arsitek/deskripsi');
        }
        $this->view('dasbor/arsitek/deskripsi');
    }

    public function verifikasi()
    {
        if (isset($_POST['verifikasi'])) {
            // Gambar
            $output_dir = dirname(getcwd()) . "/public/image/produk/";
            $RandomNum  = time();
            $ImageName  = str_replace(' ', '-', strtolower($_FILES['gambar']['name'][0]));
            $ImageType  = $_FILES['gambar']['type'][0];

            $ImageExt   = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt   = str_replace('.', '', $ImageExt);
            $ImageName  = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName = $ImageName . '-' . $RandomNum . '.' . $ImageExt;
            $ret[$NewImageName] = $output_dir . $NewImageName;

            if (!file_exists($output_dir)) {
                @mkdir($output_dir, 0777);
            }

            move_uploaded_file($_FILES["gambar"]["tmp_name"][0], $output_dir . $NewImageName);

            //Dokumen
            $output_dir = dirname(getcwd()) . "/public/dokumen/produk/";
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
                'judul'     => $_POST['judul'],
                'gambar'    => $NewImageName,
                'harga'     => $_POST['harga'],
                'dokumen'   => $NewDokumenName,
                'tautan_video' => $_POST['tautan_video'],
                'kategori'  => $_POST['kategori'],
                'deskripsi' => $_POST['deskripsi'],
                'status'    => 0,
            ];
            $this->model('ProdukModel')->tambah($data);
            $this->route('arsitek/verifikasi');
            exit();
        }

        $data['status'] = 'belum';
        if (count($this->model('ProdukModel')->cek_produk(0)) > 0) {
            $data['status'] = 'diproses';
        } else if (count($this->model('ProdukModel')->cek_produk(-1)) > 0) {
            $data['status'] = 'ditolak';
        }
        $this->view('dasbor/arsitek/verifikasi', $data);
    }

    public function update_rekening()
    {
        if (isset($_POST['bank'])) {
            $data = [
                'bank'          => $_POST['bank'],
                'nomor_rekening' => $_POST['nomor_rekening']
            ];
            $this->model('ArsitekModel')->update_rekening($data);
            $this->alert('Informasi rekening berhasil ditambahkan', 'user/profile');
            exit();
        }
    }

    // Saldo
    public function saldo()
    {
        $user = $this->model('UserModel')->profile();
        if ($user['nomor_rekening'] == NULL) {
            $this->alert('Tambahkan informasi rekening sebelum memasuki menu ini', 'user/profile');
            exit();
        }
        $data = [
            'user' => $user,
            'saldo' => $this->model('SaldoModel')->saldo(),
            'permintaan_penarikan' => $this->model('PermintaanPenarikanModel')->permintaan_penarikan()
        ];
        $this->view('dasbor/saldo', $data);
    }
    public function tarik_saldo()
    {
        $user = $this->model('UserModel')->profile();
        $pp = $this->model('PermintaanPenarikanModel')->permintaan_penarikan();
        if ($pp == NULL) {
            $this->model('PermintaanPenarikanModel')->tarik_saldo();

            $this->alert('Permintaan akan segera diproses, paling lama 7 hari kerja.', 'arsitek/saldo');
        } else {
            $this->alert('Sebelumnya Anda sudah melakukan permintaan penarikan saldo', 'arsitek/saldo');
        }
    }

    // CRUD Produk
    public function index()
    {
        $total_pembayaran = $this->model('PembayaranModel')->total_pembayaran();
        $data['total_pembayaran'] = 0;
        foreach ($total_pembayaran as $pembayaran) {
            $data['total_pembayaran'] = $data['total_pembayaran'] + $pembayaran['total_dibayar'];
        }
        $data['tahunan_pembayaran'] = $this->model('PembayaranModel')->tahunan_pembayaran()[0];
        $data['total_pesanan'] = count($this->model('PesananModel')->total_pesanan());
        $data['tahunan_pesanan'] = $this->model('PesananModel')->tahunan_pesanan()[0];

        if (array_sum($data['tahunan_pembayaran']) == 0) {
            $data['tahunan_pembayaran'] = [
                'Jan' => 0, 'Feb' => 0, 'Mar' => 0, 'Apr' => 0,
                'May' => 0, 'Jun' => 0, 'Jul' => 0, 'Aug' => 0,
                'Sep' => 0, 'Oct' => 0, 'Nov' => 0, 'Dec' => 0
            ];
        }
        if (array_sum($data['tahunan_pesanan']) == 0) {
            $data['tahunan_pesanan'] = [
                'Jan' => 0, 'Feb' => 0, 'Mar' => 0, 'Apr' => 0,
                'May' => 0, 'Jun' => 0, 'Jul' => 0, 'Aug' => 0,
                'Sep' => 0, 'Oct' => 0, 'Nov' => 0, 'Dec' => 0
            ];
        }

        $tahunan_pembayaran_sementara = [];
        $tahunan_pesanan_sementara = [];

        $start = $month = date('Y-m-d');
        $end = date('Y-m-d', strtotime('-12 month'));
        while ($month > $end) {
            $data['nama_bulan'][] = date('M', strtotime($month));
            $data['tahun'][] = date('Y', strtotime($month));
            foreach ($data['tahunan_pembayaran'] as $tpem => $value) {
                if ($tpem == date('M', strtotime($month))) {
                    $tahunan_pembayaran_sementara[] = $value;
                }
            }
            foreach ($data['tahunan_pesanan'] as $tpes => $value) {
                if ($tpes == date('M', strtotime($month))) {
                    $tahunan_pesanan_sementara[] = $value;
                }
            }
            $month = date('Y-m-d', strtotime('-1 months', strtotime($month)));
        }
        for ($i = 0; $i < count($data['nama_bulan']); $i++) {
            if ($data['nama_bulan'][$i] == 'May') {
                $data['nama_bulan'][$i] = 'Mei';
            } else if ($data['nama_bulan'][$i] == 'Aug') {
                $data['nama_bulan'][$i] = 'Agu';
            } else if ($data['nama_bulan'][$i] == 'Oct') {
                $data['nama_bulan'][$i] = 'Okt';
            } else if ($data['nama_bulan'][$i] == 'Dec') {
                $data['nama_bulan'][$i] = 'Des';
            }
        }
        $data['tahunan_pembayaran'] = array_reverse($tahunan_pembayaran_sementara);
        $data['tahunan_pesanan'] = array_reverse($tahunan_pesanan_sementara);
        $this->view('dasbor/arsitek/index', $data);
    }

    public function produk()
    {
        $this->controller('produk')->index();
    }

    public function tambah_produk()
    {
        $this->controller('produk')->tambah();
    }

    public function detail_produk($id_produk)
    {
        $this->controller('produk')->detail($id_produk);
    }

    public function edit_produk($id_produk)
    {
        $this->controller('produk')->edit($id_produk);
    }

    public function update_produk($id_produk)
    {
        $this->controller('produk')->update($id_produk);
    }

    public function nonaktifkan_produk($id_produk)
    {
        $this->controller('produk')->nonaktifkan($id_produk);
    }

    public function aktifkan_produk($id_produk)
    {
        $this->controller('produk')->aktifkan($id_produk);
    }

    public function hapus_produk($id_produk)
    {
        $this->controller('produk')->hapus($id_produk);
    }

    public function rating_produk($id_produk)
    {
        $this->controller('produk')->rating($id_produk);
    }

    // CRUD Pesanan
    public function pesanan()
    {
        $this->controller('pesanan')->index();
    }

    public function detail_pesanan($id_pesanan)
    {
        $this->controller('pesanan')->detail($id_pesanan);
    }

    public function laporan_pesanan()
    {
        $this->controller('pesanan')->laporan();
    }

    public function terima_pesanan($id_pesanan)
    {
        $this->controller('pesanan')->terima($id_pesanan, $_POST['tawaran_harga'], $_POST['jadwal_survei']);
    }

    public function tolak_pesanan($id_pesanan)
    {
        $this->controller('pesanan')->tolak($id_pesanan);
    }

    public function desain_pesanan($id_pesanan)
    {
        $this->controller('desain')->index_desain($id_pesanan);
    }
    public function create_desain($id_pesanan)
    {
        $this->controller('desain')->create_desain($id_pesanan);
    }

    public function konfirmasi_revisi($id_desain, $konfirmasi)
    {
        $this->model('DesainModel')->konfirmasi_revisi($id_desain, $konfirmasi);

        $desain = $this->model('DesainModel')->desain($id_desain);
        $this->model('PesananModel')->update_status($desain['id_pesanan'], 4);
        $hari_ini = date('Y-m-d');
        $deadline = date('Y-m-d', strtotime('+14 days', strtotime($hari_ini)));
        $this->model('PesananModel')->update_deadline($desain['id_pesanan'], $deadline);
        $this->controller('arsitek')->desain_pesanan($desain['id_pesanan']);
    }

    public function tambah_desain()
    {
        $this->controller('desain')->tambah_desain();
    }

    public function hapus_desain($id_pesanan, $id_desain)
    {
        $this->controller('desain')->hapus_desain($id_pesanan, $id_desain);
    }
}
