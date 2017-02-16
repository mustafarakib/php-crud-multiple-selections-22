<?php
require_once("../../../vendor/autoload.php");

use App\Message\Message;

  if(!isset($_SESSION)){
      session_start();
  }
  $msg = Message::getMessage();

  echo "<div id='message'> $msg </div>";

$objBookTitle = new \App\BookTitle\BookTitle();
$objBookTitle->setData($_GET);
$oneData = $objBookTitle->view();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Title Edit Form</title>
    <link rel="stylesheet" href="../../../resource/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../resource/bootstrap/css/bootstrap-theme.min.css">
    <script src="../../../resource/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <form  class="form-group" action="update.php" method="post">
        Enter Book Name:
        <input class="form-control" type="text" name="bookName" value="<?php echo $oneData->book_name ?>">
        <br>
        Enter Author Name:
        <input class="form-control" type="text" name="authorName"  value="<?php echo $oneData->author_name ?>">
        <br>
        <input type="hidden" name="id" value="<?php echo $oneData->id ?>">
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


