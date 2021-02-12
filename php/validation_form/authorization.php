<?php
require_once "../functions.php";

$email = $_POST["_email"];
$password = $_POST['_password'];
$remember_me = $_POST['remember_me'];

$link = mysqli_connect("localhost", "root", "", "foodday");
$sql = "SELECT * FROM `users` WHERE ( `_email` Like '$email' AND `_password` Like '$password')";
$result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));

$user = $result->fetch_assoc();
mysqli_close($link);

if (count($user) != 0) {

    $timeA = 1;
    if ($remember_me) $timeA = 30;
    
    setcookie('Authorized', 'true', time()+3600*24*$timeA, "/");
    setcookie('ID', $user['id'], time()+3600*24*$timeA, "/");
    setcookie('Login', $user['_login'], time()+3600*24*$timeA, "/");
    setcookie('Password', $user['_password'], time()+3600*24*$timeA, "/");
    setcookie('Email', $user['_email'], time()+3600*24*$timeA, "/");
    setcookie('Phone', $user['_phone'], time()+3600*24*$timeA, "/");
    setcookie('AccountType', $user['account_type'], time()+3600*24*$timeA, "/");

    header("Location: /");
}
else header("Location: /");

?>