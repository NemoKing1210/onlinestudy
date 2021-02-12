<?php
require_once "database.php";

//---------------------------------------------------------------------------------------------------------

function console_log($data)
{
    if (is_array($data) || is_object($data)) {
        echo ("<script>console.log('PHP [array]:'," . json_encode($data) . ");</script>");
    } else {
        echo ("<script>console.log('PHP [string]: " . $data . "');</script>");
    }
}

function toArray(...$elements)
{
    $mainArray = array();
    $lastElem;
    $elemV = true;
    foreach ($elements as $elem) {
        if ($elemV) {
            $mainArray[$elem] = '';
            $lastElem = $elem;
            $elemV = false;
        } else {
            $mainArray[$lastElem] = $elem;
            $elemV = true;
        }
    }
    return $mainArray;
}

$sendReplyConst = true;
function sendReply($text)
{
    global $sendReplyConst;
    if ($sendReplyConst) {
        $sendReplyConst = false;
        echo json_encode($text);
    }
}

//---------------------------------------------------------------------------------------------------------

?>