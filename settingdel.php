<?php
  require 'connection.php';
      if(isset($_POST['sel'])){
        $requess = $_POST['sel'];
         $gettings = "DELETE  FROM pst WHERE ID = $requess";
         $resulS = $connect->query($gettings);
          $connect->close();
        }
   ?>