<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    // tampilkan form login
    public function index()
    {
        // kalau sudah login sebagai admin, langsung ke dashboard
        if ($this->session->userdata('role') === 'admin') {
            redirect('admin/dashboard');
        }
        $this->load->view('admin/login');
    }

    // proses login
    public function proses()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->User_model->get_by_email($email);

        // cek: user ada, password cocok, DAN rolenya admin
        if ($user && password_verify($password, $user->password) && $user->role === 'admin') {
            $this->session->set_userdata([
                'user_id' => $user->id,
                'nama'    => $user->nama,
                'role'    => $user->role,
            ]);
            redirect('admin/dashboard');
        } else {
            $this->session->set_flashdata('error', 'Email atau password salah, atau Anda bukan admin.');
            redirect('admin/auth');
        }
    }

    // logout
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin/auth');
    }
}