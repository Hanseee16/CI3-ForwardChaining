<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct(); // Memanggil constructor dari CI_Controller

        // CEK LOGIN
        if (!$this->session->userdata('id_user')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login'); // Redirect ke halaman login jika belum login
        }

        // FORMAT TANGGAL
        function tanggalIndonesia($tanggal)
        {
            $bulan = [
                1 => 'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ];
            $pecahkan = explode('-', date('Y-m-d', strtotime($tanggal)));

            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }
    }


    // DASHBOARD
    public function index() // Fungsi index() yang akan dipanggil saat halaman dashboard diakses
    {
        $data = [ // Membuat array $data untuk dikirim ke tampilan (view)
            'title'         => 'Dashboard', // Menyimpan judul halaman
            'penyakit'      => $this->Model_admin->getTotalPenyakit(), // Mengambil total data penyakit dari model
            'gejala'        => $this->Model_admin->getTotalGejala(), // Mengambil total data gejala dari model
            'konsultasi'    => $this->Model_admin->getTotalKonsultasi(), // Mengambil total data konsultasi dari model
            'user'          => $this->Model_admin->getTotalUser(), // Mengambil total data pengguna dari model
        ];

        $this->load->view('templates/admin/header', $data); // Memuat tampilan header dan mengirimkan data ke dalamnya
        $this->load->view('templates/admin/sidebar'); // Memuat tampilan sidebar yang berisi menu navigasi admin
        $this->load->view('admin/dashboard'); // Memuat tampilan utama halaman dashboard
        $this->load->view('templates/admin/footer'); // Memuat tampilan footer untuk menutup halaman
    }


    // GEJALA
    public function gejala() // Fungsi untuk menampilkan halaman data gejala
    {
        $lastKode = $this->Model_admin->getKodeGejalaTerakhir(); // Mengambil kode gejala terakhir dari database
        $newKode = 'G' . str_pad(($lastKode ? (int) substr($lastKode, 1) + 1 : 1), 3, '0', STR_PAD_LEFT);
        // Membuat kode gejala baru dengan format 'GXXX' (contoh: G001, G002)
        // Jika ada kode terakhir, ambil angka di belakang 'G', tambahkan 1, dan format menjadi 3 digit

        $data = [ // Data yang akan dikirim ke tampilan
            'title'     => 'Gejala', // Judul halaman
            'gejala'    => $this->Model_admin->getAllGejala(), // Mengambil semua data gejala dari database
            'newKode'   => $newKode, // Mengirim kode gejala baru ke tampilan
        ];

        $this->load->view('templates/admin/header', $data); // Memuat header dan mengirimkan data
        $this->load->view('templates/admin/sidebar'); // Memuat sidebar navigasi
        $this->load->view('admin/gejala'); // Memuat halaman utama gejala
        $this->load->view('templates/admin/footer'); // Memuat footer halaman
    }

    public function tambah_gejala() // Fungsi untuk menambah data gejala
    {
        $data = [ // Menyiapkan data yang akan disimpan
            'kode_gejala'   => $this->input->post('kode_gejala'), // Mengambil input kode gejala dari form
            'nama_gejala'   => $this->input->post('nama_gejala'), // Mengambil input nama gejala dari form
        ];

        $this->Model_admin->tambahGejala($data); // Memanggil model untuk menyimpan data ke database
        $this->session->set_flashdata( // Menyimpan pesan sukses dalam session
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
             Data berhasil disimpan.
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>'
        );

        redirect('admin/gejala'); // Mengarahkan kembali ke halaman daftar gejala
    }

    public function edit_gejala($kode_gejala) // Fungsi untuk mengedit data gejala
    {
        $data = [ // Data yang akan diperbarui
            'kode_gejala'   => $this->input->post('kode_gejala'), // Mengambil input kode gejala dari form
            'nama_gejala'   => $this->input->post('nama_gejala'), // Mengambil input nama gejala dari form
        ];

        $this->Model_admin->editGejala($kode_gejala, $data); // Memanggil model untuk memperbarui data di database
        $this->session->set_flashdata( // Menyimpan pesan sukses dalam session
            'pesan',
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
             Data berhasil diperbarui.
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>'
        );
        redirect('admin/gejala'); // Mengarahkan kembali ke halaman daftar gejala
    }

    public function hapus_gejala($kode_gejala) // Fungsi untuk menghapus data gejala
    {
        $this->Model_admin->hapusGejala($kode_gejala); // Memanggil model untuk menghapus data berdasarkan kode gejala
        $this->session->set_flashdata( // Menyimpan pesan sukses dalam session
            'pesan',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
             Data berhasil dihapus.
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>'
        );

        redirect('admin/gejala'); // Mengarahkan kembali ke halaman daftar gejala
    }
    // END GEJALA


    // PENYAKIT
    public function penyakit() // Fungsi untuk menampilkan halaman daftar penyakit
    {
        $lastKode = $this->Model_admin->getKodePenyakitTerakhir(); // Mengambil kode penyakit terakhir dari database
        $newKode = 'P' . str_pad(($lastKode ? (int) substr($lastKode, 1) + 1 : 1), 3, '0', STR_PAD_LEFT);
        // Membuat kode penyakit baru dengan format 'PXXX' (contoh: P001, P002)
        // Jika ada kode terakhir, ambil angka di belakang 'P', tambahkan 1, dan format menjadi 3 digit

        $data = [ // Data yang akan dikirim ke tampilan
            'title'     => 'Penyakit', // Judul halaman
            'penyakit'  => $this->Model_admin->getAllPenyakit(), // Mengambil semua data penyakit dari database
            'newKode'   => $newKode, // Mengirim kode penyakit baru ke tampilan
        ];

        $this->load->view('templates/admin/header', $data); // Memuat header dan mengirimkan data
        $this->load->view('templates/admin/sidebar'); // Memuat sidebar navigasi
        $this->load->view('admin/penyakit'); // Memuat halaman utama daftar penyakit
        $this->load->view('templates/admin/footer'); // Memuat footer halaman
    }

    public function tambah_penyakit() // Fungsi untuk menambah data penyakit
    {
        $data = [ // Menyiapkan data yang akan disimpan
            'kode_penyakit' => $this->input->post('kode_penyakit'), // Mengambil input kode penyakit dari form
            'nama_penyakit' => $this->input->post('nama_penyakit'), // Mengambil input nama penyakit dari form
            'keterangan'    => $this->input->post('keterangan'), // Mengambil input keterangan penyakit dari form
        ];

        $this->Model_admin->tambahPenyakit($data); // Memanggil model untuk menyimpan data ke database
        $this->session->set_flashdata( // Menyimpan pesan sukses dalam session
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil disimpan.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
        );

        redirect('admin/penyakit'); // Mengarahkan kembali ke halaman daftar penyakit
    }

    public function edit_penyakit($kode_penyakit) // Fungsi untuk mengedit data penyakit
    {
        $data = [ // Data yang akan diperbarui
            'kode_penyakit' => $this->input->post('kode_penyakit'), // Mengambil input kode penyakit dari form
            'nama_penyakit' => $this->input->post('nama_penyakit'), // Mengambil input nama penyakit dari form
            'keterangan'    => $this->input->post('keterangan'), // Mengambil input keterangan penyakit dari form
        ];

        $this->Model_admin->editPenyakit($kode_penyakit, $data); // Memanggil model untuk memperbarui data di database
        $this->session->set_flashdata( // Menyimpan pesan sukses dalam session
            'pesan',
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            Data berhasil diperbarui.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
        );
        redirect('admin/penyakit'); // Mengarahkan kembali ke halaman daftar penyakit
    }

    public function hapus_penyakit($kode_penyakit) // Fungsi untuk menghapus data penyakit
    {
        $this->Model_admin->hapusPenyakit($kode_penyakit); // Memanggil model untuk menghapus data berdasarkan kode penyakit
        $this->session->set_flashdata( // Menyimpan pesan sukses dalam session
            'pesan',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Data berhasil dihapus.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
        );

        redirect('admin/penyakit'); // Mengarahkan kembali ke halaman daftar penyakit
    }
    // END PENYAKIT


    // RELASI
    public function relasi() // Fungsi untuk menampilkan halaman daftar relasi penyakit dan gejala
    {
        $data = [
            'title'     => 'Relasi', // Judul halaman
            'gejala'    => $this->Model_admin->getAllGejala(), // Mengambil semua data gejala dari database
            'penyakit'  => $this->Model_admin->getAllPenyakit(), // Mengambil semua data penyakit dari database
            'relasi'    => $this->Model_admin->getAllRelasi(), // Mengambil semua data relasi dari database
        ];

        $this->load->view('templates/admin/header', $data); // Memuat header dengan data yang dikirim
        $this->load->view('templates/admin/sidebar'); // Memuat sidebar navigasi
        $this->load->view('admin/relasi'); // Memuat halaman daftar relasi
        $this->load->view('templates/admin/footer'); // Memuat footer halaman
    }

    public function v_tambah_relasi($kode_penyakit) // Fungsi untuk menampilkan form tambah relasi
    {
        $data = [
            'title'     => 'Tambah Relasi', // Judul halaman
            'gejala'    => $this->Model_admin->getAllGejala(), // Mengambil semua gejala dari database
            'penyakit'  => $this->Model_admin->getPenyakitByKode($kode_penyakit), // Mengambil data penyakit berdasarkan kode
        ];

        $this->load->view('templates/admin/header', $data); // Memuat header dengan data
        $this->load->view('templates/admin/sidebar'); // Memuat sidebar navigasi
        $this->load->view('admin/tambah_relasi'); // Memuat halaman form tambah relasi
        $this->load->view('templates/admin/footer'); // Memuat footer halaman
    }

    public function tambah_relasi($kode_penyakit) // Fungsi untuk menambahkan relasi baru ke database
    {
        $gejala_codes = $this->input->post(); // Mengambil semua data input dari form

        foreach ($gejala_codes as $key => $value) { // Looping semua data input
            if (strpos($key, 'keterangan_') === 0) { // Mengecek apakah input adalah keterangan gejala
                $kode_gejala = substr($key, 11); // Mengambil kode gejala dari nama input form

                $data = [
                    'kode_penyakit'     => $kode_penyakit, // Menyimpan kode penyakit yang direlasikan
                    'kode_gejala'       => $kode_gejala, // Menyimpan kode gejala yang direlasikan
                    'keterangan_relasi' => $value, // Menyimpan keterangan relasi antara penyakit dan gejala
                ];

                $this->Model_admin->tambahRelasi($data); // Menyimpan data relasi ke database melalui model
            }
        }

        $this->session->set_flashdata( // Menyimpan pesan sukses dalam session
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil disimpan.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
        );

        redirect('admin/relasi'); // Mengarahkan kembali ke halaman daftar relasi
    }

    public function v_edit_relasi($kode_penyakit) // Fungsi untuk menampilkan form edit relasi
    {
        $data = [
            'title'     => 'Edit Relasi', // Judul halaman
            'gejala'    => $this->Model_admin->getAllGejala(), // Mengambil semua data gejala dari database
            'penyakit'  => $this->Model_admin->getPenyakitByKode($kode_penyakit), // Mengambil data penyakit berdasarkan kode
            'relasi'    => $this->Model_admin->getRelasiByKodePenyakit($kode_penyakit), // Mengambil semua relasi untuk penyakit yang dipilih
        ];

        $this->load->view('templates/admin/header', $data); // Memuat header dengan data
        $this->load->view('templates/admin/sidebar'); // Memuat sidebar navigasi
        $this->load->view('admin/edit_relasi'); // Memuat halaman edit relasi
        $this->load->view('templates/admin/footer'); // Memuat footer halaman
    }

    public function edit_relasi($kode_penyakit) // Fungsi untuk memperbarui data relasi di database
    {
        $gejala_codes = $this->input->post(); // Mengambil semua input dari form
        foreach ($gejala_codes as $key => $value) { // Looping semua data input

            if (strpos($key, 'keterangan_') === 0) { // Mengecek apakah input adalah keterangan gejala
                $kode_gejala = substr($key, 11); // Mengambil kode gejala dari nama input form

                $data = [
                    'kode_penyakit'     => $kode_penyakit, // Menyimpan kode penyakit yang diperbarui relasinya
                    'kode_gejala'       => $kode_gejala, // Menyimpan kode gejala yang diperbarui relasinya
                    'keterangan_relasi' => $value, // Menyimpan keterangan relasi yang baru
                ];

                $this->Model_admin->editRelasi($data); // Memanggil model untuk memperbarui data di database
            }
        }

        $this->session->set_flashdata( // Menyimpan pesan sukses dalam session
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
             Data berhasil diperbarui.
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
        );

        redirect('admin/relasi'); // Mengarahkan kembali ke halaman daftar relasi
    }
    // END RELASI


    // KONSULTASI
    public function konsultasi() // Menampilkan daftar semua konsultasi yang ada
    {
        $data = [
            'title'         => 'Konsultasi', // Judul halaman
            'konsultasi'    => $this->Model_admin->getAllKonsultasi(), // Mengambil semua data konsultasi dari database
        ];

        $this->load->view('templates/admin/header', $data); // Memuat header dengan data
        $this->load->view('templates/admin/sidebar'); // Memuat sidebar navigasi
        $this->load->view('admin/konsultasi'); // Menampilkan halaman daftar konsultasi
        $this->load->view('templates/admin/footer'); // Memuat footer halaman
    }

    public function detail_konsultasi($id_user, $konsultasi_ke) // Menampilkan detail konsultasi berdasarkan user dan sesi konsultasi
    {
        $detail_konsultasi    = $this->Model_admin->getDetailData($id_user, $konsultasi_ke); // Mengambil detail konsultasi
        $hasil_konsultasi     = $this->Model_admin->getDetailHasil($id_user, $konsultasi_ke); // Mengambil hasil dari konsultasi

        $data = [
            'title'             => 'Detail Konsultasi', // Judul halaman
            'detail_konsultasi' => $detail_konsultasi, // Data detail konsultasi
            'hasil_konsultasi'  => $hasil_konsultasi, // Data hasil konsultasi
            'id_user'           => $id_user, // ID user yang melakukan konsultasi
            'konsultasi_ke'     => $konsultasi_ke // Nomor sesi konsultasi
        ];

        $this->load->view('templates/admin/header', $data); // Memuat header dengan data
        $this->load->view('templates/admin/sidebar'); // Memuat sidebar navigasi
        $this->load->view('admin/detail_konsultasi', $data); // Menampilkan halaman detail konsultasi
        $this->load->view('templates/admin/footer'); // Memuat footer halaman
    }

    public function print_konsultasi($id_user, $konsultasi_ke) // Menampilkan halaman cetak konsultasi
    {
        $detail_konsultasi    = $this->Model_admin->getDetailData($id_user, $konsultasi_ke); // Mengambil detail konsultasi
        $hasil_konsultasi     = $this->Model_admin->getDetailHasil($id_user, $konsultasi_ke); // Mengambil hasil konsultasi

        $data = [
            'detail_konsultasi' => $detail_konsultasi, // Data detail konsultasi
            'hasil_konsultasi'  => $hasil_konsultasi, // Data hasil konsultasi
            'id_user'           => $id_user, // ID user yang melakukan konsultasi
            'konsultasi_ke'     => $konsultasi_ke // Nomor sesi konsultasi
        ];

        $this->load->view('admin/print_konsultasi_pdf', $data); // Menampilkan halaman cetak PDF konsultasi
    }

    public function hapus_konsultasi($id_user, $konsultasi_ke) // Menghapus data konsultasi dari database
    {
        $this->Model_admin->hapusKonsultasi($id_user, $konsultasi_ke); // Memanggil model untuk menghapus data konsultasi berdasarkan user dan sesi konsultasi

        $this->session->set_flashdata( // Menyimpan pesan notifikasi dalam session
            'pesan',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Data berhasil dihapus.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );

        redirect('admin/konsultasi'); // Mengarahkan kembali ke halaman daftar konsultasi
    }

    // END KONSULTASI


    // USER
    public function user() // Menampilkan daftar pengguna
    {
        $data = [
            'title' => 'User', // Judul halaman
            'user'  => $this->Model_admin->getAllUser(), // Mengambil semua data user dari database
            'role'  => $this->Model_admin->getAllRole(), // Mengambil semua data role dari database
        ];

        $this->load->view('templates/admin/header', $data); // Memuat header dengan data
        $this->load->view('templates/admin/sidebar'); // Memuat sidebar navigasi
        $this->load->view('admin/user'); // Menampilkan halaman daftar user
        $this->load->view('templates/admin/footer'); // Memuat footer halaman
    }

    public function tambah_user() // Menambahkan user baru
    {
        $data = [
            'nama_lengkap'  => $this->input->post('nama_lengkap'), // Mengambil input nama lengkap
            'username'      => $this->input->post('username'), // Mengambil input username
            'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT), // Hash password sebelum disimpan
            'id_role'       => $this->input->post('id_role'), // Mengambil input role user
        ];

        $this->Model_admin->tambahUser($data); // Memanggil model untuk menyimpan data user baru

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil disimpan.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
        );

        redirect('admin/user'); // Redirect kembali ke halaman daftar user
    }

    public function edit_user($id_user) // Mengedit data user
    {
        $data = [
            'id_user'       => $this->input->post('id_user'), // Mengambil input ID user
            'nama_lengkap'  => $this->input->post('nama_lengkap'), // Mengambil input nama lengkap
            'username'      => $this->input->post('username'), // Mengambil input username
            'id_role'       => $this->input->post('id_role'), // Mengambil input role user
        ];

        if ($this->input->post('password')) { // Jika ada password baru yang diinput
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT); // Hash password sebelum disimpan
        }

        $this->Model_admin->editUser($id_user, $data); // Memanggil model untuk mengupdate data user

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            Data berhasil diperbarui.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
        );

        redirect('admin/user'); // Redirect kembali ke halaman daftar user
    }

    public function hapus_user($id_user) // Menghapus user berdasarkan ID
    {
        $this->Model_admin->hapusUser($id_user); // Memanggil model untuk menghapus user berdasarkan ID

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Data berhasil dihapus.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );

        redirect('admin/user'); // Redirect kembali ke halaman daftar user
    }
    // END USER


    // PROFILE
    public function profile()
    {
        $id_user = $this->session->userdata('id_user'); // Mengambil ID user yang sedang login dari session

        $data = [
            'title' => 'Profile', // Judul halaman
            'user'  => $this->Model_admin->getProfileByIdUser($id_user), // Mengambil data profile berdasarkan ID user
            'role'  => $this->Model_admin->getAllRole(), // Mengambil daftar semua role
        ];

        $this->load->view('templates/admin/header', $data); // Memuat header dengan data
        $this->load->view('templates/admin/sidebar'); // Memuat sidebar navigasi
        $this->load->view('admin/profile'); // Menampilkan halaman profile
        $this->load->view('templates/admin/footer'); // Memuat footer halaman
    }

    public function edit_profile($id_user)
    {
        $data = [
            'id_user'       => $this->input->post('id_user'), // Mengambil input ID user
            'nama_lengkap'  => $this->input->post('nama_lengkap'), // Mengambil input nama lengkap
            'username'      => $this->input->post('username'), // Mengambil input username
            'id_role'       => $this->input->post('id_role'), // Mengambil input role user
        ];

        if ($this->input->post('password')) { // Jika ada password baru yang diinput
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT); // Hash password sebelum disimpan
        }

        $this->Model_admin->editUser($id_user, $data); // Memanggil model untuk mengupdate data user

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            Profile berhasil diperbarui.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
        );

        redirect('admin/profile'); // Redirect kembali ke halaman profile
    }
    // END PROFILE
}

/* End of file Admin.php */
