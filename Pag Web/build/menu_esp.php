    <div id="menu_gauche">
      <a href="?pagina=vote" target="_blank"><img src="images/block_2.png" /></a>
      <?php if(isset($_SESSION['id']) && $_SESSION['id'] != ''){ ?>
      <div id="block_compte2">
        <div class="compte">
		
          <table>
          <tr>
          <td><span class="infos_compte"><a href="?pagina=account">Mi Perfil</a></span></td>
          <td><span class="infos_compte"><a href="?pagina=points">Mis Puntos (<?php echo $sys->acc_info('cuenta',$_SESSION['cuenta'],'puntos'); ?>)</a></span></td>
          </tr>
          <tr>
          <td><span class="infos_compte"><a href="?pagina=contact">Contactarnos</a></span></td>
          <td><span class="infos_compte"><a href="?pagina=rule">Regalamento</a></span></td>
          </tr>
          <tr>
          <td><span class="infos_compte"><a href="?pagina=chat">Acceder al Xat</a></span></td>
          <td><span class="infos_compte"><a href="?pagina=disconnect">Desconexión</a></span></td>
          </tr>
          </table>
        </div>
      </div>

     

      <?php }else{ ?>
      <div id="block_connexion2">
        <img src="images/clef.png" style="margin-top:35px;margin-left:-230px;position:absolute;"/>
        <div style="margin-top:23px; margin-left:150px; position:absolute; left: 109px; top: 575px;">
          <br /><a href="?pagina=register"><span style="font-size:8px;">>></span> Registrarse </a>
          <br /><a href="?pagina=lost_password"><span style="font-size:8px;">>></span> ¿ Contraseña Olvidada ?</a>
        </div>
        <span style="text-shadow:0em 0em 0.2em #000;margin-bottom:10px;margin-left:70px;margin-top:59px;float:left;">
          _______________________</span>
        <div style="margin-left: 25px;">
          <form method="post" action="?pagina=login">
            <input class="form" type="text" name="cuenta" value=""/> <input class="form" type="password" name="contraseña" value=""/>
            <span style="text-shadow:0em 0em 0.2em #000;font-size:9px;height:13px;margin-left:-3px;margin-top:3px;margin-bottom:0px;float:left;">
              <input type="checkbox" value="1" name="auto" class="checkbox-style" />Conexión automática
            </span>
            <input class="form" style="margin-left:147px;margin-top:-10px;margin-bottom:5px;" type="submit" name="send" value="Conexión"/>
          </form>
        </div>
</div>
      <?php }if(empty($_SESSION['id'])){ ?>
      <a href="?pagina=register_esp"><img style="margin-top: 10px;" src="images/block_inscription2.png" /></a>
      <?php }else{ ?>
      <a href="?pagina=join"><img style="margin-top: 10px;" src="images/join2.png" /></a>
      <?php } ?>
    </div>
    <div id=corp>
      <img src="images/top.png" />
      <div id="mid_corp">
        <div class="menu_top">
          <a href="?pagina=home_esp">Noticias</a> -
          <a href="http://dpforo.com.nu/index.php">Foro</a> -
          <a href="http://www.multiupload.com/P217VFYZIB">Descargar SWF</a> -
		  <a href="http://www.multiupload.com/HG0DEF0ZJX">Descargar CONFIG</a> -
          <a href="?pagina=laddera_esp">Ranking</a> -
          <a href="?pagina=staff_esp">Staff</a> -
          <a href="?pagina=contact_esp">Contactarnos</a>
        </div>
      </div>
      <img style="margin-top: -5px;" src="images/bottom.png" />
      <div id="carrousel"></div>