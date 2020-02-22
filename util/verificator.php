<?php
  require_once("DAO.php");
  require_once("funciones.php");
  require_once("utilities.php");
  if(isset($_POST["userName"]))
  {
    $initRegex = "'%";
    $endRegex  = "%'";
    $query_userName = sprintf("SELECT email_usuario FROM usuarios WHERE alter_usuario LIKE %s%s%s",
    $initRegex,strtolower(GetSQLValueString($conexion, $_POST["userName"], "defined", $_POST["userName"])),
    $endRegex);
    //echo $query_userName; //Warning debug
    $result_userName = mysqli_query($conexion, $query_userName);
    if(mysqli_num_rows($result_userName) > 0)
    {
      echo 1;
    }
    else {
      echo 0;
    }
  }
  if(isset($_POST["email"]))
  {
    $query_email = sprintf("SELECT alter_usuario FROM usuarios WHERE email_usuario = %s",
    GetSQLValueString($conexion, $_POST["email"],"text"));
    $result_email = mysqli_query($conexion, $query_email);
    if(mysqli_num_rows($result_email) > 0)
    {
      echo 1;
    }
    else {
      echo 0;
    }
  }
  if(isset($_POST["edit"]) && isset($_POST["_userName"]))
  {
    $initRegex = "'%";
    $endRegex  = "%'";
    $query_userName = sprintf("SELECT email_usuario FROM usuarios WHERE alter_usuario LIKE %s%s%s AND id_usuario <> %s",
    $initRegex,strtolower(GetSQLValueString($conexion, $_POST["_userName"], "defined", $_POST["_userName"])),
    $endRegex,
    GetSQLValueString($conexion, $_POST["id"], "int"));
    //echo $query_userName; //Warning debug
    //echo '<br>';
    $result_userName = mysqli_query($conexion, $query_userName);
    if(mysqli_num_rows($result_userName) > 0)
    {
      echo 1;
    }
    else {
      echo 0;
    }
  }
  if(isset($_POST["edit"]) && isset($_POST["_email"]))
  {
    $query_email = sprintf("SELECT alter_usuario FROM usuarios WHERE email_usuario = %s AND id_usuario <> %s",
    GetSQLValueString($conexion, $_POST["_email"],"text"),
    GetSQLValueString($conexion, $_POST["id"], "int"));
    $result_email = mysqli_query($conexion, $query_email);
    if(mysqli_num_rows($result_email) > 0)
    {
      echo 1;
    }
    else {
      echo 0;
    }
  }
 ?>
