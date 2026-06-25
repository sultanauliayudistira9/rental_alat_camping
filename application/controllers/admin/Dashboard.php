<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // PENJAGA: kalau belum login sebagai admin, tendang ke halaman login
        if ($this->session->userdata('role') !== 'admin') {
            redirect('admin/auth');
        }
    }

    public function index()
    {
        $data['nama'] = $this->session->userdata('nama');
        $this->load->view('admin/dashboard', $data);
    }
}