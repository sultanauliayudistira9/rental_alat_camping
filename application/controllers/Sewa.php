<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sewa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Alat_model');
        $this->load->model('Transaksi_model');
    }

    // form sewa untuk 1 alat
    public function alat($id)
    {
        // LOGIN-PAKSA: kalau belum login sebagai penyewa, lempar ke login
        if ($this->session->userdata('role') !== 'penyewa') {
            $this->session->set_flashdata('error', 'Silakan login dulu untuk menyewa.');
            redirect('auth/login');
            return;
        }

        $data['alat'] = $this->Alat_model->get_by_id($id);
        if (!$data['alat']) {
            show_404();
        }
        $this->load->view('sewa/form', $data);
    }

    // proses simpan sewa
    public function proses()
    {
        if ($this->session->userdata('role') !== 'penyewa') {
            redirect('auth/login');
            return;
        }

        $alat_id   = $this->input->post('alat_id');
        $jumlah    = (int) $this->input->post('jumlah');
        $tgl_sewa  = $this->input->post('tanggal_sewa');
        $tgl_kembali = $this->input->post('tanggal_kembali');

        $alat = $this->Alat_model->get_by_id($alat_id);

        // hitung durasi (selisih hari)
        $d1 = new DateTime($tgl_sewa);
        $d2 = new DateTime($tgl_kembali);
        $durasi = $d2->diff($d1)->days;
        if ($durasi < 1) { $durasi = 1; } // minimal 1 hari

        // validasi: tanggal kembali harus setelah tanggal sewa
        if ($d2 <= $d1) {
            $this->session->set_flashdata('error', 'Tanggal kembali harus setelah tanggal sewa.');
            redirect('sewa/alat/' . $alat_id);
            return;
        }

        // validasi stok cukup
        if ($jumlah > $alat->stok) {
            $this->session->set_flashdata('error', 'Stok tidak cukup. Sisa: ' . $alat->stok);
            redirect('sewa/alat/' . $alat_id);
            return;
        }

        $subtotal = $alat->harga_sewa * $durasi * $jumlah;

        // simpan transaksi utama
        $transaksi_id = $this->Transaksi_model->insert_transaksi([
            'user_id'        => $this->session->userdata('user_id'),
            'tanggal_sewa'   => $tgl_sewa,
            'tanggal_kembali'=> $tgl_kembali,
            'total_harga'    => $subtotal,
            'status'         => 'pending',
        ]);

        // simpan detail
        $this->Transaksi_model->insert_detail([
            'transaksi_id' => $transaksi_id,
            'alat_id'      => $alat_id,
            'jumlah'       => $jumlah,
            'durasi'       => $durasi,
            'subtotal'     => $subtotal,
        ]);

        // kurangi stok
        $this->Transaksi_model->kurangi_stok($alat_id, $jumlah);

        $this->session->set_flashdata('sukses', 'Sewa berhasil! Total: Rp ' . number_format($subtotal, 0, ',', '.'));
        redirect('sewa/riwayat');
    }

    // riwayat sewa milik customer
    public function riwayat()
    {
        if ($this->session->userdata('role') !== 'penyewa') {
            redirect('auth/login');
            return;
        }

        $data['transaksi'] = $this->Transaksi_model->get_by_user($this->session->userdata('user_id'));

        // ambil detail tiap transaksi
        foreach ($data['transaksi'] as $t) {
            $t->detail = $this->Transaksi_model->get_detail($t->id);
        }

        $this->load->view('sewa/riwayat', $data);
    }
}