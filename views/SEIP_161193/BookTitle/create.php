<?php
require_once("../../../vendor/autoload.php");

use App\Message\Message;

if(!isset($_SESSION)){
    session_start();
}
$msg = Message::getMessage();

echo "<div class='container' style='height: 50px'><div id='message'> $msg </div> </div> ";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Title Create Form</title>
    <link rel="stylesheet" href="../../../resource/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../resource/bootstrap/css/bootstrap-theme.min.css">
    <script src="../../../resource/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="navbar">
        <td><a href='index.php' class='btn btn-group-lg btn-info'>Active-List</a> </td>
    </div>

    <form  class="form-group f" action="store.php" method="post">
        Enter Book Name:
        <input class="form-control" type="text" name="bookName">
        <br>
        Enter Author Name:
        <input class="form-control" type="text" name="authorName">
        <br>
        <input type="submit">
    </form>
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


