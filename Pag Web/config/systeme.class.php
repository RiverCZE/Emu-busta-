<?php
class SystemClass
{

  public $dbHost, $dbName, $dbUser, $dbPass;
  public $dbOther;
  public $pagina;
  public $name;
  public $points, $puntos_vip;
  public $ladder_blacklist;
  public $puntos_voto, $link_vote;
  public $register;
  public $beta;

  var $idp = 15104;
  var $idd = 32002;

  public function database()
  {
    $this->dbOther = new PDO('mysql:host='.$this->dbHost.';dbname='.$this->dbName, $this->dbUser, $this->dbPass);
    $this->dbOther->exec('SET NAMES utf8');
  }

  public function page_name()
  {
    switch($this->pagina)
    {
      case 'home';
        $pagina = 'Accueil';
        break;
      case ''; // Si $pagina est vide
        $pagina = 'Accueil';
        break;
      case '404';
        $pagina = 'Erreur 404';
        break;
      case 'rule';
        $pagina = 'Charte du Serveur';
        break;
      case 'register';
        $pagina = 'Inscription';
        break;
      case 'welcome';
        $pagina = 'Bienvenue';
        break;
      case 'disconnect';
        $pagina = 'Déconnexion';
        break;
      case 'account';
        $pagina = 'Mon Profil';
        break;
	  case 'contact';
        $pagina = 'Contact';
        break;
      case 'login';
        $pagina = 'Connexion';
        break;
      case 'faq';
        $pagina = 'Foire aux Questions';
        break;
      case 'staff';
        $pagina = 'Équipe';
        break;
      case 'points';
        $pagina = 'Achat de Points';
        break;
      case 'ladder';
        $pagina = 'Classement';
        break;
      case 'article';
        $pagina = 'Article';
        break;
      case 'vote';
        $pagina = 'Vote';
        break;
      case 'event';
        $pagina = 'Evènement';
        break;
      case 'mantenimiento';
        $pagina = 'Maintenance';
        break;
      case 'commentaire';
        $pagina = 'Commentaire';
        break;
      case 'join';
        $pagina = 'Nous Rejoindre';
        break;
      case 'key';
        $pagina = 'Clé Beta Test';
        break;
      case 'tracker';
        $pagina = 'Bug Tracker';
        break;
      case 'shop_buy';
        $pagina = 'Achat Boutique';
        break;
      default :
        $pagina = 'Unknown';
        break;
    }
    return $pagina;
  }

  public function date_fr($format,$timestamp)
  {
     $date_en = date($format,$timestamp);

     $texte_en = array(
     "Monday", "Tuesday", "Wednesday", "Thursday",
     "Friday", "Saturday", "Sunday", "January",
     "February", "March", "April", "May",
     "June", "July", "August", "September",
     "October", "November", "December"
     );
     $texte_fr = array(
     "Lundi", "Mardi", "Mercredi", "Jeudi",
     "Vendredi", "Samedi", "Dimanche", "Janvier",
     "F&eacute;vrier", "Mars", "Avril", "Mai",
     "Juin", "Juillet", "Ao&ucirc;t", "Septembre",
     "Octobre", "Novembre", "Décembre"
     );
     $date_fr = str_replace($texte_en, $texte_fr, $date_en);
     return $date_fr;
  }

  private function connect()
  {
    if(isset($_SESSION['id']) && $_SESSION['id'] != '')
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }

  private function admin($level=false)
  {
    if($this->connect())
    {
      if($level == false)
      {
        if(@$_SESSION['gml'] > 0)
        {
          return TRUE;
        }
        else
        {
          return FALSE;
        }
      }
      elseif(is_numeric($level))
      {
        if(@$_SESSION['gml'] >= $level)
        {
          return TRUE;
        }
        else
        {
          return FALSE;
        }
      }
      else
      {
        return FALSE;
      }
    }
    else
    {
      return FALSE;
    }
  }

  public function infos()
  {
    if(isset($_SESSION['id']) && $_SESSION['id'] != '' && empty($_SESSION['cuenta']))
    {
      $sql = $this->dbOther->query("SELECT * FROM cuentas WHERE id = '".$_SESSION['id']."'");
      $_SESSION = $sql->fetch(PDO::FETCH_ASSOC);
    }
  }
  
  public function actualizar()
  {
    if(isset($_SESSION['id']) && $_SESSION['id'] != '' )
    {
      $sql = $this->dbOther->query("SELECT * FROM cuentas WHERE id = '".$_SESSION['id']."'");
      $_SESSION = $sql->fetch(PDO::FETCH_ASSOC);
    }
  }

  public function acc_info($where, $where2, $get)
  {
    if(isset($_SESSION['id']) && $_SESSION['id'] != '')
    {
      $sql = $this->dbOther->query("SELECT * FROM cuentas WHERE ".$where." = '".$where2."'");
      $data = $sql->fetch(PDO::FETCH_ASSOC);
      return $data[$get];
    }
  }

 public function rank_name($name)
 {
    switch($name)
    {
      case 0:
        $name = 'Normal';
        break;
      case 1:
        $name = 'Animateur';
        break;
      case 2:
        $name = 'Maître du Jeu';
        break;
      case 3:
        $name = 'Chef Maître du Jeu';
        break;
      case 4:
        $name = 'Administrateur';
        break;
      case 5:
        $name = 'Createur';
        break;
      default :
        $name = 'Unknown';
        break;
    }
    return $name;
 }

 public function class_name($name)
 {
   switch($name)
   {
     case 1:
       $name = 'Féca';
       break;
     case 2:
       $name = 'Osamodas';
       break;
     case 3:
       $name = 'Enutrof';
       break;
     case 4:
       $name = 'Sram';
       break;
     case 5:
       $name = 'Xélor';
       break;
     case 6:
       $name = 'Ecaflip';
       break;
     case 7:
       $name = 'Eniripsa';
       break;
     case 8:
       $name = 'Iop';
       break;
     case 9:
       $name = 'Crâ';
       break;
     case 10:
       $name = 'Sadida';
       break;
     case 11:
       $name = 'Sacrieur';
       break;
     case 12:
       $name = 'Pandawa';
       break;
   }
   return $name;
 }

 public function align_name($name)
 {
   switch($name)
   {
     case 0:
       $name = 'Neutre';
       break;
     case 1:
       $name = 'Ange';
       break;
     case 2:
       $name = 'Démon';
       break;
     case 3:
       $name = 'Mercenaire';
       break;
   }
   return $name;
 }

 public function sexe_name($name)
 {
   switch($name)
   {
     case 0:
       $name = 'Male';
       break;
     case 1:
       $name = 'Femelle';
       break;
   }
   return $name;
 }

  public function state($name)
  {
    switch($name)
    {
      case 0:
        $name = '<font color="#79d8ff">Non Traité</font>';
        break;
      case 1:
        $name = '<font color="#ffbe79">En cours</font>';
        break;
      case 2:
        $name = '<font color="#79ff86">Terminé</font>';
        break;
    }
    return $name;
  }

  public function login()
  {
    if(!(isset($_SESSION['id']) && $_SESSION['id'] != ''))
    {
      if(isset($_POST['send']) && $_POST['send'] != '')
      {
        $cuenta = htmlentities(@$_POST['cuenta']);
        $contraseña = htmlentities(@$_POST['contraseña']);
        if(isset($cuenta) && $cuenta != '' && isset($contraseña) && $contraseña != '')
        {
          $sql = $this->dbOther->query("SELECT * FROM cuentas WHERE cuenta = '".$cuenta."'");
          if($sql->rowCount() > 0)
          {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
			
            if($data['cuenta'] == $cuenta && $data['pass'] == $contraseña)
            {
              $sql = $this->dbOther->prepare("UPDATE cuentas SET utlimaIP = :IP WHERE id = :id");
              $sql->execute(array(':IP' => $_SERVER['REMOTE_ADDR'], ':id' => $data['id']));
              $guid = $data['id'];
              $_SESSION['id'] = $guid;
              echo '<center>Bonjour '.ucfirst($cuenta).', bonne visite sur Bustofus !</center>';

              if(@$_POST['auto'])
              {
                setcookie('auto', '1|'.$cuenta.'|'.$contraseña, time()+60*60*24*30);
              }

              header('refresh: 2;url=?pagina=home');
            }
            else
            {
              echo ERROR_003;
            }
          }
          else
          {
            echo ERROR_002;
          }
        }
        else
        {
          echo ERROR_001;
        }
      }
      else
      {
        echo ERROR_002;
      }
    }
    else
    {
      echo INFO_001;
    }
  }

