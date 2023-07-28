<?php
// function connectDB() {
//     // Thong tin ket noi den DB
//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $dbname = "web_app_development";

//     // Tao ket noi den DB
//     $conn = mysqli_connect($servername, $username, $password, $dbname);

//     if ($conn->connect_error) {
//         die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
//     }
//     return $conn;
// }
class DB {
    public function connectDB() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "web_app_development";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        return $conn;    
    }
}
?>
