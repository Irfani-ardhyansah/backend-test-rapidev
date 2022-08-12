<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class AuthController extends BaseController
{
    public function __construct()
    {
        $this->users    = new User;
    }

    public function index()
    {
        helper(['form']);
        return view('login');
    }
    
    public function auth()
    {
        $session    = session();
        $email      = $this->request->getPost('email');
        $password   = $this->request->getPost('password');
        $data       = $this->users->where('email', $email)->first();
        if($data){
            $pass           = $data['password'];
            $verify_pass    = password_verify($password, $pass);
            if($verify_pass){
                $ses_data = [
                    'id'        => $data['id'],
                    'name'      => $data['name'],
                    'email'     => $data['email'],
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/promotions');
            }else{
        //         $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/');
            }
        }else{
        //     $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
