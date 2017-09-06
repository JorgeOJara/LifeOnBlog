 <?php
  session_start();
 require 'connection.php';
  require 'setting.php';
      if(isset($_SESSION['user'])){
       $member = $_SESSION['user'];
      }
 ?>
<!doctype html>
     <html>
        <head>
           <title>www.LifeOnBlog.com</title>
              <link href="https://fonts.googleapis.com/css?family=Lobster|Montserrat+Subrayada" rel="stylesheet">
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
              <link href="https://fonts.googleapis.com/css?family=Sedgwick+Ave" rel="stylesheet">
              <link href="https://fonts.googleapis.com/css?family=Cabin+Sketch" rel="stylesheet">
              <link rel="stylesheet" type="text/css" href="blogg.css">
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
              <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        </head>
     <body>
      <style>
      .block{margin:0px;padding:0px;height:70px;}
       .header{color:white;padding-left:4%; padding-top:15px; margin:0px;}

       
         /*//btnss...*/
         #cl{width:155px;margin:1%;}
         #newO{width:155px;margin:1%;}
         #newU{width:155px;margin:1%;}
         #drop{margin:1%;}
         #drop{margin-left:0%;margin-top:-0.5%;}
     </style>
  <div class='block' style='border-bottom:1px solid black;'>
    <div class='heade'><h1 class='header'>lIFEOnBLOG</h1></div>
  <div class='drop-container'><div id='drop' class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">   
    <span class="glyphicon glyphicon-cog"></span></button>
    <ul id='showSetting' class="dropdown-menu dropdown-menu-right"></ul>
     </div>
  </div><div class='ffl'></div>        
