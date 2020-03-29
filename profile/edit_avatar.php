<?php
include_once("../util/utilities.php");
require_once("../util/funciones.php");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$avatar = (isset($_POST["avatar"]) ? $_POST["avatar"]   : "default");
$idUsuario = (isset($_POST["idUsuario"])) ? $_POST["idUsuario"] : false;
if(!$idUsuario){
  echo "Couldn't get user ID";
}else if(isset($_POST["update"])) {
  $query_update_info = sprintf("UPDATE usuarios SET
  avatar_usuario = %s WHERE id_usuario = %s",
  GetSQLValueString($conexion, $avatar, "text"),
  GetSQLValueString($conexion, $idUsuario, "int"));  
  $result_update_usuario = mysqli_query($conexion, $query_update_info) or die(mysqli_error($conexion));
  Echo $result_update_usuario;
}
 ?>