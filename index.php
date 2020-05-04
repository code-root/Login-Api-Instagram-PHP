<?php
            session_start();
            include 'conn.php';
            $isUserLoggedIn = isset($_SESSION['username']  ) ? true : false;

if ($isUserLoggedIn) {    
                 // Is Login Done 
         header("Location: home.php");
    exit;
}     
?>
  <!doctype html>
  <html lang="en">
  <head>
     <meta charset="utf-8" />
     <link rel="icon" type="image/png" href="https://www.instagram.com/static/images/ico/favicon-192.png/68d99ba29cc8.png">
     <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
     <title> Login instagram  </title>
     <link rel="stylesheet" href="css/stayle.css">
     <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Overpass+Mono" rel="stylesheet">
     <script src="js/jquery-1.9.1.min.js"></script>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
 </head>
 <body class="body"> 
    <br>
    <br>
    <br>
    <br>
 <div class="login-form">
    <form action="" method="post">
    <div class="header">
      <img src="https://i.imgur.com/zqpwkLQ.png" />
    </div>
    <br>
    <h5> Log in with Instagram  </h5>
    <br>
    <div class="res" > </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" id="username" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" id="password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block Login">Log in</button>
        </div>
        <div class="clearfix">
        </div>        
    </form>
    <div class="sub-content">
  </div>
</div>
<script type="text/javascript">

$(document).ready(function() {

    $('.Login').click(function(e){
      e.preventDefault();

      var username = $("#username").val();
      var password = $("#password").val();
      $.ajax({
          type: "POST",
          url: "ajax.php",
          dataType: "json",

          data: { Username : $("#username").val() , Password : $("#password").val() },


         success : function(data){
          if (data.status == "done"){
            $(".res").html(data.msg);
                setTimeout(function(){ window.location.href= 'home.php';}, 3000);
              }
              if (data.status == "error"){
                $(".res").html(data.msg);
              } 
          } 
      });


    });
});


</script>
    </body>
</html>