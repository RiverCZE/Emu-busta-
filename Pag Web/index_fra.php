<?php
session_start();

require_once 'config/configuracion.inc.php';

$pagina = htmlentities(@$_GET['pagina']);
$sys->pagina = $pagina;
if(isset($_GET['id'])){ $sys->id = $_GET['id']; }

include_once 'build/header' . PHP;
include_once 'build/menu' . PHP;

if($mantenimiento == 0)
{
  if($construct == 0)
  {
    if(!($sys->ban_ip()))
    {
      if(isset($pagina) && $pagina != '')
      {
        if(file_exists(PAGES_FOLDER . $pagina . PHP))
        {
          if(in_array($pagina,$cache))
          {
            if(file_exists($pagina_cache) && filemtime($pagina_cache) > $expire)
            {
              readfile($pagina_cache);
            }
            else
            {
              ob_start();
              include_once PAGES_FOLDER . $pagina . PHP;
              echo '<input type="hidden" value="'.base64_encode($_SERVER['REMOTE_ADDR']).'" />';
              $view = ob_get_contents();
              ob_end_clean();
              @file_put_contents($pagina_cache, $view);
              echo $view;
            }
          }
          else
          {
            include_once PAGES_FOLDER . $pagina . PHP;
          }
        }
        else
        {
          include_once PAGES_FOLDER . '404' . PHP;
        }
      }
      else
      {
        if(file_exists($pagina_cache) && filemtime($pagina_cache) > $expire)
        {
          readfile($pagina_cache);
        }
        else
        {
          ob_start();
          include_once PAGES_FOLDER . 'home' . PHP;
          echo '<input type="hidden" value="'.base64_encode($_SERVER['REMOTE_ADDR']).'" />';
          $view = ob_get_contents();
          ob_end_clean();
          file_put_contents($pagina_cache, $view);
          echo $view;
        }
      }
    }
    else
    {
      header('location:ban_view.php');
    }
  }
  else
  {
    include_once PAGES_FOLDER . 'opening' . PHP;
  }
}
else
{
  include_once PAGES_FOLDER . 'maintenance' . PHP;
}

include_once 'build/footer' . PHP;