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

        <main id="content" class="container-xl px-5 py-2">
            <h1 class="bd-title">О нас</h1>

            <p class="bd-lead"> Узнайте больше о команде, поддерживающей OnlineStudy! О том, как и почему начался
                проект, и как
                принять участие.
            </p>

            <h3 class="h3 mt-5">Команда</h3>
            <p>
                OnlineStudy поддерживается небольшой командой разработчиков. Мы активно работаем над расширением
                этой команды и будем рады услышать от вас, если вы заинтересованы в улучшении качества сервиса.
            </p>

            <h3 class="h3 mt-4">История</h3>
            <p>
                Проект задумывался для улучшения локальной университетской системы онлайн-обучения. В период
                пандемии была возможность опробовать всю мощность локальных и самых популярных платформ, которые
                позволяют воспроизвести процесс рабочьей деятельности удаленно. Проект должен был включать в себя
                универсальную модель взаимодействия с пользователем, которая достигается путем предоставления разных
                структурно представленных баз данных. Амбициозная цель была частично воплощена в альфа версии
                онлайн-сервиса в феврале 2021 года...
            </p>

            <h3 class="h3 mt-4">Ваш вклад</h3>
            <p>
                Если у вас есть замечания или предложения по поводу нашего сервиса OnlineStudy вы можете связаться с
                нами через Email или Discord.
            </p>

            <div class="callout callout-info mb-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">@: Vincent.Freeman@list.ru</li>
                    <li class="list-group-item">@: qwertysvbo@gmail.com</li>
                    <li class="list-group-item">Discord: https://discord.gg/XRDrdksfW8</li>
                </ul>
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