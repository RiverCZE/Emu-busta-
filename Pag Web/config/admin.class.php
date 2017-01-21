<?php
class AdminClass
{

  public function AutoBan()
  {

  }

  private function admin($level=false)
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

  var $supreme_right = array('Sorrow','thediminou','Aly','Seillan');

  public function config()
  {
    global $sys;
    if($this->admin(5) && in_array($_SESSION['cuenta'],$this->supreme_right))
    {
      switch(@$_GET['action'])
      {
        case 'edit':
          echo '<div id="result">';
          $sys->dbOther->query("UPDATE config SET mantenimiento = '".$_POST['mantenimiento']."', m_raison = '".$_POST['m_raison']."', construct = '".$_POST['construct']."', c_time = '".$_POST['c_time']."', rpg_link = '".$_POST['rpg_link']."', points = '".$_POST['puntos']."', puntos_vip = '".$_POST['puntos_vip']."', puntos_voto = '".$_POST['puntos_voto']."', register = '".$_POST['register']."', beta = '".$_POST['beta']."'");
          echo 'Configuration modifié - <a href="#" onClick="DevTool(\'config\');"><img src=images/devtool/back.png /> Retour</a>
            </div>';
          break;
        default :
          $sql = $sys->dbOther->query("SELECT * FROM config");
          $data = $sql->fetch(PDO::FETCH_ASSOC);
          echo '<div id="result">
            <form method="post" onSubmit="DevForm_Config(this.mantenimiento.value,this.m_raison.value,this.construct.value,this.c_time.value,this.rpg_link.value,this.points.value,this.puntos_vip.value,this.puntos_voto.value,this.register.value,this.beta.value);return false;" action="">
              <h2>Maintenance</h2>
              <select name="mantenimiento">
                <option value="'.$data['mantenimiento'].'">'.($data['mantenimiento'] > 0 ? 'Activer' : 'Désactiver').'</option>
                <option value="0">--------</option>
                <option value="1" style="color:green;">Activer</option>
                <option value="0" style="color:red;">Désactiver</option>
              </select><br /><br />
              <textarea name="m_raison" cols="50">'.$data['mant_razon'].'</textarea>
              <h2>Construction</h2>
              <select name="construct">
                <option value="'.$data['construccion'].'">'.($data['construccion'] > 0 ? 'Activer' : 'Désactiver').'</option>
                <option value="0">--------</option>
                <option value="1" style="color:green;">Activer</option>
                <option value="0" style="color:red;">Désactiver</option>
              </select>
              <input type="text" name="c_time" value="'.date('Y-m-d H:i:s').'" />
              <h2>RPG Paradize</h2>
              <input type="text" name="rpg_link" value="'.$data['rpg_link'].'" size="5" />
              <h2>Points</h2>
              <input type="text" name="points" value="'.$data['puntos'].'" size="3" /> Points par achat</br >
              <input type="text" name="puntos_vip" value="'.$data['puntos_vip'].'" size="3" /> Suplément pour VIP</br >
              <input type="text" name="puntos_voto" value="'.$data['puntos_voto'].'" size="3" /> Points par vote</br ><br />
              <h2>Inscription</h2>
              <select name="register">
                <option value="'.$data['registro'].'">'.($data['registro'] > 0 ? 'Ouvert' : 'Fermer').'</option>
                <option value="0">--------</option>
                <option value="1" style="color:green;">Ouvert</option>
                <option value="0" style="color:red;">Fermer</option>
              </select> Inscription
             <br />
              <select name="beta">
                <option value="'.$data['beta'].'">'.($data['beta'] > 0 ? 'ON' : 'OFF').'</option>
                <option value="0">--------</option>
                <option value="1" style="color:green;">ON</option>
                <option value="0" style="color:red;">OFF</option>
              </select> Mode Beta (Parrainage obligatoire)
              <br /><br />
              <input type="submit" name="send" value="Modifier" />
            <form>
            </div>';
          break;
      }
    }
    else
    {
      echo ERROR_A01;
    }
  }
  
