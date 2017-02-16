<?php
require_once("../../../vendor/autoload.php");

$objBookTitle = new \App\BookTitle\BookTitle();
$allData = $objBookTitle->index();

use App\Message\Message;
use App\Utility\Utility;

if(!isset($_SESSION)){
    session_start();
}
$msg = Message::getMessage();

if(isset($_SESSION['mark']))  unset($_SESSION['mark']);

################## search  block 1 of 5 start ##################
if(isset($_REQUEST['search']) )$someData =  $objBookTitle->search($_REQUEST);
$availableKeywords=$objBookTitle->getAllKeywords();
$comma_separated_keywords= '"'.implode('","',$availableKeywords).'"';
################## search  block 1 of 5 end ##################



######################## pagination code block#1 of 2 start #####################
$recordCount= count($allData);

if(isset($_REQUEST['Page']))   $page = $_REQUEST['Page'];
else if(isset($_SESSION['Page']))   $page = $_SESSION['Page'];
else   $page = 1;


$_SESSION['Page']= $page;

if(isset($_REQUEST['ItemsPerPage']))   $itemsPerPage = $_REQUEST['ItemsPerPage'];
else if(isset($_SESSION['ItemsPerPage']))   $itemsPerPage = $_SESSION['ItemsPerPage'];
else   $itemsPerPage = 3;

$_SESSION['ItemsPerPage']= $itemsPerPage;

$pages = ceil($recordCount/$itemsPerPage);
$someData = $objBookTitle->indexPaginator($page,$itemsPerPage);

$serial = (  ($page-1) * $itemsPerPage ) +1;

if($serial<1) $serial=1;
####################### pagination code block#1 of 2 end ############################



################## search  block 2 of 5 start ##################
if(isset($_REQUEST['search']) ) {
    $someData = $objBookTitle->search($_REQUEST);
    $serial = 1;
}
################## search  block 2 of 5 end ##################
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Title - Active List</title>
    <link rel="stylesheet" href="../../../resource/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../resource/bootstrap/css/bootstrap-theme.min.css">
    <script src="../../../resource/bootstrap/js/bootstrap.min.js"></script>
    <style>
        td{  border: 0; }
        table{  border: 1px; }
        tr{  height: 30px; }
    </style>

    <!-- required for search, block3 of 5 start -->
    <link rel="stylesheet" href="../../../resource/bootstrap/css/jquery-ui.css">
    <script src="../../../resource/bootstrap/js/jquery.js"></script>
    <script src="../../../resource/bootstrap/js/jquery-ui.js"></script>
    <!-- required for search, block3 of 5 end -->
</head>
<body>

<div class="container">

    <?php echo "<div style='height: 30px; text-align: center'>
                    <div class='alert-success ' id='message'> $msg </div>
                </div>";
    ?>

    <!-- required for search, block 4 of 5 start -->
    <div style="margin-left: 65%">
        <form id="searchForm" action="index.php"  method="get" style="margin-top: 5px;  ">
            <input type="text" value="" id="searchID" name="search" placeholder="Search" width="60" >
            <input type="checkbox"  name="byTitle"   checked  >By Title
            <input type="checkbox"  name="byAuthor"  checked >By Author
            <input hidden type="submit" class="btn-primary" value="search">
        </form>
    </div>
    <!-- required for search, block 4 of 5 end -->

<form action="trashmultiple.php" method="post" id="multiple">

    <div class="navbar"?>
       <a href="trashed.php?Page=1"   class="btn btn-info role="button"> View Trashed List</a> &nbsp;&nbsp;&nbsp;
       <a href="create.php "  class="btn btn-primary role="button"> Add new Book</a>&nbsp;&nbsp;&nbsp;
       <button type="button" class="btn btn-danger" id="delete">Delete  Selected</button>&nbsp;&nbsp;&nbsp;
       <button type="submit" class="btn btn-warning">Trash Selected</button>
   </div>

    <h1 style="text-align: center" ;">Book Title - Active List (<?php echo count($allData) ?>)</h1>

<table class="table table-striped table-bordered" cellspacing="0px">

    <tr>
        <th>Select all  <input id="select_all" type="checkbox" value="select all"></th>

        <th style='width: 10%; text-align: center'>Serial</th>
        <th style='width: 10%; text-align: center'>ID</th>

        <th>Book Name</th>
        <th>Author Name</th>
        <th>Action Buttons</th>
    </tr>

    <?php
        // $serial= 1;  ##### We need to remove this line to work pagination correctly.

    foreach($someData as $oneData){ ## Traversing $someData is Required for pagination  ###
        if($serial%2) $bgColor = "AZURE";
        else $bgColor = "#ffffff";

        echo "
              <tr  style='background-color: $bgColor'>
                 <td style='padding-left: 6%'><input type='checkbox' class='checkbox' name='mark[]' value='$oneData->id'></td>

                 <td style='width: 10%; text-align: center'>$serial</td>
                 <td style='width: 10%; text-align: center'>$oneData->id</td>

                 <td>$oneData->book_name</td>
                 <td>$oneData->author_name</td>

                 <td>
                   <a href='view.php?id=$oneData->id' class='btn btn-info'>View</a>
                   <a href='edit.php?id=$oneData->id' class='btn btn-primary'>Edit</a>
                   <a href='trash.php?id=$oneData->id' class='btn btn-warning'>Soft Delete</a>
                   <a href='delete.php?id=$oneData->id' class='btn btn-danger'>Delete</a>
                 </td>
              </tr>
          ";
        $serial++;
    }
    ?>

