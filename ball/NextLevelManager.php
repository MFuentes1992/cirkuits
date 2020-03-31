<?php 
    include_once("../util/utilities.php");
    require_once("../util/funciones.php");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    session_start();
    if(isset($_SESSION["user"])) {
        $queryUsuario = sprintf("select * from videogame_progress vp 
        inner join  leaderboard lb on vp.id_progress = lb.id_progress where vp.id_usuario = %s; ", 
        GetSQLValueString($conexion, $_SESSION["user"]["id_usuario"], "int"));
        $resul = mysqli_query($conexion, $queryUsuario) or die(mysqli_error($conexion));
        if($resul > 0)
        {
            $_SESSION["uprogressv1"] =  mysqli_fetch_assoc($resul);
        }
        header("Location:".$url."ball/level".$_SESSION["uprogressv1"]["nivel"]."/");
    }
?>  