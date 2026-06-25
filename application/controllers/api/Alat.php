<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Alat extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Alat_model');
    }

    // GET: ambil semua alat, atau satu alat kalau ada ?id=
    public function index_get()
    {
        $id = $this->get('id');

        if ($id === null) {
            $data = $this->Alat_model->get_all();
        } else {
            $data = $this->Alat_model->get_by_id($id);
        }

        if ($data) {
            $this->response([
                'status' => true,
                'data'   => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status'  => false,
                'message' => 'Data alat tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    // POST: tambah alat baru
    public function index_post()
    {
        $data = [
            'kategori_id' => $this->post('kategori_id'),
            'nama_alat'   => $this->post('nama_alat'),
            'deskripsi'   => $this->post('deskripsi'),
            'harga_sewa'  => $this->post('harga_sewa'),
            'stok'        => $this->post('stok'),
            'kondisi'     => $this->post('kondisi'),
        ];

        if ($this->Alat_model->insert($data)) {
            $this->response([
                'status'  => true,
                'message' => 'Alat berhasil ditambahkan'
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status'  => false,
                'message' => 'Gagal menambahkan alat'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    // PUT: edit alat (butuh ?id=)
    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'nama_alat'  => $this->put('nama_alat'),
            'harga_sewa' => $this->put('harga_sewa'),
            'stok'       => $this->put('stok'),
        ];

        if ($this->Alat_model->update($id, $data)) {
            $this->response([
                'status'  => true,
                'message' => 'Alat berhasil diperbarui'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status'  => false,
                'message' => 'Gagal memperbarui / tidak ada perubahan'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    // DELETE: hapus alat (butuh ?id=)
    public function index_delete()
    {
        $id = $this->delete('id');

        if ($this->Alat_model->delete($id)) {
            $this->response([
                'status'  => true,
                'message' => 'Alat berhasil dihapus'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status'  => false,
                'message' => 'Data alat tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
}