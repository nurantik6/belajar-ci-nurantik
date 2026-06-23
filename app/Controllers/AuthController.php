<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    function __construct()
    {
        helper('form');
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if ($this->request->getPost()) {
            $rules = [
                'username' => 'required|min_length[6]',
                'password' => 'required|min_length[7]|numeric',
            ];

            if ($this->validate($rules)) {
                //code pengecekan data user

                $username = $this->request->getVar('username');
                $password = $this->request->getVar('password');

                $dataUser = $this->userModel->where(['username' => $username])->first();

                if ($dataUser) {
                    if (password_verify($password, $dataUser['password'])) {
                        session()->set([
                            'username' => $dataUser['username'],
                            'role' => $dataUser['role'],
                            'isLoggedIn' => TRUE
                        ]);

                        return redirect()->to(base_url('/'));
                    } else {
                        session()->setFlashdata('failed', 'Username & Password Salah');
                        return redirect()->back();
                    }
                } else {
                    session()->setFlashdata('failed', 'Username Tidak Ditemukan');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('failed', $this->validator->listErrors());
                return redirect()->back();
            }
        } else {
            return view('v_login');
        }
    }

    public function google()
    {
        session()->set('register_email', 'contoh.email@gmail.com');
        return redirect()->to(base_url('auth/register_form'));
    }

    // Klik tombol Facebook langsung diarahkan ke form dengan email default simulasi
    public function facebook()
    {
        session()->set('register_email', 'contoh.email@facebook.com');
        return redirect()->to(base_url('auth/register_form'));
    }

    // Menampilkan Form Pendaftaran
    public function register_form()
    {
        $data = [
            'email' => session()->get('register_email') ?? ''
        ];
        return view('register_sosmed', $data);
    }

    // Proses Simpan ke Database
    public function register_submit()
    {
        $db = \Config\Database::connect();
        
        $username = $this->request->getPost('username');
        $email    = $this->request->getPost('email');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $role     = $this->request->getPost('role');

        // Cek jika username ganda
        $cekUser = $db->table('user')->where('username', $username)->get()->getRow();
        if ($cekUser) {
            return redirect()->back()->with('failed', 'Username sudah digunakan, silakan pilih yang lain.');
        }

        $dataSimpan = [
            'username'   => $username,
            'email'      => $email,
            'password'   => $password,
            'role'       => $role,
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Simpan ke tabel user
        $db->table('user')->insert($dataSimpan);

        // Bersihkan session
        session()->remove('register_email');

        return redirect()->to(base_url('login'))->with('success', 'Pendaftaran akun berhasil! Silakan login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
