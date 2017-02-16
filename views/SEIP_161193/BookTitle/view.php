<?php
require_once("../../../vendor/autoload.php");

$objBookTitle = new \App\BookTitle\BookTitle();
$objBookTitle->setData($_GET);
$oneData = $objBookTitle->view();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Title - Single Book Information</title>
    <link rel="stylesheet" href="../../../resource/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../resource/bootstrap/css/bootstrap-theme.min.css">
    <script src="../../../resource/bootstrap/js/bootstrap.min.js"></script>
    <style>
        td{
            border: 0;
        }
        table{
            border: 1px;
        }
        tr{
            height: 30px;
        }
    </style>
</head>

<body>
<div class="container">
    <h1 style="text-align: center" ;">Book Title - Single Book Information</h1>

    <table class="table table-striped table-bordered" cellspacing="0px">
        <tr>
            <th style='width: 10%; text-align: center'>ID</th>
            <th>Book Name</th>
            <th>Author Name</th>
            <th>Action Buttons</th>
        </tr>

        <?php

            echo "
                  <tr >
                     <td style='width: 10%; text-align: center'>$oneData->id</td>
                     <td>$oneData->book_name</td>
                     <td>$oneData->author_name</td>
                     <td><a href='index.php' class='btn btn-info'>Back To Active List</a> </td>
                  </tr>
              ";
        ?>

    </table>
</div>

<script src="../../../resource/bootstrap/js/jquery.js"></script>
<script>
    jQuery(function($) {
        $('#message').fadeOut (550);
        $('#message').fadeIn (550);
        $('#message').fadeOut (550);
        $('#message').fadeIn (550);
        $('#message').fadeOut (550);
        $('#message').fadeIn (550);
        $('#message').fadeOut (550);
    })
</script>

</body>
</html>
