<?php
  require_once('../inc/autenticazione.inc.php');
?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <?php
      require_once('../inc/header.inc.php');
    ?>
    <script type="text/javascript" src="/js/social.js"></script>
    <style type="text/css">
      .box { display: table; border: 1px solid <?php echo TEMA_BG_PRINCIPALE ?>; width: 100%; border-radius: 3px; margin-bottom: 15px; }
      .box > div { display: table-cell; vertical-align: top; padding: 10px; }
      .box > div:first-child { background: <?php echo TEMA_BG_PRINCIPALE ?>; width: 120px; font-size: 20px;  }

      #contenuto > h1 { margin-bottom: 20px; }
    </style>
  </head>
  <body>
    <?php
      include_once('../inc/nav.inc.php');
    ?>
    <div id="contenuto">
      <h1>I tuoi social networks</h1>
      <div class="box">
        <div>Telegram</div>
        <div>
          <?php
            if($dizionario -> getValue('telegramBotName') === false || $dizionario -> getValue('telegramBotName') === null)
              echo '<p>Il bot Telegram non è disponibile.</p>';

            else {
              $sql = "SELECT * FROM socialNetworks WHERE idUtente = {$autenticazione -> id} AND tipo = 'telegram' LIMIT 0, 1";
              $query = $mysqli -> query($sql);

              if($query) {

                // L'utente non ha ancora un token di registrazione
                if($query -> num_rows == 0) {
                  $sql = "INSERT INTO socialNetworks (idUtente, tipo, authCode) VALUES ({$autenticazione -> id}, 'telegram', UUID());";

                  $query = $mysqli -> query($sql);

                  if(!$query) {
                    $console -> alert('Impossibile completare l\'inserimento del social nel db. '.$mysqli -> error, $autenticazione -> id);
                    echo '<p>Impossibile completare la richiesta.</p>';
                  } else {

                    $sql = "SELECT * FROM socialNetworks WHERE idUtente = {$autenticazione -> id} AND tipo = 'telegram' LIMIT 0, 1";
                    $query = $mysqli -> query($sql);

                    if(!$query) {
                      $console -> alert('Impossibile completare l\'inserimento del social nel db. '.$mysqli -> error, $autenticazione -> id);
                      echo '<p>Impossibile completare la richiesta.</p>';

                    } else {
                      $row = $query -> fetch_assoc();

                      $codiceAutenticazione = $row['authCode'];
                      echo '<p>Per collegare il tuo account Telegram con il tuo profilo, apri il seguente link su un dispositivo con l\'app installata.</p>';
                      echo '<p style="margin-top: 15px;"><a target="_blank" href="https://telegram.me/'.$dizionario -> getValue('telegramBotName').'?start='.$codiceAutenticazione.'">https://telegram.me/'.$dizionario -> getValue('telegramBotName').'?start='.$codiceAutenticazione.'</a></p>';
                    }
                  }
                } else {
                  $row = $query -> fetch_assoc();

                  $codiceAutenticazione = $row['authCode'];

                  if($codiceAutenticazione != null) {
                    echo '<p>Per collegare il tuo account Telegram con il tuo profilo, apri il seguente link su un dispositivo con l\'app installata.</p>';
                    echo '<p style="margin-top: 15px;"><a target="_blank" href="https://telegram.me/'.$dizionario -> getValue('telegramBotName').'?start='.$codiceAutenticazione.'">https://telegram.me/'.$dizionario -> getValue('telegramBotName').'?start='.$codiceAutenticazione.'</a></p>';

                  } else {
                    echo '<p>Collegamento effettuato.</p>';
                    echo '<p><a onclick="rimuoviCollegamentoTelegram()">Disconnetti</a></p>';
                  }
                }
              } else {

                $console -> alert('Impossibile richiedere i dati Telegram. '.$mysqli -> error, $autenticazione -> id);
                echo '<p>Impossibile completare la richiesta.</p>';
              }
            }
          ?>
        </div>
      </div>
    </div>
    <?php
      include_once('../inc/footer.inc.html');
    ?>
  </body>
</html>