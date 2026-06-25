<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alat_model extends CI_Model
{
    // ambil semua alat + nama kategorinya (JOIN)
    public function get_all()
    {
        $this->db->select('alat.*, kategori.nama_kategori');
        $this->db->from('alat');
        $this->db->join('kategori', 'kategori.id = alat.kategori_id', 'left');
        $this->db->order_by('alat.id', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('alat', ['id' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert('alat', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('alat', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('alat');
    }
}