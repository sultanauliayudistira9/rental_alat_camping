<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    // cari user berdasarkan email (buat proses login)
    public function get_by_email($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row();
    }

    // cari user berdasarkan id
    public function get_by_id($id)
    {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    // daftar user baru (buat register customer nanti)
    public function insert($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }
}