  public function commentaire()
  {
    global $sys;
    if($this->admin(5))
    {
      switch(@$_GET['action'])
      {
        case 'delete':
          $sys->dbOther->query("DELETE FROM comentarios WHERE id = '".$_GET['id']."'");
          echo 'Commentaire supprimer - <a href="#" onClick="DevTool(\'commentaire\');"><img src=images/devtool/back.png /> Retour</a>';
          break;
        default :
          echo '<div id="result">
            <h2>Recherche</h2>
            <form method="post" onsubmit="DevForm_Search(\'commentaire\',this.search.value,this.where.value);return false;" action="">
              <input type="text" name="search" value="">
              <select name="where">
                <option value="author">Auteur</option>
                <option value="content">Contenue</option>
              </select>
              <input type="submit" name="send" value="Rechercher" />
            </form>
            <h2>Résultats</h2>
            <table border="0" width="100%">
            <th>Auteur</th>
            <th>Message</th>
            <th>Date</th>
            <th>Supprimer</th>';
          if(isset($_POST['search']) && $_POST['search'] != '')
          {
            $sql = $sys->dbOther->query("SELECT * FROM comentarios WHERE ".$_POST['where']." LIKE '%".$_POST['search']."%' ORDER BY id DESC");
          }
          else
          {
            $sql = $sys->dbOther->query("SELECT * FROM comentarios ORDER BY id DESC");
          }
          foreach ($sql as $data)
          {
            echo '<tr align="center">
                <td>'.$data['autor'].'</td>
                <td>'.substr($data['contenido'],0,100).'</td>
                <td>'.$data['fecha'].'</td>
                <td><a href="#" onClick="if(confirm(\'Vous êtes sur le point de supprimer le commentaire de '.$data['autor'].'\n Message : '.substr(htmlentities($data['contenido']),0,100).'\')) DevTool(\'commentaire&action=delete&id='.$data['id'].'\'); else return false;"><img src="images/cross.png" /></a></td>
              </tr>';
          }
          echo '</table>
            </div>';
          break;
      }
    }
    else
    {
      echo ERROR_A01;
    }
  }

  public function ban_ip()
  {
    global $sys;
    if($this->admin(5))
    {
      switch(@$_GET['action'])
      {
        case 'add':
          if(isset($_POST['ip']) && $_POST['ip'] != 'IP' && $_POST['ip'] != '')
          {
            if($_POST['life'] == 0)
            {
              $sys->dbOther->query("INSERT INTO ban_ip (IP, expira, razon) VALUES ('".$_POST['ip']."','".$_POST['expira']." ".date('H:i:s')."','".$_POST['razon']."')");
            }
            else
            {
              $sys->dbOther->query("INSERT INTO ban_ip (IP, expira, razon) VALUES ('".$_POST['ip']."','0000-00-00 00:00:00','".$_POST['razon']."')");
            }
          }
          echo 'IP '.$_POST['ip'].' banni - <a href="#" onClick="DevTool(\'bannissement\');return false;"><img src=images/devtool/back.png /> Retour</a>';
          break;
        case 'delete':
          $sys->dbOther->query("DELETE FROM ban_ip WHERE id = '".$_GET['id']."'");
          echo 'IP banni supprimer - <a href="#" onClick="DevTool(\'bannissement\');return false;"><img src=images/devtool/back.png /> Retour</a>';
          break;
        default :
          echo '<div id="result">
            <h2>Ajouter</h2>
            <form method="post" onsubmit="DevForm_AddBan(this.ip.value,this.date.value,this.life.value,this.raison.value);return false;" action="">
              <input type="text" name="ip" value="IP">
              <input type="text" name="date" id="date" value="Expiration" />
              <select name="life">
                <option value="0">Date</option>
                <option value="1">Jamais</option>
              </select>
              <input type="text" name="raison" value="Raison">
              <input type="submit" name="send value="Rechercher" />
            </form>
            <h2>IPs Bannis</h2>
            <table border="0" width="100%">
              <th>IP</th>
              <th>Date</th>
              <th>Raison</th>
              <th>Expire</th>
              <th>Supprimer</th>';
          $sql = $sys->dbOther->query("SELECT * FROM ban_ip ORDER BY id DESC");
          foreach ($sql as $data)
          {
            echo '<tr align="center">
                <td>'.$data['IP'].'</td>
                <td>'.$data['fecha'].'</td>
                <td>'.$data['razon'].'</td>
                <td>'.$data['expira'].'</td>
                <td><a href="#" onClick="if(confirm(\'Vous êtes sur le point de supprimer le bannisement de l`IP '.$data['IP'].'\')) DevTool(\'bannissement&action=delete&id='.$data['id'].'\'); else return false;"><img src="images/cross.png" /></a></td>
              </tr>';
          }
          echo '</table>
            <h2>Comptes Bannis</h2>
              <table border="0" width="100%">
              <th>Compte</th>
              <th>Pseudo</th>
              <th>IP</th>
              <th>Modifier</th>';
          $sql = $sys->dbOther->query("SELECT * FROM cuentas WHERE baneado = 1 ORDER BY guid DESC");
          foreach ($sql as $data)
          {
            echo '<tr align="center">
                <td>'.$data['cuenta'].'</td>
                <td>'.$data['apodo'].'</td>
                <td>'.$data['ultimoIP'].'</td>
                <td><a href="#" onClick="DevTool(\'membre&action=edit&id='.$data['id'].'\');return false;"><img src="images/devtool/write.png" /></a></td>
              </tr>';
          }
          echo '</table>
            </div>';
          break;
      }
    }
    else
    {
      echo ERROR_A01;
    }
  }

