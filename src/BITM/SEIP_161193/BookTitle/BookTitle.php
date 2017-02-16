<?php

namespace App\BookTitle;

use App\Message\Message;
use App\Utility\Utility;

use App\Model\Database as DB;
use PDO;
use PDOException;

class BookTitle extends DB
{
       private $id;
       private $book_name;
       private $author_name;

    public function setData($postData){

         if(array_key_exists('id',$postData)){
             $this->id = $postData['id'];
         }

         if(array_key_exists('bookName',$postData)){
             $this->book_name = $postData['bookName'];
         }

         if(array_key_exists('authorName',$postData)){
             $this->author_name = $postData['authorName'];
         }
     }


    public function store(){

        $arrData = array($this->book_name,$this->author_name);

        $sql = "INSERT into book_title(book_name,author_name) VALUES(?,?)";

        $STH = $this->DBH->prepare($sql);
        $result =$STH->execute($arrData);

        if($result)
          Message::message("Success! Data Has Been Inserted Successfully :)");
        else
          Message::message("Failed! Data Has Not Been Inserted :( ");

        Utility::redirect('index.php');
    }


    public function index(){

        $sql = "select * from book_title where soft_deleted='No'";

        $STH = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        return $STH->fetchAll();
    }


    public function view(){

        $sql = "select * from book_title where id=".$this->id;

        $STH = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        return $STH->fetch();
    }


    public function trashed(){

        $sql = "select * from book_title where soft_deleted='Yes'";

        $STH = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        return $STH->fetchAll();
    }


    public function update(){

        $arrData = array($this->book_name,$this->author_name);

        $sql = "UPDATE  book_title SET book_name=?,author_name=? WHERE id=".$this->id;

        $STH = $this->DBH->prepare($sql);
        $result =$STH->execute($arrData);

        if($result)
            Message::message("Success! Data Has Been Updated Successfully :)");
        else
            Message::message("Failed! Data Has Not Been Updated  :( ");

        Utility::redirect('index.php');
    }


    public function trash(){

        $sql = "UPDATE  book_title SET soft_deleted='Yes' WHERE id=".$this->id;

        $result = $this->DBH->exec($sql);

        if($result)
            Message::message("Success! Data Has Been Soft Deleted Successfully :)");
        else
            Message::message("Failed! Data Has Not Been Soft Deleted  :( ");

        Utility::redirect('index.php');
    }


    public function recover(){

        $sql = "UPDATE  book_title SET soft_deleted='No' WHERE id=".$this->id;

        $result = $this->DBH->exec($sql);

        if($result)
            Message::message("Success! Data Has Been Recovered Successfully :)");
        else
            Message::message("Failed! Data Has Not Been Recovered  :( ");

        Utility::redirect('index.php');
    }


    public function delete(){

        $sql = "Delete from book_title  WHERE id=".$this->id;

        $result = $this->DBH->exec($sql);

        if($result)
            Message::message("Success! Data Has Been Permanently Deleted :)");
        else
            Message::message("Failed! Data Has Not Been Permanently Deleted  :( ");

        Utility::redirect('index.php');
    }


    public function indexPaginator($page=1,$itemsPerPage=3){

        try{
          $start = (($page-1) * $itemsPerPage);
          if($start<0) $start = 0;
          $sql = "SELECT * from book_title  WHERE soft_deleted = 'No' LIMIT $start,$itemsPerPage";
        }

        catch (PDOException $error){
          $sql = "SELECT * from book_title  WHERE soft_deleted = 'No'";
        }

        $STH = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);

