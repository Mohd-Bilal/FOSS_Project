<?php
$server = "localhost";
$susername = "user123";
$spassword = "12345";
$database = "Lamp";

$connect = new mysqli($server,$susername,$spassword,$database);
if($connect->connect_error){
    consolelog("Connection error");
}else{
    consolelog("Connection established");
}
$email = $_POST["email"];
$password = $_POST["password"];

$sql = "SELECT email,pass from user u,user_details ud where u.id=ud.userid and u.email='$email'";
function consolelog($error){
    echo "<script>";
    echo "console.log('$error')";
    echo "</script>";
    // echo "$error";
}
$result = $connect->query($sql);
if($result === FALSE){ 
    consolelog("SQL Error:".$result);
   }else{
    while($rows = $result->fetch_assoc()){
        if(password_verify($password,$rows["pass"])){
            consolelog("Success logged in");
            header("Location:/loginsuccess.html");
        }
        else{
            consolelog("Wrong password");
            header("Location:/loginfailed.html");
        }
}
}