<?php
require_once('controllers/base_controller.php');
require_once('models/user.php');

class AuthenController extends BaseController
{
    function __construct()
    {
        $this->folder = 'authen';
    }

    function signup() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['uname'];
            $password = $_POST['passwd'];
            $email = $_POST['email'];
            $fullname = $_POST['fname'];
            $user = new User($username, $password, $email, $fullname);	
            if (!$user->verifyPasswordLength()) {
                $data = array (
                    'message' => 'Password must be more than 8 characters !!!'
                );
                $this->render('alert',$data);
            }
            elseif(!$user->verifyEmailFormat()) {
                $data = array (
                    'message' => 'Invalid email !!!'
                );
                $this->render('alert',$data);
            }
            elseif($user->verifyUsername()) {
                $user->addUser();
                $data = array (
                    'message' => 'Sign Up sucessfully'
                );
                $this->render('alert',$data);
            }
            else {
                $data = array (
                    'message' => 'Username already exists !!!'
                );
                $this->render('alert',$data);
            }
        }
    }

    function login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['uname'];
            $password = $_POST['passwd'];
            $user = new User($username, $password);
            if($user->login()) {
                $_SESSION['username'] = $user->getUsername();
                $_SESSION['fullname'] = $user->getFullname();
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['avatar'] = $user->getAvatar();
                $controller = 'pages';
                $action = 'home';
                require('routes.php');
            }
            else {

                $data = array (
                    'message' => 'Invalid username or password!!!'
                );
                $this->render('alert',$data);
            }
        }
    }

    function logout() {
        session_destroy();
        $this->render('form');
    }
}


?>