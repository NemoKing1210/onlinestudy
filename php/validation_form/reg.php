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
$accountType      = "admin";

$link    = mysqli_connect("localhost","root", "", "foodday");
$registr = checkNoteByAttribute("foodday", "users", "_email", $email);

if ($registr == false) {
    $sql = "INSERT INTO `users` ( `_login` , `_password` , `_email` , `_phone` , `account_type`) VALUES ('$login' , '$password' , '$email' , '$phone' , '$accountType')";
    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
    mysqli_close($link);

    sendReply(toArray("reply", true)); 
}
else {
    mysqli_close($link);
    sendReply(toArray("reply", false)); 
}

?>