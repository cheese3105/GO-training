<?php
require_once('controllers/base_controller.php');
require_once('models/user.php');

class ProfileController extends BaseController
{
    function __construct()
    {
        $this->folder = 'pages';
    }

    public function view()
    {
        $data = array (
            'username' => $_SESSION['username'],
            'fullname' => $_SESSION['fullname'],
            'avatar' => $_SESSION['avatar'],
            'email' => $_SESSION['email']
        );
        $this->render('profile',$data);
    }

    public function update()
    {
        if( !isset( $_SESSION['username'] ) ) {
            $this->folder = 'authen';
            $this->render('form');
        }

        if (isset($_POST['submit'])) 
        {
            // get POST value
            $file = $_FILES['uploadfile'];
    
            $fileName = $_FILES['uploadfile']['name'];
            $fileTmpName = $_FILES['uploadfile']['tmp_name'];
            $fileSize = $_FILES['uploadfile']['size'];
            $fileError = $_FILES['uploadfile']['error'];
            $fileType = $_FILES['uploadfile']['type'];

            $fileExt = explode(".",$fileName);
            $fileExt = strtolower(end($fileExt));
            $allowed = array('jpg', 'jpeg', 'png');

            if (in_array($fileExt, $allowed)) // check extension
            {
                if ($fileError === 0) // check error
                {
                    if ($fileSize < 1000000) // check size
                    {
                        // store file with new name
                        $fileNameNew = $_SESSION['username'].".".$fileExt;
                        $fileDestination = 'assets/images/avatars/'.$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        
                        // update path to field avatar
                        $user = new User();
                        $user->setUsername($_SESSION['username']);
                        $user->setAvatar($fileNameNew);

                        if($user->updateAvatar()) {
                            $_SESSION['avatar'] = $user->getAvatar();
                            $this->view();
                        }
                        else
                        {
                            $data = array (
                                'message' => 'Something wrong!'
                            );
                            $this->render('alert',$data);
                        }

                    }
                    else
                    {
                        $data = array (
                            'message' => 'Your file is too big!'
                        );
                        $this->render('alert',$data);
                    }
                }
                else 
                {
                    $data = array (
                        'message' => 'There was an error uploading your file!'
                    );
                    $this->render('alert',$data);
                }

            } 
            else 
            {
                $data = array (
                    'message' => 'You cannot upload files of this type! '
                );
                $this->render('alert',$data);
            }

        }

    }
}