        $arrSomeData  = $STH->fetchAll();
        return $arrSomeData;
    }


    public function trashedPaginator($page=1,$itemsPerPage=3){

        try{
            $start = (($page-1) * $itemsPerPage);
            if($start<0) $start = 0;
            $sql = "SELECT * from book_title  WHERE soft_deleted = 'Yes' LIMIT $start,$itemsPerPage";
        }

        catch (PDOException $error){
            $sql = "SELECT * from book_title  WHERE soft_deleted = 'Yes'";
        }

        $STH = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);

        $arrSomeData  = $STH->fetchAll();
        return $arrSomeData;
    }


    public function trashMultiple($selectedIDsArray){

        foreach($selectedIDsArray as $id){

            $sql = "UPDATE  book_title SET soft_deleted='Yes' WHERE id=".$id;

            $result = $this->DBH->exec($sql);
            if(!$result) break;
        }

        if($result)
            Message::message("Success! All Seleted Data Has Been Soft Deleted Successfully :)");
        else
            Message::message("Failed! All Selected Data Has Not Been Soft Deleted  :( ");

        Utility::redirect('trashed.php?Page=1');
    }


    public function recoverMultiple($markArray){

        foreach($markArray as $id){

            $sql = "UPDATE  book_title SET soft_deleted='No' WHERE id=".$id;

            $result = $this->DBH->exec($sql);
            if(!$result) break;
        }

        if($result)
            Message::message("Success! All Seleted Data Has Been Recovered Successfully :)");
        else
            Message::message("Failed! All Selected Data Has Not Been Recovered  :( ");

        Utility::redirect('index.php?Page=1');
    }


    public function deleteMultiple($selectedIDsArray){

        foreach($selectedIDsArray as $id){

            $sql = "Delete from book_title  WHERE id=".$id;

            $result = $this->DBH->exec($sql);
            if(!$result) break;
        }

        if($result)
            Message::message("Success! All Seleted Data Has Been  Deleted Successfully :)");
        else
            Message::message("Failed! All Selected Data Has Not Been Deleted  :( ");

        Utility::redirect('index.php?Page=1');
    }


    public function listSelectedData($selectedIDs){

        foreach($selectedIDs as $id){

            $sql = "Select * from book_title  WHERE id=".$id;

            $STH = $this->DBH->query($sql);
            $STH->setFetchMode(PDO::FETCH_OBJ);
            $someData[]  = $STH->fetch();
        }
        return $someData;
    }


    public function search($requestArray){
        $sql = "";

        if( isset($requestArray['byTitle']) && isset($requestArray['byAuthor']) )
            $sql = "SELECT * FROM `book_title` WHERE `soft_deleted` ='No' AND (`book_name` LIKE '%".
                $requestArray['search']."%' OR `author_name` LIKE '%".$requestArray['search']."%')";

        if(isset($requestArray['byTitle']) && !isset($requestArray['byAuthor']) )
            $sql = "SELECT * FROM `book_title` WHERE `soft_deleted` ='No' AND `book_name` LIKE '%".
                $requestArray['search']."%'";

        if(!isset($requestArray['byTitle']) && isset($requestArray['byAuthor']) )
            $sql = "SELECT * FROM `book_title` WHERE `soft_deleted` ='No' AND `author_name` LIKE '%".
                $requestArray['search']."%'";

        $STH  = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $someData = $STH->fetchAll();

        return $someData;
    }
    // end of search()


    public function getAllKeywords()
    {
        $_allKeywords = array();
        $WordsArr = array();

        $allData = $this->index();
        foreach ($allData as $oneData) {
            $_allKeywords[] = trim($oneData->book_name);
        }

        $allData = $this->index();
        foreach ($allData as $oneData) {
            $eachString= strip_tags($oneData->book_name);
            $eachString=trim( $eachString);
            $eachString= preg_replace( "/\r|\n/", " ", $eachString);
            $eachString= str_replace("&nbsp;","",  $eachString);

            $WordsArr = explode(" ", $eachString);

            foreach ($WordsArr as $eachWord){
                $_allKeywords[] = trim($eachWord);
            }
        }
        // for each search field block end


        // for each search field block start
        $allData = $this->index();
        foreach ($allData as $oneData) {
            $_allKeywords[] = trim($oneData->author_name);
        }

        $allData = $this->index();
        foreach ($allData as $oneData) {
            $eachString= strip_tags($oneData->author_name);
            $eachString=trim( $eachString);
            $eachString= preg_replace( "/\r|\n/", " ", $eachString);
            $eachString= str_replace("&nbsp;","",  $eachString);
            $WordsArr = explode(" ", $eachString);

            foreach ($WordsArr as $eachWord){
                $_allKeywords[] = trim($eachWord);
            }
        }
        // for each search field block end

        return array_unique($_allKeywords);

    }// get all keywords
}
