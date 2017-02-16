<?php
require_once("../../../vendor/autoload.php");
use \App\BookTitle\BookTitle;

$objBookTitle = new BookTitle();

$objBookTitle->setData($_GET);

$objBookTitle->trash();
