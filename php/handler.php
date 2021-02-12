<?php
require_once "functions.php";

// -----------------------------------------------

$REQUEST = file_get_contents('php://input');
$DATA = (array) json_decode($REQUEST);
$FUNCTION = $DATA["FUNCTION"];

$FUNC_LIST = array(
    'addToBasket',
    'changeValueFood',
    'createBasketList',
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

function addToBasket($DATA)
{
    $id_user = (int) $DATA["IdUser"];
    $id_food = (int) $DATA["IdItem"];
    $_num = 1;

    $link = mysqli_connect("localhost", "root", "", "foodday");

    $sql = "SELECT * FROM `basket_list` WHERE ( `user_id` Like '$id_user' AND `food_id` Like '$id_food' )";
    $result = mysqli_query($link, $sql);

    if (!$result->num_rows) {
        $sql = "INSERT INTO `basket_list` ( user_id , food_id , value ) VALUES ( '$id_user' , '$id_food' , '$_num' )";
        $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));

        $sql = "SELECT * FROM basket_list b
            JOIN food_list s ON b.food_id = s.id
            JOIN users a ON b.user_id = a.id
            WHERE ( b.user_id = '$id_user' AND b.food_id = '$id_food' )";
        $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));

        $resultArray = resultToArray($result);

        sendReply(toArray("reply", true, "array", $resultArray));
    } else {
        sendReply(toArray("reply", false));
    }

    mysqli_close($link);

}

// !-----------------------------------------------------------------------------------------

function changeValueFood($DATA)
{
    $id_user = (int) $DATA["IdUser"];
    $id_food = (int) $DATA["IdItem"];
    $t_func = $DATA["Argument"];

    $link = mysqli_connect("localhost", "root", "", "foodday");

    $sql = "SELECT * FROM `basket_list` WHERE ( `user_id` Like '$id_user' AND `food_id` Like '$id_food' )";
    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));

    $resultArray = resultToArray($result)[0];
    $id_item = (int) $resultArray["id"];
    $value_item = (int) $resultArray["value"];

    $ARRAY = json_encode(resultToArray($result));

    if ($result->num_rows) {

        if ($t_func == "minus") {
            if ($value_item <= 1) {
                deleteNoteByAttribute("foodday", "basket_list", "id", $id_item);
                sendReply(toArray("function", "changeValueFood", "reply", "delete", "id", $id_food, "array", $ARRAY));
            } else {
                $new_value = $value_item - 1;
                updateNoteByAttribute("foodday", "basket_list", "id", $id_item, "value", $new_value);
                sendReply(toArray("function", "changeValueFood", "reply", "minus", "id", $id_food, "array", $ARRAY));
            }
        } elseif ($t_func == "plus") {
            $new_value = $value_item + 1;
            updateNoteByAttribute("foodday", "basket_list", "id", $id_item, "value", $new_value);
            sendReply(toArray("function", "changeValueFood", "reply", "plus", "id", $id_food, "array", $ARRAY));
        } elseif ($t_func == "delete") {
            deleteNoteByAttribute("foodday", "basket_list", "id", $id_item);
            sendReply(toArray("function", "changeValueFood", "reply", "delete", "id", $id_food, "array", $ARRAY));
        } else {
            sendReply(false);
        }

    } else {
        sendReply(false);
    }

    mysqli_close($link);

}

// !-----------------------------------------------------------------------------------------

function createBasketList($DATA)
{
    $USER_ID = $DATA["IdUser"];

    $link = mysqli_connect("localhost", "root", "", "foodday");
    $sql = "SELECT * FROM basket_list b
            JOIN food_list s ON b.food_id = s.id
            JOIN users a ON b.user_id = a.id
            WHERE ( b.user_id = '$USER_ID' )";
    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));

    mysqli_close($link);

    $resultArray = resultToArray($result);

    sendReply(toArray("FUNCTION", "createBasketList", "ARRAY", $resultArray));

}