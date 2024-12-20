<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\JWTHandler;
use App\Models\RoleModel;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $jwt;
    protected $db;
    public function __construct()
    {    $this->db = \Config\Database::connect();
        $this->jwt = new JWTHandler();
    }

    public function index(){
     
        return view('login');
    }

    public function login()
    {
        $email = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid credentials']);
        }

        $time=date('Y-m-d H:i:s');
        updateLastLogin($this->db,$user['id'],$time);
        $token = $this->jwt->generateToken(['id' => $user['id'], 'email' => $user['email'], 'role'=> $user['role']]);


        $roleModel = new RoleModel();
        $roleData = $roleModel->where('id', $user['role'])->first();

        $ses_data = [
            'user_id'       => $user['id'],
            'first_name'     => $user['first_name'],
            'last_name'    => $user['last_name'],
            'email'  => $user['email'],
            'role_name' =>$roleData['role_name'],
            'role_id' =>$user['role'],
            'profile_img'  => $user['profile_img'],
            'last_login' => $user['last_login'],
            'logged_in'     => TRUE
        ];
        session()->set($ses_data);

        return $this->response->setJSON(['status' => 'success', 'token' => $token]);
    }
    public function userDetails(){
        return loadView('dashboard');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }

}