  public function auto()
  {
    if(!(isset($_SESSION['id']) && $_SESSION['id'] != ''))
    {
      if(isset($_COOKIE['auto']) && $_COOKIE['auto'] != '')
      {
        $cookie = explode('|',$_COOKIE['auto']);
        $sql = $this->dbOther->query("SELECT * FROM cuentas WHERE cuenta = '".$cookie[1]."'");
        if($sql->rowCount() > 0)
        {
          $data = $sql->fetch(PDO::FETCH_ASSOC);
          if($data['cuenta'] == $cookie[1] && $data['pass'] == $cookie[2])
          {
            $guid = $data['id'];
            $_SESSION['id'] = $guid;
            header('location:?pagina=home');
          }
        }
      }
    }
  }

  public function news()
  {
    $sql = $this->dbOther->query("SELECT * FROM noticias");
    if($sql->rowCount() > 0)
    {
      $sql = $this->dbOther->query("SELECT COUNT(id) as nroNoticias FROM noticias");
      $data = $sql->fetch(PDO::FETCH_ASSOC);
      $nroNoticias = $data['nroNoticias'];
      $nbPage = ceil($nroNoticias/5);
      if(isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage)
      {
        $cPage = $_GET['p'];
      }
      else
      {
        $cPage = 1;
      }

      $sql = $this->dbOther->query("SELECT * FROM noticias ORDER BY id DESC LIMIT ".(($cPage-1)*5).",5");
      foreach ($sql as $data)
      {
        $Com = $this->dbOther->query("SELECT * FROM comentarios WHERE noticias = '".$data['id']."'");
        echo '<img src="images/top.png" />
        <div id="mid_corp">
          <div id="text_corp">
            <div class="titre">'.$data['titulo'].'</div>
            '.($data['bMostrarImagen'] == 1 ? '<div class="avatar"><img src="'.$data['urlImagen'].'" /></div>' : null).'
            '.$data['contenido'].'
            <div style="width:100px;height:1px;clear:both;"></div>
            <div class="date">Ecrit par <b>'.$data['autor'].'</b> le '.$this->date_fr('l d F Y à H:i',strtotime($data['fecha'])).'</div>
            <div class="suite"><a href="'.PAGE.'article&id='.$data['id'].'">Commentaires ('.$Com->rowCount().')</a></div>
          </div>
        </div>
        <img src="images/bottom.png" />';
      }
    }
    else
    {
      echo '<img src="images/top.png" />
      <div id="mid_corp">
        <div id="text_corp">
          <center>Aucune news</center>
        </div>
      </div>
      <img src="images/bottom.png" />';
    }

    if(@$nroNoticias > 0)
    {
      echo '<img src="images/top.png" />
      <div id="mid_corp">
        <div id="text_corp">
          <center>Pages : ';
      for($i=1;$i<=$nbPage;$i++)
      {
        if($i==$cPage)
        {
          echo '<a href="?pagina=home&p='.$i.'"><b>'.$i.'</b></a> ';
        }
        else
        {
          echo '<a href="?pagina=home&p='.$i.'">'.$i.'</a> ';
        }
      }
      echo '</center>
      </div>
      </div>
      <img src="images/bottom.png" />';
    }
  }

