<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function register(): string
    {
        helper(['form']);
        return view('auth/register');
    }

    public function processRegister()
    {
        helper(['form']);

        $rules = [
            'username'     => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'email'        => 'required|valid_email|is_unique[users.email]',
            'password'     => 'required|min_length[6]',
            'pass_confirm' => 'matches[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();

        $userModel->save([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to('register')->with('success', 'Account created successfully! You can now log in.');
    }
    // 3. Show login form
public function login(): string
{
    helper(['form']);
    return view('auth/login');
}


public function processLogin()
{
    helper(['form']);

    $rules = [
        'email'    => 'required|valid_email',
        'password' => 'required',
    ];

    if (! $this->validate($rules)) {
        return redirect()->back()->withInput()->with('error', 'Please provide a valid email and password.');
    }

    $userModel = new UserModel();
    $user = $userModel->where('email', $this->request->getPost('email'))->first();

    
    if (! $user || ! password_verify($this->request->getPost('password'), $user['password'])) {
        return redirect()->back()->withInput()->with('error', 'Invalid email or password.');
    }

    
    session()->set([
        'user_id'    => $user['id'],
        'username'   => $user['username'],
        'email'      => $user['email'],
        'isLoggedIn' => true,
    ]);

    return redirect()->to('dashboard');
}


public function dashboard()
{
    if (! session()->get('isLoggedIn')) {
        return redirect()->to('login')->with('error', 'Please log in first.');
    }

    return view('dashboard');
}


public function logout()
{
    session()->destroy();
    return redirect()->to('login')->with('success', 'Logged out successfully.');
}
}