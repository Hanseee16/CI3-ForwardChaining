<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_auth extends CI_Model
{

    public function getUsername($username)
    {
        return $this->db
            ->get_where('user', ['username' => $username])
            ->row_array();
    }

    public function tambahUser($data)
    {
        $this->db->insert('user', $data);
    }
}

/* End of file Model_auth.php */
