<?php

setcookie('Authorized', 'true', time()-3600*24*30, "/");
setcookie('Login', $user['_login'], time()-3600*24*30, "/");
setcookie('Password', $user['_password'], time()-3600*24*30, "/");
setcookie('Email', $user['_email'], time()-3600*24*30, "/");
setcookie('Phone', $user['_phone'], time()-3600*24*30, "/");
setcookie('AccountType', $user['account_type'], time()-3600*24*30, "/");
setcookie('ID', $user['account_type'], time()-3600*24*30, "/");

header("Location: /");

?>