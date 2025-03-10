<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_pakar extends CI_Model
{

    public function getTotalPenyakit()
    {
        return $this->db->count_all('penyakit');
    }

    public function getTotalGejala()
    {
        return $this->db->count_all('gejala');
    }

    public function getTotalKonsultasi()
    {
        return $this->db
            ->select('COUNT(DISTINCT CONCAT(k.id_user, "-", k.konsultasi_ke)) as total_konsultasi')
            ->join('user u', 'u.id_user = k.id_user')
            ->get('konsultasi k')
            ->row_array();
    }

    // get all data
    public function getAllGejala()
    {
        return $this->db
            ->order_by('kode_gejala', 'ASC')
            ->get('gejala')
            ->result_array();
    }

    public function getAllPenyakit()
    {
        return $this->db
            ->order_by('kode_penyakit', 'ASC')
            ->get('penyakit')
            ->result_array();
    }

    public function getAllRelasi()
    {
        return $this->db
            ->join('gejala AS g', 'g.kode_gejala = r.kode_gejala', 'INNER')
            ->join('penyakit AS p', 'p.kode_penyakit = r.kode_penyakit', 'INNER')
            ->get('relasi AS r')
            ->result_array();
    }

    public function getAllRole()
    {
        return $this->db
            ->order_by('role', 'ASC')
            ->get('role')
            ->result_array();
    }



    // get kode
    public function getKodeGejalaTerakhir()
    {
        return $this->db->select('kode_gejala')
            ->from('gejala')
            ->order_by('kode_gejala', 'DESC')
            ->limit(1)
            ->get()
            ->row()
            ->kode_gejala ?? null;
    }

    public function getKodePenyakitTerakhir()
    {
        return $this->db->select('kode_penyakit')
            ->from('penyakit')
            ->order_by('kode_penyakit', 'DESC')
            ->limit(1)
            ->get()
            ->row()
            ->kode_penyakit ?? null;
    }



    // get data by kode atau id
    public function getPenyakitByKode($kode_penyakit)
    {
        return $this->db
            ->get_where('penyakit', ['kode_penyakit' => $kode_penyakit])
            ->row_array();
    }

    public function getRelasiByKodePenyakit($kode_penyakit)
    {
        $this->db->select('kode_gejala, keterangan_relasi');
        $this->db->from('relasi');
        $this->db->where('kode_penyakit', $kode_penyakit);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->result_array();

            $formatted_result = [];
            foreach ($result as $row) {
                $formatted_result[$row['kode_gejala']] = $row['keterangan_relasi'];
            }
            return $formatted_result;
        }

        return [];
    }

    public function getDetailData($id_user, $konsultasi_ke)
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

    public function getDetailHasil($id_user, $konsultasi_ke)
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

    public function getProfileByIdUser($id_user)
    {
        return $this->db
            ->where('u.id_user', $id_user)
            ->join('role r', 'r.id_role = u.id_role', 'INNER')
            ->get('user u')
            ->row_array();
    }



    // tambah data
    public function tambahGejala($data)
    {
        $this->db->insert('gejala', $data);
    }

    public function tambahPenyakit($data)
    {
        $this->db->insert('penyakit', $data);
    }

    public function tambahRelasi($data)
    {
        $this->db->insert('relasi', $data);
    }




    // edit data
    public function editGejala($kode_gejala, $data)
    {
        $this->db
            ->where('kode_gejala', $kode_gejala)
            ->update('gejala', $data);
    }

    public function editPenyakit($kode_penyakit, $data)
    {
        $this->db
            ->where('kode_penyakit', $kode_penyakit)
            ->update('penyakit', $data);
    }

    public function editRelasi($data)
    {
        $existing = $this->db->get_where('relasi', [
            'kode_penyakit' => $data['kode_penyakit'],
            'kode_gejala' => $data['kode_gejala']
        ])->row();

        if ($existing) {
            $this->db->where('kode_penyakit', $data['kode_penyakit']);
            $this->db->where('kode_gejala', $data['kode_gejala']);
            $this->db->update('relasi', $data);
        } else {
            $this->db->insert('relasi', $data);
        }
    }

    public function editUser($id_user, $data)
    {
        $this->db
            ->where('id_user', $id_user)
            ->update('user', $data);
    }



    // hapus data
    public function hapusGejala($kode_gejala)
    {
        $this->db->delete('konsultasi', ['kode_gejala' => $kode_gejala]);
        $this->db->delete('relasi', ['kode_gejala' => $kode_gejala]);
        $this->db->delete('gejala', ['kode_gejala' => $kode_gejala]);
    }

    public function hapusPenyakit($kode_penyakit)
    {
        $this->db->delete('relasi', ['kode_penyakit' => $kode_penyakit]);
        $this->db->delete('penyakit', ['kode_penyakit' => $kode_penyakit]);
    }
}

/* End of file Model_pakar.php */