</div>
    <!-- post data from the pop up.... -->
      <div id='popup_container'>
      <div id='form_container' class='popup_form_container'>
      <div id='close' class='close_pop' onclick='closeb()'><p class='close_element'>X</p></div>

      <form method='POST' action='blogg.php' enctype="multipart/form-data">
         <div class='header-blocks'><input class='tt' name='td' type='text' placeholder='Title?'/></div>
           <div class='image-containers'><input type='file' name='image'/></div>
              <div class='text-containers'>
                <textarea name='txt' class='txt'></textarea>
              </div>
  <button onclick='load()' name='insert' id='helper' class='btn btn-success'>POST</button>
             </form>
           </div>
         </div>
      <?php
  //require 'connection.php';
  $connect = new mysqli('localhost','root','','blogg');
  if(isset($_POST['insert'])){
  $head =$connect->real_escape_string(htmlentities($_POST['td']));           
  $txt =$connect->real_escape_string(htmlentities($_POST['txt']));
  $img =$_FILES['image']['name'];
  $target = "image/".basename($_FILES['image']['name']);        
  if(strlen($head) > 1 && strlen($txt) > 1){          
$finding = 'SELECT header FROM pst WHERE header=$head';
$results = $connect->query($finding);
if(mysqli_num_rows($results) == 0){
if(isset($img)){      
if(substr($img,-3) == "jpg" || substr($img,-3)=="png"){
if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
   $inserted = "INSERT INTO pst(ID,header,image,textd,user)VALUES('NULL','$head','$img','$txt','$member')";
           $request = mysqli_query($connect,$inserted);
                }
                  }else{
            $ins = "INSERT INTO pst(ID,header,image,textd,user)VALUES('NULL','$head','NULL','$txt','$member')";
                $request2 = mysqli_query($connect,$ins);
                    }
                       }else{
            $ins = "INSERT INTO pst(ID,header,image,textd,user)VALUES('NULL','$head','NULL','$txt','$member')";
                $request2 = mysqli_query($connect,$ins);
                       }
                     }
                  }else{
                  echo '<div class="alert alert-danger"><h2>You need to insert something in order to request a post</h2></div>';
                     }
                 }
              ?>
     <!--  //////////////////////////////////////////////// -->
           <!-- ///Data Sender Jquery Shit \-->
      <script type='text/javascript' src='jquery-3.2.1.min.js'></script>
              <script>
              $('document').ready(function(){
                 $('#scontainer').hide();
               $('#upOn').click(function(){
                    var conn = $('#upOn').val();
                    $.ajax({
                      url:'setting.php',
                      data:'num='+ conn,
                      success: function(data){
                           console.log("done");
                         $('#scontainer').show();
                          var dat = data.split('~');  
                     $('#requesting').attr('value',dat[1]);
                      $("#textUpdate").text(dat[2]);
                       }
                    });
                 });
               $('#settingsk').click(function(){
                  $('#del').toggle();
               });
//////////////////////////////////////////////////////////////////////////////
   //delete data sender ....//
                $('#delOn').click(function(){
                     var id = $('#delOn').val();
                       $.ajax({
                      url:'setting.php',
                      data:'sel='+ id,
                      success: function(data){
                           console.log("done");
                          load();
                       }
                    });
                });
                $('#ccc').click(function(){
                  $('#scontainer').hide();
                });
             });
              </script>
        <div id='blcontent' class='container-block'>
   <!-- blogg content -->
      </div> 
        <script>
        var pop = document.getElementById('popup_container');
          function closeb(){pop.style.display ='none';}
          function openb(){ pop.style.display ='block';}
                var showing = document.getElementById('blcontent');

                   function load(){
                      var finder = new XMLHttpRequest();
                        finder.open('GET','bloggContent.php',true);
                        finder.onreadystatechange = function(){
                             if(this.readyState == 4 && this.status ==200){
                                  showing.innerHTML = this.responseText;
                             }
                        }
                        finder.send();
                       reload();
                   }
                load();
           
                  function reload(){
                    var finders = new XMLHttpRequest();
                        finders.open('GET','displayer.php',true);
                        finders.onreadystatechange = function(){
                             if(this.readyState == 4 && this.status ==200){
                       var showings = document.getElementById('showSetting');
                                 showings.innerHTML = this.responseText;
                             }
                        }
                        finders.send();
                  }
       </script>  
     <style>
            .loginCreator{ font-family:'Cabin Sketch', cursive; font-size:35px; padding:0px;width:140px;background-color:white;padding-top:5px;padding-bottom:5px;border:1px solid black;border-radius:5px;}
            .log-container{height:auto; width:150px;text-align:center;margin-bottom:2%;margin-left:38%;}

            /*background container pop setting */
                .scontainer{position:fixed;display:none; top:0px;height:100%;width:100%;background-color:rgba(0,0,0,0.7);}
                 /*form container setting */
             .config{position:fixed;margin-top:10%;height:auto; width:50%;margin-left:25%;border:1px solid black;background-color:white;}
            /*///another inputs inside..///*/
                 .updes{margin-left:24%;margin-top:5%;}
                #requesting{margin-top:5%;margin:1%;width:50%;margin-left:24%;}
                #textUpdate{margin:1%;width:50%;margin-left:24%;height:160px;overflow:none;}
                #senders{margin:1%;width:50%;margin-left:24%;margin-bottom:5%;}
                 .ourclose{ text-align:center;float:right;height:35px;width:35px;background-color:#f44295;border-bottom:1px solid black;border-left:1px solid black;}
                 .endzone{font-size:16px;color:white;padding-top:8px;color:black;}
                @media(max-width:500px){
            .config{position:fixed;margin:0px; width:100%;height:auto;top:10%;}
            .updes{margin-left:10%;}
            #requesting{margin-left:10%}
                #textUpdate{margin-left:10%}
                #senders{margin-left:10%;margin-bottom:5%;}
                }
        .del{display:none; height:50px; width:100px; display:flex;margin:0px;}
             @media(max-width:600px){
                   .del{display:none;height:200px; width:100px;}
             }

     /* ///btn helper//*/
             #upOn{width:100%;margin:1%;}
             #delOn{width:100%;margin:1%;}
             </style>
<!-- ///////////////////////////////////////////////////////////////// -->
        <!-- deaL Maker Setting -setup -->
    <div id='scontainer' class='scontainer'>

      <div class='config'>
       <div id='ccc' class='ourclose'><p class='endzone'>X</p></div>
        <?php
         if(isset($_SESSION['loopup'])){
           $val = $_SESSION['loopup'];
         }
       
      $connect = new mysqli('localhost','root','','blogg');
      if(isset($_SESSION['user'])){
     if(isset($_POST['senders'])){
   $Nh = $connect->real_escape_string(htmlentities($_POST['newheader']));
   $Nt = $connect->real_escape_string(htmlentities($_POST['newtext']));
    if(isset($Nh)){
       $chang = "UPDATE pst SET header = '$Nh' WHERE ID = $val ";
          $connect->query($chang);
              if(isset($Nt)){
          $cha = "UPDATE pst SET textd ='$Nt' WHERE ID = $val";
        $connect->query($cha); 
             }
            }           
          }
        }
        ?>
         <h2 class='updes'>Fix Or Change</h2>
         <form method='POST' action='blogg.php' id='continuedc'>
           <div class='form-group'>
              <input name='newheader' class='form-control' id='requesting' type='text' placeholder=''/>
             </div>  
                <div class='form-group'>
              <textarea name='newtext' class='form-control' id='textUpdate' value=''></textarea>
              </div>
                <button onclick='load()' name='senders' id='senders' class='btn btn-info'>Update</button>
              </form>
          </div>
       </div>
        <style>
          .second_pop{ position:fixed; top:0px;background-color:rgba(0,0,0,0.7);}
          .second_pops{ display:none;height:100%; width:100%;position:fixed; top:0px;background-color:rgba(0,0,0,0.7);}
            .C-containers{margin-left:20%;}
            .log-container{margin-left:25%}
        @media(max-width:600px){
           .form-container_pops{width:70%;} 
        }
    .drop-container{height:auto; width:auto;float:right;flex:0.5;margin-top:6%;}
        .block{display:flex;}
        .heade{flex:5;}
        .ffl{flex:0.1;}
        #drop{margin:15%;}
          @media(max-width:600px;){
            #drop{margin:15%;margin-top:20%;}
         }
        @media(max-width:400px){
           .form-container_pops{width:100%}
           #drop{float:right;margin-top:-10%;}
        }
         #settingsk{position:relative; top:150px;}
  </style>
          <div id='creator-displayer' class='second_pop'>
               <div  class='form-container_pop'>
            <!-- Second pop activator .... -->
            <div onclick='Createclose()' class='close_box'><p class='x-box'>X</p></div>
                 <h1 class='Create_user_h'>Create USer</h1>
                  <div id='eddit'>
                  <form  method='POST'>
                   <div class='form-group'>
                    <input class='form-control' name='user' type='text' placeholder='type Ur User Name'/>
                    </div>
                    <div class='form-group'>
                    <input class='form-control' name='email' type='email' placeholder='Type Email'/>
                    </div>
                    <div class='form-group'>
                    <input class='form-control' name='password' type='password' placeholder='Ur password'/>
                    </div>
                   <div class='form-group'>
                   <input class='form-control' name='spassword' type='password' placeholder='Re Enter Password'/>
                   </div>
            <button onclick='load()' name='sss' id='sbtn' class='btn btn-info'>Submit</button>
        </form>      
    <?php
      $connecting2 = new mysqli('localhost','root','','blogg');
      if(!$connecting2){echo 'Connection Fail'; header('location:https://www.google.com');}

    if(isset($_POST['sss'])){
      $U=$connecting2->real_escape_string($_POST['user']);
      $E=$connecting2->real_escape_string($_POST['email']);
  $p=$connecting2->real_escape_string(md5($_POST['password']));
 $p2=$connecting2->real_escape_string(md5($_POST['spassword']));
      if(strlen($U) > 4 && strlen($E) > 5){
        if($p == $p2){
            $finded = "SELECT * FROM users Where email = '$E'";
            $requestedinto = $connecting2->query($finded);
              if(mysqli_num_rows($requestedinto) == 0){
            $in ="INSERT INTO users(ID,user,email,password)VALUES('NULL','$U','$E','$p')";
               $conclude = $connecting2->query($in);
               if($conclude == true){
                $_SESSION['user']= $U; 
               }
              }else{echo "<div class='something'></div>" ;}
                 }else{
                   echo "<div class='something'></div>" ; 
                 }
                   }else{
                     echo "<div class='something'></div>" ; 
                   }
                 }
                  ?> 
                </div>
            <div class='log-container'>
                  <button class='loginCreator' onclick='log()'>LogIn</button>
                  </div>
              </div>
          </div>  
           <!-- Second pop logIn activator .... -->
            <style>
              #sbtns{width:100%;}
             .Create_user_hs{top:10px; margin-top:1%; margin-bottom:0px; position:relative;top:10px;font-size:45px;padding-top:50px;padding-left:50px;font-family:'Cabin Sketch', cursive;}
             .close_boxs{height:30px;width:30px;float:right;text-align:center; z-index:400;}
             .x-boxs{font-size:20px;background-color:#e5326b;color:white;}
             @media(max-width:600px){#eddits{text-align:center;}#newU{margin-top:-10%;}}

             @media(max-width:450px){.Create_user_hs{font-size:30px;padding-left:10px;}.form-container_pops{width:100%;height:90%;margin-left:0%;}#newU{margin-top:-10%;}}

             .usa{ margin-left:10%; padding-left:5px;height:40px; display:flex; width:200px;margin-top:1%;}   
             .uname{font-size:20px;margin-top:0%;}}



              /* fix change login and Create Account..*/
              .second_pops{display:none; position:fixed; margin:0px; padding:0px; height:100%; width:100%; z-index:100;}

          .form-container_pops{position:relative; top:10%; height:85%; width:50%; border:1px solid black; background-color:white; left:25%;border-radius:10px;}

          @media(max-width:600px){
              .form-container_pops{ position:relative; top:10%; height:85%; width:70%; border:1px solid black; background-color:white; left:10%;border-radius:10px;}
          }

              #eddits{width:60%;position:relative;left:20%;margin-top:10%;}

               @media(min-width:900px){
                 #eddits{width:40%;position:relative;left:30%;margin-top:10%;}
               }

               .close_box{border-radius:0px;}
               .x-box{border-radius:0px;}


               .chois{height:auto; width:150px;border-radius:1000px;position:relative;left:37%; top:20px;}

               /*//// btn in*/
               .C-containers{height:auto;width:auto;float:right;}
                .CCreators{width:50px;float:right;}
          @media(max-width:420px){
              .form-container_pops{top:10%; height:60%; width:98%; border:1px solid black; background-color:white; left:1%;border-radius:10px;}

                  #eddits{width:65%;left:0px;margin-top:10%;}
                  .chois{height:auto; width:150px;border-radius:1000px;position:relative;left:37%; top:20px;}
               }
             </style>
           <div id='creator-displayers' class='second_pops'>
      <div class='form-container_pops'>         
          <div onclick='logclose()' class='close_box'><p class='x-box'>X</p></div>
                <img class='chois' src='choise.jpg'/>
                  <div id='eddits'>
                  <form  method='POST'>
                    <div class='form-group'>
                    <input class='form-control' name='emailL' type='email' placeholder='Type Email'/>
                    </div>
                    <div class='form-group'>
                    <input class='form-control' name='passwordL' type='password' placeholder='Ur password'/>
                    </div>
                  <button onclick='load()' name='ssd' id='sbtns' class='btn btn-info'>Submit</button>
              </form>       
          </div>
   <?php
       if(isset($_POST['ssd'])){
        $em = $connect->real_escape_string(htmlentities($_POST['emailL']));
  $pa = $connecting2->real_escape_string(htmlentities(md5($_POST['passwordL'])));
  if(strlen($em) > 4 && strlen($pa) > 4){
    $finding2 = "SELECT * FROM users WHERE email ='$em'";
    $resulted = mysqli_query($connect,$finding2);
    if(mysqli_num_rows($resulted) > 0){
    while($rows = mysqli_fetch_assoc($resulted)){
    $colle = $rows["user"];
    $collp =$rows["password"];
    if($collp != $pa){
    $_SESSION['user'] =$colle;
    }else{echo "<div class='something'><h1>Ups six</h1></div>";}
}}else{echo "<div class='something'><h1>Ups clonee</h1></div>";
  } } }?>
      <style>
        
        .C-containers{height:auto; width:250px;text-align:center;margin-bottom:5%;margin-left:25%;}
     </style>
             <div class='C-containers'>
           <button id='CCreators' class='btn btn-info'onclick='logger()'></botton>
        </div>
      </div>
   </div>
 </div>
      <script>
        var Creator  = document.getElementById('newU'); 
         var showCreator = document.getElementById('creator-displayer');
            function dome(){ showCreator.style.display ='block'; console.log('doing');Secondblocklog.style.display ='none';}

          function Createclose(){
            showCreator.style.display ='none';
            Secondblocklog.style.display ='none';
          }

    var Secondblocklog = document.getElementById('creator-displayers');
  function log(){ 
       showCreator.style.display ='none';
        Secondblocklog.style.display ='block';
       }
       function logger(){
        Secondblocklog.style.display ='none';
         showCreator.style.display ='block';
       }

       function logclose(){
          Secondblocklog.style.display ='none';
       }
         </script>      
       </body>
   </html>