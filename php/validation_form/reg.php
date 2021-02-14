<?php
require_once "../functions.php";

$REQUEST = file_get_contents('php://input');
$DATA    = (array) json_decode($REQUEST);

$name             = $DATA["_name"];
$email            = $DATA["_email"];
$login            = $DATA["_login"];
$phone            = $DATA['_phone'];
$password         = $DATA['_password'];
$password_confirm = $DATA['_password_confirm'];
$org_type         = $DATA['_org_type'];
$acc_type         = "admin";

if ($password == $password_confirm) {
    $link = connect_mysql(HOST, USER, PASSWORD, BD);
    $sql = "SELECT * FROM `admin` WHERE ( `_login` LIKE '$login' AND `_email` LIKE '$email' )";
    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));

    $array = $result->fetch_assoc();

    if (count($array) == 0) {
        $sql = "INSERT INTO `admin` ( `_name` , `_login` , `_email` , `_phone` , `_password` , `_org_type` , `_acc_type`) VALUES ('$name' , '$login' , '$email' , '$phone' , '$password' , '$org_type' , '$acc_type')";
        $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));

        sendReply(toArray("reply", true)); 
    } else {
        sendReply(toArray("reply", false)); 
    }
    
    mysqli_close($link);
}
else sendReply(toArray("reply", false)); 


?>