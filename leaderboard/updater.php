<?php
include_once("../util/utilities.php");
require_once("../util/funciones.php");

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$id_videogame = isset($_POST["id_videogame"]) ? $_POST["id_videogame"]   : 0;
$currLevel    = isset($_POST["current_level"]) ? $_POST["current_level"] : 0;
$idUser       = isset($_POST["id_usuario"]) ? $_POST["id_usuario"]       : 0;
$score        = isset($_POST["score"]) ? $_POST["score"]                 : 0;


$query_get_curr_score = sprintf("SELECT score FROM videogame_progress WHERE id_videogame = %s AND id_usuario = %s AND nivel = %s",
GetSQLValueString($conexion, $id_videogame, "int"),
GetSQLValueString($conexion, $idUser, "int"),
GetSQLValueString($conexion, $currLevel, "int"));
$result_get_score = mysqli_query($conexion, $query_get_curr_score)or die(mysqli_error($conexion));
$row_cs = mysqli_num_rows($result_get_score) > 0 ? mysqli_fetch_assoc($result_get_score) : NULL;

if($row_cs["score"] < $score)
{
  $query_update_lvl = sprintf("UPDATE videogame_progress SET score = %s WHERE id_videogame = %s AND id_usuario = %s AND nivel = %s",
  GetSQLValueString($conexion, $score, "int"),
  GetSQLValueString($conexion, $id_videogame, "int"),
  GetSQLValueString($conexion, $idUser, "int"),
  GetSQLValueString($conexion, $currLevel, "int"));
  $result_update = mysqli_query($conexion, $query_update_lvl)or die(mysqli_error($conexion));
}

$query_is_a_lvl = sprintf("SELECT score FROM videogame_progress WHERE id_videogame = %s AND id_usuario = %s AND nivel = %s",
GetSQLValueString($conexion, $id_videogame, "int"),
GetSQLValueString($conexion, $idUser, "int"),
GetSQLValueString($conexion, ($currLevel + 1), "int"));
$result_lvl = mysqli_query($conexion, $query_is_a_lvl)or die(mysqli_error($conexion));

if(mysqli_num_rows($result_lvl) == 0)
{
  $query_unlock_lvl = sprintf("INSERT INTO videogame_progress (id_videogame, id_usuario, nivel, score) VALUES(%s, %s, %s, %s)",
  GetSQLValueString(),
  GetSQLValueString(),
  GetSQLValueString(),
  GetSQLValueString());
}


 ?>
