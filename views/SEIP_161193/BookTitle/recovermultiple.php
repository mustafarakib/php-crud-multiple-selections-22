<?php
require_once("../../../vendor/autoload.php");

use App\Message\Message;
use App\Utility\Utility;
use \App\BookTitle\BookTitle;

if(isset($_POST['mark'])) {
    $objBookTitle = new BookTitle();
    $objBookTitle->recoverMultiple($_POST['mark']);

    Utility::redirect("index.php?Page=1");
}

else {
    Message::message("Empty Selection! Please select some records.");
    Utility::redirect("trashed.php");
}
