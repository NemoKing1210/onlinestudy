<?php require_once "../php/functions.php";
$Authorized = $_COOKIE["Authorized"];
$ONLYUSER = false;
if ($Authorized == null || $Authorized == "false") {$Authorized = false;} else { $Authorized = true;}
if ($ONLYUSER && !$Authorized) header("Location: /");
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Авторизация</title>
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

        <main id="content" class="container-xl p-4 bg-transparent">

            <form id="login-form" class="box box__login p-4" action="../php/validation_form/login.php" method="POST">
                <h5 class="h5 text-center font-weight-bold">Войти в аккаунт</h5>

                <hr>

                <div class="form-group">
                    <label>Тип аккаунта</label>
                    <select class="form-control input-contrast" name="_type">
                        <option value="1" selected>Администратор</option>
                        <option value="2">Пользователь</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control input-contrast" name="_login" placeholder="Логин">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control input-contrast" name="_password" placeholder="Пароль">
                    <small class="form-text text-muted">Никому не говорите свой пароль</small>
                </div>

                <div class="form-group">
                    <input class="btn btn-success btn-block" onclick="" type="submit" value="Войти">
                </div>

                <div class="form-group mb-3">
                    <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="_remember_me"
                            id="customControlAutosizing">
                        <label class="custom-control-label" for="customControlAutosizing">Запомнить меня</label>
                    </div>
                </div>

                <div id="danger_alert-login" class="alert alert-danger d-none" role="alert"></div>

                <hr>

                <div class="mx-auto">
                    Ещё нет учётной записи? <a href="reg.php">Зарегистрируйтесь</a>
                </div>

            </form>

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