<?php
require 'connectDB.php';

class User {
    private $username;
    private $password;
    private $email;
    private $fullname;

    // Initialization function
    public function __construct($username, $password, $email = "Unknow", $fullname = "Unknow") {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->fullname = $fullname;
    }

    // Save user information to db, use mysqli in procedural style
    public function save() {
        $conn = connectDB();
        $sql = "INSERT INTO users(username, password, fullname, email) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        $hash_password = md5($this->password);
        mysqli_stmt_bind_param($stmt, "ssss", $this->username, $hash_password, $this->fullname, $this->email);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            return(TRUE);
        } else {
            return(FALSE);
        }
    }

    // Check if username already taken
    public function verifyUsername() {
        $conn = connectDB();
        $sql = "SELECT 1 FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $this->username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            return(FALSE);
        }
        return(TRUE);

    }
    // Verify username and password to login, use mysqli in object-oriented style
    public function login() {
        $conn = connectDB();
        $sql = "SELECT password, fullname FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $this->username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($hash_password, $fullname);
        $stmt->fetch();
        if ($stmt->num_rows() == 0 || $hash_password != md5($this->password)) {
            return (FALSE);
        }
        session_start();
        $_SESSION['username'] = $this->username;
        $_SESSION['fullname'] = $fullname;
        return(TRUE);
    }


    // Check if password length < 8
    public function verifyPasswordLength() {
        if(strlen($this->password) < 8) {
            return (FALSE);
        }
        return (TRUE);
    }

    // Check if email invalidate
    public function verifyEmailFormat() {
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return (TRUE);
       }
        return (FALSE);

    }

}
?>