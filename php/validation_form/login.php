<?php
require_once "../functions.php";

$login       = $_POST["_login"];
$password    = $_POST['_password'];
$remember_me = $_POST['_remember_me'];
$type        = $_POST['_type'];

$timeA = 1;
if ($remember_me) $timeA = 30;

if ($type == "1") {

$link = connect_mysql(HOST, USER, PASSWORD, BD);
$sql    = "SELECT * FROM `admin` WHERE ( `_login` Like '$login' AND `_password` Like '$password')";
$result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));

$user = $result->fetch_assoc();
mysqli_close($link);

if (count($user) != 0) {
    
    setcookie('Authorized', 'true', time()+3600*24*$timeA, "/");
    setcookie('ID', $user['id'], time()+3600*24*$timeA, "/");
    setcookie('Login', $user['_login'], time()+3600*24*$timeA, "/");
    setcookie('Password', $user['_password'], time()+3600*24*$timeA, "/");
    setcookie('Email', $user['_email'], time()+3600*24*$timeA, "/");
    setcookie('Phone', $user['_phone'], time()+3600*24*$timeA, "/");
    setcookie('AccountType', "admin", time()+3600*24*$timeA, "/");

    header("Location: /");
}
else header("Location: /");

}


// else {

//     $link = connect_mysql(HOST, USER, PASSWORD, BD);
//     $sql    = "SELECT * FROM `learner` WHERE ( `_login` Like '$login' AND `_password` Like '$password')";
//     $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
    
//     $user = $result->fetch_assoc();
//     mysqli_close($link);
    
//     if (count($user) != 0) {
        
//         setcookie('Authorized', 'true', time()+3600*24*$timeA, "/");
//         setcookie('ID', $user['id'], time()+3600*24*$timeA, "/");
//         setcookie('Login', $user['_login'], time()+3600*24*$timeA, "/");
//         setcookie('Password', $user['_password'], time()+3600*24*$timeA, "/");
//         setcookie('Email', $user['_email'], time()+3600*24*$timeA, "/");
//         setcookie('Phone', $user['_phone'], time()+3600*24*$timeA, "/");
//         setcookie('AccountType', "learner", time()+3600*24*$timeA, "/");
    
//         header("Location: /");
//     }
//     else {

//         $link = connect_mysql(HOST, USER, PASSWORD, BD);
//         $sql    = "SELECT * FROM `teacher` WHERE ( `_login` Like '$login' AND `_password` Like '$password')";
//         $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
        
//         $user = $result->fetch_assoc();
//         mysqli_close($link);
        
//         if (count($user) != 0) {
            
//             setcookie('Authorized', 'true', time()+3600*24*$timeA, "/");
//             setcookie('ID', $user['id'], time()+3600*24*$timeA, "/");
//             setcookie('Login', $user['_login'], time()+3600*24*$timeA, "/");
//             setcookie('Password', $user['_password'], time()+3600*24*$timeA, "/");
//             setcookie('Email', $user['_email'], time()+3600*24*$timeA, "/");
//             setcookie('Phone', $user['_phone'], time()+3600*24*$timeA, "/");
//             setcookie('AccountType', "learner", time()+3600*24*$timeA, "/");
        
//             header("Location: /");
//         }
//         else header("Location: /");

//     }

// }

?>