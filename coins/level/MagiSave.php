<?php 
    include_once("../util/utilities.php");
    require_once("../util/funciones.php");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    $UserID = (isset($_POST["UserID"]) ? $_POST["UserID"] : NULL);
    $VideogameID = (isset($_POST["VideogameID"]) ? $_POST["VideogameID"] : NULL);
    $CurrentLevel = (isset($_POST["CurrentLevel"]) ? $_POST["CurrentLevel"] : NULL);
    $NextLevel = (isset($_POST["NextLevel"]) ? $_POST["NextLevel"] : NULL);
    $Score = (isset($_POST["Score"]) ? $_POST["Score"] : NULL);

    if($UserID != NULL){
        $getUserInfo = sprintf("    select * from videogame_progress vp 
            inner join  leaderboard lb on vp.id_progress = lb.id_progress where vp.id_usuario = %s", 
            GetSQLValueString($conexion, $UserID, "int"));
        
    }
?>