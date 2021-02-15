<?php require_once "../php/functions.php";
$Authorized = $_COOKIE["Authorized"];
$ONLYUSER = true; $ONLYADMIN = true;
if ($Authorized == null || $Authorized == "false") {$Authorized = false;} else { $Authorized = true;}
if ($ONLYUSER && !$Authorized) header("Location: /");
if ($ONLYADMIN && $_COOKIE["AccountType"] != "admin") header("Location: /");
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

    <script src="../js/js.cookie.js"></script>
    <script src="../js/script.js"></script>
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

        <main id="content" class="content-2">
            <?php require_once "../modules/sidebar.php"?>

            <div class="middle">


                <div class="middle__top-menu">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="cabinet.php">Личный кабинет</a></li>
                            <li class="breadcrumb-item active">Учетные записи</li>
                        </ol>
                    </nav>
                </div>

                <div class="middle__main-content">
                    <div class="middle__main-content-up form-row">

                        <div class="col">
                            <label>Тип пользователя</label>
                            <select class="form-control">
                                <option value="1">Студент</option>
                                <option value="2">Ведущий</option>
                            </select>
                        </div>

                        <div class="col">
                            <label>Рабочая группа</label>
                            <select class="form-control">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>

                        <div class="col-6">
                            <label>Поиск по ФИО</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Поиск</button>
                                </div>
                            </div>
                        </div>



                    </div>

                    <div class="box middle__main-content-center my-4">


                    </div>

                    <div class="middle__main-content-down form-row">

                        <div class="col">
                            <input type="text" class="form-control" placeholder="Фамилия">
                        </div>

                        <div class="col">
                            <input type="text" class="form-control" placeholder="Имя">
                        </div>

                        <div class="col">
                            <input type="text" class="form-control" placeholder="Отчество">
                        </div>

                        <div class="col input-group">
                            <select class="form-control">
                                <option value="1">Студент</option>
                                <option value="2">Ведущий</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary btn-block" onclick="addNewUser();">Добавить</button>
                            </div>
                        </div>

                    </div>

                </div>

        </main>


        <!--------------------------------------- FOOTER ------------------------------------->

        <button id="btn-goup" class="btn-goup"><i class="fas fa-arrow-up"></i></button>

    </div>

    <!--------------------------------------- SCRIPT ------------------------------------->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>

</body>

</html>