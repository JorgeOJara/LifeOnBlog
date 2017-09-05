<?php
  //btn diplsayer
  session_start();
   if(isset($_SESSION['user'])){
       $member = $_SESSION['user'];
      }


 if(isset($member)){
        echo "<li><a href='#'><button id='cl' onclick='openb()' class='btn btn-info'>Post</button></li>";
          }
          if(!isset($member)){
           echo "<li><a class='ssl' href='#'><button id='newU' onclick='dome()' class='btn btn-danger'>Account</button></a></li>";
         }else{
          echo "<li><a class='ssl'href='bye.php'><button id='newO' class='btn btn-danger'>Exit</button></a></li>";
         }
?>