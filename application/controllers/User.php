<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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


    // dashboard
    public function index()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'         => 'Dashboard',
            'penyakit'      => $this->Model_user->getTotalPenyakit(),
            'gejala'        => $this->Model_user->getTotalGejala(),
            'konsultasi'    => $this->Model_user->getTotalKonsultasi($id_user),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/sidebar');
        $this->load->view('user/dashboard');
        $this->load->view('templates/user/footer');
    }
    // end dashboard


    // konsultasi
    public function konsultasi()
    {
        $data = [
            'title'     => 'Mulai Konsultasi', // Judul halaman
            'gejala'    => $this->Model_user->getAllGejala(), // Mengambil daftar gejala dari model
        ];

        $this->load->view('templates/user/header', $data); // Memuat tampilan header dengan data
        $this->load->view('templates/user/sidebar'); // Memuat tampilan sidebar
        $this->load->view('user/konsultasi'); // Memuat halaman konsultasi
        $this->load->view('templates/user/footer'); // Memuat tampilan footer
    }

    public function tambah_konsultasi()
    {
        date_default_timezone_set('Asia/Jakarta'); // Menetapkan zona waktu Asia/Jakarta

        $id_user            = $this->session->userdata('id_user'); // Mengambil ID user dari session
        $jawaban_list       = $this->input->post('jawaban'); // Mengambil jawaban gejala dari form
        $tanggal_konsultasi = date('Y-m-d H:i:s'); // Mendapatkan tanggal dan waktu saat ini

        // Mengambil konsultasi terakhir berdasarkan ID user
        $last_konsultasi = $this->db->select('MAX(konsultasi_ke) as last_number')
            ->where('id_user', $id_user)
            ->get('konsultasi')
            ->row();

        $konsultasi_ke = ($last_konsultasi->last_number ?? 0) + 1; // Menentukan nomor konsultasi berikutnya

        $data = [];

        // Memasukkan jawaban gejala yang valid ke dalam array data
        foreach ($jawaban_list as $kode_gejala => $jawaban) {
            if ($kode_gejala && $jawaban) {
                $data[] = [
                    'id_user'               => $id_user,
                    'kode_gejala'           => $kode_gejala,
                    'jawaban'               => $jawaban,
                    'tanggal_konsultasi'    => $tanggal_konsultasi,
                    'konsultasi_ke'         => $konsultasi_ke
                ];
            }
        }

        // Jika ada data yang valid, simpan ke dalam tabel konsultasi
        if (!empty($data)) {
            $this->db->insert_batch('konsultasi', $data); // Menyimpan data konsultasi ke database
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Konsultasi berhasil disimpan.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>' // Pesan sukses setelah data disimpan
            );
        } else {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Tidak ada data yang disimpan. Pastikan Anda memilih minimal satu gejala.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>' // Pesan error jika tidak ada data yang disimpan
            );
        }

        redirect('user/hasil_konsultasi'); // Redirect ke halaman hasil konsultasi
    }

    public function hasil_konsultasi()
    {
        $id_user            = $this->session->userdata('id_user'); // Mengambil ID user dari session
        $user               = $this->Model_user->getIdUser($id_user); // Mengambil data user berdasarkan ID user
        $konsultasi         = $this->Model_user->getKonsultasiByUser($id_user); // Mengambil data konsultasi oleh user
        $hasil_konsultasi   = $this->Model_user->getHasilKonsultasi($id_user); // Mengambil hasil konsultasi user

        $data = [
            'title'             => 'Hasil Konsultasi', // Judul halaman
            'user'              => $user, // Data user
            'konsultasi'        => $konsultasi, // Data konsultasi
            'hasil_konsultasi'  => $hasil_konsultasi, // Hasil konsultasi
        ];

        $this->load->view('templates/user/header', $data); // Memuat tampilan header dengan data
        $this->load->view('templates/user/sidebar'); // Memuat tampilan sidebar
        $this->load->view('user/hasil_konsultasi', $data); // Memuat halaman hasil konsultasi
        $this->load->view('templates/user/footer'); // Memuat tampilan footer
    }
    // end konsultasi


    // data konsultasi
    public function data_konsultasi()
    {
        $id_user = $this->session->userdata('id_user'); // Mengambil ID user dari session

        $data = [
            'title'         => 'Data Konsultasi', // Judul halaman
            'konsultasi'    => $this->Model_user->getDataKonsultasiByUser($id_user), // Mengambil data konsultasi berdasarkan ID user
        ];

        $this->load->view('templates/user/header', $data); // Memuat tampilan header dengan data
        $this->load->view('templates/user/sidebar'); // Memuat tampilan sidebar
        $this->load->view('user/data_konsultasi'); // Memuat halaman data konsultasi
        $this->load->view('templates/user/footer'); // Memuat tampilan footer
    }

    public function detail_data_konsultasi($id_user, $konsultasi_ke)
    {
        // Mengambil detail konsultasi dan hasil konsultasi berdasarkan ID user dan nomor konsultasi
        $detail_konsultasi  = $this->Model_user->getDetailKonsultasi($id_user, $konsultasi_ke);
        $hasil_konsultasi   = $this->Model_user->getDetailHasilKonsultasi($id_user, $konsultasi_ke);

        $data = [
            'title'             => 'Detail Data Konsultasi', // Judul halaman
            'detail_konsultasi' => $detail_konsultasi, // Data detail konsultasi
            'hasil_konsultasi'  => $hasil_konsultasi, // Data hasil konsultasi
            'id_user'           => $id_user, // ID user
            'konsultasi_ke'     => $konsultasi_ke // Nomor konsultasi
        ];

        $this->load->view('templates/user/header', $data); // Memuat tampilan header dengan data
        $this->load->view('templates/user/sidebar'); // Memuat tampilan sidebar
        $this->load->view('user/detail_data_konsultasi', $data); // Memuat halaman detail data konsultasi
        $this->load->view('templates/user/footer'); // Memuat tampilan footer
    }

    public function print_konsultasi($id_user, $konsultasi_ke)
    {
        // Mengambil detail konsultasi dan hasil konsultasi berdasarkan ID user dan nomor konsultasi
        $detail_konsultasi  = $this->Model_user->getDetailKonsultasi($id_user, $konsultasi_ke);
        $hasil_konsultasi   = $this->Model_user->getDetailHasilKonsultasi($id_user, $konsultasi_ke);

        $data = [
            'detail_konsultasi' => $detail_konsultasi, // Data detail konsultasi
            'hasil_konsultasi'  => $hasil_konsultasi, // Data hasil konsultasi
            'id_user'           => $id_user, // ID user
            'konsultasi_ke'     => $konsultasi_ke // Nomor konsultasi
        ];

        $this->load->view('user/print_konsultasi_pdf', $data); // Memuat tampilan untuk mencetak konsultasi dalam format PDF
    }

    public function hapus_konsultasi($id_user, $konsultasi_ke)
    {
        $this->Model_user->hapusKonsultasi($id_user, $konsultasi_ke); // Menghapus data konsultasi berdasarkan ID user dan nomor konsultasi
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Data berhasil dihapus.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>' // Pesan error setelah data dihapus
        );

        redirect('user/data_konsultasi'); // Redirect ke halaman data konsultasi
    }
    // end riwayat konsultasi


    // profile
    public function profile()
    {
        $id_user = $this->session->userdata('id_user'); // Mengambil ID user dari session

        $data = [
            'title' => 'Profile', // Judul halaman
            'user'  => $this->Model_user->getProfileByIdUser($id_user), // Mengambil data profil berdasarkan ID user
        ];

        $this->load->view('templates/user/header', $data); // Memuat tampilan header dengan data
        $this->load->view('templates/user/sidebar'); // Memuat tampilan sidebar
        $this->load->view('user/profile'); // Memuat halaman profile user
        $this->load->view('templates/user/footer'); // Memuat tampilan footer
    }

    public function edit_profile($id_user)
    {
        // Mengambil data yang dikirimkan melalui form dan menyimpannya dalam array
        $data = [
            'id_user'       => $this->input->post('id_user'), // ID user yang ingin diperbarui
            'nama_lengkap'  => $this->input->post('nama_lengkap'), // Nama lengkap user
            'username'      => $this->input->post('username'), // Username user
        ];

        // Jika password diinputkan, maka password akan di-hash sebelum disimpan
        if ($this->input->post('password')) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT); // Hashing password
        }

        $this->Model_user->editUser($id_user, $data); // Memperbarui data user pada model

        // Menampilkan pesan bahwa profile berhasil diperbarui
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Profile berhasil diperbarui.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );

        redirect('user/profile'); // Redirect ke halaman profile setelah data berhasil diperbarui
    }
    // edn profile
}

/* End of file User.php */
