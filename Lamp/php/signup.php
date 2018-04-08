<?php
$server = "localhost";
$suname = "user123";
$spassword = "12345";
$database = "Lamp";

$email = $_POST["email"];
$password = $_POST["password"];
$fname = $_POST["first_name"];
$lname = $_POST["last_name"];
$phone = $_POST["phone_name"];
$pwd = password_hash($password,PASSWORD_DEFAULT);

$connect = new mysqli($server,$suname,$spassword,$database);

$c = 1;
function consolelog($value){
    echo '<script>';
    echo "console.log('$value')";
    echo '</script>';
    // echo "$value";
}

if($connect->connect_error){
    echo "Connection Error".$connect->connect_error;
}
$usersql = "INSERT INTO user(email) VALUES('$email')";

if($connect->query($usersql)===TRUE){
    consolelog("Query successful");
}else{
    consolelog("Query unsuccessful".$connect->error);
    $c = 0;
}
$userid = "SELECT id from user where email='$email'";

$id = $connect->query($userid);
if($id === FALSE){
    consolelog($connect->error);
    $c = 0;
    
}
else{
    while($uid=$id->fetch_assoc()){
        $rid = $uid["id"];
        $detailsql = "INSERT into user_details(userid,pass,firstname,lastname,phone_no) VALUES('$rid','$pwd','$fname','$lname','$phone')";
        if($connect->query($detailsql)===FALSE){
            consolelog($connect->error);
            $c = 0;
        }else{
            consolelog("Insertion success");
        }
    }
    if($c === 1){
        header("Location:/signupsuccess.html");
    }
}

$connect->close();