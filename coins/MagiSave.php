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
    $updateHighScore = "";
    if($UserID != NULL){
        $getUserInfo = sprintf("select * from videogame_progress vp 
            inner join  leaderboard lb on vp.id_progress = lb.id_progress where vp.id_usuario = %s", 
            GetSQLValueString($conexion, $UserID, "int"));
        $result_save = mysqli_query($conexion, $getUserInfo);
        $row = mysqli_fetch_assoc($result_save);
        if(intval($row["nivel"]) == intval($NextLevel)){
            $updateScore = sprintf("UPDATE videogame_progress SET score = %s where id_usuario = %s", 
            GetSQLValueString($conexion, $Score, "int"), GetSQLValueString($conexion, $UserID, "int"));
            $result = mysqli_query($conexion, $updateScore) or die(mysqli_error($conexion));
            $result2 = 0;
            if($Score > $row['high_score']){
                $updateHighScore = sprintf("UPDATE leaderboard set high_score = %s where id_usuario = %s", 
                GetSQLValueString($conexion, $Score, "int"), GetSQLValueString($conexion, $UserID, "int"));
                $result2 = mysqli_query($conexion, $updateHighScore) or die(mysqli_error($conexion));
            }
            if($result > 0 || $result2 > 0){
                echo 1;
            }else{
                echo -1;
            }
        }else if(intval($NextLevel) > intval($row["nivel"])){
            
            $updateHighScore = sprintf("UPDATE videogame_progress SET nivel = %s,  score = %s 
                where id_usuario = %s", GetSQLValueString($conexion, $NextLevel, "int"),
                GetSQLValueString($conexion, $Score, "int"), GetSQLValueString($conexion, $UserID, "int"));
            $result = mysqli_query($conexion, $updateHighScore) or die(mysqli_error($conexion));
            if($Score > $row['high_score']){
                $updateHighScore = sprintf("UPDATE leaderboard set high_score = %s where id_usuario = %s", 
                GetSQLValueString($conexion, $Score, "int"), GetSQLValueString($conexion, $UserID, "int"));
                $result2 = mysqli_query($conexion, $updateHighScore) or die(mysqli_error($conexion));
            }
            if($result > 0 || $result2 > 0){
                echo 1;
            }else{
                echo -1;
            }
        }
        
    }
?>