<?php
require_once("../../../vendor/autoload.php");
use App\Message\Message;
use App\Utility\Utility;

session_start();
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
        td{  border: 0; }
        table{  border: 1px; }
        tr{  height: 30px; }
    </style>
</head>
<body>

<div class="container">

    <?php
    if(isset($_POST['mark']) || isset($_SESSION['mark'])) {    // start of boss if
       $someData=null;
       $objBookTitle= new App\BookTitle\BookTitle();

       if(isset($_POST['mark']) ){
        $_SESSION['mark'] = $_POST['mark'];
        $someData =  $objBookTitle->listSelectedData($_SESSION['mark']);
       }

        echo "
              <h1> Are you sure you want to delete all selected data?</h1>
              <a href='deletemultiple.php?YesButton=1' class='btn btn-danger'>Yes</a>
              <a href='index.php' class='btn btn-success'>No</a>
            ";

        if(isset($_GET['YesButton'])){
            $objBookTitle->deleteMultiple($_SESSION['mark']);
            unset($_SESSION['mark']);
        }
    ?>


    <table class="table table-striped table-bordered" cellspacing="0px">

        <tr>
            <th style='width: 10%; text-align: center'>Serial Number</th>
            <th style='width: 10%; text-align: center'>ID</th>
            <th>Book Name</th>
            <th>Author Name</th>
        </tr>

        <?php
        $serial = 1;

        foreach ($someData as $oneData) { ## Traversing $someData is Required for pagination  ##
            if ($serial % 2) $bgColor = "AZURE";
            else $bgColor = "#ffffff";

            echo "
                  <tr  style='background-color: $bgColor'>
                     <td style='width: 10%; text-align: center'>$serial</td>
                     <td style='width: 10%; text-align: center'>$oneData->id</td>
                     <td>$oneData->book_name</td>
                     <td>$oneData->author_name</td>
                  </tr>
              ";
            $serial++;
        }
        ?>

    </table>


<?php
}  // end of boos if

    else
    {
        Message::message("Empty Selection! Please select some records.");
        Utility::redirect($_SERVER["HTTP_REFERER"]);
    }
?>
</div>

</body>
</html>