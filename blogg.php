
<!doctype html>
 <?php
  session_start();
 require 'connection.php';
  // require 'setting.php';
      if(isset($_SESSION['user'])){
        $member = $_SESSION['user'];
      }   
 ?>
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
      .block{margin:0px;padding:0px;height:70px;width:100%;}
       .header{color:white;padding-left:4%; padding-top:15px; margin:0px;}

         /*//btnss...*/
         #cl{width:155px;margin:1%;}
         #newO{width:155px;margin:1%;}
         #newU{width:155px;margin:1%;}
         #drop{margin:1%;}
         #drop{margin-left:0%;margin-top:-0.5%;}
     </style>
  <div class='block' style='border-bottom:1px solid black;width:100%;margin:0px;'>
    <div class='heade'><h1 class='header'>lIFEOnBLOG</h1></div>
  <div class='drop-container'><div id='drop' class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">   
    <span class="glyphicon glyphicon-cog"></span></button>
    <ul id='showSetting' class="dropdown-menu dropdown-menu-right"></ul>
     </div>
  </div>        
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
  <button onclick='loading()' name='insert' id='helper' class='btn btn-success'>POST</button>
             </form>
           </div>
         </div>
      <?php
  require 'connection.php';
  if(isset($_POST['insert'])){
  $head =$connect->real_escape_string(htmlentities($_POST['td']));           
  $txt =$connect->real_escape_string(htmlentities($_POST['txt']));
  $img =$_FILES['image']['name'];
  $target = "image/".basename($_FILES['image']['name']);
  $dt = date("Y/m/d");        
  if(strlen($head) > 1 && strlen($txt) > 1){          
$finding = "SELECT header FROM pst WHERE header='$head'";
$results = $connect->query($finding);
if(mysqli_num_rows($results) == 0){
if(isset($img)){      
if(substr($img,-3) == "jpg" || substr($img,-3)=="png"){
if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
   $inserted = "INSERT INTO pst(ID,header,image,textd,user,dt)VALUES('NULL','$head','$img','$txt','$member','$dt')";
           $request4 = mysqli_query($connect,$inserted);
             $inserteds = "INSERT INTO likes(pstid,userlike,numlikes)VALUES('$head','None','0')";
                $request3 = mysqli_query($connect,$inserteds);
                 if($request4 == true){
                    $lasp = "SELECT * FROM pst WHERE header = '$head'";
                    $findersSlepers = mysqli_query($connect,$lasp);
                    $lhelp = mysqli_fetch_assoc($findersSlepers);
                      //pst ID 
                       $compare = $lhelp['ID'];
                      // Update
                  $lup = "UPDATE users SET lpst = $compare WHERE user ='$member'";
                      mysqli_query($connect,$lup);
                    $connect->close();
                   }
                   $connect->close();
                }
                  }else{
                  require 'connection.php';
            $ins = "INSERT INTO pst(ID,header,image,textd,user,dt)VALUES('NULL','$head','NULL','$txt','$member','$dt')";
            $ins = "INSERT INTO likes(pstid,userlike,numlikes)VALUES('$head','None','0')";
                $request2 = mysqli_query($connect,$ins);  
                 if($request2 == true){
                    $lasp = "SELECT * FROM pst WHERE header = '$head'";
                    $findersSlepers = mysqli_query($connect,$lasp);
                     $lhelp = mysqli_fetch_assoc($findersSlepers);
                      //pst ID 
                       $compare = $lhelp['ID'];
                      // Update
                  $lup = "UPDATE users SET lpst = $compare WHERE user ='$member'";
                      mysqli_query($connect,$lup);
                    }
                    $connect->close();
                  }
                       }else{
                    require 'connection.php';
            $ins = "INSERT INTO pst(ID,header,image,textd,user,dt)VALUES('NULL','$head','NULL','$txt','$member','$dt')";
          $ins = "INSERT INTO likes(pstid,userlike,numlikes)VALUES('$head','None','0')";
                $request2 = mysqli_query($connect,$ins);
                 if($request2 == true){
                    $lasp = "SELECT * FROM pst WHERE header = '$head'";
                    $findersSlepers = mysqli_query($connect,$lasp);
                     $lhelp = mysqli_fetch_assoc($findersSlepers);
                      //pst ID 
                       $compare = $lhelp['ID'];
                      // Update
                $lup = "UPDATE users SET lpst = $compare WHERE user ='$member'";
                      mysqli_query($connect,$lup);
                    }
                    $connect->close();
                       }
                     }
                  }else{
               echo '<div id="alerted" class="alert alert-danger"><h2>Sorry Something went wrong...</h2></div><script> var ale  = document.getElementById("alerted"); 
                   function s(){
                    setTimeout(function(){
                       ale.style.opacity ="0";
                    },3000);
                   }
                   s();
               </script>';}
                 }
              ?>
    <script type='text/javascript' src='jquery-3.2.1.min.js'></script>
     <style>
          #alerted{margin-top:5%; transition:opacity 3s;}
     </style>
        <script>
              //start  Listener For Setting Menu..
          
      // if update Setting Menu Isset show and display edditor whit value .../ 
      $('document').ready(function(){
               $('#upOn').click(function(){
                    var conn = $('#upOn').val();
                    $.post({
                      url:'setting.php',
                      data:{'num':conn},
                      success: function(data){
                    $('#scontainer').show();
                        console.log("done");   
                        var dat = data.split('~');
                        var hold = dat[0];
                     $('#requesting').attr('value',dat[1]);
                      $("#textUpdate").text(dat[2]);
                       }
                    });
                 });
  // if Delete Btn Isset send value of the request to aliminate pst...
                $('#delOn').click(function(){
                     var id = $('#delOn').val();
                       $.post({
                       url:'settingdel.php',
                      data:{'sel':id},
                      success: function(data){
                           console.log("done");
                          loading();
                       }
                    });
                });
                $('#ccc').click(function(){
                  $('#scontainer').hide();
                });
             });
              </script>
           <!-- blogg content -->
        <div id='blcontent' class='container-block'>
   


            </div> 
        <script>
        var pop = document.getElementById('popup_container');
          function closeb(){pop.style.display ='none';}
          function openb(){ pop.style.display ='block';}
                var showing = document.getElementById('blcontent');
    /// function use In All the Btn To load All the content...Pure Javascript
                   function loading(){
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
                loading();
           // to realod Another part Of the blogg site... Manu //
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
        <!--It show The edditor Manu And display Value-->
        <div id='scontainer' class='scontainer'>
      <div class='config'>
       <div id='ccc' class='ourclose'><p class='endzone'>X</p></div>
         <h2 class='updes'>Fix Or Change</h2>
         <form method='POST' action='blogg.php' id='continuedc'>
           <div class='form-group'>
              <input name='newheader' class='form-control' id='requesting' type='text' placeholder=''/>
             </div>  
                <div class='form-group'>
              <textarea name='newtext' class='form-control' id='textUpdate' value=''></textarea>
              </div>
                <button onclick='loading()' name='senders' id='senders' class='btn btn-info'>Update</button>
              </form>
          </div>
       </div>
    <?php
     if(isset($_SESSION['look'])){
        $val = $_SESSION['look'];
     }        
      require 'connection.php';
  if(isset($_SESSION['user'])){
      if(isset($_POST['senders'])){
   $Nh = $connect->real_escape_string(htmlentities($_POST['newheader']));
   $Nt = $connect->real_escape_string(htmlentities($_POST['newtext']));
    if(isset($Nh)){
          $chang = "UPDATE pst SET header = '$Nh' WHERE ID = $val ";
          $connect->query($chang);
         }  
      if(isset($Nt)){
               $cha = "UPDATE pst SET textd ='$Nt' WHERE ID = $val";
               $connect->query($cha); 
             }  
             $connect->close();   
          }
        }
        ?>
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
                 <h1 class='Create_user_h'>Create Account</h1>
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
            <button onclick='loading()' name='sss' id='sbtn' class='btn btn-info'>Submit</button>
        </form>      
    <?php
      require 'connection.php';
      if(!$connect){echo 'Connection Fail'; header('location:https://www.google.com');}

    if(isset($_POST['sss'])){
      $U=$connect->real_escape_string($_POST['user']);
      $E=$connect->real_escape_string($_POST['email']);
  $p=$connect->real_escape_string(md5($_POST['password']));
 $p2=$connect->real_escape_string(md5($_POST['spassword']));
      if(strlen($U) > 4 && strlen($E) > 5){
        if($p == $p2){
            $finded = "SELECT * FROM users Where email = '$E'";
            $requestedinto = $connect->query($finded);
              if(mysqli_num_rows($requestedinto) == 0){
   $in ="INSERT INTO users(ID,user,email,password)VALUES('NULL','$U','$E','$p')";
               $conclude = $connect->query($in);
               if($conclude == true){
                $_SESSION['user']= $U; 
               }
               $connect->close();
              }else{echo '<div id="alerted" class="alert alert-danger"><h2>Sorry Something went wrong...</h2></div><script> var ale  = document.getElementById("alerted"); 
                   function s(){
                    setTimeout(function(){
                       ale.style.opacity ="0";
                    },3000);
                   }
                   s();
               </script>';}
                 }else{
                   echo "<div id='alerted' class='alert alert-danger'><h2>Sorry Something went wrong...</h2></div><script> var ale  = document.getElementById('alerted'); 
                   function s(){
                    setTimeout(function(){
                       ale.style.opacity ='0';
                    },3000);
                   }
                   s();
               </script>;" ; 
                 }
                   }else{
                     echo '<div id="alerted" class="alert alert-danger"><h2>Sorry Something went wrong...</h2></div><script> var ale  = document.getElementById("alerted"); 
                   function s(){
                    setTimeout(function(){
                       ale.style.opacity ="0";
                    },3000);
                   }
                   s();
               </script>'; 
                   }
                 }
                  ?> 
                </div>
            <div class='log-container'>
                  <button id='lig' class='btn btn-info' onclick='log()'>...</button>
                  </div>
              </div>
          </div>  
           <!-- Second pop logIn activator .... -->
            <style>
            #CCreators{float:right;margin-right:10px; border-radius:1000px;margin-bottom:10px;}
            .log-container{float:right; margin:0px;margin-bottom:10px;margin-right:1px;}
            #lig{border-radius:1000px;}
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


               .chois{height:auto; width:auto;border-radius:10000px;position:relative; top:20px;}

               /*//// btn in*/
               .C-containers{height:auto;width:auto;float:right;}
                .CCreators{width:50px;float:right;}
          @media(max-width:420px){
              .form-container_pops{top:10%; height:80%; width:98%; border:1px solid black; background-color:white; left:1%;border-radius:10px;}

                  #eddits{width:65%;left:0px;margin-top:10%;}
                  .chois{height:150px; width:150px;border-radius:1000px;}
               }
                 .imagelogcontainer{width:100%;margin:0px; padding:0px;display:flex;justify-content:center}
             </style>
           <div id='creator-displayers' class='second_pops'>
      <div class='form-container_pops'>         
        <div onclick='logclose()' class='close_box'><p class='x-box'>X</p></div>
                <div class='imagelogcontainer'><img class='chois' src='choise.jpg'/></div>
                  <div id='eddits'>
                  <form  method='POST'>
                    <div class='form-group'>
                    <input class='form-control' name='emailL' type='email' placeholder='Type Email'/>
                    </div>
                    <div class='form-group'>
                    <input class='form-control' name='passwordL' type='password' placeholder='Ur password'/>
                    </div>
                  <button onclick='loading()' name='ssd' id='sbtns' class='btn btn-info'>Submit</button>
              </form>       
          </div>
   <?php
       if(isset($_POST['ssd'])){
        $em = $connect->real_escape_string(htmlentities($_POST['emailL']));
  $pa = $connect->real_escape_string(htmlentities(md5($_POST['passwordL'])));
  if(strlen($em) > 4 && strlen($pa) > 4){
    $finding2 = "SELECT * FROM users WHERE email ='$em'";
    $resulted = mysqli_query($connect,$finding2);
    if(mysqli_num_rows($resulted) > 0){
    while($rows = mysqli_fetch_assoc($resulted)){
    $colle = $rows["user"];
    $collp =$rows["password"];
    if($collp == $pa){
    $_SESSION['user'] = $colle;
    $connect->close();
    }else{echo '<div id="alerted" class="alert alert-danger"><h2>Sorry Something went wrong...</h2></div><script> var ale  = document.getElementById("alerted"); 
                   function s(){
                    setTimeout(function(){
                       ale.style.opacity ="0";
                    },3000);
                   }
                   s();
               </script>';}
}}else{echo '<div id="alerted" class="alert alert-danger"><h2>Sorry Something went wrong...</h2></div><script> var ale  = document.getElementById("alerted"); 
                   function s(){
                    setTimeout(function(){
                       ale.style.opacity ="0";
                    },3000);
                   }
                   s();
               </script>';
  } } }?>
      <style>
        .C-containers{height:auto; width:250px;text-align:center;margin-bottom:5%;margin-left:25%;}
     </style>
             <div class='C-containers'>
             <button id='CCreators' class='btn btn-info'onclick='logger()'>...</botton>
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
      <style>
     /* //comment container*/
        .comm-container{
        height:500px; width:100%;display:flex; justify-content:center;overflow-x:hidden;overflow-y:scroll;
        }
       /* //text container*/
        .text-container-comm{
           height:100px; width:70%;margin:10%;display:flex;border-radius:6px;
        }
        /*// daaaaa?*/
        .image-profile-container{
           height:60px; width:60px;border:1px solid black;border-radius:50%;flex:1;
        }

      /*  // message container*/
        .message-container{
     flex:6; height:60px;border:0.5px solid black;border-radius:6px;margin-left:3px;
        }
       /* /// messager creater ...*/
       .insert-container{
         height:70px; width:100%;display:flex;
           justify-content:center;overflow:hidden;
       }
        @media(min-width:650px){
         .holder{
          height:100%;width:60%;
       } 
       .image-profile-container{
           height:100px; width:100px;border:1px solid black;border-radius:50%;flex:1;
        }
         .message-container{
     flex:6; height:60px;border:0.5px solid black;border-radius:6px;margin-left:3px;margin-top:20px;
        }
        }
     /*  //text holder*/
       .holder{
          height:100%;width:100%;
       }
      /* // btn container comm*/
       .comm-btn{
          height:50px; width:100%;display:flex;
           justify-content:center;margin:1px;
       }
       #commbtn{
         height:35px; width:100%;
       }
         </style> 
       </body>
   </html>