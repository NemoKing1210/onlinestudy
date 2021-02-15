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
                        "Общение" => array("all", "news.php")
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