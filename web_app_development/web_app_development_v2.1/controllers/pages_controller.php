<?php
require_once('controllers/base_controller.php');

class PagesController extends BaseController
{
    function __construct()
    {
        $this->folder = 'pages';
    }

    public function home()
    {
        if( !isset( $_SESSION['username'] ) ) {
            $this->folder = 'authen';
            $this->render('form');
        }
        else {
            $data = array (
                'fullname' => $_SESSION['fullname']
            );
            $this->render('home',$data);
        }
        
    }

    public function error()
    {
        $this->render('error');
    }
}
?>