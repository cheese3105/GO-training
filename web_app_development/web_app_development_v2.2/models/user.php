<?php

class User {
    private $username;
    private $password;
    private $email;
    private $fullname;
    private $avatar;

    // Initialization function
    public function __construct($username = "Unknown", $password ="Unknown", $email = "Unknown", $fullname = "Unknown", $avatar = "default.jpg") {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->fullname = $fullname;
        $this->avatar = $avatar;
    }

    // Save user information to db, use mysqli in procedural style
    public function addUser() {
        $conn = (new DB)-> connectDB();
        $sql = "INSERT INTO users(username, password, fullname, email, avatar) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        $hash_password = md5($this->password);
        mysqli_stmt_bind_param($stmt, "sssss", $this->username, $hash_password, $this->fullname, $this->email, $this->avatar);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            return(TRUE);
        } else {
            return(FALSE);
        }
    }

    // Check if username already taken
    public function verifyUsername() {
        $conn = (new DB)-> connectDB();
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
        $conn = (new DB)-> connectDB();
        $sql = "SELECT password, fullname, email, avatar FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $this->username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($hash_password, $this->fullname, $this->email, $this->avatar);
        $stmt->fetch();
        if ($stmt->num_rows() == 0 || $hash_password != md5($this->password)) {
            return (FALSE);
        }
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

    // Upload path to avatar field
    public function updateAvatar() {
        $conn = (new DB)-> connectDB();
        $sql = "UPDATE users SET avatar = ? WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $this->avatar, $this->username);
        $stmt->execute();
        return TRUE;
    }
    
    /**
     * Get the value of fullname
     */ 
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the value of avatar
     */ 
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set the value of avatar
     *
     * @return  self
     */ 
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }
}
?>