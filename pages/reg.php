<?php require_once "../php/functions.php";
$Authorized = $_COOKIE["Authorized"];
$ONLYUSER = false;
if ($Authorized == null || $Authorized == "false") {$Authorized = false;} else { $Authorized = true;}
if ($ONLYUSER && !$Authorized) header("Location: /");
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Регистрация</title>
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

            <div class="box box__reg">

                <h3 class="h3 m-3">Регистрация нового учреждения</h3>

                <hr>

                <form id="reg-form" class="p-3">

                    <div class="form-group">
                        <label>Название вашего учреждения</label>
                        <input type="text" class="form-control input-contrast" name="_name" validation
                            data-reg-type="name">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group">
                        <label>Имя администратора</label>
                        <input type="text" class="form-control input-contrast" name="_login" validation
                            data-reg-type="login">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-row mb-3">

                        <div class="col">
                            <label>Электронная почта</label>
                            <input type="text" class="form-control input-contrast" name="_email" validation
                                data-reg-type="email">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col">
                            <label>Номер телефона</label>
                            <input type="text" class="form-control input-contrast" name="_phone" validation
                                data-reg-type="phone">
                            <div class="invalid-feedback"></div>
                        </div>

                    </div>

                    <div class="form-row mb-3">

                        <div class="col">
                            <label>Пароль</label>
                            <input type="password" class="form-control input-contrast" name="_password" validation
                                data-reg-type="password">
                            <div class="invalid-feedback"></div>

                        </div>

                        <div class="col">
                            <label>Подтверждение пароля</label>
                            <input type="password" class="form-control input-contrast" name="_password_confirm"
                                validation data-reg-type="password_confirm">
                            <div class="invalid-feedback"></div>

                        </div>

                    </div>

                    <div class="form-row align-items-end mb-2">

                        <div class="col-6">
                            <label>Тип учреждения</label>
                            <select class="form-control input-contrast" name="_org_type">
                                <option value="1" selected>Университет</option>
                            </select>
                        </div>

                        <div class="col-auto">
                            <input class="btn btn-outline btn-block" type="button" value="Создать аккаунт" validation
                                data-reg-type="submit">
                        </div>
                        <div class="col-auto">
                            <input class="btn btn-outline-danger btn-block" type="reset" value="Очистить">
                        </div>

                    </div>

                </form>

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