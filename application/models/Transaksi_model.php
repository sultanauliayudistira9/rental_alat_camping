<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
    // simpan transaksi utama, kembalikan id-nya
    public function insert_transaksi($data)
    {
        $this->db->insert('transaksi', $data);
        return $this->db->insert_id();
    }

    // simpan detail (alat apa yang disewa)
    public function insert_detail($data)
    {
        return $this->db->insert('detail_transaksi', $data);
    }

    // kurangi stok alat setelah disewa
    public function kurangi_stok($alat_id, $jumlah)
    {
        $this->db->set('stok', 'stok - ' . (int)$jumlah, FALSE);
        $this->db->where('id', $alat_id);
        return $this->db->update('alat');
    }

    // ambil riwayat sewa milik 1 customer
    public function get_by_user($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        return $this->db->get('transaksi')->result();
    }

    // ambil detail alat dari 1 transaksi
    public function get_detail($transaksi_id)
    {
        $this->db->select('detail_transaksi.*, alat.nama_alat');
        $this->db->from('detail_transaksi');
        $this->db->join('alat', 'alat.id = detail_transaksi.alat_id', 'left');
        $this->db->where('transaksi_id', $transaksi_id);
        return $this->db->get()->result();
    }
}