  public function membre()
  {
    global $sys;
    if($this->admin(5))
    {
      switch(@$_GET['action'])
      {
        case 'send':
          echo '<div id="result">';
          $sys->dbOther->query("UPDATE cuentas SET cuenta = '".$_POST['cuenta']."', apodo = '".$_POST['apodo']."', email = '".$_POST['email']."', gm = '".$_POST['level']."', vip = '".$_POST['vip']."', baneado = '".$_POST['baneado']."', puntos = '".$_POST['puntos']."' WHERE id = '".$_POST['id']."'");
          echo 'Compte modifié - <a href="#" onClick="DevTool(\'membre&action=edit&id='.$_POST['id'].'\');return false;"><img src=images/devtool/back.png /> Retour</a></div>';
          break;
        case 'edit':
          echo '<div id="result">
            <h2>Modification de compte</h2>';
          $sql = $sys->dbOther->query("SELECT * FROM cuentas WHERE id = '".$_GET['id']."'");
          $data = $sql->fetch(PDO::FETCH_ASSOC);
          echo '<form method="post" onsubmit="DevForm_EditAcc(this.id.value,this.cuenta.value,this.apodo.value,this.email.value,this.gm.value,this.vip.value,this.baneado.value,this.puntos.value);return false;" action="">
              <table border="0">
                <input type="hidden" name="guid" value="'.$data['id'].'" />
                <tr><td>Compte :</td><td><input type="text" name="account" value="'.$data['cuenta'].'" /></td></tr>
                <tr><td>Password :</td><td><input type="text" name="password" disabled="disabled" value="'.$data['pass'].'" /></td></tr>
                <tr><td>Pseudo :</td><td><input type="text" name="pseudo" value="'.$data['apodo'].'" /></td></tr>
                <tr><td>Email :</td><td><input type="text" name="email" value="'.$data['email'].'" /></td></tr>
                <tr><td>IP :</td><td><input type="text" name="ip" disabled="disabled" value="'.$data['ultimoIP'].'" /></td></tr>
                <tr>
                  <td>Niveau :</td>
                  <td>
                    <select name="level">
                      <option value="'.$data['gm'].'">'.$sys->rank_name($data['gm']).'</option>
                      <option value="0">---------------</option>
                      <option value="0">Normal</option>
                      <option value="1">Animateur</option>
                      <option value="2">Maître du Jeu</option>
                      <option value="3">Chef Maître du Jeu</option>
                      <option value="4">Administrateur</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>VIP :</td>
                  <td>
                    <select name="vip">
                      <option value="'.$data['vip'].'">'.($data['vip'] > 1 ? 'OUI' : 'NON').'</option>
                      <option value="1">-----</option>
                      <option value="2">OUI</option>
                      <option value="1">NON</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Banni :</td>
                  <td>
                    <select name="banned">
                      <option value="'.$data['baneado'].'">'.($data['baneado'] > 0 ? 'OUI' : 'NON').'</option>
                      <option value="0">-----</option>
                      <option value="1">OUI</option>
                      <option value="0">NON</option>
                    </select>
                  </td>
                </tr>
                <tr><td>Points :</td><td><input type="text" name="puntos" value="'.$data['puntos'].'" /></td></tr>
                <tr><td>Votes :</td><td><input type="text" name="votos" disabled="disabled" value="'.$data['votos'].'" /></td></tr>
                <tr><td></td><td><input type="submit" name="send" value="Modifier" /></td></tr>
              </table>
            <form>
            <a href="#" onClick="DevTool(\'membre\');"><img src=images/devtool/back.png /> Retour</a>
            <div>';
          break;
        default :
          echo '<div id="result">
            <h2>Recherche</h2>
            <form method="post" onsubmit="DevForm_Search(\'membre\',this.search.value,this.where.value);return false" action="">
              <input type="text" name="search" value="">
              <select name="where">
                <option value="account">Compte</option>
                <option value="guid">GUID</option>
                <option value="pseudo">Pseudo</option>
                <option value="email">Email</option>
                <option value="lastIP">IP</option>
              </select>
              <input type="submit" name="send" value="Rechercher" />
            </form>
            <h2>Trie</h2>

            <form method="post" onsubmit="DevForm_TrieAcc(this.by.value,this.order.value,this.limit.value);return false" action="">
              <select name="by">
                <option value="guid">GUID</option>
                <option value="account">Compte</option>
                <option value="pseudo">Pseudo</option>
                <option value="email">Email</option>
                <option value="lastIP">IP</option>
                <option value="VIP">VIP</option>
                <option value="level">Niveau</option>
                <option value="banned">Banni</option>
                <option value="points">Points</option>
                <option value="votes">Votes</option>
              </select>
              <select name="order">
                <option value="DESC">Décroissant</option>
                <option value="ASC">Croissant</option>
              </select>
              <input type="text" name="limit" value="20" size="1" />
              <input type="submit" name="send" value="Trier" />
            </form>

            <h2>Résultats</h2>
            <table border="0" width="100%">
              <th>GUID</th>
              <th>Compte</th>
              <th>Pseudo</th>
              <th>IP</th>
              <th>Niveau</th>
              <th>Modifier</th>';
          if(isset($_POST['limit']) && $_POST['limit'] != '' && is_numeric($_POST['limit']))
          {
            $LIMIT = $_POST['limit'];
             setcookie('limit', $LIMIT, time()+3600);
          }
          elseif(isset($_COOKIE['limit']) && $_COOKIE['limit'] != '' && is_numeric($_COOKIE['limit']))
          {
            $LIMIT = $_COOKIE['limit'];
          }
          else
          {
            $LIMIT = 20;
          }
          $sql = $sys->dbOther->query("SELECT COUNT(id) as nroCuentas FROM cuentas");
          $data = $sql->fetch(PDO::FETCH_ASSOC);
          $nroCuentas = $data['nroCuentas'];
          $nbPage = ceil($nroCuentas/$LIMIT);
          if(isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage)
          {
            $cPage = $_GET['p'];
          }
          else
          {
            $cPage = 1;
          }
          if(isset($_POST['search']) && $_POST['search'] != '')
          {
            $sql = $sys->dbOther->query("SELECT * FROM cuentas WHERE ".$_POST['where']." LIKE '%".$_POST['search']."%' ORDER BY id DESC LIMIT ".(($cPage-1)*$LIMIT).",".$LIMIT."");
          }
          else
          {
            if(isset($_POST['by']) && $_POST['by'] != '')
            {
              if(is_numeric($_POST['limit']))
              {
                $sql = $sys->dbOther->query("SELECT * FROM cuentas ORDER BY ".$_POST['by']." ".$_POST['order']." LIMIT ".(($cPage-1)*$LIMIT).",".$LIMIT."");
              }
              else
              {
                $sql = $sys->dbOther->query("SELECT * FROM cuentas ORDER BY ".$_POST['by']." ".$_POST['order']." LIMIT ".(($cPage-1)*$LIMIT).",".$LIMIT."");
              }
            }
            else
            {
              $sql = $sys->dbOther->query("SELECT * FROM cuentas ORDER BY guid DESC LIMIT ".(($cPage-1)*$LIMIT).",".$LIMIT."");
            }
          }
          foreach ($sql as $data)
          {
            echo ''.($data['gm'] > 0 ? '<tr align="center" bgcolor="#5287ff">' : '<tr align="center">').'
                <td>'.$data['id'].'</td>
                '.($data['baneado'] > 0 ? '<td bgcolor="#ff5252">'.$data['cuenta'].'' : '<td>'.$data['cuenta'].'').'</td>
                <td>'.$data['apodo'].'</td>
                <td>'.$data['ultimoIP'].'</td>
                <td>'.$data['gm'].'</td>
                <td><a href="#" onClick="DevTool(\'membre&action=edit&id='.$data['id'].'\');return false;"><img src="images/devtool/write.png" /></a></td>
              </tr>';
          }
          echo '</table>';
          if(@$nroCuentas > 0)
          {
            echo '<center>Pages : ';
            for($i=1;$i<=$nbPage;$i++)
            {
              if($i==$cPage)
              {
                echo '<a href="#" onClick="DevTool(\'membre&p='.$i.'\');return false;"><b>'.$i.'</b></a> ';
              }
              else
              {
                echo '<a href="#" onClick="DevTool(\'membre&p='.$i.'\');return false;">'.$i.'</a> ';
              }
            }
            echo '</center>';
          }
          echo '<div>';
          break;
      }
    }
    else
    {
      echo ERROR_A01;
    }
  }

