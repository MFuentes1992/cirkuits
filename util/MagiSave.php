<?php 
    include_once("utilities.php");
    require_once("funciones.php");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    $UserID = (isset($_POST["UserID"]) ? $_POST["UserID"] : NULL);
    $VideogameID = (isset($_POST["VideogameID"]) ? $_POST["VideogameID"] : NULL);
    $CurrentLevel = (isset($_POST["CurrentLevel"]) ? $_POST["CurrentLevel"] : NULL);
    $Pass = (isset($_POST["Pass"]) ? $_POST["Pass"] : NULL);
    $Score = (isset($_POST["Score"]) ? $_POST["Score"] : NULL);
    $Estrellas = (isset($_POST["Estrellas"]) ? $_POST["Estrellas"] : NULL );
    $updateHighScore = "";
    if($UserID != NULL){
        //Get the ID of the current level relationship to populate the progress.
        $videogame_level_id = 0; // Replace by value in DB  
        $strQueryLevelId = sprintf("SELECT id_videogame_level FROM videogame_level WHERE id_level = %s AND id_usuario = %s AND id_videogame = %s;",
        GetSQLValueString($conexion, $CurrentLevel, "int"), GetSQLValueString($conexion, $UserID, "int"), GetSQLValueString($conexion, $VideogameID, "int"));
        $rawLevelId = mysqli_query($conexion, $strQueryLevelId)or die(mysqli_error($conexion));
        $resultLevelId = mysqli_fetch_assoc($rawLevelId);
        $videogame_level_id = $resultLevelId["id_videogame_level"];

        $progressFound = 0;
        $strQueryLevelProgress = sprintf("SELECT count(*) AS total FROM level_progress WHERE id_videogame_level = %s;",
        $videogame_level_id);
        $rawLevelProgress = mysqli_query($conexion, $strQueryLevelProgress)or die(mysqli_error($conexion));
        $progressFound = mysqli_fetch_assoc($rawLevelProgress)["total"];

        if(intval($Pass) == 1){            
            $strUpdateVL = sprintf("UPDATE videogame_level SET isLocked = 0 WHERE id_videogame = %s AND id_usuario = %s AND id_level = %s;",
            GetSQLValueString($conexion, $VideogameID, "int"), GetSQLValueString($conexion, $UserID, "int"), (intval($CurrentLevel) + 1));
            $resultVL = mysqli_query($conexion, $strUpdateVL)or die(mysqli_error($conexion));
        }

        if($progressFound > 0){
            //TODO: Update table level_progress
            $strQueryEstrellaHScore = sprintf("SELECT estrellas, high_score FROM level_progress WHERE id_videogame_level = %s;", 
            GetSQLValueString($conexion, $videogame_level_id, "int"));
            $rawVP = mysqli_query($conexion, $strQueryEstrellaHScore)or die(mysqli_error($conexion));
            $resultVP = mysqli_fetch_assoc($rawVP);            
            
            $updateEstrellas = intval( $Estrellas ) > intval( $resultVP["estrellas"] ) ? $Estrellas : $resultVP["estrellas"];
            $hscore_record = intval( $Score ) > intval( $resultVP["high_score"] ) ? $Score : $resultVP["high_score"];
                        
            $strUpdateVP = sprintf("UPDATE level_progress SET score = %s, high_score = %s, estrellas = %s WHERE id_videogame_level = %s;", 
            GetSQLValueString($conexion, $Score, "int"), GetSQLValueString($conexion, $hscore_record, "int"), 
            GetSQLValueString($conexion, $updateEstrellas, "int"), GetSQLValueString($conexion, $videogame_level_id, "int"));
            $resultVP = mysqli_query($conexion, $strUpdateVP)or die(mysqli_error($conexion));
            if($resultVP){
                echo '1';
            }

        }else {
            $queryInsert = sprintf("INSERT INTO level_progress (id_videogame_level, score, high_score, estrellas) VALUES (%s, %s, %s, %s);",
            GetSQLValueString($conexion, $videogame_level_id, "int"), GetSQLValueString($conexion, $Score, "int"), GetSQLValueString($conexion, $Score, "int"), GetSQLValueString($conexion, $Estrellas, "int"));
            $result = mysqli_query($conexion, $queryInsert)or die(mysqli_error($conexion));
            if($result){
                echo '1';
            }
        }
    }else echo "-1";
?>