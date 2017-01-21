<?php
require_once '../config/configuration.inc.php';
$sys->dbOther->query("INSERT INTO ban_ip (IP, expira, razon) VALUES ('".$_SERVER['REMOTE_ADDR']."','0000-00-00 00:00:00','[AntiBot] Aspiration du site')");
setcookie('ban_time', '1', time()+1);
?>