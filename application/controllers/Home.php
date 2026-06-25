<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Alat_model');
    }

    // halaman depan: katalog alat (bisa dilihat tanpa login)
    public function index()
    {
        $data['alat'] = $this->Alat_model->get_all();
        $this->load->view('home/katalog', $data);
    }
}