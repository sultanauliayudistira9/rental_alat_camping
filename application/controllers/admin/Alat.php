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
        $nama_file = null;

        if (!empty($_FILES['gambar']['name'])) {
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']      = 2048;
            $config['file_name']     = 'alat_' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $nama_file = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/alat/tambah');
                return;
            }
        }

        $data = [
            'kategori_id' => $this->input->post('kategori_id'),
            'nama_alat'   => $this->input->post('nama_alat'),
            'deskripsi'   => $this->input->post('deskripsi'),
            'harga_sewa'  => $this->input->post('harga_sewa'),
            'stok'        => $this->input->post('stok'),
            'kondisi'     => $this->input->post('kondisi'),
            'gambar'      => $nama_file,
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
        // ambil data lama dulu (buat tahu foto sebelumnya)
        $alat_lama = $this->Alat_model->get_by_id($id);
        $nama_file = $alat_lama->gambar; // default: pakai foto lama

        if (!empty($_FILES['gambar']['name'])) {
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']      = 2048;
            $config['file_name']     = 'alat_' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $nama_file = $this->upload->data('file_name');
                // hapus foto lama kalau ada
                if ($alat_lama->gambar && file_exists('./uploads/' . $alat_lama->gambar)) {
                    unlink('./uploads/' . $alat_lama->gambar);
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/alat/edit/' . $id);
                return;
            }
        }

        $data = [
            'kategori_id' => $this->input->post('kategori_id'),
            'nama_alat'   => $this->input->post('nama_alat'),
            'deskripsi'   => $this->input->post('deskripsi'),
            'harga_sewa'  => $this->input->post('harga_sewa'),
            'stok'        => $this->input->post('stok'),
            'kondisi'     => $this->input->post('kondisi'),
            'gambar'      => $nama_file,
        ];
        $this->Alat_model->update($id, $data);
        redirect('admin/alat');
    }

    public function hapus($id)
    {
        // hapus file foto juga kalau ada
        $alat = $this->Alat_model->get_by_id($id);
        if ($alat && $alat->gambar && file_exists('./uploads/' . $alat->gambar)) {
            unlink('./uploads/' . $alat->gambar);
        }
        $this->Alat_model->delete($id);
        redirect('admin/alat');
    }
}