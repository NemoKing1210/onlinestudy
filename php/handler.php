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

function addNewUser($DATA) {
    
}

// !-----------------------------------------------------------------------------------------



// !-----------------------------------------------------------------------------------------