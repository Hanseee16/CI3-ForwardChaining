<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_user extends CI_Model
{

    public function getTotalPenyakit()
    {
        return $this->db->count_all('penyakit');
    }

    public function getTotalGejala()
    {
        return $this->db->count_all('gejala');
    }

    public function getTotalKonsultasi($id_user)
    {
        return $this->db
            ->select('COUNT(DISTINCT CONCAT(k.id_user, "-", k.konsultasi_ke)) as total_konsultasi')
            ->join('user u', 'u.id_user = k.id_user')
            ->where('u.id_user', $id_user)
            ->get('konsultasi k')
            ->row_array();
    }

    public function getAllGejala()
    {
        return $this->db
            ->order_by('kode_gejala', 'ASC')
            ->get('gejala')
            ->result_array();
    }

    public function getIdUser($id_user)
    {
        return $this->db
            ->get_where('user', ['id_user' => $id_user])
            ->row_array();
    }

    public function getProfileByIdUser($id_user)
    {
        return $this->db
            ->where('u.id_user', $id_user)
            ->join('role r', 'r.id_role = u.id_role', 'INNER')
            ->get('user u')
            ->row_array();
    }

    public function getKonsultasiByUser($id_user)
    {
        $latest_konsultasi = $this->db
            ->select('MAX(konsultasi_ke) as latest')
            ->where('id_user', $id_user)
            ->get('konsultasi')
            ->row();

        return $this->db
            ->join('gejala g', 'g.kode_gejala = k.kode_gejala')
            ->where('k.id_user', $id_user)
            ->where('k.konsultasi_ke', $latest_konsultasi->latest)
            ->get('konsultasi k')
            ->result_array();
    }

    public function getHasilKonsultasi($id_user)
    {
        $latest_konsultasi = $this->db
            ->select('MAX(konsultasi_ke) as latest')
            ->where('id_user', $id_user)
            ->get('konsultasi')
            ->row();

        $jawaban_user = $this->db
            ->select('k.kode_gejala, k.jawaban')
            ->where('k.id_user', $id_user)
            ->where('k.konsultasi_ke', $latest_konsultasi->latest)
            ->get('konsultasi k')
            ->result_array();

        return $this->db
            ->select('p.kode_penyakit, p.nama_penyakit, p.keterangan')
            ->where('k.id_user', $id_user)
            ->where('k.konsultasi_ke', $latest_konsultasi->latest)
            ->where('r.keterangan_relasi = k.jawaban')
            ->group_by('p.kode_penyakit')
            ->having('COUNT(r.kode_gejala) = ' . count($jawaban_user))
            ->join('penyakit p', 'p.kode_penyakit = r.kode_penyakit')
            ->join('konsultasi k', 'k.kode_gejala = r.kode_gejala')
            ->get('relasi r')
            ->result_array();
    }

    public function getDataKonsultasiByUser($id_user)
    {
        return $this->db
            ->where('k.id_user', $id_user)
            ->group_by('k.id_user, k.konsultasi_ke')
            ->order_by('k.tanggal_konsultasi', 'DESC')
            ->join('user u', 'u.id_user = k.id_user')
            ->get('konsultasi k')
            ->result_array();
    }

    public function getDetailKonsultasi($id_user, $konsultasi_ke)
    {
        return $this->db
            ->select('u.nama_lengkap, g.kode_gejala, g.nama_gejala, k.jawaban, k.tanggal_konsultasi')
            ->from('konsultasi k')
            ->join('user u', 'u.id_user = k.id_user')
            ->join('gejala g', 'g.kode_gejala = k.kode_gejala')
            ->where('k.id_user', $id_user)
            ->where('k.konsultasi_ke', $konsultasi_ke)
            ->order_by('k.kode_gejala', 'ASC')
            ->get()
            ->result_array();
    }

    public function getDetailHasilKonsultasi($id_user, $konsultasi_ke)
    {
        $jawaban_user = $this->db
            ->select('k.kode_gejala, k.jawaban')
            ->where('k.id_user', $id_user)
            ->where('k.konsultasi_ke', $konsultasi_ke)
            ->get('konsultasi k')
            ->result_array();

        return $this->db
            ->select('p.kode_penyakit, p.nama_penyakit, p.keterangan')
            ->where('k.id_user', $id_user)
            ->where('k.konsultasi_ke', $konsultasi_ke)
            ->where('r.keterangan_relasi = k.jawaban')
            ->group_by('p.kode_penyakit')
            ->having('COUNT(r.kode_gejala) = ' . count($jawaban_user))
            ->join('penyakit p', 'p.kode_penyakit = r.kode_penyakit')
            ->join('konsultasi k', 'k.kode_gejala = r.kode_gejala')
            ->get('relasi r')
            ->result_array();
    }


    // edit data
    public function editUser($id_user, $data)
    {
        $this->db
            ->where('id_user', $id_user)
            ->update('user', $data);
    }


    // hapus data
    public function hapusKonsultasi($id_user, $konsultasi_ke)
    {
        $this->db->delete('konsultasi', ['id_user' => $id_user, 'konsultasi_ke' => $konsultasi_ke]);
    }

    public function getUsername($username)
    {
        return $this->db
            ->get_where('user', ['username' => $username])
            ->row_array();
    }

    public function add($data)
    {
        $this->db->insert('user', $data);
    }

    public function update($id_user, $data)
    {
        $this->db
            ->where('id_user', $id_user)
            ->update('user', $data);
    }

    public function delete($id_user)
    {
        $this->db->delete('user', ['id_user' => $id_user]);
    }
}

/* End of file Model_user.php */
