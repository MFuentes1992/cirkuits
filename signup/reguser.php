<?php
  include_once("util/utilities.php");
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
  $strServerMsg = "";
  $date = date("Y-m-d H:i:s");
  if(isset($_POST["name"]))
  {
    $name      = strip_tags($_POST["name"], FILTER_SANITIZE_STRING);
    $lstName   = strip_tags($_POST["lastName"], FILTER_SANITIZE_STRING);
    $userName  = strip_tags($_POST["userName"], FILTER_SANITIZE_STRING);
    $password  = strip_tags($_POST["password"], FILTER_SANITIZE_STRING);
    $email     = strip_tags($_POST["email"], FILTER_SANITIZE_STRING);
    $birthDate = strip_tags($_POST["birthDate"], FILTER_SANITIZE_STRING);

    $strServerMsg .= $name;
    $strServerMsg .= "|";
    $strServerMsg .= $lstName;
    $strServerMsg .= "|";
    $strServerMsg .= $userName;
    $strServerMsg .= "|";
    $strServerMsg .= $email;
    $strServerMsg .= "|";
    $strServerMsg .= $birthDate;
    $strServerMsg .= "|";

    write_console(check_user($userName));
    write_console($strServerMsg);

    if(check_user($userName) <= 0)
    {
      $result = insert_user($name, $lstName, $userName, $password, $email, $birthDate, 1, $date);
      $id_usuario = mysqli_insert_id($conexion);
      //write_console($result);
      if($result > 0)
      {
        session_start();
        $str_query = "SELECT * FROM usuarios where id_usuario = ".$id_usuario;
        $select_user = mysqli_query($conexion, $str_query);
        $row = mysqli_fetch_assoc($select_user);
        $_SESSION["user"] = $row;
        header("Location:payment.php");
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
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="css/cirkuits.css" />
  <link rel="stylesheet" href="css/master.css" />
  <link rel="stylesheet" href="css/jquery-ui.css" />
  <link rel="stylesheet" href="css/validationEngine.jquery.css" />
  <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet"> <!-- For banner propouses only -->
  <script src="js/jquery-1.12.3.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/sanitizer.js"></script>
  <script src="js/jquery.validationEngine-es.js"></script>
  <script src="js/jquery.validationEngine.js"></script>
  <script src="js/reguser.js"></script>
</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top menu">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#cirkuitsNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="#" class="navbar-brand"><img src="img/logo2.png" alt="Logo Cirkuits" class="img-navbar"/></a>
      </div>
      <div class="collapse navbar-collapse" id="cirkuitsNavbar">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.php"><strong>Home</strong></a></li>
          <li><a href="cirkuits.php"><strong>Cirkuits</strong></a></li>
          <li><a href="videojuegos.php"><strong>Video Games</strong></a></li>
          <li><a href="reguser.php"><span class="glyphicon glyphicon-user"></span> <strong>Sing Up</strong></a></li>
          <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> <strong>Login</strong></a></li>
        </ul>
      </div>
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
      <div class="form">
        <form action="reguser.php" method="post" id="reguser_form" onsubmit="return validaForm()">
          <div class="form form-group">
            <!--<label>Name</label>-->
            <input type="text" class="form-control"
            data-validation-engine="validate[required, custom[onlyLetterSp]]"
            data-errormessage-value-missing="Name is required"
            data-errormessage-custom-error="Invalid, let me give you a hint: Andrew"
            name="name" id="name" placeholder="Name" />
          </div>
          <div class="form form-group">
            <!--<label>Last name</label>-->
            <input type="text" class="form-control"
            data-validation-engine="validate[required, custom[onlyLetterSp]]"
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
      <div id="btn-login">
        <button type="button" name="btnLogin" id="btn-log" onclick="register()" class="btn btn-success btn-block"><h4>Register</h4></button>
      </div>
      <div class="" id="regLogin">
        <span>Already registred?</span><h3><a href="login.php" class="label label-success">Sign in</a></h3>
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
            <div class="img-social">
              <img src="img/index/twitter.png" alt="Twitter" />
            </div>
            <div class="img-social">
              <img src="img/index/facebook.png" alt="Facebook" />
            </div>
            <div class="img-social">
              <img src="img/index/youtube.png" alt="Youtube" />
            </div>
          </div>
        </div>
      </footer>
    </div>

  </div>
  <script type="text/javascript">
    $(document).ready( function(){
      $('#reguser_form').validationEngine();
      $('#birthDate').datepicker({changeYear:true});
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
        url:"verificator.php",
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
            $('#userName').popover("destroy");
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
        url:"verificator.php",
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
            $('#email').popover("destroy");
          }
        }
      })
    }
  </script>
</body>
</html>
