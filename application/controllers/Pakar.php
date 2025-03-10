<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pakar extends CI_Controller
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
            'penyakit'      => $this->Model_pakar->getTotalPenyakit(), // Mengambil total data penyakit dari model
            'gejala'        => $this->Model_pakar->getTotalGejala(), // Mengambil total data gejala dari model
            'konsultasi'    => $this->Model_pakar->getTotalKonsultasi(), // Mengambil total data konsultasi dari model
        ];

        $this->load->view('templates/pakar/header', $data); // Memuat tampilan header dan mengirimkan data ke dalamnya
        $this->load->view('templates/pakar/sidebar'); // Memuat tampilan sidebar yang berisi menu navigasi pakar
        $this->load->view('pakar/dashboard'); // Memuat tampilan utama halaman dashboard
        $this->load->view('templates/pakar/footer'); // Memuat tampilan footer untuk menutup halaman
    }


    // GEJALA
    public function gejala()
    {
        $lastKode = $this->Model_pakar->getKodeGejalaTerakhir(); // Mendapatkan kode gejala terakhir dari model
        $newKode = 'G' . str_pad(($lastKode ? (int) substr($lastKode, 1) + 1 : 1), 3, '0', STR_PAD_LEFT); // Menentukan kode gejala baru dengan format 'G' dan nomor urut yang dipadankan 3 digit

        $data = [
            'title'     => 'Gejala', // Judul halaman
            'gejala'    => $this->Model_pakar->getAllGejala(), // Mengambil semua data gejala dari model
            'newKode'   => $newKode, // Kode gejala baru yang dihitung
        ];

        $this->load->view('templates/pakar/header', $data); // Memuat tampilan header dengan data
        $this->load->view('templates/pakar/sidebar'); // Memuat tampilan sidebar
        $this->load->view('pakar/gejala'); // Memuat halaman utama gejala
        $this->load->view('templates/pakar/footer'); // Memuat tampilan footer
    }

    public function tambah_gejala()
    {
        $data = [
            'kode_gejala'   => $this->input->post('kode_gejala'), // Mengambil input kode gejala
            'nama_gejala'   => $this->input->post('nama_gejala'), // Mengambil input nama gejala
        ];

        $this->Model_pakar->tambahGejala($data); // Menyimpan data gejala ke database menggunakan model

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
             Data berhasil disimpan.
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>' // Menampilkan pesan sukses dengan flashdata
        );

        redirect('pakar/gejala'); // Redirect ke halaman daftar gejala setelah data disimpan
    }

    public function edit_gejala($kode_gejala)
    {
        $data = [
            'kode_gejala'   => $this->input->post('kode_gejala'), // Mengambil input kode gejala baru
            'nama_gejala'   => $this->input->post('nama_gejala'), // Mengambil input nama gejala baru
        ];

        $this->Model_pakar->editGejala($kode_gejala, $data); // Memperbarui data gejala berdasarkan kode gejala

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
             Data berhasil diperbarui.
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>' // Menampilkan pesan peringatan sukses setelah data diperbarui
        );
        redirect('pakar/gejala'); // Redirect ke halaman daftar gejala setelah data diperbarui
    }

    public function hapus_gejala($kode_gejala)
    {
        $this->Model_pakar->hapusGejala($kode_gejala); // Menghapus data gejala berdasarkan kode gejala

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
             Data berhasil dihapus.
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>' // Menampilkan pesan sukses penghapusan dengan flashdata
        );

        redirect('pakar/gejala'); // Redirect ke halaman daftar gejala setelah penghapusan selesai
    }
    // END GEJALA


    // PENYAKIT
    public function penyakit()
    {
        $lastKode = $this->Model_pakar->getKodePenyakitTerakhir(); // Mendapatkan kode penyakit terakhir dari model
        $newKode = 'P' . str_pad(($lastKode ? (int) substr($lastKode, 1) + 1 : 1), 3, '0', STR_PAD_LEFT); // Menentukan kode penyakit baru dengan format 'P' dan nomor urut yang dipadankan 3 digit

        $data = [
            'title'     => 'Penyakit', // Judul halaman
            'penyakit'  => $this->Model_pakar->getAllPenyakit(), // Mengambil semua data penyakit dari model
            'newKode'   => $newKode, // Kode penyakit baru yang dihitung
        ];

        $this->load->view('templates/pakar/header', $data); // Memuat tampilan header dengan data
        $this->load->view('templates/pakar/sidebar'); // Memuat tampilan sidebar
        $this->load->view('pakar/penyakit'); // Memuat halaman utama penyakit
        $this->load->view('templates/pakar/footer'); // Memuat tampilan footer
    }

    public function tambah_penyakit()
    {
        $data = [
            'kode_penyakit' => $this->input->post('kode_penyakit'), // Mengambil input kode penyakit
            'nama_penyakit' => $this->input->post('nama_penyakit'), // Mengambil input nama penyakit
            'keterangan'    => $this->input->post('keterangan'),    // Mengambil input keterangan penyakit
        ];

        $this->Model_pakar->tambahPenyakit($data); // Menyimpan data penyakit ke database menggunakan model

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
             Data berhasil disimpan.
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>' // Menampilkan pesan sukses dengan flashdata
        );

        redirect('pakar/penyakit'); // Redirect ke halaman daftar penyakit setelah data disimpan
    }

    public function edit_penyakit($kode_penyakit)
    {
        $data = [
            'kode_penyakit' => $this->input->post('kode_penyakit'), // Mengambil input kode penyakit baru
            'nama_penyakit' => $this->input->post('nama_penyakit'), // Mengambil input nama penyakit baru
            'keterangan'    => $this->input->post('keterangan'),    // Mengambil input keterangan penyakit baru
        ];

        $this->Model_pakar->editPenyakit($kode_penyakit, $data); // Memperbarui data penyakit berdasarkan kode penyakit

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
             Data berhasil diperbarui.
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>' // Menampilkan pesan sukses peringatan setelah data diperbarui
        );
        redirect('pakar/penyakit'); // Redirect ke halaman daftar penyakit setelah data diperbarui
    }

    public function hapus_penyakit($kode_penyakit)
    {
        $this->Model_pakar->hapusPenyakit($kode_penyakit); // Menghapus data penyakit berdasarkan kode penyakit

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
             Data berhasil dihapus.
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>' // Menampilkan pesan sukses penghapusan dengan flashdata
        );

        redirect('pakar/penyakit'); // Redirect ke halaman daftar penyakit setelah penghapusan selesai
    }
    // END PENYAKIT


    // RELASI
    public function relasi()
    {
        $data = [
            'title'     => 'Relasi', // Judul halaman
            'gejala'    => $this->Model_pakar->getAllGejala(), // Mendapatkan semua gejala dari model
            'penyakit'  => $this->Model_pakar->getAllPenyakit(), // Mendapatkan semua penyakit dari model
            'relasi'    => $this->Model_pakar->getAllRelasi(), // Mendapatkan semua relasi penyakit dan gejala dari model
        ];

        $this->load->view('templates/pakar/header', $data); // Memuat tampilan header dengan data
        $this->load->view('templates/pakar/sidebar'); // Memuat tampilan sidebar
        $this->load->view('pakar/relasi'); // Memuat halaman relasi
        $this->load->view('templates/pakar/footer'); // Memuat tampilan footer
    }

    public function v_tambah_relasi($kode_penyakit)
    {
        $data = [
            'title'     => 'Tambah Relasi', // Judul halaman
            'gejala'    => $this->Model_pakar->getAllGejala(), // Mendapatkan semua gejala dari model
            'penyakit'  => $this->Model_pakar->getPenyakitByKode($kode_penyakit), // Mendapatkan data penyakit berdasarkan kode penyakit
        ];

        $this->load->view('templates/pakar/header', $data); // Memuat tampilan header dengan data
        $this->load->view('templates/pakar/sidebar'); // Memuat tampilan sidebar
        $this->load->view('pakar/tambah_relasi'); // Memuat halaman tambah relasi
        $this->load->view('templates/pakar/footer'); // Memuat tampilan footer
    }

    public function tambah_relasi($kode_penyakit)
    {
        $gejala_codes = $this->input->post(); // Mengambil semua input yang dikirimkan

        foreach ($gejala_codes as $key => $value) { // Melakukan iterasi pada semua data input
            if (strpos($key, 'keterangan_') === 0) { // Memeriksa apakah key dimulai dengan 'keterangan_'
                $kode_gejala = substr($key, 11); // Mengambil kode gejala dari key

                $data = [
                    'kode_penyakit'     => $kode_penyakit, // Menyimpan kode penyakit yang diterima
                    'kode_gejala'       => $kode_gejala,   // Menyimpan kode gejala
                    'keterangan_relasi' => $value,         // Menyimpan keterangan relasi gejala dan penyakit
                ];

                $this->Model_pakar->tambahRelasi($data); // Menyimpan relasi ke database
            }
        }

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil disimpan.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>' // Menampilkan pesan sukses dengan flashdata
        );

        redirect('pakar/relasi'); // Redirect ke halaman daftar relasi setelah data disimpan
    }

    public function v_edit_relasi($kode_penyakit)
    {
        $data = [
            'title'     => 'Edit Relasi', // Judul halaman
            'gejala'    => $this->Model_pakar->getAllGejala(), // Mendapatkan semua gejala dari model
            'penyakit'  => $this->Model_pakar->getPenyakitByKode($kode_penyakit), // Mendapatkan data penyakit berdasarkan kode penyakit
            'relasi'    => $this->Model_pakar->getRelasiByKodePenyakit($kode_penyakit), // Mendapatkan semua relasi berdasarkan kode penyakit
        ];

        $this->load->view('templates/pakar/header', $data); // Memuat tampilan header dengan data
        $this->load->view('templates/pakar/sidebar'); // Memuat tampilan sidebar
        $this->load->view('pakar/edit_relasi'); // Memuat halaman edit relasi
        $this->load->view('templates/pakar/footer'); // Memuat tampilan footer
    }

    public function edit_relasi($kode_penyakit)
    {
        $gejala_codes = $this->input->post(); // Mengambil semua input yang dikirimkan

        foreach ($gejala_codes as $key => $value) { // Melakukan iterasi pada semua data input
            if (strpos($key, 'keterangan_') === 0) { // Memeriksa apakah key dimulai dengan 'keterangan_'
                $kode_gejala = substr($key, 11); // Mengambil kode gejala dari key

                $data = [
                    'kode_penyakit'     => $kode_penyakit, // Menyimpan kode penyakit yang diterima
                    'kode_gejala'       => $kode_gejala,   // Menyimpan kode gejala
                    'keterangan_relasi' => $value,         // Menyimpan keterangan relasi gejala dan penyakit
                ];

                $this->Model_pakar->editRelasi($data); // Memperbarui relasi di database
            }
        }

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
             Data berhasil diperbarui.
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>' // Menampilkan pesan sukses dengan flashdata
        );

        redirect('pakar/relasi'); // Redirect ke halaman daftar relasi setelah data diperbarui
    }
    // END RELASI



    // PROFILE
    public function profile()
    {
        $id_user = $this->session->userdata('id_user'); // Mengambil ID user dari session

        $data = [
            'title' => 'Profile', // Judul halaman
            'user'  => $this->Model_pakar->getProfileByIdUser($id_user), // Mengambil data profil user berdasarkan ID user
            'role'  => $this->Model_pakar->getAllRole(), // Mengambil data semua role dari model
        ];

        $this->load->view('templates/pakar/header', $data); // Memuat tampilan header dengan data
        $this->load->view('templates/pakar/sidebar'); // Memuat tampilan sidebar
        $this->load->view('pakar/profile'); // Memuat halaman profil
        $this->load->view('templates/pakar/footer'); // Memuat tampilan footer
    }

    public function edit_profile($id_user)
    {
        $data = [
            'id_user'       => $this->input->post('id_user'), // Mendapatkan id_user dari input form
            'nama_lengkap'  => $this->input->post('nama_lengkap'), // Mendapatkan nama lengkap dari input form
            'username'      => $this->input->post('username'), // Mendapatkan username dari input form
        ];

        if ($this->input->post('password')) { // Jika password diinputkan
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT); // Meng-hash password baru
        }

        $this->Model_pakar->editUser($id_user, $data); // Memperbarui data user di database
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            Profile berhasil diperbarui.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>' // Menampilkan pesan flash bahwa profile berhasil diperbarui
        );
        redirect('pakar/profile'); // Redirect ke halaman profile setelah diperbarui
    }
    // END PROFILE
}

/* End of file Pakar.php */
