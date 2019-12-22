<?php
$servername = "localhost";
$username = "root";
$password ="";
$dbname = "vuejs";

$conn = new mysqli ($servername,$username,$password,$dbname);

if ($conn->connect_error) {
    die("connection_failed  " . $conn->connect_error);
    }

$result = array();
$action = '';

if(isset($_GET['action'])){
    $action = $_GET['action'];
}

if($action == 'read'){
    $sql = $conn->query("SELECT * FROM user");
    $users = array();
    while($row = $sql->fetch_assoc()){
        array_push($users,$row);
    }
    $result['users'] = $users;
}

if($action == 'create'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phoneNum = $_POST['phoneNum'];
    $sql = $conn->query("INSERT INTO `user` (`id`,`name`,`email`,`address`,`phoneNum`)
    VALUES ('','$name','$email','$address','$phoneNum') ");
    if($sql){
        $result["message"] = "User Added";
    }
    else{
        $result['error'] = true;
        $result["message"] = "User tidak dapat ditambahkan";
    }
}

if($action == 'edit'){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phoneNum = $_POST['phoneNum'];

    $sql = $conn->query("UPDATE `user` SET name = '$name',email = '$email', address = '$address', phoneNum = '$phoneNum'
    WHERE id = '$id' ");
    if($sql){
        $result['message'] = "User Updated";
    }
    else{
        $result['error'] = true;
        $result['message'] = "User tidak dapat diupdate";
    }

}
if($action == 'delete'){
    $id = $_POST['id'];
    $sql = $conn->query("DELETE FROM `user` WHERE id = '$id'");
    if($sql){
        $result['message'] = "User Deleted";
    }
    else{
        $result['error'] = true;
        $result['message'] =  "Gagal untuk Delete";
    }
}
$conn->close();
echo json_encode($result);
?>