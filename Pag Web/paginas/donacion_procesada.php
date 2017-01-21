<?php


if (!in_array($_SERVER['REMOTE_ADDR'], array('109.70.3.48', '109.70.3.146',
    '109.70.3.58')))
{
    header("HTTP/1.0 403 Forbidden");
    die("Error: Unknown IP");
}

$message_id = $_GET['message_id'];
$shortcode = $_GET['shortcode'];
$keyword = $_GET['keyword'];
$message = $_GET['message'];
$sender = $_GET['sender'];
$operator = $_GET['operator'];
$country = $_GET['country'];
$custom = $_GET['custom'];
$points = $_GET['points'];
$price = $_GET['price'];
$currency = $_GET['currency'];

$sql = mysql_query("SELECT * FROM cuentas WHERE id = '" . $custom . "' ");
$data = mysql_fetch_array($sql);
$id_cuenta = $data['id'];
$nombre = $data['cuenta'];
$cuenta = $data['cuenta'];
$puntos = $data['puntos'];
$puntosfinal = $puntos + $points;
mysql_query("UPDATE cuentas SET puntos =" . $puntosfinal . " WHERE id = '" . $id_cuenta .
    "'");
mysql_query("INSERT INTO `compras` (`mensaje`, `comprador`, `puntos`) VALUES ('" .
    $message . "', '" . $nombre . "', '" . $points . "')");

?>
