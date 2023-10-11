<?php

class admin extends Controller
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['email'])) {
            $this->route('auth/login');
        } else if ($_SESSION['level'] != 2) {
            $this->controller('alert')->message('Forbidden', '403 | Forbidden');
            exit();
        }
    }

    public function index()
    {
        $data['tahunan_semua_pembayaran'] = $this->model('PembayaranModel')->tahunan_semua_pembayaran()[0];
        $data['tahunan_semua_pesanan'] = $this->model('PesananModel')->tahunan_semua_pesanan()[0];

        if (array_sum($data['tahunan_semua_pembayaran']) == 0) {
            $data['tahunan_semua_pembayaran'] = [
                'Jan' => 0, 'Feb' => 0, 'Mar' => 0, 'Apr' => 0,
                'May' => 0, 'Jun' => 0, 'Jul' => 0, 'Aug' => 0,
                'Sep' => 0, 'Oct' => 0, 'Nov' => 0, 'Dec' => 0
            ];
        }
        if (array_sum($data['tahunan_semua_pesanan']) == 0) {
            $data['tahunan_semua_pesanan'] = [
                'Jan' => 0, 'Feb' => 0, 'Mar' => 0, 'Apr' => 0,
                'May' => 0, 'Jun' => 0, 'Jul' => 0, 'Aug' => 0,
                'Sep' => 0, 'Oct' => 0, 'Nov' => 0, 'Dec' => 0
            ];
        }

        $tahunan_semua_pembayaran_sementara = [];
        $tahunan_semua_pesanan_sementara = [];

        $start = $month = date('Y-m-d');
        $end = date('Y-m-d', strtotime('-12 month'));
        while ($month > $end) {
            $data['nama_bulan'][] = date('M', strtotime($month));
            $data['tahun'][] = date('Y', strtotime($month));
            foreach ($data['tahunan_semua_pembayaran'] as $tpem => $value) {
                if ($tpem == date('M', strtotime($month))) {
                    $tahunan_semua_pembayaran_sementara[] = $value;
                }
            }
            foreach ($data['tahunan_semua_pesanan'] as $tpes => $value) {
                if ($tpes == date('M', strtotime($month))) {
                    $tahunan_semua_pesanan_sementara[] = $value;
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
        // Chart
        $data['tahunan_semua_pembayaran'] = array_reverse($tahunan_semua_pembayaran_sementara);
        $data['tahunan_semua_pesanan'] = array_reverse($tahunan_semua_pesanan_sementara);
        // Top 3
        $data['top3_pembayaran'] = $this->model('PembayaranModel')->top3_total_pembayaran();
        $data['top3_pesanan'] = $this->model('PesananModel')->top3_total_pesanan();
        // Data
        $data['total_user'] = count($this->model('UserModel')->semua_user());
        $data['total_admin'] = count($this->model('UserModel')->semua_user(2));
        $data['total_pengguna'] = count($this->model('UserModel')->semua_user('0'));
        $data['total_arsitek'] = count($this->model('UserModel')->semua_user(1));
        $data['total_calon_arsitek'] = count($this->model('UserModel')->semua_user(-1));

        $start = $month = date('Y-m-d');
        $end = date('Y-m-d', strtotime('-12 month'));
        while ($month > $end) {
            $data['nama_bulan'][] = date('M', strtotime($month));
            $data['tahun'][] = date('Y', strtotime($month));
            $month = date('Y-m-d', strtotime('-1 months', strtotime($month)));
        }
        $this->view('dasbor/admin/index', $data);
    }

    public function calon_arsitek()
    {
        $data['calon_arsiteks'] = $this->model('UserModel')->semua_calon_arsitek();
        $this->view('dasbor/admin/calon-arsitek/index', $data);
    }
    public function detail_calon_arsitek($id_user)
    {
        $data['calon_arsitek'] = $this->model('UserModel')->profile_arsitek($id_user);
        $data['produk'] = $this->model('ProdukModel')->calon_arsitek_produk($id_user);
        $this->view('dasbor/admin/calon-arsitek/detail', $data);
    }
    public function terima_calon_arsitek($id_user)
    {
        $this->model('ProdukModel')->update_status_byadmin($id_user, 0);
        $this->model('UserModel')->update_level_byadmin($id_user, 1);

        // ==============[Notifikasi Diterima]===============
        $judul_notifikasi = 'Selamat Datang di ArtNow';
        $notifikasi = 'Selamat, datamu telah diverifikasi admin. Sekarang kamu bisa mengakses semua menu sebagai Arsitek. Jangan lupa buat Produkmu sekarang!';
        $pesan = [
            'id_user' => $id_user,
            'judul' => $judul_notifikasi,
            'keterangan' => $notifikasi,
            'link' => '/arsitek/produk'
        ];
        $this->model('NotifikasiModel')->notifikasi($pesan);

        $contentMail = '<h1>' . $judul_notifikasi . '</h1><p>' . $notifikasi . '</p>';
        $arsitek = $this->model('UserModel')->profile_arsitek($id_user);
        // $this->kirim_mail($arsitek['email'], $judul_notifikasi, $contentMail);

        $this->route('admin/calon_arsitek');
    }
    public function tolak_calon_arsitek($id_user)
    {
        $alasan = $_POST['alasan'];
        $judul_notifikasi = 'Formulir Registrasi Sebagai Arsitek Ditolak';
        $notifikasi = $_POST['notifikasi'];

        if ($alasan == 'deskripsi') {
            $this->kosongkan_data_arsitek($id_user);
        } else if ($alasan == 'produk') {
            $this->model('ProdukModel')->update_status_byadmin($id_user, -1);
        } else if ($alasan == 'semua') {
            $this->kosongkan_data_arsitek($id_user);
            $this->model('ProdukModel')->update_status_byadmin($id_user, -1);
        }

        // ==============[Notifikasi Penolakan]===============
        $pesan = [
            'id_user' => $id_user,
            'judul' => $judul_notifikasi,
            'keterangan' => $judul_notifikasi . ". " . $notifikasi,
            'link' => '/arsitek/index'
        ];
        $this->model('NotifikasiModel')->notifikasi($pesan);

        $contentMail = '<h1>' . $judul_notifikasi . '</h1><p>' . $notifikasi . '</p>';
        $calon_arsitek = $this->model('UserModel')->profile_arsitek($id_user);
        // $this->kirim_mail($calon_arsitek['email'], $judul_notifikasi, $contentMail);

        $this->route('admin/calon_arsitek');
    }

    public function kosongkan_data_arsitek($id_user)
    {
        $calon_arsitek = $this->model('UserModel')->profile_arsitek($id_user);

        $ktp = $calon_arsitek['ktp'];
        $ijazah = $calon_arsitek['ijazah'];
        $sertifikasi_arsitek = $calon_arsitek['sertifikasi_arsitek'];

        $this->model('UserModel')->hapus_arsitek($id_user);
        $path = dirname(getcwd()) . "/public/dokumen/";

        if (file_exists($path . $ktp)) {
            unlink($path . $ktp);
        }
        if (file_exists($path . $ijazah)) {
            unlink($path . $ijazah);
        }
        if (file_exists($path . $sertifikasi_arsitek)) {
            unlink($path . $sertifikasi_arsitek);
        }
    }

    public function kirim_mail($email, $subject, $content)
    {
        require '../public/PHPMailer/PHPMailerAutoload.php';

        $mail = new PHPMailer;

        // Konfigurasi SMTP
        // $mail->isSMTP();
        // $mail->Host = 'smtp-mail.outlook.com';
        // $mail->SMTPAuth = true;
        // $mail->Username = 'alazim.dev@outlook.com';
        // $mail->Password = 'Secret123';
        // $mail->SMTPSecure = 'tls';
        // $mail->Port = 587;
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '95e90a6e1ca640';
        $mail->Password = '88d97866952c07';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;


        $mail->setFrom('no-reply@artnow.com', 'ArtNow');
        $mail->addReplyTo('no-reply@artnow.com', 'ArtNow');

        // Menambahkan penerima
        $mail->addAddress($email);

        // Menambahkan cc atau bcc 
        $mail->addCC('cc@artnow.com');
        $mail->addBCC('bcc@artnow.com');

        // Subjek email
        $mail->Subject = $subject;

        // Mengatur format email ke HTML
        $mail->isHTML(true);

        // Konten/isi email
        $mail->Body = $content;

        // Kirim email
        if (!$mail->send()) {
        } else {
        }
    }

    // CRUD Data Admin
    public function data_admin()
    {
        $data = [
            'admins' => $this->model('UserModel')->semua_admin()
        ];
        $this->view('dasbor/admin/admin/index', $data);
    }
    public function tambah_admin()
    {
        $data = [
            'nama_lengkap'  => $_POST['nama_lengkap'],
            'email'         => $_POST['email'],
            'password'      => $_POST['password'],
            'telepon'       => $_POST['telepon'],
            'level'         => 2
        ];
        $this->model('UserModel')->register($data);
        $this->alert('Admin berhasil ditambahkan.', 'admin/data_admin');
    }
    public function nonaktifkan_user($id_user)
    {
        $this->model('UserModel')->update_status_byadmin($id_user, 0);
        $this->alert('User berhasil dinonaktifkan.', null);
        echo "<script>window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
    }
    public function aktifkan_user($id_user)
    {
        $this->model('UserModel')->update_status_byadmin($id_user, 1);
        $this->alert('User berhasil diaktifkan.', null);
        echo "<script>window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
    }
    public function edit_admin($id_user)
    {
        if ($this->model('UserModel')->cek_user($id_user, 2) != null) {
            $data = $this->model('UserModel')->cek_user($id_user, 2);
            $this->view('dasbor/admin/admin/edit', $data);
        } else {
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }

    public function update_admin($id_user)
    {
        if ($this->model('UserModel')->cek_user($id_user, 2) != null) {
            if (isset($_POST['update'])) {
                $data = [
                    'id_user'       => $id_user,
                    'nama_lengkap'  => $_POST['nama_lengkap'],
                    'email'         => $_POST['email'],
                    'telepon'       => $_POST['telepon']
                ];
                if ($_POST['password'] != null) {
                    $data['password'] = $_POST['password'];
                } else {
                    $data['password'] = null;
                }
                $this->model('UserModel')->update_user($data);
                $this->alert('Data user berhasil diubah.', 'admin/data_admin');
                exit();
            } else {
                $this->controller('alert')->message('Not Found', '404 | Not Found');
            }
        } else {
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }
    public function hapus_admin($id_user)
    {
        if ($this->model('UserModel')->cek_user($id_user, 2) != null) {
            $foto = dirname(getcwd()) . "/public/image/profile/" . $this->model('UserModel')->cek_user($id_user)['foto'];
            if (file_exists($foto)) {
                unlink($foto);
            }
            $this->model('UserModel')->hapus_user($id_user);
            $this->alert('Admin berhasil dihapus.', 'admin/data_admin');
        } else {
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }

    // CRUD Arsitek dan Pengguna
    public function data_arsitek()
    {
        $data = [
            'arsiteks' => $this->model('UserModel')->semua_arsitek()
        ];
        $this->view('dasbor/admin/arsitek/index', $data);
    }
    public function kosongkan_rekening_arsitek($id_user)
    {
        $data = [
            'id_user' => $id_user
        ];
        $this->model('ArsitekModel')->kosongkan_rekening($data);
        $this->alert('Informasi Rekening berhasil dikosongkan', 'admin/data_arsitek');
        exit();
    }
    public function data_pengguna()
    {
        $data = [
            'penggunas' => $this->model('UserModel')->semua_pengguna()
        ];
        $this->view('dasbor/admin/pengguna/index', $data);
    }

    // Validasi Pembayaran Pengguna
    public function validasi_pembayaran_pengguna()
    {
        $data = [
            'pembayarans' => $this->model('PembayaranModel')->semua_byadmin(0)
        ];
        $this->view('dasbor/admin/validasi-pembayaran-pengguna/index', $data);
    }

    public function riwayat_pembayaran_pengguna($id_pesanan)
    {
        $data = $this->model('PembayaranModel')->riwayat_pembayaran_byadmin($id_pesanan);
        $data = [
            'pembayarans' => $data
        ];
        $this->view('dasbor/admin/validasi-pembayaran-pengguna/riwayat', $data);
    }

    public function detail_pembayaran_pengguna($id_pembayaran)
    {
        $data = $this->model('PembayaranModel')->pembayaran_byadmin($id_pembayaran);
        if ($data != null) {
            $this->view('dasbor/admin/validasi-pembayaran-pengguna/detail', $data);
        } else {
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }

    public function terima_pembayaran_pengguna($id_pembayaran)
    {
        $data = $this->model('PembayaranModel')->pembayaran_byadmin($id_pembayaran);
        if ($data != null) {
            $this->model('PembayaranModel')->update_status($id_pembayaran, 1);
            if ($data['pembayaran'] == 1) {
                // ==============[Aksi yang dikomentari akan menjadi milik Admin]===============
                $pesan = [
                    'id_user' => $data['id_arsitek'],
                    'judul' => 'Pembayaran Berhasil',
                    'keterangan' => 'Selamat! Pelanggan baru saja membayar pesanannya. Cek <a href="' . BASEURL . '/arsitek/saldo">saldo</a> sekarang!',
                    'link' => '/arsitek/saldo'
                ];
                $this->model('NotifikasiModel')->notifikasi($pesan);
                $this->model('PesananModel')->update_status($data['id_pesanan'], 3);
            }

            // Penambahan Saldo Arsitek
            $saldo = [
                'id_user' => $data['id_arsitek'],
                'nominal' => $data['total_dibayar'],
                'keterangan' => 'Bayaran dari produk ' . $data['judul_produk'] . ' oleh ' . $data['nama_lengkap_pengguna'],
                'bukti' => NULL
            ];
            $this->model('SaldoModel')->tambah($saldo);

            $this->alert('Pembayaran berhasil diterima dan divalidasi.', 'admin/validasi_pembayaran_pengguna');
        } else {
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }

    public function tolak_pembayaran_pengguna($id_pembayaran)
    {
        $pembayaran = $this->model('PembayaranModel')->pembayaran_byadmin($id_pembayaran);
        if ($pembayaran != null) {
            $this->model('PembayaranModel')->update_status($id_pembayaran, -1);

            $judul_notifikasi = 'Pembayaran Ditolak';
            $notifikasi = $_POST['notifikasi'];
            // ==============[Notifikasi Penolakan]===============
            $pesan = [
                'id_user' => $pembayaran['id_pengguna'],
                'judul' => $judul_notifikasi,
                'keterangan' => $judul_notifikasi . ". " . $notifikasi,
                'link' => '/pengguna/index'
            ];
            $this->model('NotifikasiModel')->notifikasi($pesan);
            $this->alert('Pembayaran ditolak.', 'admin/validasi_pembayaran_pengguna');
        } else {
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }

    // Permintaan Penarikan
    public function permintaan_penarikan()
    {
        $data = [
            'permintaan_penarikan' => $this->model('PermintaanPenarikanModel')->semua()
        ];
        $this->view('dasbor/admin/permintaan-penarikan/index', $data);
    }

    public function detail_permintaan_penarikan($id_permintaan_penarikan)
    {
        $data = $this->model('PermintaanPenarikanModel')->detail($id_permintaan_penarikan);
        if ($data != null) {
            $this->view('dasbor/admin/permintaan-penarikan/detail', $data);
        } else {
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }

    public function tandai_permintaan_selesai($id_permintaan_penarikan)
    {
        $pp = $this->model('PermintaanPenarikanModel')->detail($id_permintaan_penarikan);
        if ($pp != null) {
            $output_dir = dirname(getcwd()) . "/public/dokumen/bukti/";
            $RandomNum  = time();
            $DokumenName  = str_replace(' ', '-', strtolower($_FILES['bukti']['name'][0]));
            $DokumenType  = $_FILES['bukti']['type'][0];

            $DokumenExt   = substr($DokumenName, strrpos($DokumenName, '.'));
            $DokumenExt   = str_replace('.', '', $DokumenExt);
            $DokumenName  = preg_replace("/\.[^.\s]{3,4}$/", "", $DokumenName);
            $NewDokumenName = $DokumenName . '-' . $RandomNum . '.' . $DokumenExt;
            $ret[$NewDokumenName] = $output_dir . $NewDokumenName;

            if (!file_exists($output_dir)) {
                @mkdir($output_dir, 0777);
            }

            move_uploaded_file($_FILES["bukti"]["tmp_name"][0], $output_dir . $NewDokumenName);

            // Logika Penarikan uang
            $pajak = (ceil(($pp['saldo'] * 0.025) / 100) * 100);
            $saldo = [
                'id_user' => $pp['id_user'],
                'nominal' => ($pp['saldo'] - $pajak) * -1,
                'keterangan' => 'Penarikan saldo',
                'bukti'    => $NewDokumenName
            ];
            $this->model('SaldoModel')->tambah($saldo);

            $saldo = [
                'id_user' => $pp['id_user'],
                'nominal' => $pajak * -1,
                'keterangan' => 'Biaya admin penarikan saldo',
                'bukti'    => NULL
            ];
            $this->model('SaldoModel')->tambah($saldo);

            $this->model('PermintaanPenarikanModel')->update_status($id_permintaan_penarikan, 1);

            $this->alert('Permintaan penarikan telah diselesaikan', 'admin/permintaan_penarikan');
        } else {
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }

    // Semua Pesanan Arsitek
    public function pesanan_arsitek()
    {
        $this->view('dasbor/admin/pesanan-arsitek/index');
    }
    public function data_pesanan_arsitek($tanggal_awal, $tanggal_akhir)
    {
        $json = [
            'data' => $this->model('PesananModel')->semua_byadmin($tanggal_awal, $tanggal_akhir)
        ];
        echo json_encode($json);
    }

    // CRUD Data Rekening Bank
    public function rekening_bank()
    {
        $data = [
            'rekenings' => $this->model('RekeningBankModel')->semua()
        ];
        $this->view('dasbor/admin/rekening-bank/index', $data);
    }
    public function tambah_rekening_bank()
    {
        // Memasukkan Logo Baru
        $output_dir = dirname(getcwd()) . "/public/image/logo-rekening/";
        $RandomNum  = time();

        // Logo
        $LogoName  = str_replace(' ', '-', strtolower($_FILES['logo']['name'][0]));
        $LogoType  = $_FILES['logo']['type'][0];

        // Nama Logo Baru
        $LogoExt   = substr($LogoName, strrpos($LogoName, '.'));
        $LogoExt   = str_replace('.', '', $LogoExt);
        $NewLogoName = rand(100, 999) . $RandomNum . '.' . $LogoExt;
        $ret[$NewLogoName] = $output_dir . $NewLogoName;

        if (!file_exists($output_dir)) {
            @mkdir($output_dir, 0777);
        }

        move_uploaded_file($_FILES["logo"]["tmp_name"][0], $output_dir . $NewLogoName);

        $data = [
            'logo'      => $NewLogoName,
            'nama'      => $_POST['nama'],
            'nomor'     => $_POST['nomor'],
            'pemegang'  => $_POST['pemegang'],
        ];
        $this->model('RekeningBankModel')->tambah($data);
        $this->alert('Rekening berhasil ditambahkan.', 'admin/rekening_bank');
    }
    public function edit_rekening_bank($id_user)
    {
        if ($this->model('RekeningBankModel')->rekening($id_user) != null) {
            $data = $this->model('RekeningBankModel')->rekening($id_user);
            $this->view('dasbor/admin/rekening-bank/edit', $data);
        } else {
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }

    public function update_rekening_bank($id_rekening)
    {
        if ($this->model('RekeningBankModel')->rekening($id_rekening) != null) {
            if (isset($_POST['update'])) {
                if ($_FILES['logo']["name"][0]) {
                    // Memasukkan Logo Baru
                    $output_dir = dirname(getcwd()) . "/public/image/logo-rekening/";
                    $RandomNum  = time();

                    // Logo
                    $LogoName  = str_replace(' ', '-', strtolower($_FILES['logo']['name'][0]));
                    $LogoType  = $_FILES['logo']['type'][0];

                    // Nama Logo Baru
                    $LogoExt   = substr($LogoName, strrpos($LogoName, '.'));
                    $LogoExt   = str_replace('.', '', $LogoExt);
                    $NewLogoName = rand(100, 999) . $RandomNum . '.' . $LogoExt;
                    $ret[$NewLogoName] = $output_dir . $NewLogoName;

                    if (!file_exists($output_dir)) {
                        @mkdir($output_dir, 0777);
                    }

                    move_uploaded_file($_FILES["logo"]["tmp_name"][0], $output_dir . $NewLogoName);

                    $data['logo'] = $NewLogoName;

                    // Penghapusan Gambar
                    $logo = $output_dir . $this->model('RekeningBankModel')->rekening($id_rekening)['logo'];
                    if (file_exists($logo)) {
                        unlink($logo);
                    }
                } else {
                    $data['logo'] = $this->model('RekeningBankModel')->rekening($id_rekening)['logo'];
                }

                $data += [
                    'id_rekening' => $id_rekening,
                    'nama'      => $_POST['nama'],
                    'nomor'     => $_POST['nomor'],
                    'pemegang'  => $_POST['pemegang']
                ];
                $this->model('RekeningBankModel')->update($data);
                $this->alert('Data user berhasil diubah.', 'admin/rekening_bank');
                exit();
            } else {
                $this->controller('alert')->message('Not Found', '404 | Not Found');
            }
        } else {
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }


    public function hapus_rekening_bank($id_rekening)
    {
        if ($this->model('RekeningBankModel')->rekening($id_rekening) != null) {
            $data = $this->model('RekeningBankModel')->rekening($id_rekening);
            try {
                $logo = $this->model('RekeningBankModel')->rekening($id_rekening)['logo'];
                $this->model('RekeningBankModel')->hapus($id_rekening);
                $path = dirname(getcwd()) . "/public/image/logo-rekening/" . $logo;

                if (file_exists($path)) {
                    unlink($path);
                }
                $this->alert('Data rekening bank berhasil dihapus.', 'admin/rekening_bank');
            } catch (\Throwable $th) {
                $this->alert('505 | Internal Server Error', 'admin/rekening_bank');
            }
        } else {
            $this->controller('alert')->message('Not Found', '404 | Not Found');
        }
    }

    // Laporan
    public function laporan_user()
    {
        $this->view('dasbor/admin/laporan/user');
    }
    public function data_laporan_user($tanggal_awal, $tanggal_akhir, $status, $level)
    {
        $json = [
            'data' => $this->model('UserModel')->semua_tanpa_owner($tanggal_awal, $tanggal_akhir, $status, $level)
        ];
        echo json_encode($json);
    }
    public function export_user()
    {
        $rentang_tanggal = $_POST['rentang_tanggal'];
        $status = $_POST['status'];
        $level = $_POST['level'];

        $rentang = explode(' - ', $rentang_tanggal);
        $tanggal_awal = substr($rentang[0], 6, 10) . "-" . substr($rentang[0], 3, 2) . "-" . substr($rentang[0], 0, 2);
        $tanggal_akhir = substr($rentang[1], 6, 10) . "-" . substr($rentang[1], 3, 2) . "-" . substr($rentang[1], 0, 2);

        $data['rentang_tanggal'] = $rentang_tanggal;
        $data['status'] = 'Semua Status';
        $data['level'] = 'Semua Level';
        if ($status != '') {
            if ($status == 1) {
                $data['status'] = 'Aktif';
            } else if ($status == 0) {
                $data['status'] = 'Nonaktif';
            }
        }
        if ($level != '') {
            if ($level == -1) {
                $data['level'] = 'Calon Arsitek';
            } else if ($level == 0) {
                $data['level'] = 'Pelanggan';
            } else if ($level == 1) {
                $data['level'] = 'Arsitek';
            } else if ($level == 2) {
                $data['level'] = 'Admin';
            }
        }
        $data += [
            'users' => $this->model('UserModel')->semua_tanpa_owner($tanggal_awal, $tanggal_akhir, $status, $level)
        ];
        $this->view('dasbor/admin/laporan/export_user', $data);
    }
    public function laporan_produk()
    {
        $this->view('dasbor/admin/laporan/produk');
    }
    public function data_laporan_produk($tanggal_awal, $tanggal_akhir)
    {
        $json = [
            'data' => $this->model('ProdukModel')->semua_byadmin($tanggal_awal, $tanggal_akhir)
        ];
        echo json_encode($json);
    }
    public function export_produk()
    {
        $rentang_tanggal = $_POST['rentang_tanggal'];
        $rentang = explode(' - ', $rentang_tanggal);
        $tanggal_awal = substr($rentang[0], 6, 10) . "-" . substr($rentang[0], 3, 2) . "-" . substr($rentang[0], 0, 2);
        $tanggal_akhir = substr($rentang[1], 6, 10) . "-" . substr($rentang[1], 3, 2) . "-" . substr($rentang[1], 0, 2);

        $data['rentang_tanggal'] = $rentang_tanggal;
        $data += [
            'produks' => $this->model('ProdukModel')->semua_byadmin($tanggal_awal, $tanggal_akhir)
        ];
        $this->view('dasbor/admin/laporan/export_produk', $data);
    }
    public function laporan_transaksi()
    {
        $this->view('dasbor/admin/laporan/transaksi');
    }
    public function data_laporan_transaksi($tanggal_awal, $tanggal_akhir)
    {
        $json = [
            'data' => $this->model('PembayaranModel')->laporan(1, $tanggal_awal, $tanggal_akhir)
        ];
        echo json_encode($json);
    }
    public function export_transaksi()
    {
        $rentang_tanggal = $_POST['rentang_tanggal'];
        $rentang = explode(' - ', $rentang_tanggal);
        $tanggal_awal = substr($rentang[0], 6, 10) . "-" . substr($rentang[0], 3, 2) . "-" . substr($rentang[0], 0, 2);
        $tanggal_akhir = substr($rentang[1], 6, 10) . "-" . substr($rentang[1], 3, 2) . "-" . substr($rentang[1], 0, 2);

        $data['rentang_tanggal'] = $rentang_tanggal;
        $data += [
            'transaksis' => $this->model('PembayaranModel')->detail_laporan(1, $tanggal_awal, $tanggal_akhir)
        ];
        $this->view('dasbor/admin/laporan/export_transaksi', $data);
    }
    public function laporan_keuangan()
    {
        $this->view('dasbor/admin/laporan/keuangan');
    }
    public function data_laporan_keuangan($tanggal_awal, $tanggal_akhir)
    {
        $json = [
            'data' => $this->model('SaldoModel')->laporan_keuangan($tanggal_awal, $tanggal_akhir)
        ];
        echo json_encode($json);
    }
    public function export_keuangan()
    {
        $rentang_tanggal = $_POST['rentang_tanggal'];
        $rentang = explode(' - ', $rentang_tanggal);
        $tanggal_awal = substr($rentang[0], 6, 10) . "-" . substr($rentang[0], 3, 2) . "-" . substr($rentang[0], 0, 2);
        $tanggal_akhir = substr($rentang[1], 6, 10) . "-" . substr($rentang[1], 3, 2) . "-" . substr($rentang[1], 0, 2);

        $data['rentang_tanggal'] = $rentang_tanggal;
        $data += [
            'keuangans' => $this->model('SaldoModel')->laporan_keuangan($tanggal_awal, $tanggal_akhir)
        ];
        $this->view('dasbor/admin/laporan/export_keuangan', $data);
    }
    public function laporan_saldo()
    {
        $data = [
            'saldos' => $this->model('SaldoModel')->laporan()
        ];
        $this->view('dasbor/admin/laporan/saldo', $data);
    }
    public function export_saldo()
    {
        $biaya_admin = 0;
        $saldos = $this->model('SaldoModel')->laporan();
        foreach ($saldos as $saldo) {
            $biaya_admin += $saldo['biaya_admin'];
        }
        $data = [
            'biaya_admin' => $biaya_admin,
            'saldos' => $saldos
        ];
        $this->view('dasbor/admin/laporan/export_saldo', $data);
    }
}
