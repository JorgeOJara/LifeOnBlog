<?php
session_start();
  require 'connection.php';
     //delete bottoms ...
          $connect = new mysqli('localhost','root','','blogg');
          $find = "SELECT * FROM pst ORDER BY dt DESC LIMIT 10";
          $gold = mysqli_query($connect,$find); 
         while($rows = mysqli_fetch_assoc($gold)){
          $ID = $rows['ID'];
          $header = $rows['header'];
          $image = $rows['image'];
          $text = $rows['textd'];
          $us = $rows['user'];
          $dt = $rows['dt'];
          if(isset($header)){
            if(isset($_SESSION['user'])){
         if($_SESSION['user'] == $us){
           $indent = $_SESSION['user'];
             $lpst = "SELECT * FROM users WHERE user = '$indent'";
              $lgetting = mysqli_query($connect,$lpst);
               $col = mysqli_fetch_assoc($lgetting);
                  $valk = $col['lpst'];
          if($ID == $valk){
       echo "<div id='dor' class='dropdown'>
    <button id ='settingsk' class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'>
    <span class='caret'></span></button>
    <ul class='dropdown-menu'>
      <li><a href='#'><button id='upOn'class='btn btn-info' value='".$ID."'>Update</button></a></li>
      <li><a href=''><button id='delOn' class='btn btn-danger' value='".$ID."'>Delete</button></a></li></ul></div></div>";
    echo "<div class='header-block'><h1 class='psh'>".$header."</h1></div>";
        }else{
          echo "<div class='header-block'><h1 class='psh'>".$header."</h1></div>";
        }
      }else{
          echo "<div class='header-block'><h1 class='psh'>".$header."</h1></div>";
        }
      }else{
         echo "<div class='header-block'><h1 class='psh'>".$header."</h1></div>";
        }
           }else{
           echo "<div class='header-block'><h1 class='psh'>".$header."</h1></div>";}
          if(isset($image)){
  if(substr($image,-3) == "jpg" ||substr($image,-3)=="png"){
        echo"<div class='image-container'><img class='psimage' src='image/".$image."'/></div>";}}
          if(isset($text)){echo "<div class='text-container'><p class='pspr'>".$text."</p></div>";}
           if(isset($us)){
          echo '<div class="usa"><p>By:</p><h2 class="uname">'.$us.'</h2></div>';
               /////Create like System...
           }
          }
?>