    <img src="images/top.png" />
      <div id="mid_corp">
        <div id="text_corp">         
          <?php
          if(isset($_SESSION['id']) && $_SESSION['id'] != '')
          {
            echo '<center>Au revoir '.$_SESSION['cuenta'].' et a bientôt !</center>';
            session_unset();
            session_destroy();
            setcookie('auto', '', 0);
          }
          else
          {
             header('location:?pagina=home');
          }
          ?>
          <meta http-equiv="refresh" content="2; URL=?pagina=home">
        </div>
      </div>
      <img src="images/bottom.png" />