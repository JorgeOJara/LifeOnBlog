<?php
  require "connection.php";
  if(isset($_POST['num'])){
      $reques = $_POST['num'];
     $getting = "SELECT * FROM pst WHERE ID = $reques";
    $resul = $connect->query($getting);
    while($rows = mysqli_fetch_assoc($resul)){
        session_start();
           $IDs = $rows['ID'];
           $headss = $rows['header'];
            $textss =$rows['textd'];
            echo  $IDs."~".$headss ."~".$textss;
            $_SESSION['look'] = $IDs;
        }
     }
     require 'connection.php';
      if(isset($_GET['sel'])){
        $requess = $_GET['sel'];
         $gettings = "DELETE  FROM pst WHERE ID = $requess";
         $resulS = $connect->query($gettings);
        }
?>