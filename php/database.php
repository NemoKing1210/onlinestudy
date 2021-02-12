<?php

define("HOST", "localhost"); 
define("USER", "root"); 
define("PASSWORD", ""); 
define("BD", ""); 

function connect_mysql($HOST = HOST, $USER = USER, $PASSWORD = PASSWORD, $BD = BD) {

    $link = mysqli_connect($HOST, $USER, $PASSWORD, $BD);

    if ($link == false) {
        return false;
    }
    else return $link;

}

//---------------------------------------------------------------------------------------------------------

function resultToArray($result)
{
    $array = array();
    while (($row = $result->fetch_assoc()) != false) {
        $array[] = $row;
    }
    return $array;
}

//---------------------------------------------------------------------------------------------------------

function getTableArrayByAttribute($BD, $TABLE, $ATTRIBUTE, $VALUE, $CONDITION = "==")
{
    $CONDITION = strtolower($CONDITION);
    $link = connect_mysql("localhost", "root", "", $BD);
    $sql;

    if ($CONDITION == "==" or $CONDITION == "like") {
        $sql = "SELECT * FROM $TABLE WHERE ( $ATTRIBUTE LIKE '$VALUE')";
    } elseif ($CONDITION == "!=" or $CONDITION == "<>") {
        $sql = "SELECT * FROM $TABLE WHERE ( $ATTRIBUTE <> '$VALUE')";
    } elseif ($CONDITION == "<") {
        $sql = "SELECT * FROM $TABLE WHERE ( $ATTRIBUTE < '$VALUE')";
    } elseif ($CONDITION == ">") {
        $sql = "SELECT * FROM $TABLE WHERE ( $ATTRIBUTE > '$VALUE')";
    } elseif ($CONDITION == "<=") {
        $sql = "SELECT * FROM $TABLE WHERE ( $ATTRIBUTE <= '$VALUE')";
    } elseif ($CONDITION == ">=") {
        $sql = "SELECT * FROM $TABLE WHERE ( $ATTRIBUTE >= '$VALUE')";
    }
    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));

    mysqli_close($link);

    return resultToArray($result);
}

function getTableArray($BD, $TABLE)
{
    $link = connect_mysql("localhost", "root", "", $BD);
    $sql = "SELECT * FROM $TABLE";
    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));

    mysqli_close($link);

    return resultToArray($result);
}

function checkNoteByAttribute($BD, $TABLE, $ATTRIBUTE, $VALUE)
{
    $link = connect_mysql("localhost", "root", "", $BD);
    $sql = "SELECT * FROM $TABLE WHERE ( $ATTRIBUTE Like '$VALUE' )";
    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));

    mysqli_close($link);
    $array = $result->fetch_assoc();

    if (count($array) > 0) return true;
    else return false;
}

function deleteNoteByAttribute($BD, $TABLE, $ATTRIBUTE, $VALUE)
{
    $link = connect_mysql("localhost", "root", "", $BD);
    $sql = "DELETE FROM $TABLE WHERE $ATTRIBUTE = '$VALUE';";
    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));

    mysqli_close($link);
}

function updateNoteByAttribute($BD, $TABLE, $ATTRIBUTE1, $VALUE1, $ATTRIBUTE2, $VALUE2)
{
    $link = connect_mysql("localhost", "root", "", $BD);
    $sql = "UPDATE $TABLE SET $ATTRIBUTE2 = '$VALUE2' WHERE $ATTRIBUTE1 = '$VALUE1';";
    $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));

    mysqli_close($link);
}

?>