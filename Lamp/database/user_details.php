<?php

$server = "localhost";
$username = "user123";
$password = "12345";
$database = "Lamp";

$conn = new mysqli($server,$username,$password,$database);
if($conn->connect_error){
    echo "Connection Error".$conn->connect_error;
}
$sql = "CREATE TABLE user_details(
        userid INT PRIMARY KEY,
        pass VARCHAR(60) NOT NULL,
        firstname VARCHAR(10) NOT NULL,
        lastname VARCHAR(10) NOT NULL,
        phone_no VARCHAR(10) ,
        FOREIGN KEY(userid) REFERENCES user(id)
)";

if($conn->query($sql)===TRUE){
    echo "Table succesfully created";
}else{
    echo "Error ".$conn->error;
}
$conn->close();