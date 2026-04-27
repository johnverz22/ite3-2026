<?php

namespace App\Controllers;

use App\Models\User;
use App\Helpers\Validator;

class AuthController extends Controller {
    protected $userModel;

    public function __construct($db) {
        $this->userModel = new User($db);
    }

    // Show the login form
    public function showLoginForm() {
        return $this->render('login');
    }

    // Process the login request
    public function login() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Validate
        Validator::clearErrors();
        Validator::required($username, 'username');
        Validator::required($password, 'password');

        if (Validator::hasErrors()) {
            return $this->render('login', [
                'errors' => Validator::getErrors()
            ]);
        }

        $user = $this->userModel->findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            // Successful login!
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: /ite3/home');
            exit;
        }

        // Failed login
        return $this->render('login', [
            'errors' => ['auth' => 'Invalid username or password!']
        ]);
    }

    // Logout the user
    public function logout() {
        session_destroy();
        header('Location: /ite3/home');
        exit;
    }
}
