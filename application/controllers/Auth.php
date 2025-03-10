<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function login()
    {
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->Model_auth->getUsername($username);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $this->session->set_userdata([
                        'id_user' => $user['id_user'],
                        'id_role' => $user['id_role']
                    ]);

                    if ($user['id_role'] == 1) {
                        $cekRole = 'admin/dashboard';
                    } elseif ($user['id_role'] == 2) {
                        $cekRole = 'pakar/dashboard';
                    } elseif ($user['id_role'] == 3) {
                        $cekRole = 'user/dashboard';
                    } else {
                        $cekRole = 'auth/not_found';
                    }

                    $this->session->set_flashdata(
                        'pesan',
                        '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                        Selamat datang, <strong>' . htmlspecialchars(ucwords($user['nama_lengkap']), ENT_QUOTES, 'UTF-8') . '</strong>!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                    );

                    redirect($cekRole);
                } else {
                    $this->session->set_flashdata(
                        'pesan',
                        '<div class="alert alert-danger alert-dismissible show fade">
                        Maaf, password yang Anda masukkan tidak sesuai.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                    );
                }
            } else {
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-dismissible show fade">
                    Username yang Anda masukkan belum terdaftar. Silakan lakukan registrasi.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
                );
            }
        }

        $this->load->view('auth/login');
    }

    public function registrasi()
    {
        if ($this->input->post()) {
            $username       = htmlspecialchars($this->input->post('username', true));
            $nama_lengkap   = htmlspecialchars($this->input->post('nama_lengkap', true));

            $cekUsername    = $this->Model_user->getUsername($username);

            if ($cekUsername) {
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                         Maaf, username sudah terdaftar.
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>'
                );

                redirect('registrasi');
            } else {
                $data = [
                    'nama_lengkap'  => $nama_lengkap,
                    'username'      => $username,
                    'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'id_role'       => 3,

                ];

                $this->Model_auth->tambahUser($data);
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Registrasi berhasil! Silakan login.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );

                redirect('login');
            }
        } else {
            $this->load->view('auth/registrasi');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('id_role');
        redirect('/');
    }

    public function not_found()
    {
        $this->load->view('404.php');
    }
}

/* End of file Auth.php */
