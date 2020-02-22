<?php
require_once("../util/DAO.php");
require_once("../util/funciones.php");
include_once("../util/utilities.php");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_start();
require_once("../conekta-php/conekta-php/lib/Conekta.php");
Conekta::setApiKey("key_CXCwvWvrrSbdLEn5Pwzjyg");

$nombre     = (isset($_POST["name"]) ? $_POST["name"]                         : "");
$apellido   = (isset($_POST["lastName"]) ? $_POST["lastName"]                 : "");
$numero     = (isset($_POST["cardNumber"]) ? $_POST["cardNumber"]             : "");
$mes        = (isset($_POST["cardValidMonth"]) ? $_POST["cardValidMonth"]     : "");
$anio       = (isset($_POST["cardValidYear"]) ? $_POST["cardValidYear"]       : "");
$cvc        = (isset($_POST["cvc"]) ? $_POST["cvc"]                           : "");
$tipo_renta = (isset($_POST["tipoSubscripcion"]) ? $_POST["tipoSubscripcion"] : "");

$idUsuario = (isset($_SESSION["user"]["id_usuario"])? $_SESSION["user"]["id_usuario"] : "");

$charge = Conekta_Charge::create(array(
'description'=> 'Stogies',
'reference_id'=> '9839-wolf_pack',
'amount'=> 20000,
'currency'=>'MXN',
'card'=> 'tok_test_visa_4242',
'details'=> array(
'name'=> 'Arnulfo Quimare',
'phone'=> '403-342-0642',
'email'=> 'logan@x-men.org',
'customer'=> array(
  'logged_in'=> true,
  'successful_purchases'=> 14,
  'created_at'=> 1379784950,
  'updated_at'=> 1379784950,
  'offline_payments'=> 4,
  'score'=> 9
),
'line_items'=> array(
  array(
    'name'=> 'Box of Cohiba S1s',
    'description'=> 'Imported From Mex.',
    'unit_price'=> 20000,
    'quantity'=> 1,
    'sku'=> 'cohb_s1',
    'category'=> 'food'
  )
),
'billing_address'=> array(
  'street1'=>'77 Mystery Lane',
  'street2'=> 'Suite 124',
  'street3'=> null,
  'city'=> 'Darlington',
  'state'=>'NJ',
  'zip'=> '10192',
  'country'=> 'Mexico',
  'tax_id'=> 'xmn671212drx',
  'company_name'=>'X-Men Inc.',
  'phone'=> '77-777-7777',
  'email'=> 'purshasing@x-men.org'
  )
  )
));

  if($charge->status == "paid")
  {
    //$str_reg_card = "UPDATE usuarios SET estatus_usuario = 2 where id_usuario = ".$_SESSION["user"]["id_usuario"];
    $query_updateStatus = sprintf("UPDATE usuarios SET estatus_usuario = 2 where id_usuario = %s",
    GetSQLValueString($conexion, $idUsuario, "text"));
    mysqli_query($conexion, $query_updateStatus) or die(mysqli_error($conexion));


    //$str_get_info = "SELECT * FROM usuarios WHERE id_usuario = ".$_SESSION["user"]["id_usuario"];
    $query_getuser = sprintf("SELECT * FROM usuarios WHERE id_usuario = %s",
    GetSQLValueString($conexion, $idUsuario, "text"));
    $result = mysqli_query($conexion, $query_getuser) or die(mysqli_error($conexion));
    $row = mysqli_fetch_assoc($result);
    $_SESSION["user"] = $row;


    $query_regplastic = sprintf("INSERT INTO plastic(nombre_tarjeta,ap_tarjeta,
     numero_tarjeta,mes_tarjeta,anio_tarjeta,cvc_tarjeta, estatus, id_usuario) VALUES (%s,%s,%s,%s,%s,%s,%s,%s)",
     GetSQLValueString($conexion,$nombre, "text"),
     GetSQLValueString($conexion,$apellido, "text"),
     GetSQLValueString($conexion,$numero, "text"),
     GetSQLValueString($conexion,$mes, "text"),
     GetSQLValueString($conexion,$anio, "text"),
     GetSQLValueString($conexion,$cvc, "text"),
     1,
     GetSQLValueString($conexion,$idUsuario, "int"));
     $result_regplastic = mysqli_query($conexion, $query_regplastic) or die(mysqli_error($conexion));
     $id_tarjeta = mysqli_insert_id($conexion);


     $fecha = date("Y-m-d H:i:s");
     $query_regpago = sprintf("INSERT INTO pago (id_usuario, id_tarjeta, id_tipo, fecha, id_tipopago)
     VALUES (%s,%s,%s,%s,%s )",
     GetSQLValueString($conexion,$idUsuario,"text"),
     GetSQLValueString($conexion,$id_tarjeta,"text"),
     GetSQLValueString($conexion,$tipo_renta,"text"),
     "'".$fecha."'",
     1);
     $result_pago = mysqli_query($conexion, $query_regpago) or die(mysqli_error($conexion));

     //Una vez pagado insertamos el progreso en los tres videojuegos, ponemos el nivel uno activo en el primer videojuego y 0 en los otros dos
     $query_videojuego_1 = sprintf("INSERT INTO videogame_progress(id_videogame, id_usuario, nivel, score, estrellas) VALUES (%s,%s,%s,%s, %s)",
     GetSQLValueString($conexion, 1,"int"),
     GetSQLValueString($conexion, $idUsuario,"int"),
     GetSQLValueString($conexion, 1,"int"),
     GetSQLValueString($conexion, 0,"int"),
     GetSQLValueString($conexion, 0,"int"));
     $result_videojuego_1 = mysqli_query($conexion, $query_videojuego_1) or die(mysqli_error($conexion));

     $query_videojuego_2 = sprintf("INSERT INTO videogame_progress(id_videogame, id_usuario, nivel, score, estrellas) VALUES (%s,%s,%s,%s,%s)",
     GetSQLValueString($conexion, 2,"int"),
     GetSQLValueString($conexion, $idUsuario,"int"),
     GetSQLValueString($conexion, 0,"int"),
     GetSQLValueString($conexion, 0,"int"),
     GetSQLValueString($conexion, 0,"int"));
     $result_videojuego_2 = mysqli_query($conexion, $query_videojuego_2) or die(mysqli_error($conexion));

     $query_videojuego_3 = sprintf("INSERT INTO videogame_progress(id_videogame, id_usuario, nivel, score, estrellas) VALUES (%s,%s,%s,%s,%s)",
     GetSQLValueString($conexion, 3,"int"),
     GetSQLValueString($conexion, $idUsuario,"int"),
     GetSQLValueString($conexion, 0,"int"),
     GetSQLValueString($conexion, 0,"int"),
     GetSQLValueString($conexion, 0,"int"));
     $result_videojuego_3 = mysqli_query($conexion, $query_videojuego_3) or die(mysqli_error($conexion));



     $query_user_progress_v1 = sprintf("SELECT * FROM videogame_progress VP INNER JOIN cat_videogames CV ON VP.id_videogame = CV.id_videogame WHERE id_usuario = %s AND VP.id_videogame = 1",
     GetSQLValueString($conexion,$idUsuario, "int"));
     $result_user_progress_v1 = mysqli_query($conexion, $query_user_progress_v1) or die(mysqli_error($conexion));

     $_SESSION["uprogressv1"] = $row_user_progress_v1 = mysqli_fetch_assoc($result_user_progress_v1);

     $query_user_progress_v2 = sprintf("SELECT * FROM videogame_progress VP INNER JOIN cat_videogames CV ON VP.id_videogame = CV.id_videogame WHERE id_usuario = %s AND VP.id_videogame = 2",
     GetSQLValueString($conexion,$idUsuario, "int"));
     $result_user_progress_v2 = mysqli_query($conexion, $query_user_progress_v2) or die(mysqli_error($conexion));

     $_SESSION["uprogressv2"] = $row_user_progress_v2 = mysqli_fetch_assoc($result_user_progress_v2);

     $query_user_progress_v3 = sprintf("SELECT * FROM videogame_progress VP INNER JOIN cat_videogames CV ON VP.id_videogame = CV.id_videogame WHERE id_usuario = %s AND VP.id_videogame = 3",
     GetSQLValueString($conexion,$idUsuario, "int"));
     $result_user_progress_v3 = mysqli_query($conexion, $query_user_progress_v3) or die(mysqli_error($conexion));

     $_SESSION["uprogressv3"] = $row_user_progress_v3 = mysqli_fetch_assoc($result_user_progress_v3);

     //echo $query_regpago;
    header("Location:".$url."dashboard/");
  }
 ?>
