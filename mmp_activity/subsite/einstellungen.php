<!-- CONTROLLER -->
<?php
session_start();
require_once('../system/config.php');
require_once('../system/data.php');

?>

<!-- VIEW -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>MMP Activity</title>

  <!-- Bootstrap & CSS Verlinkung -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="../styles.css" rel="stylesheet" type="text/css">
</head>
<body>
  <!-- Navigation -->


  <div class="container">
    <?php include_once('../templates/menu.php'); ?>

      <h1>Vor-Einstellungen</h1></br>

      <!-- Spielart -->
      <h3>Spielmodus</h3>
      <p>Wähle aus, wie du spielen möchtest. Du kannst einen Spielmodus oder mehrere auswählen.</br>
        Die gewählten Spielarten werden den Wörtern zufällig zugeordnet.</p>

        <!-- Checkbox Erklären -->
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="erklaeren" checked>
          <label class="form-check-label" for="erklaeren">
            Erklären
          </label>
        </div>

        <!-- Checkbox Pantomime -->
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="pantomime" checked>
          <label class="form-check-label" for="pantomime">
            Pantomime
          </label>
        </div>

        <!-- Checkbox Zeichnen -->
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="zeichnen" checked>
          <label class="form-check-label" for="zeichnen">
            Zeichnen
          </label>
        </div> </br>

      <!-- Timer -->
      <h3>Timer</h3>
      <p>Setze einen Timer. Du kannst auch ohne Zeitlimit spielen.</p>

          <!-- Dropout Timer -->
          <div class="form-group">
           <select class="form-control" id="timer">
             <option>30s</option>
             <option>45s</option>
             <option>60s</option>
             <option>Ohne Timer spielen</option>
           </select>
         </div>


        <!-- Kategorien -->
        <h3>Kategorien</h3>
        <p>Wähle die Kategorien an, aus welchen die Wörter selektiert werden.</p>

          <!-- Checkbox IM -->
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="interaktive_medien" value="option1" checked>
            <label class="form-check-label" for="interaktive_medien">Interaktive Medien</label>
          </div>

          <!-- Checkbox Visualisieren -->
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="visualisieren" value="option2" checked>
            <label class="form-check-label" for="visualisieren">Visualisieren</label>
          </div>

          <!-- Checkbox Schreiben & Sprechen -->
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="schreiben_sprechen" value="option3" checked>
            <label class="form-check-label" for="schreiben_sprechen">Schreiben & Sprechen</label>
          </div>

          <!-- Checkbox Konvergent Arbeiten -->
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="konvergent_arbeiten" value="option4" checked>
            <label class="form-check-label" for="konvergent_arbeiten">Konvergent Arbeiten</label>
          </div>

          <!-- Checkbox AKT -->
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="akt" value="option5" checked>
            <label class="form-check-label" for="akt">Audio- & Kameratechnik</label>
          </div>

          <!-- Checkbox Filmisches Gestalten -->
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="filmisches_gestalten" value="option6" checked>
            <label class="form-check-label" for="filmisches_gestalten">Filmisches Gestalten</label>
          </div>

          <!-- Checkbox Corporate Communications -->
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="cc" value="option7" checked>
            <label class="form-check-label" for="cc">Corporate Communications</label>
          </div>

          <!-- Checkbox Markt- & Medienforschung -->
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="mamef" value="option8" checked>
            <label class="form-check-label" for="mamef">Markt- & Medienforschung</label>
          </div>

          <!-- Checkbox Medien BWL -->
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="medien_bwl" value="option9" checked>
            <label class="form-check-label" for="medien_bwl">Medien BWL</label>
          </div>

          <!-- Checkbox Medienethik -->
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="medienethik" value="option10" checked>
            <label class="form-check-label" for="medienethik">Medienethik</label>
          </div>

          <!-- Checkbox Medienrecht -->
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="medienrecht" value="option11" checked>
            <label class="form-check-label" for="medienrecht">Medienrecht</label>
          </div>

          <!-- Button Go -->
          </br>
          <a class="float-right" href="<?php echo $base_url; ?>subsite/spielen.php">
            <button type="button" class="btn btn-primary btn-lg">Go!</button>
          </a>
  </div>

<?php include_once('../templates/footer.php'); ?>

</body>
</html>