</table>
</form>

<!--  ######################## pagination code block#2 of 2 start ######################### -->
<div align="left" class="container">
<ul class="pagination">

    <?php
    $pageMinusOne  = $page-1;
    $pagePlusOne  = $page+1;

    if($page>$pages) Utility::redirect("index.php?Page=$pages");
    if($page>1)  echo "<li><a href='index.php?Page=$pageMinusOne'>" . "Previous" . "</a></li>";

    for($i=1;$i<=$pages;$i++)
    {
        if($i==$page) echo '<li class="active"><a href="">'. $i . '</a></li>';
        else  echo "<li><a href='?Page=$i'>". $i . '</a></li>';
    }
    if($page<$pages) echo "<li><a href='index.php?Page=$pagePlusOne'>" . "Next" . "</a></li>";
    ?>

    <select  class="form-control"  name="ItemsPerPage" id="ItemsPerPage" onchange="javascript:location.href = this.value;" >
        <?php
        if($itemsPerPage==3 ) echo '<option value="?ItemsPerPage=3" selected >Show 3 Items Per Page</option>';
        else echo '<option  value="?ItemsPerPage=3">Show 3 Items Per Page</option>';

        if($itemsPerPage==4 )  echo '<option  value="?ItemsPerPage=4" selected >Show 4 Items Per Page</option>';
        else  echo '<option  value="?ItemsPerPage=4">Show 4 Items Per Page</option>';

        if($itemsPerPage==5 )  echo '<option  value="?ItemsPerPage=5" selected >Show 5 Items Per Page</option>';
        else echo '<option  value="?ItemsPerPage=5">Show 5 Items Per Page</option>';

        if($itemsPerPage==6 )  echo '<option  value="?ItemsPerPage=6"selected >Show 6 Items Per Page</option>';
        else echo '<option  value="?ItemsPerPage=6">Show 6 Items Per Page</option>';

        if($itemsPerPage==10 )   echo '<option  value="?ItemsPerPage=10"selected >Show 10 Items Per Page</option>';
        else echo '<option  value="?ItemsPerPage=10">Show 10 Items Per Page</option>';

        if($itemsPerPage==15 )  echo '<option  value="?ItemsPerPage=15"selected >Show 15 Items Per Page</option>';
        else    echo '<option  value="?ItemsPerPage=15">Show 15 Items Per Page</option>';
        ?>
    </select>
</ul>
</div>
<!--  ######################## pagination code block#2 of 2 end ###################################### -->

</div>

<script>
    jQuery(function($) {
        $('#message').fadeIn(500);
        $('#message').fadeOut (500);
        $('#message').fadeIn (500);
        $('#message').delay (2500);
        $('#message').fadeOut (2000);
    })

    $('#delete').on('click',function(){
        document.forms[1].action="deletemultiple.php";
        $('#multiple').submit();
    });

    //select all checkboxes
    $("#select_all").change(function(){  //"select all" change
        var status = this.checked; // "select all" checked status
        $('.checkbox').each(function(){ //iterate all listed checkbox items
            this.checked = status; //change ".checkbox" checked status
        });
    });

    $('.checkbox').change(function(){ //".checkbox" change
//uncheck "select all", if one of the listed checkbox item is unchecked
        if(this.checked == false){ //if this item is unchecked
            $("#select_all")[0].checked = false; //change "select all" checked status to false
        }

//check "select all" if all checkbox items are checked
        if ($('.checkbox:checked').length == $('.checkbox').length ){
            $("#select_all")[0].checked = true; //change "select all" checked status to true
        }
    });
</script>


<!-- required for search, block 5 of 5 start -->
<script>
    $(function() {
        var availableTags = [

            <?php
            echo $comma_separated_keywords;
            ?>
        ];
            // Filter function to search only from the beginning of the string
        $( "#searchID" ).autocomplete({
            source: function(request, response) {

                var results = $.ui.autocomplete.filter(availableTags, request.term);

                results = $.map(availableTags, function (tag) {
                    if (tag.toUpperCase().indexOf(request.term.toUpperCase()) === 0) {
                        return tag;
                    }
                });

                response(results.slice(0, 15));
            }
        });

        $( "#searchID" ).autocomplete({
            select: function(event, ui) {
                $("#searchID").val(ui.item.label);
                $("#searchForm").submit();
            }
        });
    });
</script>
<!-- required for search, block5 of 5 end -->

</body>
</html>