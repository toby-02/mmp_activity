<!-- CONTROLLER -->
<?php
session_start();
require_once('../system/config.php');
require_once('../system/data.php');

$kategorien= selektiere_alle_kategorien();

// überprüfen, ob der Button Go geklickt wurde
if(isset($_POST['go'])){
  $go_valid = true;
  $msg_modus = "";
  $msg_kategorie = "";

  // if(!isset($_POST['test'])){
  //   $msg_kategorie = "Bitte wähle eine Kategorie an";
  // }
  $test = $_POST['test'];
  if ($test == 1) {
  $test = 1;
  } else {
  $test = 0;
  $msg_kategorie = "Bitte wähle eine Kategorie an";
  }

}
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
    <!-- Formular -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

      <!-- Spielart -->
      <h3>Spielmodus</h3>
      <p>Wähle aus, wie du spielen möchtest. Du kannst einen Spielmodus oder mehrere auswählen.</br>
        Die gewählten Spielarten werden den Wörtern zufällig zugeordnet.</p>

        <!-- Checkbox Erklären -->
        <div class="form-check">
          <input name="erklaeren" class="form-check-input" type="checkbox" value="" id="erklaeren" checked>
          <label class="form-check-label" for="erklaeren">
            Erklären
          </label>
        </div>

        <!-- Checkbox Pantomime -->
        <div class="form-check">
          <input name="pantomime" class="form-check-input" type="checkbox" value="" id="pantomime" checked>
          <label class="form-check-label" for="pantomime">
            Pantomime
          </label>
        </div>

        <!-- Checkbox Zeichnen -->
        <div class="form-check">
          <input name="zeichnen" class="form-check-input" type="checkbox" value="" id="zeichnen" checked>
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
           <option name="30s">30s</option>
           <option name="45s">45s</option>
           <option name="60s">60s</option>
           <option name="no_timer">Ohne Timer spielen</option>
         </select>
       </div>


      <!-- Kategorien -->
      <h3>Kategorien</h3>
      <p>Wähle die Kategorien an, aus welchen die Wörter selektiert werden.</p>

      <?php foreach ($kategorien as $kategorie) { ?>

        <!-- Checkboxen Kategorien -->
        <div class="form-check form-check-inline">
          <input name="kategorien" class="form-check-input" type="checkbox" id="<?php echo $kategorie['kategorie_name']; ?>" value="option1" checked>
          <label class="form-check-label" for="<?php echo $kategorie['kategorie_name']; ?>"><?php echo $kategorie['kategorie_name']; ?></label>
        </div>

      <?php } ?>

      <!-- Test -->
      </br></br></br></br>
      <div class="form-check">
        <input name="test" class="form-check-input" type="checkbox" value="1" id="test"
        <?php if(isset($test)){
          if($test == 1){
            echo "checked='checked'";
          }
        } ?>>
        <label class="form-check-label" for="test">
          Test
        </label>
      </div>

      <!-- Kategorie Message -->
      <?php if(!empty($msg_kategorie)){ ?>
            <div class="alert alert-info msg" role="alert">
              <p><?php echo $msg_kategorie ?></p>
            </div>
      <?php } ?>

      <!-- Button Go -->
      </br>
      <a class="float-right">
        <button name="go" type="submit" class="btn btn-primary btn-lg">Go!</button>
      </a>

    </form>
  </div>

<!-- <?php include_once('../templates/footer.php'); ?> -->

</body>
</html>