  public function noticias()
  {
    global $sys;
    if($this->admin(5))
    {
      switch(@$_GET['action'])
      {
        case 'edit_send':
          echo '<div id="result">';
          $sys->dbOther->query("UPDATE noticias SET titulo = '".$_POST['titulo']."', contenido = '".$_POST['contenido']."', com = '".$_POST['com']."' WHERE id = '".$_POST['id']."'");
          @unlink('../cache/pagina=home.html');
          @unlink('../cache/pagina=home&p=1.html');
          @unlink('../cache/pagina=home&p=2.html');
          @unlink('../cache/pagina=home&p=3.html');
          @unlink('../cache/.html');
          echo 'News modifié - <a href="#" onClick="DevTool(\'news\');return false;"><img src=images/devtool/back.png /> Retour</a>
            </div>';
          break;
        case 'edit':
          $sql = $sys->dbOther->query("SELECT * FROM noticias WHERE id = '".$_GET['id']."'");
          $data = $sql->fetch(PDO::FETCH_ASSOC);
          echo '<div id="result">
            <form method="post" onsubmit="DevForm_EditNews(this.id.value,this.tiulo.value,this.contenido.value,this.com.value);return false;" action="">
              <input type="hidden" name="id" value="'.$data['id'].'" />
              <label for="title">Titre :</label><br />
              <input type="text" id="title" name="title" value="'.$data['titulo'].'" /><br /><br />
              Message :<br />
              <textarea name="content" cols="100" rows="20">'.$data['contenido'].'</textarea><br /><br />
              Activer le commentaires :
              <select name="com">
                <option value="'.$data['com'].'">'.($data['com'] > 0 ? 'OUI' : 'NON').'</option>
                <option value="1">-----</option>
                <option value="1">OUI</option>
                <option value="0">NON</option>
              </select>
              <input type="submit" name="send" value="Modifier" />
            </form>
            <br /><a href="#" onClick="DevTool(\'news\');return false;"><img src=images/devtool/back.png /> Retour</a>
            </div>';
          break;
        case 'add_send':
          echo '<div id="result">';
          $sys->dbOther->query("INSERT INTO noticias (titulo, contenido, autor, com) VALUES ('".$_POST['titulo']."','".$_POST['contenido']."','".$_SESSION['cuenta']."','".$_POST['com']."')");
          @unlink('../cache/pagina=home.html');
          @unlink('../cache/pagina=home&p=1.html');
          @unlink('../cache/pagina=home&p=2.html');
          @unlink('../cache/pagina=home&p=3.html');
          @unlink('../cache/.html');
          echo 'News ajouté - <a href="#" onClick="DevTool(\'news\');return false;"><img src=images/devtool/back.png /> Retour</a>
            </div>';
          break;
        case 'add':
          echo '<div id="result">
            <form method="post" onsubmit="DevForm_AddNews(this.titulo.value,this.contenido.value,this.com.value);return false;" action="">
              <label for="title">Titre :</label><br />
              <input type="text" id="title" name="title" value="" /><br /><br />
              Message :<br />
              <textarea name="content" cols="100" rows="20"></textarea><br /><br />
              Activer le commentaires :
              <select name="com">
                <option value="1">OUI</option>
                <option value="0">NON</option>
              </select>
              <input type="submit" name="send" value="Ajouter" />
            </form>
            <br /><a href="#" onClick="DevTool(\'news\');return false;"><img src=images/devtool/back.png /> Retour</a>
            </div>';
          break;
        case 'delete':
          $sys->dbOther->query("DELETE FROM noticias WHERE id = '".$_GET['id']."'");
          @unlink('../cache/pagina=home.html');
          @unlink('../cache/pagina=home&p=1.html');
          @unlink('../cache/pagina=home&p=2.html');
          @unlink('../cache/pagina=home&p=3.html');
          @unlink('../cache/.html');
          echo 'News supprimé - <a href="#" onClick="DevTool(\'news\');return false;"><img src=images/devtool/back.png /> Retour</a>';
          break;
        default :
          echo '<div id="result">
            <h2>Recherche</h2>
            <form method="post" onsubmit="DevForm_Search(\'news\',this.search.value,this.where.value);return false;" action="">
              <input type="text" name="search" value="">
              <select name="where">
                <option value="content">Contenue</option>
                <option value="aithor">Auteur</option>
                <option value="id">ID</option>
              </select>
              <input type="submit" name="send" value="Rechercher" />
            </form>

            <h2>Ajouter</h2>
            <a href="#" onClick="DevTool(\'news&action=add\');return false;">Ajouter une news</a>
            <h2>Résultats</h2>
            <table border="0" width="100%">
            <th>ID</th>
            <th>Titre</th>
            <th>Contenue</th>
            <th>Auteur</th>
            <th>Date</th>
            <th>Modifier</th>
            <th>Supprimer</th>';
          if(isset($_POST['search']) && $_POST['search'] != '')
          {
            $sql = $sys->dbOther->query("SELECT * FROM noticias WHERE ".$_POST['where']." LIKE '%".$_POST['search']."%' ORDER BY id DESC");
          }
          else
          {
            $sql = $sys->dbOther->query("SELECT * FROM noticias ORDER BY id DESC");
          }
          foreach ($sql as $data)
          {
            echo '<tr align="center">
                <td>'.$data['id'].'</td>
                <td>'.$data['titulo'].'</td>
                <td>'.substr($data['contenido'],0,80).'</td>
                <td>'.$data['autor'].'</td>
                <td>'.$data['fecha'].'</td>
                <td><a href="#" onClick="DevTool(\'news&action=edit&id='.$data['id'].'\');return false;"><img src="images/devtool/write.png" /></a></td>
                <td><a href="#" onClick="if(confirm(\'Vous êtes sur le point de supprimer la news '.$data['id'].'\')) DevTool(\'news&action=delete&id='.$data['id'].'\'); else return false;"><img src="images/cross.png" /></a></td>
              </tr>';
          }
          echo '</table>
            </div>';
          break;
      }
    }
    else
    {
      echo ERROR_A01;
    }
  }

