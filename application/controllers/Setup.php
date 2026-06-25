<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller
{
    public function buat_admin()
    {
        $this->load->model('User_model');

        // cek dulu, jangan bikin dobel kalau udah ada
        if ($this->User_model->get_by_email('admin@rental.com')) {
            echo 'Akun admin sudah ada.';
            return;
        }

        $data = [
            'nama'     => 'Administrator',
            'email'    => 'admin@rental.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role'     => 'admin',
        ];
        $this->User_model->insert($data);

        echo 'Akun admin berhasil dibuat! Email: admin@rental.com / Password: admin123';
    }
}