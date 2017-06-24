<?php
  require_once('../../inc/autenticazione.inc.php');

  if($autenticazione -> gestionePortale != 1)
    header('Location: /');
?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <?php
      require_once('../../inc/header.inc.php');
    ?>
    <link type="text/css" rel="stylesheet" media="screen" href="/css/dashboard.css" />
    <script type="text/javascript" src="/js/badge/aggiungi.js"></script>
    <script type="text/javascript" src="/js/badge/revoca.js"></script>
  </head>
  <body>
    <?php
      include_once('../../inc/nav.inc.php');

      $id = $mysqli -> real_escape_string(isset($_GET['id']) ? trim($_GET['id']) : '');
    ?>
    <div id="contenuto">
      <h2>Badge utente</h1>
      <a onclick="aggiungi(this)" class="button">Aggiungi</a>
      <input type="hidden" id="idUtente" value="<?php echo $id ?>" />
      <div style="overflow-x: auto;">
        <?php
          $sql = "SELECT * FROM badge WHERE idUtente = '{$id}' ORDER BY id DESC";

          if($query = $mysqli -> query($sql)) {
        ?>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Rilasciato da</th>
              <th>RFID</th>
              <th>Data rilascio</th>
              <th>Revocato</th>
              <th>Azioni</th>
            </tr>
          </thead>
          <tbody>
            <?php
              // Stampo i badge
              while($row = $query -> fetch_assoc()) {

                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td><a href=\"/gestione/utenti/utente.php?id={$row['idUtenteRilascio']}\" class=\"button\" style=\"padding: 3px 5px;\">{$row['idUtenteRilascio']}</a></td>";
                echo "<td>{$row['rfid']}</td>";
                echo "<td>".date("d/m/Y H:i:s", $row['dataRilascio'])."</td>";
                echo ($row['revocato'] == false) ? '<td>NO</td>' : '<td><span style="padding: 3px 5px; border-radius: 3px; color: #fff; margin-top: 3px; display: inline-block; background: #f44336; font-weight: 700;">SI</span></td>';
                echo ($row['revocato'] == false) ? "<td><a onclick=\"revoca(this, {$row['id']})\">Revoca</a></td>" : "<td></td>";
                echo "</tr>";
              }
            ?>
          </tbody>
        </table>
        <?php
          } else
            echo "<p>Impossibile comunicare con il database!</p>";
        ?>
      </div>
    </div>
    <?php
      include_once('../../inc/footer.inc.html');
    ?>
  </body>
</html>