  public function contact()
  {
    global $sys;
    if($this->admin(5))
    {
      switch(@$_GET['action'])
      {
        case 'delete':
          echo '<div id="result">';
          $sys->dbOther->query("DELETE FROM contact WHERE id = '".$_GET['id']."'");
          echo 'Message suprimé <a href="#" onClick="DevTool(\'contact\');return false;"><img src=images/devtool/back.png /> Retour</a>
            </div>';
          break;
          break;
        case 'view':
          echo '<div id="result">
            <h2>Messages</h2>';
          $sys->dbOther->query("UPDATE contact SET state = 1 WHERE id = '".$_GET['id']."'");
          $sql = $sys->dbOther->query("SELECT * FROM contact WHERE id = '".$_GET['id']."'");
          $data = $sql->fetch(PDO::FETCH_ASSOC);
          echo 'Auteur : '.($author = $sys->acc_info('guid',$data['cuenta'],'account')).'<br />
            Objet : '.$data['object'].'<br /><br />
            Message :<br /><br />
            '.$data['contenido'].'
            <br /><br />
            <a href="#" onClick="if(confirm(\'Vous êtes sur le point de supprimer le message de '.$author.'\')) DevTool(\'contact&action=delete&id='.$data['id'].'\'); else return false;"><img src=images/devtool/close.png /> Suprimer</a> - <a href="#" onClick="DevTool(\'contact\');return false;"><img src=images/devtool/back.png /> Retour</a>
            </div>';
          break;
        default :
          echo '<div id="result">
            <h2>Messages</h2>';
          $sql = $sys->dbOther->query("SELECT COUNT(id) as nbMails FROM contact WHERE A = '0'");
          $data = $sql->fetch(PDO::FETCH_ASSOC);
          $nbMails = $data['nbMails'];
          $nbPage = ceil($nbMails/10);
          if(isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage)
          {
            $cPage = $_GET['p'];
          }
          else
          {
            $cPage = 1;
          }

          echo '<table border="0" width="100%">
            <th>Etat</th>
            <th>Objet</th>
            <th>Contenue</th>
            <th>Date</th>
            <th>Lire</th>';

          $sql = $sys->dbOther->query("SELECT * FROM contact WHERE A = '0' ORDER BY id DESC LIMIT ".(($cPage-1)*10).",10");
          foreach ($sql as $data)
          {
            echo '<tr align="center">
                <td>'.($data['state'] == 0 ? '<img src="images/devtool/email.png" />' : '<img src="images/devtool/email_open.png" />').'</td>
                <td>'.$data['object'].'</td>
                <td>'.substr($data['contenido'],0,80).'</td>
                <td>'.$data['fecha'].'</td>
                <td><a href="#" onClick="DevTool(\'contact&action=view&id='.$data['id'].'\');return false;"><img src="images/devtool/zoom.png" /></a></td>
              </tr>';
          }
          echo '</table>';
          if(@$nbMails > 0)
          {
            echo '<center>Pages : ';
            for($i=1;$i<=$nbPage;$i++)
            {
              if($i==$cPage)
              {
                echo '<a href="#" onClick="DevTool(\'contact&p='.$i.'\');return false;"><b>'.$i.'</b></a> ';
              }
              else
              {
                echo '<a href="#" onClick="DevTool(\'contact&p='.$i.'\');return false;">'.$i.'</a> ';
              }
            }
            echo '</center>';
          }
          echo '<h2>Messages concerné</h2>
            <table border="0" width="100%">
              <th>Etat</th>
              <th>Objet</th>
              <th>Contenue</th>
              <th>Date</th>
              <th>Lire</th>';

          $sql = $sys->dbOther->query("SELECT * FROM contact WHERE A = '".$_SESSION['cuenta']."' ORDER BY id DESC");
          foreach ($sql as $data)
          {
            echo '<tr align="center">
                <td>'.($data['state'] == 0 ? '<img src="images/devtool/email.png" />' : '<img src="images/devtool/email_open.png" />').'</td>
                <td>'.$data['object'].'</td>
                <td>'.substr($data['contenido'],0,80).'</td>
                <td>'.$data['fecha'].'</td>
                <td><a href="#" onClick="DevTool(\'contact&action=view&id='.$data['id'].'\');return false;"><img src="images/devtool/zoom.png" /></a></td>
              </tr>';
          }
          echo '</table>
            </div>';
          break;
      }
    }
  }

