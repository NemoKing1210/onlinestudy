<?php
$Authorized = $_COOKIE["Authorized"];
if ($Authorized == null || $Authorized == "false") {$Authorized = false;} else { $Authorized = true;}
?>

<div id="navbar" class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="../index.php">
        <img src="/img/logo/logo.png" height="40" class="d-inline-block align-top" alt="" loading="lazy">
        <p class="navbar-brand h1 m-auto">OnlineStudy</p>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">

        <div class="navbar-nav mr-auto">
            <a class="nav-link" href="../index.php">Главное</a>
            <a class="nav-link" href="../pages/about.php">О нас</a>
            <a class="nav-link" href="../pages/news.php">Новости</a>
            <?php if ($Authorized == false): ?>
            <a class="nav-link" href="../pages/reg.php">Регистрация</a>
            <?endif;?>

        </div>

        <?php

        if ($Authorized == false):
        ?>
        <div>
            <a class="btn btn-outline-light" href="">Войти</a>
        </div>

        <?php else: ?>
        <div>
            <a class="btn btn-outline-light" href="">Выйти</a>
        </div>
        <?php endif;?>

    </div>
</div>