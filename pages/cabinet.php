<?php require_once "../php/functions.php";
$Authorized = $_COOKIE["Authorized"];
$ONLYUSER = true;
if ($Authorized == null || $Authorized == "false") {$Authorized = false;} else { $Authorized = true;}
if ($ONLYUSER && !$Authorized) header("Location: /");
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Личный кабинет</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="../img/logo/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body onload="loadData();" onresize="onResizeWindow();">

    <div id="root">

        <div id="popup-container" class="popup-container">
            <div id="popup-body" class="popup-container__body"></div>
        </div>

        <!--------------------------------------- HEADER ------------------------------------->

        <header id="header">
            <?php require_once "../modules/header.php"?>
        </header>


        <!--------------------------------------- CONTENT ------------------------------------->

        <main id="content" class="">
            <?php require_once "../modules/sidebar.php"?>


        </main>


        <!--------------------------------------- FOOTER ------------------------------------->

        <button id="btn-goup" class="btn-goup"><i class="fas fa-arrow-up"></i></button>

    </div>

    <!--------------------------------------- SCRIPT ------------------------------------->

    <script src="../js/js.cookie.js"></script>
    <script src="../js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>

</body>

</html>