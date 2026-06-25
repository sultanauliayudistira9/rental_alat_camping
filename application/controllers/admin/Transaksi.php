<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // penjaga: cuma admin
        if ($this->session->userdata('role') !== 'admin') {
            redirect('admin/auth');
        }
        $this->load->model('Transaksi_model');
    }

    public function index()
    {
        $data['transaksi'] = $this->Transaksi_model->get_all();
        // ambil detail tiap transaksi
        foreach ($data['transaksi'] as $t) {
            $t->detail = $this->Transaksi_model->get_detail($t->id);
        }
        $this->load->view('admin/transaksi/index', $data);
    }

    public function ubah_status($id)
    {
        $status = $this->input->post('status');
        $this->Transaksi_model->update_status($id, $status);
        redirect('admin/transaksi');
    }
}