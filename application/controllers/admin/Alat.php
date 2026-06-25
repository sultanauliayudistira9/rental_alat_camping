<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') !== 'admin') {
            redirect('admin/auth');
        }
        $this->load->model('Alat_model');
    }

    public function index()
    {
        $data['nama'] = $this->session->userdata('nama');
        $data['alat'] = $this->Alat_model->get_all();
        $this->load->view('admin/alat/index', $data);
    }

    public function tambah()
    {
        $this->load->model('Kategori_model');
        $data['kategori'] = $this->Kategori_model->get_all();
        $this->load->view('admin/alat/tambah', $data);
    }

    public function simpan()
    {
        $data = [
            'kategori_id' => $this->input->post('kategori_id'),
            'nama_alat'   => $this->input->post('nama_alat'),
            'deskripsi'   => $this->input->post('deskripsi'),
            'harga_sewa'  => $this->input->post('harga_sewa'),
            'stok'        => $this->input->post('stok'),
            'kondisi'     => $this->input->post('kondisi'),
        ];
        $this->Alat_model->insert($data);
        redirect('admin/alat');
    }

    public function edit($id)
    {
        $this->load->model('Kategori_model');
        $data['kategori'] = $this->Kategori_model->get_all();
        $data['alat'] = $this->Alat_model->get_by_id($id);
        $this->load->view('admin/alat/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'kategori_id' => $this->input->post('kategori_id'),
            'nama_alat'   => $this->input->post('nama_alat'),
            'deskripsi'   => $this->input->post('deskripsi'),
            'harga_sewa'  => $this->input->post('harga_sewa'),
            'stok'        => $this->input->post('stok'),
            'kondisi'     => $this->input->post('kondisi'),
        ];
        $this->Alat_model->update($id, $data);
        redirect('admin/alat');
    }

    public function hapus($id)
    {
        $this->Alat_model->delete($id);
        redirect('admin/alat');
    }
}