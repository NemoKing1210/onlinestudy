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
            <h3 class="h2 m-5">О нас</h3>

            <div class="news-container__header m-5">

                <a> Узнайте больше о команде, поддерживающей OnlineStudy! О том, как и почему начался проект, и как
                    принять участие.<a>
            </div>

            <div class="news-container__title m-5 ">Команда</div>
            <div class="news-container__header m-5">

                <a> OnlineStudy поддерживается небольшой командой разработчиков. Мы активно работаем над расширением
                    этой команды и будем рады услышать от вас, если вы заинтересованы в улучшении качества сервиса. <a>

            </div>

            <div class="news-container__title m-5 ">История</div>
            <div class="news-container__header m-5">

                <a> Проект задумывался для улучшения локальной университетской системы онлайн-обучения. В период
                    пандемии была возможность опробовать всю мощность локальных и самых популярных платформ, которые
                    позволяют воспроизвести процесс рабочьей деятельности удаленно. Проект должен был включать в себя
                    универсальную модель взаимодействия с пользователем, которая достигается путем предоставления разных
                    структурно представленных баз данных. Амбициозная цель была частично воплощена в альфа версии
                    онлайн-сервиса в феврале 2021 года... <a>

            </div>

            <div class="news-container__title m-5 ">Ваш вклад</div>
            <div class="news-container__header m-5">

                <a> Если у вас есть замечания или предложения по поводу нашего сервиса OnlineStudy вы можете связаться с
                    нами через Email или Discord. <a>
            </div>
            <div class="news-container__card news-container__header m-4">
                <a>@: Vincent.Freeman@list.ru <a>
            </div>
            <div class="news-container__card m-4">
                <a>@: qwertysvbo@gmail.com <a>
            </div>
            <div class="news-container__card m-4">
                <a>Discord: https://discord.gg/XRDrdksfW8 <a>
            </div>




        </main>


        <!--------------------------------------- FOOTER ------------------------------------->

        <?php require_once "../modules/footer.php"?>

        <button id="btn-goup" class="btn-goup">
            <img class="btn-goup__img" src="/img/icons/goup.png" alt="">
        </button>

    </div>

    <!--------------------------------------- SCRIPT ------------------------------------->

    <script src="../js/js.cookie.js"></script>
    <script src="../js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>

</body>

</html>