<?php 
    include_once("../util/utilities.php");
    require_once("../util/funciones.php");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    session_start();
    if(isset($_SESSION["user"]) && $_GET["game"]) {
        /**//////////////////////// GET THE LEVEL SESSION ///////////////////////// */
        $strSpeechRecognition = sprintf("SELECT count(*) as levels FROM videogame_level WHERE id_usuario = %s AND isLocked = %s AND id_videogame = %s",
        $_SESSION["user"]["id_usuario"], 0, 1);
        $strTheseThose = sprintf("SELECT count(*) as levels FROM  videogame_level WHERE id_usuario = %s AND isLocked = %s AND id_videogame = %s",
        $_SESSION["user"]["id_usuario"], 0, 2);
        $strToBe = sprintf("SELECT count(*) as levels FROM  videogame_level WHERE id_usuario = %s AND isLocked = %s AND id_videogame = %s",
        $_SESSION["user"]["id_usuario"], 0, 3);

        $resultSpeechRecognition = mysqli_query($conexion, $strSpeechRecognition)or die(mysqli_error($conexion));
        $resultTheseThose = mysqli_query($conexion, $strTheseThose)or die(mysqli_error($conexion));
        $resultToBe = mysqli_query($conexion, $strToBe)or die(mysqli_error($conexion));

        $_SESSION["SpeechRecognitionLevels"] = mysqli_fetch_assoc($resultSpeechRecognition);
        $_SESSION["TheseThoseLevels"] = mysqli_fetch_assoc($resultTheseThose);
        $_SESSION["ToBeLevels"] = mysqli_fetch_assoc($resultToBe);
        switch(intval($_GET["game"])){
            case 1:
                header("Location:".$url."speechrecognition/level".$_SESSION["SpeechRecognitionLevels"]["levels"]."/");
            break;
            case 2:
                header("Location:".$url."speechrecognition/level".$_SESSION["SpeechRecognitionLevels"]["levels"]."/");
            break;
            case 3: 
                header("Location:".$url."speechrecognition/level".$_SESSION["SpeechRecognitionLevels"]["levels"]."/");
            break;
        }        
    }
?>  