  public function register()
  {
    if(!($this->connect()))
    {
      if($this->register > 0)
      {
        echo '<span class="cambria orange italic size25">Inscription</span>
          <br /><br />';
        $error['cuenta'] = FALSE;
        $error['contraseña'] = FALSE;
        $error['confir_contra'] = FALSE;
        $error['email'] = FALSE;
        $error['code'] = FALSE;
        $error['rule'] = FALSE;
		$error['apodo'] = FALSE;
		$error['pregunta'] = FALSE;
		$error['respuesta'] = FALSE;

        if(isset($_POST['send']) && $_POST['send'] != '')
        {
          $cuenta = htmlentities(@$_POST['cuenta']);
          $contraseña = htmlentities(@$_POST['contraseña']);
          $confir_contra = htmlentities(@$_POST['confir_contra']);
          $email = htmlentities(@$_POST['email']);
          $code = htmlentities(@$_POST['code']);
          $rule = htmlentities(@$_POST['rule']);
		  $apodo = htmlentities(@$_POST['apodo']);
		  $pregunta = htmlentities(@$_POST['pregunta']);
		  $respuesta = htmlentities(@$_POST['respuesta']);

          $register['cuenta'] = FALSE;
          $register['contraseña'] = FALSE;
          $register['email'] = FALSE;
          $register['code'] = FALSE;
          $register['rule'] = FALSE;
		  $register['apodo'] = FALSE;
		  $register['pregunta'] = FALSE;
		  $register['respuesta'] = FALSE;
          
          if(isset($cuenta) && $cuenta != '')
          {
            if(preg_match("/^[a-z0-9\-_.]+$/i",$cuenta))
            {
              $sql = $this->dbOther->query("SELECT * FROM cuentas WHERE cuenta = '".$cuenta."'");
              if($sql->rowCount() < 1)
              {
                $register['cuenta'] = TRUE;
              }
              else
              {
                $error['cuenta'] = TRUE;
                $errMsg['cuenta'] = '<font color="red">Le nom de compte est déjà utiliser</font>';
              }
            }
            else
            {
              $error['cuenta'] = TRUE;
              $errMsg['cuenta'] = '<font color="red">Le nom de compte n\'est pas valide (Caractères spéciaux)</font>';
            }
          }
          else
          {
            $error['cuenta'] = TRUE;
            $errMsg['cuenta'] = '<font color="red">Veuillez saisir un nom de compte</font>';
          }
		  
		   if(isset($apodo) && $apodo != '')
          {
            if(preg_match("/^[a-z0-9\-_.]+$/i",$apodo) )
            {
              $sql = $this->dbOther->query("SELECT * FROM cuentas WHERE apodo = '".$apodo."'");
              if($sql->rowCount() < 1)
              {
                $register['apodo'] = TRUE;
              }
              else
              {
                $error['apodo'] = TRUE;
                $errMsg['apodo'] = '<font color="red">Le nom de pseudo est déjà utiliser</font>';
              }
            }
            else
            {
              $error['apodo'] = TRUE;
              $errMsg['apodo'] = '<font color="red">Le nom de pseudo n\'est pas valide (Caractères spéciaux)</font>';
            }
          }
          else
          {
            $error['apodo'] = TRUE;
            $errMsg['apodo'] = '<font color="red">Veuillez saisir un nom de pseudo</font>';
          }
          if(isset($contraseña) && $contraseña != '' && isset($confir_contra) && $confir_contra != '')
          {
            if(preg_match("/^[a-z0-9\-_.]+$/i",$contraseña))
            {
              if($contraseña == $confir_contra)
              {
                $register['contraseña'] = TRUE;
              }
              else
              {
                $error['contraseña'] = TRUE;
                $errMsg['contraseña'] = '<font color="red">Les mots de passes ne sont pas identiques</font>';
              }
            }
            else
            {
              $error['contraseña'] = TRUE;
              $errMsg['contraseña'] = '<font color="red">Les mots de passes ne sont pas valides (Caractères spéciaux)</font>';
            }
          }
          else
          {
            $error['contraseña'] = TRUE;
            $errMsg['contraseña'] = '<font color="red">Veuillez saisir un mot de passe</font>';
          }

          if(isset($email) && $email != '')
          {
            if(preg_match("/^[a-z0-9\-_.]+@[a-z0-9\-_.]+\.[a-z]{2,3}$/i",$email))
            {
                $register['email'] = TRUE;
            }
            else
            {
              $error['email'] = TRUE;
              $errMsg['email'] = '<font color="red">L\'adresses e-mail n\'est pas valide</font>';
            }
          }
          else
          {
            $error['email'] = TRUE;
            $errMsg['email'] = '<font color="red">Veuillez saisir une adresse de courriel valide</font>';
          }
		  
		  if(isset($pregunta) && $pregunta != '')
          {
            if(preg_match("/^[a-z0-9\-_.]+$/i",$pregunta))
            {
                $register['pregunta'] = TRUE;
            }
            else
            {
              $error['pregunta'] = TRUE;
              $errMsg['pregunta'] = '<font color="red">L\'question secret n\'est pas valide</font>';
            }
          }
          else
          {
            $error['pregunta'] = TRUE;
            $errMsg['pregunta'] = '<font color="red">Le question secret ne sont pas valides (Caractères spéciaux)</font>';
          }
		  
		  if(isset($respuesta) && $respuesta != '')
          {
            if(preg_match("/^[a-z0-9\-_.]+$/i",$respuesta))
            {
                $register['respuesta'] = TRUE;
            }
            else
            {
              $error['respuesta'] = TRUE;
              $errMsg['respuesta'] = '<font color="red">L\'response secret n\'est pas valide</font>';
            }
          }
          else
          {
            $error['respuesta'] = TRUE;
            $errMsg['respuesta'] = '<font color="red">Le response secret ne sont pas valides (Caractères spéciaux)</font>';
          }
		  
		  

          if(isset($code) && $code != '')
          {
            if(strtoupper($code) == $_SESSION['captcha'])
            {
              $register['code'] = TRUE;
            }
            else
            {
              $error['code'] = TRUE;
              $errMsg['code'] = '<font color="red">Le code de sécurité n\'est pas valide</font>';
            }
          }
          else
          {
            $error['code'] = TRUE;
            $errMsg['code'] = '<font color="red">Veuillez saisir le code de sécurité</font>';
          }

          if(isset($rule) && $rule == 'checked')
          {
            $register['rule'] = TRUE;
          }
          else
          {
            $error['rule'] = TRUE;
            $errMsg['rule'] = '<font color="red">Les Conditions Générales d\'Utilisation doivent être lu, compris et accepter</font><br />';
          }

          if($register['cuenta'] && $register['contraseña'] && $register['email'] && $register['code'] && $register['rule'] && $register['apodo']&& $register['pregunta']&& $register['respuesta'] )
          {
			 // $this->dbOther->query("INSERT INTO cuentas (cuenta, pass, email, utlimoIP) VALUES ('asdfasdf','asdfcasdf','jasdusad','111111')");
           	$this->dbOther->query("INSERT INTO cuentas (id,cuenta,pass,gm,email,ultimaIP,pregunta,respuesta,apodo) 
			VALUES ('','" .$cuenta. "','".$contraseña."','0','".$email."','".$_SERVER['REMOTE_ADDR']."','".$pregunta."','".$respuesta."','".$apodo."')");
            $sql = $this->dbOther->query("SELECT * FROM cuentas WHERE cuenta = '".$cuenta."'");
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $guid = $data['id'];
            $_SESSION['id'] = $guid;
			$_SESSION['cuenta'] = $data['cuenta'];
            header('location:?pagina=welcome');
          }
        }

        echo 'Pour vous inscrire et nous rejoindre sur notre serveur de jeu, il vous suffit simplement de remplir les champs ci-dessous.
              Les identifiants que vous choisirez lors de votre inscription seront ceux que vous utiliserez pour vous connecter à nos services.<br /><br />
              <form method="post" action="#">
                <fieldset>
                  <legend>Veuillez saisir un nom de compte</legend>
                  <p>Le nom de compte choisis sera celui que vous devrez utiliser pour vous connecter au jeu. Celui-ci ne doit contenir que des lettres (A à Z) et/ou des chiffres (0 à 9).</p>
                  <label for="cuenta">Nom de compte : </label>'; if($error['cuenta']){ echo $errMsg['cuenta']; } echo '<br />
                  <input type="text" id="cuenta" name="cuenta" value="'.@$cuenta.'" />
                </fieldset>
                <fieldset>
                  <legend>Veuillez saisir un mot de passe</legend>
                  <p>Votre mot de passe est la sécurité de votre compte. N\'oubliez jamais que celui-ci est personnel et qu\'aucun membre de l\'équipe ne vous le demandera ainsi que les autres joueurs. Alors, ne communiquez jamais votre mot de passe et cela peut importe la situation.</p>
                  <label for="contraseña">Mot de passe : </label>'; if($error['contraseña']){ echo $errMsg['contraseña']; } echo '<br />
                  <input type="password" id="contraseña" name="contraseña" value="'.@$contraseña.'" /><br /><br />
                  <label for="confir_contra">Confirmez votre mot de passe :</label><br />
                  <input type="password" id="confir_contra" name="confir_contra" value="'.@$confir_contra.'" />
                </fieldset>
				<fieldset>
                  <legend>Veuillez saisir et confirmez une adresse de courriel valide</legend>
                  <p>L\'adresse E-mail doit être valide, c\'est votre seule chance de pouvoir récupérer votre mot de passe en cas d\'oubli. Elle vous permet aussi de rester au courant des news apportent du site et serveur.</p>
                  <label for="email">Adresse E-mail : </label>'; if($error['email']){ echo $errMsg['email']; } echo '<br />
                  <input type="text" id="email" name="email" value="'.@$email.'" />
                </fieldset>
                <fieldset>
                  <legend>Veuillez saisir et confirmez un pseudo valide</legend>
                  <p>L\'pseudo doit être valide, vous servira le surnom pour les autres joueurs vous reconnaître sans utiliser votre nom de compte.</p>
                  <label for="apodo">Pseudo : </label>'; if($error['apodo']){ echo $errMsg['apodo']; } echo '<br />
                  <input type="text" id="apodo" name="apodo" value="'.@$apodo.'" />
                </fieldset>
				 <fieldset>
                  <legend>Veuillez saisir et confirmez une question secret valide</legend>
                  <p>L\'question secret doit être valide, la question secrète, vous servira pour supprimer un caractère dans le jeu.</p>
                  <label for="pregunta">Question Secret : </label>'; if($error['pregunta']){ echo $errMsg['pregunta']; } echo '<br />
                  <input type="text" id="pregunta" name="pregunta" value="'.@$pregunta.'" />
                </fieldset>
				<fieldset>
                  <legend>Veuillez saisir et confirmez une response secret valide</legend>
                  <p>L\'response secret doit être valide, la response secret, vous servira pour supprimer un caractère dans le jeu.</p>
                  <label for="respuesta">Response Secret : </label>'; if($error['respuesta']){ echo $errMsg['respuesta']; } echo '<br />
                  <input type="text" id="respuesta" name="respuesta" value="'.@$respuesta.'" />
                </fieldset>
                <fieldset>
                  <legend>Veuillez saisir le code de sécurité</legend>
                  <p>Le code de sécurité permet d\'optimier les inscriptions en bloquant les bots.</p>
                  <label for="code">Code de sécurité : </label>'; if($error['code']){ echo $errMsg['code']; } echo '<br />
                  <input type="text" id="code" name="code" value="'.@$code.'" /> : <img src="config/captcha.php" alt="Captcha" />
                </fieldset>
                <fieldset>
                  <legend>Veuillez accepter les Conditions Générales d\'Utilisation</legend>';
                   if($error['rule']){ echo $errMsg['rule']; } echo '
                  <input type="checkbox" value="checked" name="rule">En cochant cette case, j\'affirme avoir lu et compris les <a href="?pagina=rule" target="_blank">Conditions Générales d\'Utilisation</a> de nos services et je les accepte.
                </fieldset>
                <center><div class="envoyer"><input type="submit" name="send" value=" " /></div></center>
              </form>';
      }
      else
      {
        echo INFO_006;
      }
    }
    else
    {
      echo INFO_001;
    }
  }

  public function profil()
  {
    if($this->connect())
    {
      echo '<span class="cambria orange italic size25">Mon Profil</span>
        <br /><br />
        <span class="profil_menu_left"><a href="?pagina=account">Gestion du compte</a></span><span class="profil_menu_right"><a href="?pagina=account&action=settings">Options avancés</a></span>
        <br /><br />
        <span class="profil_menu_left"><a href="?pagina=account&action=parrain">Parrainez des amis</a></span><span class="profil_menu_right"><a href="?pagina=account&action=avatar">Avatar & Siganture</a></span>
        <br /><br />';

      switch(htmlentities(@$_GET['action']))
      {
        case 'principal' :
          if(isset($_POST['send']) && $_POST['send'] != '')
          {
            if(isset($_POST['personaje']) && $_POST['personaje'] != '')
            {
              if($_POST['personaje'] != 0)
              {
                $sql = $this->dbOther->query("SELECT * FROM personajes WHERE id = '".htmlentities($_POST['personaje'])."'");
                if($sql->rowCount() > 0)
                {
                  $sql = $this->dbOther->query("SELECT * FROM personajes WHERE id = '".htmlentities($_POST['personaje'])."'");
                  $data = $sql->fetch(PDO::FETCH_ASSOC);
                  if($_SESSION['id'] == $data['cuenta'])
                  {
                    $this->dbOther->query("UPDATE cuentas SET personajePrincipal = '".htmlentities($_POST['personaje'])."', recarga = 1 WHERE id = '".$_SESSION['id']."'");
                    $_SESSION['personajePrincipal'] = htmlentities($_POST['personaje']);
                    header('location:?pagina=account');
                  }
                  else
                  {
                    echo ERROR_005;
                  }
                }
                else
                {
                  echo ERROR_006;
                }
              }
              else
              {
                echo ERROR_007;
              }
            }
          }

          echo '<fieldset>
              <legend>Personnage principal</legend>
              <div style="margin-top: 20px;">';
          if($_SESSION['personajePrincipal'] != 0)
          {
            $sql = $this->dbOther->query("SELECT * FROM personajes WHERE id = '".$_SESSION['personajePrincipal']."'");
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            echo '<img src="images/avatar/classes/'.$data['clase'].$data['sexo'].'.jpg" with="50" height="50" style="float: left; border: 2px solid #c0ae7c;" />
                &nbsp; <b>Nom</b> : '.$data['nombre'].'<br />
                &nbsp; <b>Classe</b> : '.$this->class_name($data['clase']).'<br />
                &nbsp; <b>Niveau</b> : '.$data['nivel'].'<br />
                &nbsp; <b>Alignement</b> : '.$this->align_name($data['alineamiento']);
          }
          else
          {
            echo '<img src="images/avatar/NO.jpg" with="50" height="50" style="float: left; border: 2px solid #c0ae7c;" />
                &nbsp; <b>Nom</b> : N/A<br />
                &nbsp; <b>Classe</b> : N/A<br />
                &nbsp; <b>Niveau</b> : N/A<br />
                &nbsp; <b>Alignement</b> : N/A';
          }
            echo '</div>
              <div style="margin-top: -70px; margin-right: 10px; float: right;">
                Selection un personnage pricinpal :<br /><br />
                <form method="post" action="#">
                  <span class="send"><select name="personnage" style="text-align:center;">
                    <option value="0">Personnage disponible</options>
                    <option value="0">--------------------</options>';
            $sql = $this->dbOther->query("SELECT * FROM personajes WHERE cuenta = '".$_SESSION['id']."' ORDER BY id DESC");
            foreach ($sql as $data)
            {
                echo '<option value="'.$data['id'].'">'.$data['nombre'].'</options>';
            }
                  echo '</select></span>
                  <br />
                  <center><div class="envoyer"><input type="submit" value=" " name="send" /></div></center>
                </form>
              </div>
            </fieldset>
            <br />';
          break;
        default :
          if(isset($_POST['send']) && $_POST['send'] != '')
          {
            if(isset($_POST['antigua_contra']) && $_POST['antigua_contra'] != '' && isset($_POST['contraseña']) && $_POST['contraseña'] != '' && isset($_POST['confir_contra']) && $_POST['confir_contra'] != '')
            {
              $sql = $this->dbOther->query("SELECT * FROM cuentas WHERE id = '".$_SESSION['id']."'");
              $data = $sql->fetch(PDO::FETCH_ASSOC);
              if($_POST['antigua_contra'] == $data['pass'])
              {
                if(isset($_POST['email']) && $_POST['email'] != '')
                {
                  if(preg_match('/^[a-z0-9\-_.]+@[a-z0-9\-_.]+\.[a-z]{2,3}$/i',htmlentities($_POST['email'])))
                  {
                    $this->dbOther->query("UPDATE cuentas SET email = '".htmlentities($_POST['email'])."', recarga = 1 WHERE id = '".$_SESSION['id']."'");
                    echo SUCCES_001;
                  }
                  else
                  {
                    echo ERROR_008;
                  }
                }

                if($_POST['contraseña'] == $_POST['confir_contra'])
                {
                  $this->dbOther->query("UPDATE cuentas SET pass = '".htmlentities($_POST['contraseña'])."', recarga = 1 WHERE id = '".$_SESSION['id']."'");
                  echo SUCCES_002;
                }
                else
                {
                  echo ERROR_009;
                }
              }
            }
            elseif(isset($_POST['antigua_contra']) && $_POST['antigua_contra'] != '' && isset($_POST['email']) && $_POST['email'] != '')
            {
              if(preg_match('/^[a-z0-9\-_.]+@[a-z0-9\-_.]+\.[a-z]{2,3}$/i',htmlentities($_POST['email'])))
              {
                $this->dbOther->query("UPDATE cuentas SET email = '".htmlentities($_POST['email'])."', recarga = 1 WHERE id = '".$_SESSION['id']."'");
                echo SUCCES_001;
              }
              else
              {
                echo ERROR_008;
              }
            }
          }
          echo '<fieldset>
              <legend>Gestion du compte</legend>
              <div style="float: left;">
                <form method="post" action="#">
                  Nouvelle adresse email :<br />
                  <input type="text" name="email" value="" /><br /><br />
                  Ancien mot de pass :<br />
                  <input type="password" name="antigua_contra" value="" /><br /><br />
                  Nouveau mot de pass :<br />
                  <input type="password" name="contraseña" value="" /><br /><br />
                  Confirmation :<br />
                  <input type="password" name="confir_contra" value="" /><br />
                  <center><div class="envoyer"><input type="submit" value=" " name="send" /></div></center>
                </form>
              </div>
              <div style="float: right; margin-right: 90px;"><br />';
              $sql = $this->dbOther->query("SELECT * FROM cuentas WHERE id = '".$_SESSION['id']."'");
              $data = $sql->fetch(PDO::FETCH_ASSOC);
                echo '<b>Nom de compte</b> : '.$data['cuenta'].'<br />
                <b>Adresse email</b> : '.$data['email'].'<br />
                <b>Rang</b> : '.$this->rank_name($data['gm']).'<br />
                <b>VIP</b> : '.($data['vip'] == 2 ? '<span style="color:green">Oui</span>' : '<span style="color:#900001">Non</span>').'<br />
                <b>Points</b> : '.$data['puntos'].' (<a href="?pagina=points">En acheter</a>)<br />
                <br /><br />
                <u><b>Personnage princiaple</b></u> :
                <br /><br />';
		 $this->actualizar();
          if($_SESSION['personajePrincipal'] != 0)
          {
            $sql = $this->dbOther->query("SELECT * FROM personajes WHERE id = '".$_SESSION['personajePrincipal']."'");
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            echo '<img src="images/avatar/classes/'.$data['clase'].$data['sexo'].'.jpg" with="50" height="50" style="float: left; border: 2px solid #c0ae7c;" />
                &nbsp; <b>Nom</b> : '.$data['nombre'].'<br />
                &nbsp; <b>Classe</b> : '.$this->class_name($data['clase']).'<br />
                &nbsp; <b>Niveau</b> : '.$data['nivel'].'<br />
                &nbsp; <b>Alignement</b> : '.$this->align_name($data['alineacion']);
          }
          else
          {
            echo '<img src="images/avatar/NO.jpg" with="50" height="50" style="float: left; border: 2px solid #c0ae7c;" />
                &nbsp; <b>Nom</b> : N/A<br />
                &nbsp; <b>Classe</b> : N/A<br />
                &nbsp; <b>Niveau</b> : N/A<br />
                &nbsp; <b>Alignement</b> : N/A';
          }
                echo '<br /><br />
                <a href="?pagina=account&action=principal">Changer de personnage principal</a>
              </div>
            </fieldset>
            <fieldset>
          <legend>Mes personnages</legend>';
          $sql = $this->dbOther->query("SELECT * FROM personajes WHERE cuenta = '".$_SESSION['id']."'");
          if($sql->rowCount() > 0)
          {
            echo '<table border="0" width="100%">
              <th>Nom</th>
              <th>Classe</th>
              <th>Sexe</th>
              <th>Niveau</th>
              <th>Alignement</th>
              <th>Visionner</th>';
            $sql = $this->dbOther->query("SELECT * FROM personajes WHERE cuenta = '".$_SESSION['id']."' ORDER BY id DESC");
            foreach ($sql as $data)
            {
                echo '<tr align="center">
                  <td>'.$data['nombre'].'</td>
                  <td><img src="images/icons/class_'.$data['clase'].'.png" title="'.$this->class_name($data['clase']).'" width="22" height="22" /></td>
                  <td><img src="images/icons/sexe_'.$data['sexo'].'.png" title="'.$this->sexe_name($data['sexo']).'" /></td>
                  <td>'.$data['nivel'].'</td>
                  <td><img src="images/icons/align_'.$data['alineacion'].'.png" title="'.$this->align_name($data['alineacion']).'" width="22" height="22" /></td>
                  <td><a href="?pagina=armorie&id='.$data['id'].'"><img src="images/fiche.png" /></a></td>
                <tr>';
            }
            echo '</table>';
          }
          else
          {
            echo INFO_002;
          }
            echo '</fieldset>
            <br />';
          break;
      }
    }
    else
    {
      echo ERROR_004;
    }
  }
  
  public function points()
  { 
    if($this->connect())
    {
      echo '<span class="cambria orange italic size25">Acheter des Points</span>
        <br /><br />';
      switch(htmlentities(@$_GET['action']))
      {
        case 'end':
          if(isset($_COOKIE['points']) && $_COOKIE['points'] != '')
          {
            if($_COOKIE['points'])
            {
              echo SUCCES_004;
            }
            else
            {
              echo ERROR_015;
            }
            setcookie('points', '', 0);
          }
          else
          {
            echo ERROR_014;
          }
          break;
        case 'verif':
          $ident=$idp=$ids=$idd=$codes=$code1=$code2=$code3=$code4=$code5=$datas='';
$idp = 34039;

//$ids n'est plus utilisé, mais il faut conserver la variable pour une question de compatibilité
$idd = 56374;
$ident=$idp.";".$ids.";".$idd; 
//On récupère le(s) code(s) sous la forme "xxxxxxxx;xxxxxxxx"
if(isset($_POST['code1'])) $code1 = $_POST['code1'];
if(isset($_POST['code2'])) $code2 = ";".$_POST['code2'];
if(isset($_POST['code3'])) $code3 = ";".$_POST['code3'];
if(isset($_POST['code4'])) $code4 = ";".$_POST['code4'];
if(isset($_POST['code5'])) $code5 = ";".$_POST['code5'];
$codes=$code1.$code2.$code3.$code4.$code5;

//On récupère le champ DATAS"
if(isset($_POST['DATAS'])) $datas = $_POST['DATAS'];

//On encode les trois chaines en URL
$ident=urlencode($ident);
$codes=urlencode($codes);
$datas=urlencode($datas);


          $get_c = @file("http://script.starpass.fr/check_php.php?ident=$ident&codes=$codes&DATAS=$datas");
          $exp = explode("|",$get_c[0]);
          if(substr($exp[0],0,3) == 'OUI')
          {
            if($_SESSION['vip'] == 2)
            {
              $this->points = $this->points + $this->puntos_vip;
              $this->dbOther->query("UPDATE cuentas SET puntos = puntos + $this->points, recarga = 1 WHERE id = '".$_SESSION['id']."'");
            }
            else
            {
              $this->dbOther->query("UPDATE cuentas SET puntos = puntos + $this->points, recarga = 1 WHERE id = '".$_SESSION['id']."'");
            }
            $this->dbOther->query("INSERT INTO historia_puntos (cuenta,code,puntos,pagos,nivel,id_pago,tipo) VALUES ('".$_SESSION['id']."','".$code1."','".$this->points."','".$exp[2]."','".$exp[3]."','".$exp[4]."','".$exp[5]."')");
            $_SESSION['puntos'] = $_SESSION['puntos'] + $this->points;
            setcookie('points', 1);
            header('location:?pagina=points&action=end');
          }
          else
          {
            setcookie('points', 0);
            header('location:?pagina=points&action=end');
          }
          break;
		  case 'paygol': 
		   echo SUCCES_004;
		   break;
        default :
          echo '<div align="center">
            L\'achat de points vous permettra de gagner <b>'.$this->points.'</b> Points (<b>'.($this->points+$this->puntos_vip).'</b> pour les VIPs).<br />
            Les micropaiements s\'effectue par <a href="http://www.starpass.fr/" target="_blank">StarPass™</a>, éditée par <a href="http://www.bdmultimedia.fr/" target="_blank">BD Multimédia</a><br /><br />
            <b>Pour obtenir vos codes d\'accès :</b><br /><br />
            Veuillez cliquer sur le drapeau de votre pays<br /><br />
            <a onclick="window.open(this.href,\'StarPass\',\'width=400,height=300,scrollbars=yes,resizable=yes\');return false;" href="http://script.starpass.fr/numero_pays_v3.php?pays=fr&id_document='.$this->idd.'"><img src="images/flags/fr.png" title="France" /></a>
            <a onclick="window.open(this.href,\'StarPass\',\'width=400,height=300,scrollbars=yes,resizable=yes\');return false;" href="http://script.starpass.fr/numero_pays_v3.php?pays=fd&id_document='.$this->idd.'"><img src="images/flags/dom.png" title="DOM" /></a>
            <a onclick="window.open(this.href,\'StarPass\',\'width=400,height=300,scrollbars=yes,resizable=yes\');return false;" href="http://script.starpass.fr/numero_pays_v3.php?pays=be&id_document='.$this->idd.'"><img src="images/flags/be.png" title="Belgique" /></a>
            <a onclick="window.open(this.href,\'StarPass\',\'width=400,height=300,scrollbars=yes,resizable=yes\');return false;" href="http://script.starpass.fr/numero_pays_v3.php?pays=ch&id_document='.$this->idd.'"><img src="images/flags/ch.png" title="Suisse" /></a>
            <a onclick="window.open(this.href,\'StarPass\',\'width=400,height=300,scrollbars=yes,resizable=yes\');return false;" href="http://script.starpass.fr/numero_pays_v3.php?pays=lu&id_document='.$this->idd.'"><img src="images/flags/lu.png" title="Luxembourg" /></a>
            <a onclick="window.open(this.href,\'StarPass\',\'width=400,height=300,scrollbars=yes,resizable=yes\');return false;" href="http://script.starpass.fr/numero_pays_v3.php?pays=ca&id_document='.$this->idd.'"><img src="images/flags/ca.png" title="Canada" /></a>
            <a onclick="window.open(this.href,\'StarPass\',\'width=400,height=300,scrollbars=yes,resizable=yes\');return false;" href="http://script.starpass.fr/numero_pays_v3.php?pays=de&id_document='.$this->idd.'"><img src="images/flags/de.png" title="Allemagne" /></a>
            <a onclick="window.open(this.href,\'StarPass\',\'width=400,height=300,scrollbars=yes,resizable=yes\');return false;" href="http://script.starpass.fr/numero_pays_v3.php?pays=es&id_document='.$this->idd.'"><img src="images/flags/es.png" title="Espagne" /></a>
            <a onclick="window.open(this.href,\'StarPass\',\'width=400,height=300,scrollbars=yes,resizable=yes\');return false;" href="http://script.starpass.fr/numero_pays_v3.php?pays=uk&id_document='.$this->idd.'"><img src="images/flags/gb.png" title="Royaume-Uni" /></a>
            <a onclick="window.open(this.href,\'StarPass\',\'width=400,height=300,scrollbars=yes,resizable=yes\');return false;" href="http://script.starpass.fr/numero_pays_v3.php?pays=it&id_document='.$this->idd.'"><img src="images/flags/it.png" title="Italie" /></a>
            <a onclick="window.open(this.href,\'StarPass\',\'width=400,height=300,scrollbars=yes,resizable=yes\');return false;" href="http://script.starpass.fr/numero_pays_v3.php?pays=at&id_document='.$this->idd.'"><img src="images/flags/at.png" title="Autriche" /></a>
            <br /><br />
            Veuillez entrer votre code<br /><br />
            <form method="post" action="?pagina=points&action=verif">
              <input type="text" name="code1" value="" maxlength="8" />
              <span class="envoyer"><input type="submit" name="send" value=" " /></span>
            </form>
          </div>';
		  
		  ?>
		  <!-- PayGol JavaScript -->
	<center  <p>&nbsp;</p> <p>&nbsp;</p> <p>&nbsp;</p>
		   <p>ACHETER PAR PAYGOL</p> <p>&nbsp;</p>
<script src="http://www.paygol.com/micropayment/js/paygol.js" type="text/javascript"></script> 

<!-- PayGol Form -->
<form name="pg_frm">
 <input type="hidden" name="pg_serviceid" value="8110">
 <input type="hidden" name="pg_currency" value="EUR">
 <input type="hidden" name="pg_name" value="bustofus">
 <input type="hidden" name="pg_custom" value=" <?php echo $_SESSION['id'] ?>">

 <!-- With Dropdown -->
 <select name="pg_price"> 
  <option value="1" selected>2 euros - 90 puntos €2</option>
  <option value="2">4 euros - 190 puntos €4</option>
  <option value="3">6 euros - 300 puntos €6</option>
  <option value="4">8 euros - 420 puntos €8</option>
  <option value="5">10 euros - 550 puntos €10</option>
 </select>
 <p>&nbsp;</p>
 <input type="hidden" name="pg_return_url" value="http://176.31.248.104/?pagina=points&action=paygol">
 <input type="hidden" name="pg_cancel_url" value="">
 <input type="image" name="pg_button" class="paygol" src="http://www.paygol.com/micropayment/img/buttons/175/donate_es_2.png" border="0" alt="Realiza pagos con PayGol: la forma mas facil!" title="Realiza pagos con PayGol: la forma mas facil!" onClick="pg_reDirect(this.form)">
</form>
 <p>&nbsp;</p>
  <p>Si vous voulez savoir combien vous avez fait des dons, s'il vous plaît entrer votre numéro de téléphone ci-dessous:</p>
  <p>&nbsp;</p>
  <iframe src="http://www.paygol.com/plugins/view_transactions?key=e5ba57fc-2a07-102f-bc7c-8e0e98d2532b&language=es" width="400" height="250" frameborder="0" scrolling="no"> </iframe>
 </center>
 <?php  
          break;
      }
    }
    else
    {
      echo ERROR_004;
    }
  }

  public function ladder2()
  {
    echo '<span class="cambria orange italic size25">Classement</span>
      <br /><br />
      <div id="item_tooltip_top"></div>
      <div id="item_tooltip_middle">
      <div align="center">
      <table border="0" width="95%">
      <th>Position</th>
      <th>Nom</th>
      <th>Classe</th>
      <th>Sexe</th>
      <th>Niveau</th>
      <th>Alignement</th>';
    $i=1;
	$sql = $this->dbOther->query("SELECT * FROM personajes WHERE nivel != 25 ORDER BY xp DESC LIMIT 0,20");
    foreach ($sql as $data)
    {
      echo ''.($i < 4 ? '<tr class="Ladder'.$i.'" align="center">' : '<tr align="center">').'
        <td>'.($i < 4 ? '<img src="images/icons/ladder'.$i.'.png" />' : ''.$i.'').'</td>
        <td><a href="">'.($i < 4 ? '<font color="black">'.$data['nombre'].'</font>' : ''.$data['nombre'].'').'</a></td>
        <td><img src="images/icons/class_'.$data['clase'].'.png" title="'.$this->class_name($data['clase']).'" width="22" height="22" /></td>
        <td><img src="images/icons/sexe_'.$data['sexo'].'.png" title="'.$this->sexe_name($data['sexo']).'" /></td>
        <td>'.$data['nivel'].'</td>
        <td><img src="images/icons/align_'.$data['alineacion'].'.png" title="'.$this->align_name($data['alineacion']).'" width="22" height="22" /></td>
      <tr>';
      $i++;
    }
    echo '</table>
      </div>
      </div>
      <div id="item_tooltip_bottom"></div>';
  }

  public function article()
  {  
    if(isset($_GET['id']) && $_GET['id'] != '' && is_numeric($_GET['id']))
    {
      $sql = $this->dbOther->query("SELECT * FROM news WHERE id = '".htmlentities($_GET['id'])."'");
      $data = $sql->fetch(PDO::FETCH_ASSOC);
      if($sql->rowCount() > 0)
      {
        echo '<img src="images/top.png" />
          <div id="mid_corp">
            <div id="text_corp">
              <div class="titre">'.$data['titulo'].'</div>
              '.($data['bMostrarImagen'] == 1 ? '<div class="avatar"><img src="'.$data['urlImagen'].'" /></div>' : null).'
              '.$data['contenido'].'
              <div style="width:100px;height:1px;clear:both;"></div>
              <div class="date">Ecrit par <b>'.$data['autor'].'</b> le '.$this->date_fr('l d F Y à H:i',strtotime($data['fecha'])).'</div>
            </div>
          </div>
          <img src="images/bottom.png" />';
        if($data['com'])
        {
          $sql = $this->dbOther->query("SELECT * FROM commentaires WHERE news = '".htmlentities($_GET['id'])."'");
          if($sql->rowCount() > 0)
          {
            $sql = $this->dbOther->query("SELECT COUNT(id) as nbComs FROM commentaires WHERE news = '".htmlentities($_GET['id'])."'");
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $nbComs = $data['nroComentarios'];
            $nbPage = ceil($nbComs/10);
            if(isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage)
            {
              $cPage = $_GET['p'];
            }
            else
            {
              $cPage = 1;
            }

            $sql = $this->dbOther->query("SELECT * FROM commentaires WHERE news = '".htmlentities($_GET['id'])."' ORDER BY id DESC LIMIT ".(($cPage-1)*10).",10");
            foreach ($sql as $data)
            {
              echo '<img src="images/top.png" />
              <div id="mid_corp">
                <div id="text_corp">
                  '.$data['contenido'].'
                  <div style="width:100px;height:1px;clear:both;"></div>
                  <div class="date">Ecrit par <b>'.$data['autor'].'</b> le '.$this->date_fr('l d F Y à H:i',strtotime($data['fecha'])).'</div>
                </div>
              </div>
              <img src="images/bottom.png" />';
            }

            if(@$nbComs > 0)
            {
              echo '<img src="images/top.png" />
              <div id="mid_corp">
                <div id="text_corp">
                  <center>Pages : ';
              for($i=1;$i<=$nbPage;$i++)
              {
                if($i==$cPage)
                {
                  echo '<a href="?pagina=article&id='.htmlentities($_GET['id']).'&p='.$i.'"><b>'.$i.'</b></a> ';
                }
                else
                {
                  echo '<a href="?pagina=article&id='.htmlentities($_GET['id']).'&p='.$i.'">'.$i.'</a> ';
                }
              }
              echo '<br /><a href="?pagina=commentaire&id='.htmlentities($_GET['id']).'">Ajouter un commentaire</a></center>
              </div>
              </div>
              <img src="images/bottom.png" />';
            }
          }
          else
          {
            echo '<img src="images/top.png" />
            <div id="mid_corp">
              <div id="text_corp">
                <center>Aucun commentaires<br /><a href="?pagina=commentaire&id='.htmlentities($_GET['id']).'">Ajouter un commentaire</a></center>
              </div>
            </div>
            <img src="images/bottom.png" />';
          }
        }
        else
        {
          echo '<img src="images/top.png" />
              <div id="mid_corp">
                <div id="text_corp">
                '.INFO_004.'
                </div>
            </div>
            <img src="images/bottom.png" />';
        }
      }
      else
      {
        echo '<img src="images/top.png" />
              <div id="mid_corp">
                <div id="text_corp">
                '.ERROR_017.'
                </div>
            </div>
            <img src="images/bottom.png" />';
      }
    }
  }

  public function commentaire()
  {
    global $bbcode;

    echo '<span class="cambria orange italic size25">Ajouter un commentaire</span>
        <br /><br />';

    if($this->connect())
    {
      if(isset($_POST['noticias']) && $_POST['noticias'] != '')
      {
        if(empty($_COOKIE['flood_time']))
        {
          $sql = $this->dbOther->query("SELECT * FROM noticias WHERE id = '".htmlentities($_POST['noticias'])."'");
          if($sql->rowCount() > 0)
          {
            if(isset($_POST['contenido']) && $_POST['contenido'] != '')
            {
              $sql = $this->dbOther->query("SELECT * FROM personnages WHERE guid = '".$_SESSION['personajePrincipal']."'");
              $data = $sql->fetch(PDO::FETCH_ASSOC);
              $this->dbOther->query("INSERT INTO comentarios (contenido,autor,noticias) VALUES ('".$bbcode->BBCodeM(htmlentities($_POST['contenido']))."','".$data['nombre']."','".htmlentities($_POST['noticias'])."')");
              setcookie('flood_time', '1', time()+60);
              if(file_exists('cache/pagina=article&id='.$_POST['noticias'].'.html'))
              {
                unlink('cache/pagina=article&id='.$_POST['noticias'].'.html');
              }
              header('location:?pagina=article&id='.$_POST['noticias']);
            }
            else
            {
              echo ERROR_001;
            }
          }
          else
          {
            header('location:?pagina=home');
          }
        }
        else
        {
          echo INFO_005;
        }
      }
      else
      {
        if(isset($_GET['id']) && $_GET['id'] != '')
        {
          $sql = $this->dbOther->query("SELECT * FROM noticias WHERE id = '".htmlentities($_GET['id'])."'");
          if($sql->rowCount() > 0)
          {
            if(isset($_SESSION['personajePrincipal']) && $_SESSION['personajePrincipal'] != '0')
            {
              echo '<br />
                <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
                <script type="text/javascript" src="markitup/jquery.markitup.js"></script>
                <script type="text/javascript" src="markitup/markitup_textarea.js"></script>
                <script type="text/javascript" src="markitup/sets/bbcode/set.js"></script>
                <link rel="stylesheet" type="text/css" href="markitup/skins/simple/style.css" />
                <link rel="stylesheet" type="text/css" href="markitup/sets/bbcode/style.css" />
                <form method="post" action="#">
                  <input type="hidden" name="news" value="'.htmlentities($_GET['id']).'" />
                  <textarea name="content" id="markItUp" cols="50" rows="10" style="color: white; background-color: #252525; border-color: #252525;"></textarea>
                  <div class="envoyer"><center><input type="submit" name="send" value=" " /></center></div>
                </form>
                <br />';
            }
            else
            {
              echo ERROR_016;
            }
          }
          else
          {
            echo ERROR_017;
          }
        }
        else
        {
          header('location:?pagina=home');
        }
      }
    }
    else
    {
      echo ERROR_004;
    }
  }

  public function ban_ip() 
  {
    if(empty($_COOKIE['ban_time']))
    {
      setcookie('ban_time', '1', time()+120);
      $sql = $this->dbOther->query("SELECT * FROM ban_ip WHERE IP = '".$_SERVER['REMOTE_ADDR']."'");
      if($sql->rowCount() > 0)
      {
        $_SESSION['ban'] = 'TRUE';
        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }
    else
    {
      if(isset($_SESSION['ban']) && $_SESSION['ban'] == 'TRUE')
      {
        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }
  }

    public function ban_page()
  {
    $sql = $this->dbOther->query("SELECT * FROM ban_ip WHERE IP = '".$_SERVER['REMOTE_ADDR']."'");
    $data = $sql->fetch(PDO::FETCH_ASSOC);

    if($data['expira'] != '0000-00-00 00:00:00')
    {
      if(date('Y-m-d H:i:s') > $data['expira'])
      {
        $sql = $this->dbOther->query("DELETE FROM ban_ip WHERE IP = '".$_SERVER['REMOTE_ADDR']."'");
        session_unset();
        session_destroy();
        setcookie('ban_time');
        header('location:http://www.nestrya.fr/?pagina=home');
      }
    }

    echo '<center>
      <b>Vous êtes banni !</b><br /><br />
      <img src="images/cranes.png" /><br /><br />
      <table border="0">
      <tr><td align="left">Banni le : </td><td align="left">'.$this->date_fr('l d F Y à H:i',strtotime($data['fecha'])).'</td></tr>
      <tr><td align="left">Raison : </td><td align="left">'.$data['razon'].'</td></tr>
      <tr><td align="left">Expire le : </td><td align="left">'.($data['expira'] == '0000-00-00 00:00:00' ? 'Jamais' : $this->date_fr('l d F Y à H:i',strtotime($data['expira']))).'</td></tr>
      </table>
      </center>';
  }

  public function contact()
  {
    global $bbcode;

    if($this->connect())
    {
      if(isset($_POST['send']) && $_POST['send'] != '')
      {
        if(empty($_COOKIE['flood_time']))
        {
          if(isset($_POST['contenido']) && $_POST['contenido'] != '' && isset($_POST['object']) && $_POST['object'] != '')
          {
            $this->dbOther->query("INSERT INTO contact (account,object,content,A) VALUES ('".$_SESSION['id']."','".htmlentities($_POST['object'])."','".$bbcode->BBCodeM($_POST['contenido'])."','".htmlentities($_POST['A'])."')");
            setcookie('flood_time', '1', time()+60);
            echo SUCCES_005;
          }
          else
          {
            echo ERROR_001;
          }
        }
        else
        {
          echo INFO_005;
        }
      }

      echo '<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="markitup/jquery.markitup.js"></script>
        <script type="text/javascript" src="markitup/markitup_textarea.js"></script>
        <script type="text/javascript" src="markitup/sets/bbcode/set.js"></script>
        <link rel="stylesheet" type="text/css" href="markitup/skins/simple/style.css" />
        <link rel="stylesheet" type="text/css" href="markitup/sets/bbcode/style.css" />
        <span class="cambria orange italic size25">Contact</span>
        <br /><br />
        Sur cette page vous pourrez prendre contact avec l\'équipe de Bustofus, pour cela, veuillez exposer votre requête grâce au formulaire ci-dessous.<br />
        Nous vous invitons à visitez notre <a href="?pagina=faq" title="Foire aux Questions">FAQ</a> avant utilisation du service d\'assistance.<br /><br />
        <form method="post" action="#">
          <input type="hidden" name="A" value="'.(isset($_GET['A']) && $_GET['A'] != '' ? ''.htmlentities($_GET['A']).'' : '0').'" />
          <label for="object">Objet :</label><br />
          <input type="text" id="object" name="object" value="" /> '.(isset($_GET['A']) && $_GET['A'] != '' ? 'Message addresé à <b>'.htmlentities($_GET['A']).'</b>' : '').'<br /><br />
          Message :<br />
          <textarea name="content" id="markItUp" cols="50" rows="20" style="color: white; background-color: #252525; border-color: #252525;"></textarea>
          <div class="envoyer"><center><input type="submit" name="send" value=" " /></center></div>
        </form>
        <br />';
    }
    else
    {
      echo ERROR_004;
    }
  }

  public function vote()
  {
    if($this->connect())
    {
      $time = time()+7200; // 2h ou 120m (Temps entre chaque vote RPG Paradize)
      $this->dbOther->query("DELETE FROM votos WHERE tiempo <= '".time()."'");
      $sql = $this->dbOther->query("SELECT * FROM votos WHERE IP = '".$_SERVER['REMOTE_ADDR']."'");
      $data = $sql->fetch(PDO::FETCH_ASSOC);
      if($sql->rowCount() > 0)
      {
        $count_time = (int)(($data['tiempo']-time())/60);
        echo 'Vous devez attendre '.$count_time.' minutes avant de pouvoir re-voter.';
      }
      else
      {
        if(!(isset($_COOKIE['vote_time'])))
        {
          $this->dbOther->query("INSERT INTO votos (IP,tiempo) VALUES ('".$_SERVER['REMOTE_ADDR']."', '".$time."')");
          $this->dbOther->query("UPDATE cuentas SET puntos = puntos + '".$this->puntos_voto."', votos = votos + 1, recarga = 1 WHERE id = '".$_SESSION['id']."'");
          $_SESSION['puntos'] = $_SESSION['puntos'] + $this->puntos_voto;
          setcookie('vote_time', '1', $time-60);
          header('Location:http://www.rpg-paradize.com/?pagina=vote&vote='.$this->link_votacion.'');
        }
        else
        {
          $this->dbOther->query("INSERT INTO votos (IP,tiempo) VALUES ('".$_SERVER['REMOTE_ADDR']."', '".$time."')");
          header('Location:?pagina=vote');
        }
      }
    }
    else
    {
      echo 'Attention, vous n\'êtes pas connecté, vous ne recevrais pas vos point.
        <br /><br />
        <a href="http://www.rpg-paradize.com/?pagina=vote&vote='.$this->link_votacion.'">Voter</a>';
    }
  }

  public function devtool()
  {
    if($this->connect())
    {
      if($this->admin(5))
      {
        echo '<div id="WebDebug">
          <div id="WebDebugBar">
            <a href="#" onclick="WebDebugToggleMenu(); return false;"><img src="images/devtool/terminal.png" alt="Debug toolbar" /></a>
            <ul id="WebDebugDetails" class="WebDebugMenu">
              <li><span id="WebDebugSymfonyVersion">1.5</span></li>

              <li class="WebDebugInfo"><a title="Open" href="?pagina=home"><img src="images/devtool/open.png" alt="Open" /></a></li>

              '.(in_array($_SESSION['cuenta'],array('Sorrow','thediminou','Aly')) ? '<li class="WebDebugInfo"><a title="Informations" href="#" onclick="DevTool(\'infos\');return false;"><img src="images/devtool/infos.png" alt="Informations" /> infos</a></li>' : '').'
              '.(in_array($_SESSION['cuenta'],array('Sorrow','thediminou')) ? '<li class="WebDebugInfo"><a title="Logs" href="#" onclick="DevTool(\'logs\');return false;"><img src="images/devtool/log.png" alt="Logs" /> logs</a></li>' : '').'
              <li class="WebDebugInfo"><a title="Configuration" href="#" onclick="DevTool(\'config\');return false;"><img src="images/devtool/config.png" alt="Config" /> config</a></li>
              '.(in_array($_SESSION['cuenta'],array('Sorrow','thediminou')) ? '<li class="WebDebugInfo"><a title="Clé Beta" href="#" onclick="DevTool(\'key\');return false;"><img src="images/devtool/key.png" alt="key" /> clés</a></li>' : '').'
              <li class="WebDebugInfo"><a title="Achat" href="#" onclick="DevTool(\'achat\');return false;"><img src="images/devtool/money.png" alt="Achat" /> achats points</a></li>
              <li class="WebDebugInfo"><a title="Boutique" href="#" onclick="DevTool(\'boutique\');return false;"><img src="images/devtool/cart.png" alt="Boutique" /> boutique</a></li>
              <li class="WebDebugInfo"><a title="Cadeau" href="#" onclick="DevTool(\'cadeau\');return false;"><img src="images/devtool/cadeau.png" alt="Cadeau" /> cadeaux</a></li>
              <li class="WebDebugInfo"><a title="Bannissement" href="#" onclick="DevTool(\'bannissement\');return false;"><img src="images/devtool/ip.png" alt="Bannnissement" /> bannissement</a></li>
              <li class="WebDebugInfo"><a title="Membres" href="#" onclick="DevTool(\'membre\');return false;"><img src="images/devtool/membre.png" alt="Membre" /> comptes</a></li>
              <li class="WebDebugInfo"><a title="News" href="#" onclick="DevTool(\'news\');return false;"><img src="images/devtool/write.png" alt="News" /> news</a></li>
              <li class="WebDebugInfo"><a title="Commentaires" href="#" onclick="DevTool(\'commentaire\');return false;"><img src="images/devtool/view.png" alt="Commentaires" /> commentaires</a></li>
              <li class="WebDebugInfo"><a title="Joueurs" href="#" onclick="DevTool(\'joueur\');return false;"><img src="images/devtool/joueur.png" alt="Joueur" /> personnages</a></li>
              <li class="WebDebugInfo"><a title="Contact" href="#" onclick="DevTool(\'contact\');return false;"><img src="images/devtool/email.png" alt="Contact" /> contact</a></li>
              <li class="WebDebugInfo"><a title="Aide" href="#" onclick="DevTool(\'help\');return false;"><img src="images/devtool/help.png" alt="Aide" /> aide</a></li>
              

              <li class="WebDebugInfo"><img src="images/devtool/time.png" alt="Time" /> <span id="date_heure"></span><script type="text/javascript">window.onload = date_heure(\'date_heure\');</script></li>
              <li class="last"><a href="#" onclick="document.getElementById(\'WebDebug\').style.display=\'none\'; return false;"><img src="images/devtool/close.png" alt="Close" /></a></li>
            </ul>
          </div>
        </div>
        <div id="DevTool" title="CP Admin" style="font-size: 12px; font-family: Arial, sans-serif;"></div>';
      }
    }
  }
  
  public function event()
  {
    echo '<span style="float:right"><img src="images/event/XP.png" /></span>
      <span class="cambria orange italic size25">Concours d\'XP</span>
      <div style="margin-top:10px;border-left:5px solid #FF2424;padding:15px;-moz-border-radius:5px;width:550px;" class="c_99CEE0 size15 justify bgbox1_n">
        <b>Objectif</b> :
        <ul>
          <li>Obtenir le plus d\'XP en une semaine.</li>
        </ul>
        <b>Récompense</b> :
        <ul>
          <li>#1 Place <span class="red2">--» *A Venir*</span></li>
          <li>#2 Place <span class="red2">--» *A Venir*</span></li>
          <li>#3 Place <span class="red2">--» *A Venir*</span></li>
        </ul>
          <b>Durée</b> :
        <ul>
          <li>Pendant une semaine après le lancement de la beta test.</li>
        </ul>
      </div>';
  }

  public function opening()
  {
    $sql = $this->dbOther->query("SELECT * FROM config");
    $data = $sql->fetch(PDO::FETCH_ASSOC);
    if($data['construccion'] == 1)
    {
      if(date('Y-m-d H:i:s') >= $data['c_time'])
      {
        $this->dbOther->query("UPDATE config SET construct = 0");
        header('location:?pagina=home');
      }
      else
      {
        echo '<span class="cambria orange italic size25">Ouverture proche</span>
          <script type="text/javascript">
            dateFuture = new Date('.date("Y,m-1,d,H,i,s",strtotime($data['c_time'])).'); // 2010,10,7,12,00,00
            function GetCount()
            {
              dateNow = new Date();
              amount = dateFuture.getTime() - dateNow.getTime();
              delete dateNow;
              if(amount < 0)
              {
                window.location="?pagina=opening";
              }
              else
              {
                days=0;hours=0;mins=0;secs=0;out="";
                amount = Math.floor(amount/1000);
                days=Math.floor(amount/86400);
                amount=amount%86400;
                hours=Math.floor(amount/3600);
                amount=amount%3600;
                mins=Math.floor(amount/60);
                amount=amount%60;
                secs=Math.floor(amount);
                if((days == 0) || (days == 1) || (days == 2) || (days == 3) || (days == 4) || (days == 5) || (days == 6) || (days == 7) || (days == 8) || (days == 9)){out += "0"+ days +" Jours ";}else{out += ""+ days +" Jours ";}
                if((hours == 0) || (hours == 1) || (hours == 2) || (hours == 3) || (hours == 4) || (hours == 5) || (hours == 6) || (hours == 7) || (hours == 8) || (hours == 9)){out += "0"+ hours +" Heures ";}else{out += ""+ hours +" Heures ";}
                if((mins == 0) || (mins == 1) || (mins == 2) || (mins == 3) || (mins == 4) || (mins == 5) || (mins == 6) || (mins == 7) || (mins == 8) || (mins == 9)){out += "0"+ mins +" Minutes ";}else{out += ""+ mins +" Minutes ";}
                if((secs == 0) || (secs == 1) || (secs == 2) || (secs == 3) || (secs == 4) || (secs == 5) || (secs == 6) || (secs == 7) || (secs == 8) || (secs == 9)){out += "0"+ secs +" Secondes";}else{out += ""+ secs +" Secondes";}
                document.getElementById(\'countbox\').innerHTML=out;
                setTimeout("GetCount()", 1000);
              }
            }
            window.onload=GetCount;
          </script>
          <br /><br />
          <center>
          <h2><span id="countbox"></span></h2>
          </center>
          <br />';
      }
    }
    else
    {
      header('location:?pagina=home');
    }
  }

  public function mantenimiento()
  {
    $sql = $this->dbOther->query("SELECT * FROM config");
    $data = $sql->fetch(PDO::FETCH_ASSOC);
    if($data['mantenimiento'] == 1)
    {
      echo '<span class="cambria orange italic size25">Maintenance</span>
        <br /><br />
        <center><img src="images/maintenance.png" />
        <br /><br />
        '.$data['mant_razon'].'</center>';
    }
    else
    {
      header('location:?pagina=home');
    }
  }

  public function tracker()
  {
    echo '<span class="cambria orange italic size25">Bug Tracker</span>
      <br /><br />';
    if($this->connect())
    {
      echo '<div id="item_tooltip_top"></div>
      <div id="item_tooltip_middle">';

      switch(@$_GET['action'])
      {
        case 'view':
          if(isset($_GET['id']) && $_GET['id'] != '' && is_numerci($_GET['id']))
          {
            
          }
          break;
        default :
          $sql = $this->dbOther->query("SELECT * FROM bug_tracker WHERE visible = 1");
          if($sql->rowCount() > 0)
          {
            echo '<div align="center">
              <div class="panier">
              <table border="0" width="95%">
                <th>Objet</th>
                <th>Contenue</th>
                <th>Etat</th>
                <th>Date</th>
                <th>Visualiser</th>';
            $sql = $this->dbOther->prepare("SELECT * FROM bug_tracker WHERE visible = 1 ORDER BY id DESC");
            $sql->execute();
            foreach ($sql as $data)
            {
              echo '<tr align="center">
                  <td>'.$data['object'].'</td>
                  <td>'.substr($data['contenido'],0,30).'</td>
                  <td>'.$this->state($data['state']).'</td>
                  <td>'.date('d/m/Y à H:i',strtotime($data['fecha'])).'</td>
                  <td><a href="?pagina=tacker&action=view&id='.$data['id'].'"><img src="images/devtool/zoom.png" /></a></td>
                </tr>';
            }
            echo '</table>
              </div>
              </div>';
          }
          else
          {
            echo '<center>Aucun bug signalé</center>';
          }
          break;
      }

      echo '
        </div>
        <div id="item_tooltip_bottom"></div>';
    }
    else
    {
      echo ERROR_004;
    }
  }

}
?>