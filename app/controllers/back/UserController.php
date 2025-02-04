<?php

namespace App\Controllers\back;

use App\Core\Controller;
use App\Models\User;
use App\Core\Auth;

class UserController extends Controller {

    public function register()
    {
        $this->view('front/register');
    }
    public function login()
    {
        $this->view('front/register');
    }

    public function handleRegister()
    {
        var_dump($_POST);

        if (isset($_POST['submit'])) {
            $username = $_POST['name']; 
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $user = new User();
            $user->username = $username;
            $user->email = $email;
            $user->password = $hashedPassword;
            $user->role = $role;
            $user->save();
            
            header('Location: /login');
            exit;
        }
    }
}
