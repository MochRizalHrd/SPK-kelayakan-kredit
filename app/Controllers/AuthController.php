<?php

namespace App\Controllers;

class AuthController extends BaseController
{
   public function view()
    {
        return view('dashboard/login.php');
    }

    public function loginProcess()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Dummy validasi
        if ($username === 'admin' && $password === 'admin123') {
            session()->set('logged_in', true);
            session()->set('username', $username);
            return redirect()->to('/dashboard');
        } else {
            return redirect()->to('/login')->with('error', 'Username atau password salah.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
