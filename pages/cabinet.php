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
            <div class="sidebar">

                <?php
                    $AccountType = $_COOKIE["AccountType"];

                    $array = array(
                        "Учетные записи" => array("admin", "c_accounts.php"),
                        "Рабочие группы" => array("admin", "2"),
                        "Управление расписанием" => array("admin", "3"),
                        "Управление предметами" => array("admin", "4"),
                        "Расписание" => array("all", "5"),
                        "Задания" => array("all", "6"),
                        "Учебный материал" => array("all", "7"),
                        "Общение" => array("all", "8")
                    );

                    foreach ($array as $key => $value):
                    if ($value[0] == $AccountType || $value[0] == "all"):
                ?>
                <a class="sidebar__button" href="<? echo $value[1]; ?>">
                    <? echo $key; ?>
                </a>
                <? endif; ?>
                <? endforeach; ?>
            </div>


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