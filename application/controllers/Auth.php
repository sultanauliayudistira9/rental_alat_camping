<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    // form register
    public function register()
    {
        $this->load->view('auth/register');
    }

    // proses register
    public function simpan_register()
    {
        $email = $this->input->post('email');

        // cek email sudah dipakai belum
        if ($this->User_model->get_by_email($email)) {
            $this->session->set_flashdata('error', 'Email sudah terdaftar.');
            redirect('auth/register');
            return;
        }

        $data = [
            'nama'     => $this->input->post('nama'),
            'email'    => $email,
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'no_hp'    => $this->input->post('no_hp'),
            'role'     => 'penyewa',
        ];
        $this->User_model->insert($data);

        $this->session->set_flashdata('sukses', 'Pendaftaran berhasil! Silakan login.');
        redirect('auth/login');
    }

    // form login
    public function login()
    {
        $this->load->view('auth/login');
    }

    // proses login
    public function proses_login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->User_model->get_by_email($email);

        // cek: user ada, password cocok, DAN rolenya penyewa
        if ($user && password_verify($password, $user->password) && $user->role === 'penyewa') {
            $this->session->set_userdata([
                'user_id' => $user->id,
                'nama'    => $user->nama,
                'role'    => $user->role,
            ]);
            redirect('home');
        } else {
            $this->session->set_flashdata('error', 'Email atau password salah.');
            redirect('auth/login');
        }
    }

    // logout
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('home');
    }
}