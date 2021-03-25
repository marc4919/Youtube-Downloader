<?php
$db_host="sql302.epizy.com";
$db_user="epiz_28215499";
$db_password="tLrd3Y242AcI6Js";
$db_name="epiz_28215499_users";
$db_table_name="usuarios";
$db_connection = mysql_connect($db_host, $db_user, $db_password);

//Falta acabar de configurar lo de la base de datos y meterlo en el html

if (!$db_connection) {
  die('No se ha podido conectar a la base de datos');
}
$subs_name = utf8_decode($_POST['nombre']);
$subs_last = utf8_decode($_POST['correo']);
$subs_email = utf8_decode($_POST['passwd']);

$resultado = mysql_query("SELECT * FROM " . $db_table_name . " WHERE passwd = '" . $subs_email . "'", $db_connection);

if (mysql_num_rows($resultado) > 0) {

} else {

  $insert_value = 'INSERT INTO `' . $db_name . '`.`' . $db_table_name . '` (`Nombre` , `correo` , `passwd`) VALUES ("' . $subs_name . '", "' . $subs_last . '", "' . $subs_email . '")';

  mysql_select_db($db_name, $db_connection);
  $retry_value = mysql_query($insert_value, $db_connection);

  if (!$retry_value) {
    die('Error: ' . mysql_error());
  }

  header('Location: registrado-index.html');
}

mysql_close($db_connection);


?>