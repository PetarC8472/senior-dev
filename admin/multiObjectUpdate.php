<?php
// requires
require_once("../assets/php/auth_login_helper.php");
require_once("../assets/php/dbessential.php");
require_once("../assets/php/dbfetchInfo.php");
require_once("../assets/php/dbAPI.php");
// start
echo("<form action='./multiObjectConfirm.php' method='post'>");

$action = $_POST['action'];
$object = $_POST['object'];
$updatingPage = $_POST['updatingPage'];
$namefield = $_POST['namefield'];
$dataType = $_POST['dataType'];
$text_field = $_POST['text_field'];
$id_field = $_POST['id_field'];
//populate form here with table fields
$builtQuery = "Update " . $object . ' set dataType="' . $dataType  .'",text="' . $text_field . '"';
$builtQuery = $builtQuery . " where id=$id_field";
echo("<input type='text' name='action' value='$action' hidden>");
echo("<input type='text' name='object' value='$object' hidden>");
echo("<input type='text' name='updatingPage' value='$updatingPage' hidden>");
echo("<input type='text' name='namefield' value='$namefield' hidden>");
echo("<input type='radio' name='fullQuery' value='$builtQuery' checked>$builtQuery</br>");
// end
echo("<input type='submit' value='Confirm Edit'>");
echo("</form>");


?>
