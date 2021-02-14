<?php require_once "../php/functions.php";
$Authorized = $_COOKIE["Authorized"];
$ONLYUSER = false;
if ($Authorized == null || $Authorized == "false") {$Authorized = false;} else { $Authorized = true;}
if ($ONLYUSER && !$Authorized) header("Location: /");
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Главное</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="../img/logo/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">


</head>

<body onload="loadData();" onresize="onResizeWindow();">

    <div id="root">

        <!--------------------------------------- HEADER ------------------------------------->

        <header id="header">
            <?php require_once "../modules/header.php"?>
        </header>


        <!--------------------------------------- CONTENT ------------------------------------->

        <main id="content" class="container-xl p-4">
            <h3 class="h3 m-3">Новости OnlineStudy</h3>


            <div class="news-container__card">
                <div class="news-container__header">
                    <div class="news-container__title">Никогда не было и вот опять</div>
                    <div class="new-container__date">14.02.2021</div>
                </div>
                <div class="new-container__body"> Сегодня стартует процесс второго рождения легендарного проекта
                    OnlineStudy. Рано или поздно
                    отпадет
                    острая необходимость в Онлайн-работе/обучении/времяпрепровождении, но отсутствие необходимости не
                    должно
                    стать причиной отказа от такой системы. Этот проект посвящается всем трудолюбивым домоседам.
                    В версии 0.056 предлагается ознакомиться с визуалом, попробовать ввести данные регистрации, а также
                    переодически
                    следить за новостной лентой.
                </div>
            </div>

            <div class="news-container__card">
                <div class="news-container__header">
                    <div class="news-container__title">Когда-то уже было и вот снова</div>
                    <div class="new-container__date">15.02.2021</div>
                </div>
                <div class="new-container__body"> В версии 0.057 предлагается ознакомиться с интерфейсом администратора,
                    получить доступ к созданию
                    учебных групп и
                    добавлению аккаунтов. Есть несколько типов аккаунтов: ученик, учитель и администратор. Администратор
                    добавляет аккаунты
                    учеников и учителей, определяет все организационные моменты при помощи готового инструментария
                    внутри системы.
                </div>

            </div>






        </main>


        <!--------------------------------------- FOOTER ------------------------------------->

        <?php require_once "../modules/footer.php"?>

        <button id="btn-goup" class="btn-goup"><i class="fas fa-arrow-up"></i></button>

    </div>

    <!--------------------------------------- SCRIPT ------------------------------------->

    <script src="../js/js.cookie.js"></script>
    <script src="../js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>

</body>

</html>