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
    $telUsuario = !empty($_POST["telUsuario"]) ? GetSQLValueString($conexion, $_POST["telUsuario"], "text") : "NULL";
    $celUsuario = !empty($_POST["celUsuario"]) ? GetSQLValueString($conexion, $_POST["celUsuario"], "text") : "NULL";
    $avatar = "'default'";
    $isAdmin = 0;

    if(check_user($email) <= 0)
    {
      $result = insert_user($name, $lstName, $userName, $password, $email, $telUsuario, $celUsuario,$birthDate, 2, $isAdmin, $avatar);
      $id_usuario = mysqli_insert_id($conexion);
      if($result > 0)
      {
        session_start();
        $str_query =  sprintf("SELECT * FROM usuarios where alter_usuario = %s AND password_usuario = %s",
        $userName, $password);
        $select_user = mysqli_query($conexion, $str_query);
        $row = mysqli_fetch_assoc($select_user);
        //Filling up initial data
        /*//////////////////////////// FILLING SPEECH RECOGNITION (id_videogame, id_level, id_usuario, IsLocked)/////////////////////////////////*/
        $strSPProgress1 = sprintf('INSERT INTO videogame_level (id_videogame, id_level, id_usuario, IsLocked) VALUES (%s,%s,%s,%s,%s)', 1, 1, $row['id_usuario'],0);
        $strSPProgress2 = sprintf('INSERT INTO videogame_level (id_videogame, id_level, id_usuario, IsLocked) VALUES (%s,%s,%s,%s,%s)', 1, 2, $row['id_usuario'],1);
        $strSPProgress3 = sprintf('INSERT INTO videogame_level (id_videogame, id_level, id_usuario, IsLocked) VALUES (%s,%s,%s,%s,%s)', 1, 3, $row['id_usuario'],1);
        $insert_SProgress1 = mysqli_query($conexion, $strSPProgress1);
        $insert_SProgress2 = mysqli_query($conexion, $strSPProgress2);
        $insert_SProgress3 = mysqli_query($conexion, $strSPProgress3);
        /*//////////////////////////// FILLING THESE/THOSE (id_videogame, id_level, id_usuario, IsLocked)/////////////////////////////////*/
        $strTTProgress1 = sprintf('INSERT INTO videogame_level (id_videogame, id_level, id_usuario, IsLocked) VALUES (%s,%s,%s,%s,%s)', 2, 1, $row['id_usuario'],0);
        $strTTProgress2 = sprintf('INSERT INTO videogame_level (id_videogame, id_level, id_usuario, IsLocked) VALUES (%s,%s,%s,%s,%s)', 2, 2, $row['id_usuario'],1);
        $strTTProgress3 = sprintf('INSERT INTO videogame_level (id_videogame, id_level, id_usuario, IsLocked) VALUES (%s,%s,%s,%s,%s)', 2, 3, $row['id_usuario'],1);
        $insert_TTprogress1 = mysqli_query($conexion, $strTTProgress1);
        $insert_TTprogress2 = mysqli_query($conexion, $strTTProgress2);
        $insert_TTprogress3 = mysqli_query($conexion, $strTTProgress3);
        /*//////////////////////////// FILLING TO BE - TENSE MASTER (id_videogame, id_level, id_usuario, IsLocked)/////////////////////////////////*/
        $strTBProgress1 = sprintf('INSERT INTO videogame_level (id_videogame, id_level, id_usuario, IsLocked) VALUES (%s,%s,%s,%s,%s)', 3, 1, $row['id_usuario'],0);
        $strTBProgress2 = sprintf('INSERT INTO videogame_level (id_videogame, id_level, id_usuario, IsLocked) VALUES (%s,%s,%s,%s,%s)', 3, 2, $row['id_usuario'],0);
        $strTBProgress3 = sprintf('INSERT INTO videogame_level (id_videogame, id_level, id_usuario, IsLocked) VALUES (%s,%s,%s,%s,%s)', 3, 3, $row['id_usuario'],0);
        $insert_TBprogress1 = mysqli_query($conexion, $strTBProgress1);
        $insert_TBprogress2 = mysqli_query($conexion, $strTBProgress2);
        $insert_TBprogress3 = mysqli_query($conexion, $strTBProgress3);
        if($insert_SProgress1 && $insert_SProgress2 && $insert_SProgress3 &&
            $insert_TTprogress1 && $insert_TTprogress2 && $insert_TTprogress3 ){
          $_SESSION["user"] = $row;
          header("Location:".$url."dashboard");
        } else{
          header("Location:".$url."error.php");
        }    
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
  <div class="pos-f-t">
      <nav class="navbar sticky-top navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="col-md-8" id="logoContainer">
          <a href="<?=$url;?>" style="margin-left: 10%;"><img class="img_logo" src="<?=$url; ?>img/horizontal_alt.png" alt="cirkuits logo" width="240" height="100"/></a>
        </div>
      </nav>
      <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark" style="padding-left: 1.5rem">
          <h5 class="text-white label"><a class="text-white label" href="../">Home</a></h5>
          <h5 class="text-white label"><a class="text-white label" href="../signin">Sign in</a></h5>
        </div>
      </div>
  </div>
  <div class="container-fluid">

    <div class="row">
      <div class="contenido">
        <div class="text-center">
          <br>
          <h1>Sign up</h1>
        </div>
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
              <!--<label>Confirm e-mail</label>-->
              <input type="text" class="form-control" name="telUsuario" id="telUsuario"
              data-validation-engine="validate[required]"
              data-errormessage-value-missing="Phone is required"
              placeholder="Telephone" />
            </div>

            <div class="form form-group">
              <!--<label>Confirm e-mail</label>-->
              <input type="text" class="form-control" name="celUsuario" id="celUsuario"
              data-validation-engine="validate[required]"
              data-errormessage-value-missing="Mobile phone is required"
              placeholder="Mobile phone" />
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
          <button type="button" name="btnLogin" id="btn-register" onclick="register()" class="btn btn-outline-info">Register</button>
        </div>
      </div>  
      <div class="" id="regLogin">
        <span>Already registred?</span><span style="margin-left:0.5%;"><a href="<?=$url;?>signin" class="label label-success">Sign in</a></span>
      </div>      
      </div>
      <br>


    </div>

    <div class="row">
      <!-- Footer -->
      <footer class="footer col-md-12" style="position:relative;">
        <div class="row">
          <div class="foot-section" id="logoAndSocial">
            <div>
              <img src="../img/cirkuits education_bw.png" alt="cirkuits logo Black & White" width="128">
            </div>              
            <ul class="list-horizontal">
              <li class="white icon"><i class="fab fa-facebook-f"></i></li>
              <li class="white icon"><i class="fab fa-youtube"></i></li>
              <li class="white icon"><i class="fas fa-envelope-open"></i></li>
            </ul>
            <p class="white">Powered by Three Js &nbsp; &nbsp;<i class="fas fa-dice-d6"></i></p>
            <p class="white">MarkCraft labs &nbsp; &nbsp;<i class="fas fa-flask"></i></p>
          </div>
          <div class="foot-section" id="contactoFooter">
            <span>
              <h4>Contact</h4>
            </span>
            <span class="label">+52 777 500 60 83</span>
            <br>
            <span class="label">postal code: 63866</span>
            <br>
            <span class="label">cirkuitsed@cirkuits.com.mx</span>
            <br>
            <span class="label">2019 www.cirkuits.com &copy;</span>
          </div>
          <div class="foot-section" id="supportFooter">
            <span>
              <h4>Soporte</h4>
            </span>
            <span class="label">Contact Us</span>
            <br>
            <span class="label">Help & FAQ</span>
            <br>
            <span class="label">Service Status</span>
            <br>
            <span class="label">Tech Requirements</span>
          </div>
        </div>
      </footer>
      <div style="position:relative; width: 100%;">
        <p style="text-align:center; color #FFF; font-family:'Jokey';">Made with &nbsp;<i class="fas fa-laptop-code"></i>&nbsp; by MarkCraft </p>
      </div>
    </div>

  </div>
  <script type="text/javascript">
    var commonResponsive = swidth => {
        $('.separator').css('visibility', 'hidden');
        
    }

   var tabletResponsive = (swidth) =>{
      commonResponsive(swidth);
      $("#logoContainer > a").css('margin-left','0%');
    }
    var mobileResponsive = (swidth) =>{
      commonResponsive(swidth);
      $('.img_logo').css('width', '200');
      $('.img_logo').css('height', '80');
      $('#logoContainer').removeClass('col-md-8');
      $("#logoContainer > a").css('margin-left','0%');      
      $('#contactoFooter').css('width', '100%');
    }

    var responsiveEngine = () => {
      var SCREEN_WIDTH = $(window).width();
      var SCREEN_HEIGHT = $(window).height();
      /** /////////////// RESPONSIVE ////////////// */

      /**//////////////// TABLET (800 - 425) ////////// */
      if(SCREEN_WIDTH <= 800 && SCREEN_WIDTH > 425){
        tabletResponsive(SCREEN_WIDTH);
      }
      /**//////////////// MOBILE (425 - 325) ////////// */
      if(SCREEN_WIDTH <= 425){
        mobileResponsive(SCREEN_WIDTH);
      }
      if(SCREEN_WIDTH >= 1404){
        $("#logoContainer > a").css('margin-left','15%');
      } 
    }


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
      responsiveEngine();
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