  public function logs()
  {
    if($this->admin(5) && in_array($_SESSION['cuenta'],$this->supreme_right))
    {
      echo 'Hello';
    }
    else
    {
      echo ERROR_A01;
    }
  }

  public function infos()
  {
    global $sys;
    if($this->admin(5) && in_array($_SESSION['cuenta'],$this->supreme_right))
    {
      echo '<div id="result">
        <h2>Starpass</h2>'.
        ($sys->idp == 15104 ? '<b><font color="green">Code IDP Correct : '.$sys->idp.'</font></b>' : '<img src="images/devtool/error.png" /> <span style="text-decoration: blink;"><b><font color="red">Code IDP Incorrect : '.$sys->idp.' (Default : 15104)</font></b></span> <img src="images/devtool/error.png" />').'<br />'.
        ($sys->idd == 32002 ? '<b><font color="green">Code IDD Correct : '.$sys->idd.'</font></b>' : '<img src="images/devtool/error.png" /> <span style="text-decoration: blink;"><b><font color="red">Code IDD Incorrect : '.$sys->idd.' (Default : 32002)</font></b></span> <img src="images/devtool/error.png" />').'<br /><br />
        <h2>RPG Paradize</h2>'.
        ($sys->link_votacion == 21633 ? '<b><font color="green">ID RPG Paradize Correct : '.$sys->link_votacion.'</font></b>' : '<img src="images/devtool/error.png" /> <span style="text-decoration: blink;"><b><font color="red">ID RPG Paradize Incorrect : '.$sys->link_votacion.' (Default : 21633)</font></b></span> <img src="images/devtool/error.png" />').'
        </div>';
    }
    else
    {
      echo ERROR_A01;
    }
  }



}