<?php
  require_once('inc/carica.inc.php');
?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <?php
      require_once('./inc/header.inc.php')
    ?>
    <link type="text/css" rel="stylesheet" media="screen" href="css/index.css" />
  </head>
  <body>
    <div id="header">
      <a href="/login.php" class="button" id="bottoneFlottante">Accesso</a>
      <div>
        <p><?php echo NOME_SITO; ?><p>
      </div>
      <img src="images/logo.png" alt="Logo" />
    </div>
    <?php
      if(!isset($_GET['token'])) {
    ?>
      <div style="margin: 10px auto 30px auto; max-width: 520px; padding: 0 20px;">
        <h1 style="text-align: center;">L'iscrizione è quasi terminata</h1>
        <p style="margin-top: 10px;">A breve riceverai un'email di conferma da <?php echo MITTENTE_EMAIL; ?> (<a href="mailto:<?php echo INDIRIZZO_MITTENTE; ?>"><?php echo INDIRIZZO_MITTENTE; ?></a>) con il link di conferma del tuo account.</p>
        <p style="margin-top: 10px;">Se non hai ricevuto l'email di conferma <b>controlla anche nella casella di SPAM</b>, se non non la trovi ancora registrati nuovamente con lo stesso indirizzo email.</p>
        <p style="margin-top: 10px;">Se il problema persiste, contatta <?php echo MITTENTE_EMAIL; ?> a questo indirizzo <a href="mailto:<?php echo INDIRIZZO_MITTENTE; ?>"><?php echo INDIRIZZO_MITTENTE; ?></a>.</p>
      </div>
    <?php
      } else {
    ?>
      <div style="margin: 10px auto 30px auto; max-width: 520px; text-align: center; padding: 0 20px;">
    <?php
      $codiceConferma = $mysqli -> real_escape_string($_GET['token']);

      if($codiceConferma == "" || strlen($codiceConferma) !== 13) {
    ?>
        <h1 style="text-align: center;">Conferma email fallita</h1>
        <p style="margin-top: 10px;">Il codice di conferma non è valido.</p>
        <p style="margin-top: 10px;">Se il problema persiste, contatta <?php echo MITTENTE_EMAIL; ?> a questo indirizzo <a href="mailto:<?php echo INDIRIZZO_MITTENTE; ?>"><?php echo INDIRIZZO_MITTENTE; ?></a>.</p>
    <?php
      } else {
        $sql = "SELECT  * FROM utenti WHERE codiceAttivazione = '".$codiceConferma."'";

        if($query = $mysqli -> query($sql)) {

          if($query -> num_rows == 1) {

            $row = $query -> fetch_assoc();
            $sql = "UPDATE utenti SET codiceAttivazione = '0' WHERE id = '".$row['id']."'";

            if($query = $mysqli -> query($sql)) {
            ?>
              <h1 style="text-align: center;">Conferma email completata</h1>
              <p style="margin-top: 10px;">Ora puoi effettuare l'accesso.</p>
            <?php
            } else {
            ?>
              <h1 style="text-align: center;">Conferma email fallita</h1>
              <p style="margin-top: 10px;">Impossibile completare la conferma.</p>
              <p style="margin-top: 10px;">Se il problema persiste, contatta <?php echo MITTENTE_EMAIL; ?> a questo indirizzo <a href="mailto:<?php echo INDIRIZZO_MITTENTE; ?>"><?php echo INDIRIZZO_MITTENTE; ?></a>.</p>
            <?php
            }
          } else {
          ?>
            <h1 style="text-align: center;">Conferma email fallita</h1>
            <p style="margin-top: 10px;">Il codice di conferma non è valido.</p>
            <p style="margin-top: 10px;">Se il problema persiste, contatta <?php echo MITTENTE_EMAIL; ?> a questo indirizzo <a href="mailto:<?php echo INDIRIZZO_MITTENTE; ?>"><?php echo INDIRIZZO_MITTENTE; ?></a>.</p>
          <?php
          }
        } else {
        ?>
          <h1 style="text-align: center;">Conferma email fallita</h1>
          <p style="margin-top: 10px;">Impossibile completare la conferma.</p>
          <p style="margin-top: 10px;">Se il problema persiste, contatta <?php echo MITTENTE_EMAIL; ?> a questo indirizzo <a href="mailto:<?php echo INDIRIZZO_MITTENTE; ?>"><?php echo INDIRIZZO_MITTENTE; ?></a>.</p>
        <?php
        }
      }
    ?>
      </div>
    <?php
      }
    ?>
    <?php
      require_once('inc/footer.inc.html');
    ?>
  </body>
</html>