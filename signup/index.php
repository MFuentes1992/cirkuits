<?php
  include_once("../util/utilities.php");
  require_once("../util/funciones.php");
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
  $strServerMsg = "";
  session_start();
  if(isset($_SESSION["user"]))
  {
    header("Location:".$url."dashboard");
  }
  if(isset($_POST["name"]))
  {
    $name      = !empty($_POST["name"]) ? GetSQLValueString($conexion, $_POST["name"], "text") : "NULL";
    $lstName   = !empty($_POST["lastName"]) ? GetSQLValueString($conexion, $_POST["lastName"], "text") : "NULL";
    $userName  = !empty($_POST["userName"]) ? GetSQLValueString($conexion, $_POST["userName"], "text") : "NULL";
    $password  = !empty($_POST["password"]) ? GetSQLValueString($conexion, $_POST["password"], "text") : "NULL";
    $email     = !empty($_POST["email"]) ? GetSQLValueString($conexion, $_POST["email"], "text") : "NULL";
    $birthDate = !empty($_POST["birthDate"]) ? GetSQLValueString($conexion, $_POST["birthDate"], "html") : "NULL";

    if(check_user($email) <= 0)
    {
      $result = insert_user($name, $lstName, $userName, $password, $email, $birthDate, 1);
      $id_usuario = mysqli_insert_id($conexion);
      if($result > 0)
      {
        session_start();
        $str_query = "SELECT * FROM usuarios where id_usuario = ".$id_usuario;
        $select_user = mysqli_query($conexion, $str_query);
        $row = mysqli_fetch_assoc($select_user);
        $_SESSION["user"] = $row;
        header("Location:".$url."dashboard");
      }
    }
  }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>Cirkuits Sign up</title>
  <link rel="stylesheet" href="<?=$url;?>css/bootstrap-4.3.1/dist/css/bootstrap.css" />
  <link rel="stylesheet" href="<?=$url;?>css/cirkuits.css" />
  <link rel="stylesheet" href="<?=$url;?>css/master.css" />
  <link rel="stylesheet" href="<?=$url;?>css/jquery-ui.css" />
  <link rel="stylesheet" href="<?=$url;?>css/fontawesome-free-5.8.1-web/css/all.css">
  <link rel="stylesheet" href="<?=$url;?>css/validationEngine.jquery.css" />
  <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet"> <!-- For banner propouses only -->
  <script src="<?=$url;?>js/jquery-1.12.3.min.js"></script>
  <script src="<?=$url;?>js/dist/bootstrap.min.js"></script>
  <script src="<?=$url;?>js/dist/bootstrap.bundle.js"></script>
  <script src="<?=$url;?>js/jquery-ui.js"></script>
  <script src="<?=$url;?>js/sanitizer.js"></script>
  <script src="<?=$url;?>js/jquery.validationEngine-es.js"></script>
  <script src="<?=$url;?>js/jquery.validationEngine.js"></script>
  <script src="<?=$url;?>js/reguser.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar navbar-brand">
      <img src="<?=$url;?>img/logo2.png" alt="" />
    </a>
    <div class="collapse navbar-collapse" id="navbarNav" style="flex-direction: row-reverse !important;">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?=$url;?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=$url;?>about">Cirkuits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=$url;?>videogames">Video Games</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=$url;?>signin">Sign In &nbsp;&nbsp;<i class="fas fa-sign-in-alt"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=$url;?>signup">Sign Up &nbsp;&nbsp;<i class="fas fa-user-plus"></i></a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container-fluid">

    <div class="row">
      <div class="contenido">
        <div class="text-center">
          <br>
          <h1>Sign up</h1>
        </div>
      </div>
      <br>
      <div class="form-wrapper">
        <div class="form">
          <form action="" method="post" id="reguser_form" onsubmit="return validaForm()">
            <div class="form form-group">
              <!--<label>Name</label>-->
              <input type="text" class="form-control"
              data-validation-engine="validate[required, custom[onlyLetterAccentSp]]"
              data-errormessage-value-missing="Name is required"
              data-errormessage-custom-error="Invalid, let me give you a hint: Andrew"
              name="name" id="name" placeholder="Name" />
            </div>
            <div class="form form-group">
              <!--<label>Last name</label>-->
              <input type="text" class="form-control"
              data-validation-engine="validate[required, custom[onlyLetterAccentSp]]"
              data-errormessage-value-missing="Last name is required"
              data-errormessage-custom-error="Invalid, let me give you a hint: Garfield"
              name="lastName" id="lastName" placeholder="Last name" />
            </div>
            <div class="form form-group">
              <!--<label>User name</label>-->
              <input type="text" class="form-control" name="userName" id="userName"
              data-validation-engine="validate[required, , custom[onlyLetterNumber]]"
              data-errormessage-value-missing="User name is required"
              data-errormessage-custom-error="Invalid, let me give you a hint: Awwwgarfiel"
              placeholder="User name" onblur="verify_user()"
              data-toggle="popover" title="Warning"
              data-placement="right"
              data-content="Username already exists" />
            </div>
            <div class="form form-group">
              <!--<label>password</label>-->
              <input type="password" class="form-control" name="password" id="password"
              data-validation-engine="validate[required]"
              data-errormessage-value-missing="Password is required"
              placeholder="password" />
            </div>
            <div class="form form-group">
              <!--<label>E-mail</label>-->
              <input type="email" class="form-control"
              data-validation-engine="validate[required,custom[email]]"
              data-errormessage-value-missing="Email is required"
              data-errormessage-custom-error="Invalid, let me give you a hint: someone@nowhere.com"
              name="email" id="email" placeholder="E-mail"
              data-toggle="popover" title="Warning"
              data-placement="right"
              data-content="Email already in use"
              onblur="verify_email()"
               />
            </div>
            <div class="form form-group">
              <!--<label>Confirm e-mail</label>-->
              <input type="text" class="form-control" name="conEmail" id="conEmail"
              data-validation-engine="validate[required,custom[email]]"
              data-errormessage-value-missing="Email is required"
              placeholder="Confirm E-mail" />
            </div>
            <div class="form form-group">
              <!--<label>Birth Date</label>-->
              <input type="text" class="form-control datepicker"
              data-validation-engine="validate[required]"
              data-errormessage-value-missing="Birth date is required"
              data-errormessage-custom-error="Invalid, let me give you a hint: 1992-10-21"
              placeholder="Birthdate" name="birthDate" id="birthDate" />
            </div>
            <div class="checkbox">
              <!--<label>Confirm e-mail</label>-->
              <label>
                <input type="checkbox"  name="terms"
                data-validation-engine="validate[required]"
                data-errormessage-value-missing="You must accept terms and conditions"
                id="terms" value="1" />
                I accept terms and conditions.
              </label>
            </div>

            <br>

          </form>
        </div>
        <div id="btn-register">
          <button type="button" name="btnLogin" id="btn-register" onclick="register()" class="btn btn-success">Register</button>
        </div>
      </div>
      <div class="" id="regLogin">
        <span>Already registred?</span><span style="margin-left:0.5%;"><a href="<?=$url;?>signin" class="label label-success">Sign in</a></span>
      </div>
    </div>

    <div class="row">
      <!-- Footer -->
      <footer class="footer col-md-12" style="position:relative">
        <div class="row">
          <div class="foot-section col-md-4" id="contacto">
            <span>+52 777 123 45 67</span>
            <br>
            <span>example@domain.com.mx</span>
            <br>
            <span>postal code: 63866</span>
            <br>
          </div>
          <div class="foot-section col-md-4" id="copyright">
            <span>2016 Cirkuits all rights reserved &copy;</span>
            <br>
          </div>
          <div class="foot-section social" id="social-1">
            <a href="http://www.twitter.com" target="_blank"><span style="font-size:28pt; color:#FFF;"><i class="fab fa-twitter-square"></i></span></a>
            <a href="http://www.facebook.com" target="_blank"><span style="font-size:28pt; color:#FFF;"><i class="fab fa-facebook"></i></span></a>
            <a href="http://www.youtube.com" target="_blank"><span style="font-size:28pt; color:#FFF;"><i class="fab fa-youtube"></i></span></a>
            <a href="http://www.instagram.com" target="_blank"><span style="font-size:28pt; color:#FFF;"><i class="fab fa-instagram"></i></span></a>
          </div>
        </div>
      </footer>
    </div>

  </div>
  <script type="text/javascript">
    $(document).ready( function(){
      $('#reguser_form').validationEngine();
      $('#birthDate').datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        maxDate: "-4Y",
        minDate: "-100Y",
        yearRange: "-100:-4"
      });
    } );
    var register = function()
    {
      $('#reguser_form').submit();
    }

    var verify_user = function()
    {
      var data = {
        userName: $('#userName').val()
      }
      console.log(data); //warning debug
      $.ajax({
        url:"<?=$url?>util/verificator.php",
        type:"post",
        data: data,
        success: function(response)
        {
          //console.log(response);
          var _response = parseInt(response);
          if(_response == 1)
          {
            console.log("popover");
            $('#userName').popover("show");
            $('#reguser_form').attr('onsubmit','return false');
          }else {
            $('#userName').popover("dispose");
            $('#reguser_form').attr('onsubmit','return validaForm()');
          }
        }
      })
    }
    var verify_email = function()
    {
      var data = {
        email: $('#email').val()
      }
      console.log(data); //warning debug
      $.ajax({
        url:"<?=$url?>util/verificator.php",
        type:"post",
        data: data,
        success: function(response)
        {
          var _response = parseInt(response);
          if(_response == 1)
          {
            console.log("popover");
            $('#email').popover("show");
            $('#reguser_form').attr('onsubmit','return false');
          }else {
            $('#reguser_form').attr('onsubmit','return validaForm()');
            $('#email').popover("dispose");
          }
        }
      })
    }
  </script>
</body>
</html>
