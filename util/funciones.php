<?php 

    function GetSQLValueString( $conexion, $theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "" ) {

        $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

        $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($conexion, $theValue) : mysqli_escape_string( $conexion, $theValue);

        switch ($theType) {
            case "text":
                $theValue = cleanString($theValue);
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                break;
            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
                break;
            case "html":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "pass":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "date":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }
        return $theValue;
    }

    function cleanString($string) {
$string = trim($string);

    $string = str_replace(
        array('à', 'ä', 'â', 'ª', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'A', 'A', 'A'),
        $string
    );

    $string = str_replace(
        array('è', 'ë', 'ê', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'E', 'E', 'E'),
        $string
    );

    $string = str_replace(
        array('ì', 'ï', 'î', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'I', 'I', 'I'),
        $string
    );

    $string = str_replace(
        array('ò', 'ö', 'ô', 'Ò', 'Ô'),
        array('o', 'o', 'o', 'O', 'O'),
        $string
    );

    $string = str_replace(
        array('ù', 'û', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'U', 'U', 'U'),
        $string
    );

    $string = str_replace(
        array('ç', 'Ç'),
        array('c', 'C',),
        $string
    );

    //Esta parte se encarga de eliminar cualquier caracter extraño
    $string = str_replace(
        array("\\", "¨", "º", "-", "~",
             "#", "|", "!", "\"",
             "•", "$", "%", "&",
             "(", ")", "¿", "?", "'", "¡",
             "[", "^", "script", "]",
             "+", "}", "{", "¨", "´",
             ">", "<", ";", ",", ":", "*", "%20", "&nbsp;",
             "php", "prompt", "ScRiPt", "sCrIpT", "Script", "SELECT", "select", "Select",
              "scRipt", "pHp", "PhP", "pHP", "bin", "\\\\", "http", "//", ".exe", ".Exe",
              ".eXe", ".EXE", "server", "src", "location", "alert", "javascript", ".js",
              "insert", "Insert", "Delete", "delete", "DELETE", "update", "Update", "UPDATE"
             ),
        '',
        $string
    );

    return $string;
}
