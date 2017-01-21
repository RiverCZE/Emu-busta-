<?php
session_start();

require_once '../config/configuration.inc.php';
require_once( '../config/admin.class' . PHP );
$admin = new AdminClass;

$pagina = htmlentities(@$_GET['pagina']);


if(!($sys->ban_ip()))
{
  if(isset($pagina) && $pagina != '')
  {
    if(file_exists($pagina . PHP))
    {
      include_once $pagina . PHP;
    }
    else
    {
      include_once '404' . PHP;
    }
  }
}
else
{
  include_once 'ban' . PHP;
}