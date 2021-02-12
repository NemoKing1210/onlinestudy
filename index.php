<?php require_once "php/functions.php";
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

    <link rel="shortcut icon" href="images/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">


</head>

<body onload="loadData();" onresize="onResizeWindow();">

    <div id="root">

        <!--------------------------------------- HEADER ------------------------------------->

        <header id="header">
            <?php require_once "modules/header.php"?>
        </header>


        <!--------------------------------------- CONTENT ------------------------------------->

        <main id="content" class="container-xl p-0">

            <div class="content-top-img"></div>


            <div class="p-4">
                <div class="alert alert-secondary">
                    <h4 class="alert-heading">Lorem, ipsum.</h4>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo cum placeat, adipisci beatae,
                        accusantium, dignissimos laboriosam illo nulla ex quibusdam facilis. Debitis quidem sint vel, ea
                        error, facilis assumenda fugiat animi fuga placeat minima. Magni expedita, libero nisi vitae
                        ullam, aspernatur repellat impedit vel, necessitatibus placeat odio aut error optio!</p>
                    <hr>
                    <p class="mb-0">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus, incidunt.</p>
                    <a class="btn btn-success mt-3" href="pages/reg.php">
                        Перейти к регистрации
                    </a>
                </div>
            </div>



        </main>


        <!--------------------------------------- FOOTER ------------------------------------->

        <?php require_once "modules/footer.php"?>

        <button id="btn-goup" class="btn-goup">
            <img class="btn-goup__img" src="/img/icons/goup.png" alt="">
        </button>

    </div>

    <!--------------------------------------- SCRIPT ------------------------------------->

    <script src="js/js.cookie.js"></script>
    <script src="js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>

</body>

</html>