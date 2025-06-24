<?php
/**
 * Author: Jay Jones
 * Date: 6/23/2025
 * File: UserController.php
 * Description:
 */

namespace Capstone\Controller;
use Capstone\Model\UserModel;
use Capstone\View\user\LoginView;
use Capstone\View\user\RegisterView;

class UserController {
    private $user_model;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->user_model = new UserModel();
    }

    // Show registration form
    public function registerForm()
    {
        // Assuming you have a view for registration form
        $view = new RegisterView();
        $view->display();
    }

    // Handle registration submission
    public function register()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $passwordConfirm = $_POST['password_confirm'] ?? '';

        // Basic validation
        if (empty($email) || empty($password) || empty($passwordConfirm)) {
            $_SESSION['error'] = "Please fill all required fields.";
            header("Location: " . BASE_URL . "/user/registerForm");
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Invalid email format.";
            header("Location: " . BASE_URL . "/user/registerForm");
            exit();
        }

        if ($password !== $passwordConfirm) {
            $_SESSION['error'] = "Passwords do not match.";
            header("Location: " . BASE_URL . "/user/registerForm");
            exit();
        }

        if ($this->user_model->emailExists($email)) {
            $_SESSION['error'] = "Email already registered.";
            header("Location: " . BASE_URL . "/user/registerForm");
            exit();
        }

        // Hash password and create user
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        if ($this->user_model->createUser($email, $passwordHash)) {
            $_SESSION['success'] = "Registration successful. Please log in.";
            header("Location: " . BASE_URL . "/user/loginForm");
            exit();
        } else {
            $_SESSION['error'] = "Registration failed. Try again.";
            header("Location: " . BASE_URL . "/user/registerForm");
            exit();
        }
    }

    // Show login form
    public function loginForm()
    {
        $view = new LoginView();
        $view->display();
    }

    // Handle login submission
    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $_SESSION['error'] = "Please fill in both email and password.";
            header("Location: " . BASE_URL . "/user/loginForm");
            exit();
        }

        $user = $this->user_model->verifyCredentials($email, $password);

        if ($user) {
            // Successful login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['success'] = "Welcome, " . htmlspecialchars($user['email']);
            header("Location: " . BASE_URL . "/index");
            exit();
        } else {
            $_SESSION['error'] = "Invalid email or password.";
            header("Location: " . BASE_URL . "/user/loginForm");
            exit();
        }
    }

    // Logout user
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: " . BASE_URL . "/index");
        exit();
    }
}