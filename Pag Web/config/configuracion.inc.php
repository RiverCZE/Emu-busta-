<?php
define( 'PAGES_FOLDER', 'paginas/' );
define( 'PHP', strrchr( __FILE__, '.' ) );
define( 'VERSION', '0.203.3596' ); // Useless :D
define( 'PAGE', '?pagina=' );
define ("EMOTICONS_DIR", "images/emoticons/"); // BBCode

ini_set('date.timezone', 'Europe/Paris');

require_once( 'msg_list' . PHP );
//require_once( 'msg_list_esp' .PHP);
require_once( 'systeme.class' . PHP );
require_once( 'bbcode.class' . PHP );

$sys = new SystemClass;
$bbcode = new BBCodeClass;

/* Configuration */

$sys->dbHost = 'localhost'; // Host
$sys->dbName = 'dbtania'; // Database // nestrya_other
$sys->dbUser = 'root'; // User
$sys->dbPass = '609652ludianda'; // Password

$sys->database(); // Etablir le connexion a la base de données
$sys->infos(); // Etablir les informations compte en cache
$sys->auto(); // Système d'auto reconnexion

$sql = $sys->dbOther->query("SELECT * FROM config");
$data = $sql->fetch(PDO::FETCH_ASSOC);

$sys->website = $_SERVER['HTTP_HOST']; // DON'T TOUCH

$idp = 34039; // DON'T TOUCH
$idd = 56374; // DON'T TOUCH

$sys->points = $data['puntos']; // Nombre de points/achat
$sys->puntos_vip = $data['puntos_vip']; // Ajout pour les VIPs
$sys->puntos_voto = $data['puntos_voto']; // Nombre de points/vote
$sys->link_votacion = $data['rpg_link']; // Lien de vote

$sys->beta = $data['beta']; // Mode Beta

$sys->ladder_blacklist = array('Elbusta'); // Liste des personnages a ne pas afficher dans le ladder
$sys->supreme_right = array('Elbusta'); // Accès droit suprême

$sys->register = $data['registro']; // Inscription

$title = 'Bustofus'; // N'T TOUCH

$cache = array('homme','ladder','article'); // Liste des pages a mettre en cache

/* Script de mise en cache */

$in = array('/bustofus','?'); // DON'T TOUCH // $in = array('/','?');
$out = array('cache',''); // DON'T TOUCH // $out = array('cache/','');
$expire = time()-3600; // Bail d'expiration en seconde (1h)
$pagina_cache = str_replace($in,$out,$_SERVER['REQUEST_URI'].'.html'); // DON'T TOUCH

$construct = $data['construccion']; // Mode Construction
$mantenimiento = $data['mantenimiento']; // Mode Maintenance

