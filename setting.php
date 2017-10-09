<?php
   session_start();
  require "connection.php";
  if(isset($_POST['num'])){
        $reques = $_POST['num']; 
     $getting = "SELECT * FROM pst WHERE ID = $reques";
    $resul = $connect->query($getting);
        $rows = mysqli_fetch_assoc($resul);   
           $IDs = $rows['ID'];
           $headss = $rows['header'];
            $textss =$rows['textd'];
            echo  $IDs."~".$headss ."~".$textss;
            $_SESSION['look'] = $IDs;
         $connect->close();
     }
     exit();
?>