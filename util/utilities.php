<?php
  include("DAO.php");
  $url = "http://localhost/cirkuits/";
  //$url = "http://cirkuits.com.mx/";
  
  function write_console($strMsg)
  {
    echo '<script>console.log("'.$strMsg.'")</script>';
  }

  function check_user($email)
  {
    $strQuery = "SELECT nombre_usuario FROM usuarios WHERE  email_usuario = ";
    $strQuery .= $email;

    $result = mysqli_query($GLOBALS["conexion"], $strQuery);
    return mysqli_num_rows($result);
  }

  function insert_user($name, $lstName, $userName, $password, $email, $telUsuario, $celUsuario, $birthDate, $estatus, $isAdmin, $avatar)
  {
    $strQuery = sprintf("INSERT INTO usuarios (nombre_usuario, apellido_usuario, alter_usuario, password_usuario,
      email_usuario, tel_usuario, cel_usuario, nacimiento_usuario, estatus_usuario, isAdmin, fecha_registro, fecha_actualizacion, avatar_usuario)  VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,NOW(), NOW(), %s)",
    $name,$lstName,$userName,$password,$email,$telUsuario,$celUsuario,$birthDate,$estatus, $isAdmin,$avatar);
    $result = mysqli_query($GLOBALS["conexion"], $strQuery);
    return $result;
  }

  function check_card_number($cardNumber)
  {
    $strQuery = "SELECT nombre_tarjeta FROM payment WHERE numero_tarjeta=".$cardNumber."";
    $result = mysqli_query($GLOBALS["conexion"], $strQuery);
    return mysqli_num_rows($result);
  }

  function insert_tarjeta($name, $lstName, $cardNumber, $cardMonth, $cardYear, $cvc, $userId )
  {
    $strQuery = " INSERT INTO payment ";
    $strQuery .= " (  nombre_tarjeta, ap_tarjeta, numero_tarjeta,  	mes_tarjeta, ";
    $strQuery .= " anio_tarjeta, cvc_tarjeta )";
    $strQuery .= " VALUES (".$name.",".$lstName.",".$cardNumber.",".$cardMonth.",".$cardYear.",".$cvc.")";

    $strQuery2 = "UPDATE usuarios SET estatus_usuario=2 WHERE id_usuario=".$userId;
    //echo $strQuery;

    $result = mysqli_query($GLOBALS["conexion"], $strQuery);

    return $result;
  }

  function iflvlExists($lvl,$idVideogame,$idUser)
  {

    $flag = 0;

    $str_check_if_level = sprintf("SELECT score, nivel FROM videogame_progress WHERE id_videogame = %s AND id_usuario = %s AND nivel = %s",
    GetSQLValueString($GLOBALS["conexion"], $idVideogame, "int"),
    GetSQLValueString($GLOBALS["conexion"], $idUser, "int"),
    GetSQLValueString($GLOBALS["conexion"], $lvl, "int"));

    $rs = mysqli_query($GLOBALS["conexion"], $str_check_if_level)or die(mysqli_error($conexion));

    $row =  mysqli_num_rows($rs) > 0 ? mysqli_fetch_assoc($rs) : NULL;

    if($lvl == $row["nivel"])
      $flag = 1;

    return $flag;
  }

  function fitDate($day, $month){
    $max_day = 0;
    $returnValue = 1;
    switch ($month) {
      case 1:
        $max_day = 31;
        $returnValue = $day <= $max_day ? 0 : $day - $max_day;
        break;
      case 2:
        $max_day = date('L') ? 28 : 29;
        $returnValue = $day <= $max_day ? 0 : $day - $max_day;
        break;
      case 3:
        $max_day = 31;
        $returnValue = $day <= $max_day ? 0: $day - $max_day;
        break;
      case 4:
        $max_day = 30;
        $returnValue = $day <= $max_day ? 0: $day - $max_day;
        break;
      case 5:
        $max_day = 31;
        $returnValue = $day <= $max_day ? 0: $day - $max_day;
        break;
      case 6:
        $max_day = 30;
        $returnValue = $day <= $max_day ? 0: $day - $max_day;
        break;
      case 7:
        $max_day = 31;
        $returnValue = $day <= $max_day ? 0: $day - $max_day;
        break;
      case 8:
        $max_day = 31;
        $returnValue = $day <= $max_day ? 0: $day - $max_day;
        break;
      case 9:
        $max_day = 30;
        $returnValue = $day <= $max_day ? 0: $day - $max_day;
        break;
      case 10:
        $max_day = 31;
        $returnValue = $day <= $max_day ? 0: $day - $max_day;
        break;
      case 11:
        $max_day = 30;
        $returnValue = $day <= $max_day ? 0: $day - $max_day;
        break;
      case 12:
        $max_day = 31;
        $returnValue = $day <= $max_day ? 0: $day - $max_day;
        break;
    }
    return $returnValue;
  }

 ?>
