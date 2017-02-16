<?php
require_once("../../../vendor/autoload.php");

use \App\BookTitle\BookTitle;
use App\Message\Message;
use App\Utility\Utility;

if(isset($_POST['mark'])) {
    $objBookTitle= new BookTitle();
    $objBookTitle->trashMultiple($_POST['mark']);
        Utility::redirect("trashed.php?Page=1");
}

else {
    Message::message("Empty Selection! Please select some records.");
    Utility::redirect("index.php");
}
