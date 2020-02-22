<?php
  require_once("../util/DAO.php");
  require_once("../util/funciones.php");
  include_once("../util/utilities.php");

  session_start();

  $nombre     = (!empty($_POST["name"]) ? GetSQLValueString($conexion, $_POST["name"], "text"): "");
  $apellido   = (!empty($_POST["lastName"]) ? GetSQLValueString($conexion, $_POST["lastName"], "text"): "");
  $numero     = (!empty($_POST["cardNumber"]) ? GetSQLValueString($conexion, $_POST["cardNumber"], "text"): "");
  $mes        = (!empty($_POST["cardValidMonth"]) ? GetSQLValueString($conexion, $_POST["cardValidMonth"], "text"): "");
  $anio       = (!empty($_POST["cardValidYear"]) ? GetSQLValueString($conexion, $_POST["cardValidYear"], "text"): "");
  $cvc        = (!empty($_POST["cvc"]) ? GetSQLValueString($conexion, $_POST["cvc"], "text"): "");

  $idUsuario = (isset($_SESSION["user"]["id_usuario"])? $_SESSION["user"]["id_usuario"] : "");

  $str_update_plastic = sprintf("UPDATE plastic SET nombre_tarjeta = %s, ap_tarjeta = %s, numero_tarjeta = %s, mes_tarjeta = %s,
    anio_tarjeta = %s, cvc_tarjeta = %s WHERE id_usuario = %s",
  $nombre, $apellido, $numero, $mes, $anio, $cvc, $idUsuario);

  $rs = mysqli_query($conexion, $str_update_plastic);

  if($rs) {
    header("Location:".$url."updatepayment/thanks/");
  } else {
    header("Location:".$url."updatepayment/error/");
  }

?>
