<?php
require_once "functions.php";

// -----------------------------------------------

$REQUEST = file_get_contents('php://input');
$DATA = (array) json_decode($REQUEST);
$FUNCTION = $DATA["FUNCTION"];

$FUNC_LIST = array(
    'addNewUser',
);

$searchFunc = false;
for ($i = 0; $i < count($FUNC_LIST); $i++) {
    if ($FUNC_LIST[$i] == $FUNCTION) {
        $searchFunc = true;
        $func = $FUNCTION;
        $func($DATA);
    }
}
if (!$searchFunc) {
    sendReply(false);
}

// !-----------------------------------------------------------------------------------------

function createRandomLoginAndPassword($DATA) {
    $symbolEN = "qwertyuiopasdfghjklzxcvbnm";
    $matchingEN_RU = array(
        "q" => "кью",
        "w" => "в",
        "e" => "е",
        "r" => "р",
        "t" => "t",
        "y" => "у",
        "u" => "у",
        "i" => "и",
        "o" => "о",
        "p" => "п",
        "a" => "а",
        "s" => "с",
        "d" => "д",
        "f" => "Ф",
        "g" => "г",
        "h" => "х",
        "j" => "ж",
        "k" => "к",
        "l" => "л",
        "z" => "з",
        "x" => "кс",
        "c" => "ц",
        "v" => "в",
        "b" => "б",
        "n" => "н",
        "m" => "м"
    );
    $new_login = (string)$DATA["ID"] . "_";
    $new_password = "";

    for ($i = 0; $i <= 5; $i++) {
        $ch = $symbolEN[rand(0, strlen($symbolEN))];
        $new_login = $new_login . $ch;
    }

    for ($i = 0; $i <= 7; $i++) {
        $r = rand(1,3);
        $ch;
        if ($r == 1) {
            $ch = $symbolEN[rand(0, strlen($symbolEN))];
        }
        elseif ($r == 2) {
            $ch = strtoupper($symbolEN[rand(0, strlen($symbolEN))]);
        }
        else {
            $ch = rand(0,9);
        }
        $new_password = $new_password . $ch;
    }

    $date = date('Y-m-d', time() - 86400);
    $new_login = $new_login.$date;

    return array($new_login, $new_password);
}

function addNewUser($DATA) {
    
    $f_name = $DATA["f-name"];
    $s_name = $DATA["s-name"];
    $d_name = $DATA["d-name"];
    $type_user = $DATA["type-user"];

    $ID = $DATA["ID"];

    if ($s_name == "" || $f_name == "") {
        if (checkNoteByAttribute("onlinestudy", "admin", "id", $ID)) {

            if ($type_user == "1") {
                $added = false;
                $loginAndPassword = createRandomLoginAndPassword($DATA);

                $link = connect_mysql(HOST, USER, PASSWORD, BD);
                $sql    = "SELECT * FROM `admin` WHERE ( `_login` Like '$login' AND `_password` Like '$password')";
                $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
                
                while ($added == false) {



                }

            }
            elseif ($type_user == "2") {

            }
            
    
        }
        else sendReply(toArray("reply", false)); 
    }
    else sendReply(toArray("reply", false)); 

}

// !-----------------------------------------------------------------------------------------



// !-----------------------------------------------------------------------------------------