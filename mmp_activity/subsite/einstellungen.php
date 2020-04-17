<!-- CONTROLLER -->
<?php
session_start();
require_once('../system/config.php');
require_once('../system/data.php');

// Kategorien dynamisch aus der Datenbank laden
$kategorien= selektiere_alle_kategorien();

// überprüfen, ob der Button Go geklickt wurde
if(isset($_POST['go'])){
  $go_valid = true;
  $msg_modus = "";
  $msg_kategorie = "";

  // Überprüfen, ob beim Spielmodus irgendwo ein Häckchen gesetzt wurde
  // Wenn ja, dann pusht es die angewählte Spielart in das Array $modus
  $modus=[];
  if(isset($_POST['erklaeren'])){
    $erklaeren_check = $_POST['erklaeren'];
    array_push($modus, "$erklaeren_check");
    }
  if(isset($_POST['pantomime'])){
    $pantomime_check = $_POST['pantomime'];
    array_push($modus, "$pantomime_check");
    }
  if(isset($_POST['zeichnen'])){
    $zeichnen_check = $_POST['zeichnen'];
    array_push($modus, "$zeichnen_check");
  }

  //Wenn nirgends ein Häckchen gesetzt wurde, dann gibt es eine Nachricht und die
  //Schaltervariable $go_valid wird auf false gesetzt
  if(!isset($erklaeren_check) && !isset($pantomime_check) && !isset($zeichnen_check)){
    $msg_modus = "Bitte wähle einen Spielmodus an";
    $go_valid = false;
  }

  // Überprüfen, ob bei den Kategorien irgendwo kein Häckchen gesetzt wurde
  //Falls nicht, dann gibt es eine Nachricht und Schaltervariable $go_valid wird auf false gesetzt
  if(isset($_POST['kategorien'])){
    $kategorie_check = $_POST['kategorien'];
  }else{
    $msg_kategorie = "Bitte wähle eine Kategorie an";
    $go_valid = false;
  }



  //Überprüfen, welchen Wert im Timer eingegeben wurde
  if(isset($_POST['timer'])){
    $t = $_POST['timer'];
  }

  //Wenn die Schaltervariable $go_valid noch true ist
  //Werden alle Einstellungen in die Variable $einstellungen gespeichert
  //Und anschliessend wird diese Variable in einer Session gespeichert
  //Umleitung auf die spielen.php Seite
  if($go_valid){
    $einstellungen = [$t, $modus, $kategorie_check];
    // print_r($einstellungen);
    $_SESSION['einstellungen'] = $einstellungen;
    header("Location: spielen.php");
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



  <div class="container">
    <!-- Navigation -->
    <?php include_once('../templates/menu.php'); ?>

    <h1>Vor-Einstellungen</h1></br>
    <!-- Formular -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

      <!-- Spielart -->
      <h3>Spielmodus</h3>
      <p>Wähle aus, wie du spielen möchtest. Du kannst einen Spielmodus oder mehrere auswählen.</br>
        Die gewählten Spielarten werden den Spielrunden zufällig zugeordnet.</p>

        <!-- Checkbox Erklären -->
        <div class="form-check">
          <input name="erklaeren" class="form-check-input" type="checkbox" value="Erkläre:" id="erklaeren"
          <?php if(isset($erklaeren_check)){
            echo "checked='checked'";
          } ?>>
          <label class="form-check-label" for="erklaeren">Erklären</label>
        </div>

        <!-- Checkbox Pantomime -->
        <div class="form-check">
          <input name="pantomime" class="form-check-input" type="checkbox" value="Pantomime:" id="pantomime"
          <?php if(isset($pantomime_check)){
            echo "checked='checked'";
          } ?>>
          <label class="form-check-label" for="pantomime">Pantomime</label>
        </div>

        <!-- Checkbox Zeichnen -->
        <div class="form-check">
          <input name="zeichnen" class="form-check-input" type="checkbox" value="Zeichne:" id="zeichnen"
          <?php if(isset($zeichnen_check)){
            echo "checked='checked'";
          } ?>>
          <label class="form-check-label" for="zeichnen">Zeichnen</label>
        </div> </br>

        <!-- Modus Message -->
        <?php if(!empty($msg_modus)){ ?>
              <div class="alert alert-info msg" role="alert">
                <p><?php echo $msg_modus ?></p>
              </div>
        <?php } ?>

      <!-- Timer -->
      <h3>Timer</h3>
      <p>Setze einen Timer. Du kannst auch ohne Zeitlimit spielen.</p>

        <!-- Dropout Timer -->
        <div class="form-group">
         <select name="timer" class="form-control" id="timer">
           <option value="30"
           <?php if(isset($t) && $t == 30){
             echo 'selected';
           }?>>30s</option>

           <option value="45"
           <?php if(isset($t) && $t == 45){
             echo 'selected';
           }?>>45s</option>

           <option value="60"
           <?php if(isset($t) && $t == 60){
             echo 'selected';
           }?>>60s</option>

           <option value="0"
           <?php if(isset($t) && $t == 0){
             echo 'selected';
           }?>>Ohne Timer spielen</option>
         </select>
       </div>


      <!-- Kategorien -->
      <h3>Kategorien</h3>
      <p>Wähle die Kategorien, aus welchen die Wörter selektiert werden.</p>

      <!-- Slider Alles anwählen -->
      <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="switch">
        <label class="custom-control-label" for="switch">Alle Kategorien anwählen</label>
      </div>

      <!-- Checkboxen Kategorien -->
      <?php foreach ($kategorien as $kategorie) { ?>

        <div id="kategorie_container" class="form-check form-check-inline">
          <input name="kategorien[]" class="form-check-input kategorie" type="checkbox" id="<?php echo $kategorie['kategorie_name']; ?>"
          value = "<?php echo $kategorie['kategorie_name']; ?>"
          <?php if(isset($kategorie_check)){
            if(in_array($kategorie['kategorie_name'], $kategorie_check)){echo 'checked';}
          }?> >
          <label class="form-check-label" for="<?php echo $kategorie['kategorie_name']; ?>"><?php echo $kategorie['kategorie_name']; ?></label>
        </div>

      <?php } ?>

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
<script>
  var schalter = 0;
  document.querySelector("#switch").addEventListener("click", function(){
    schalter = schalter + 1;
    console.log(schalter);
    if(schalter % 2 == 0){
      console.log("gerade");
      document.getElementById("Audio- & Kameratechnik").removeAttribute("checked", "checked");
      document.getElementById("Corporate Communictions").removeAttribute("checked", "checked");
      document.getElementById("Filmisches Gestalten").removeAttribute("checked", "checked");
      document.getElementById("Interaktive Medien").removeAttribute("checked", "checked");
      document.getElementById("Konvergent Arbeiten").removeAttribute("checked", "checked");
      document.getElementById("Markt- & Medienforschung").removeAttribute("checked", "checked");
      document.getElementById("Medien BWL").removeAttribute("checked", "checked");
      document.getElementById("Medienethik").removeAttribute("checked", "checked");
      document.getElementById("Medienrecht").removeAttribute("checked", "checked");
      document.getElementById("Schreiben & Sprechen").removeAttribute("checked", "checked");
      document.getElementById("Visualisieren").removeAttribute("checked", "checked");
    }else{
      document.getElementById("Audio- & Kameratechnik").setAttribute("checked", "checked");
      document.getElementById("Corporate Communictions").setAttribute("checked", "checked");
      document.getElementById("Filmisches Gestalten").setAttribute("checked", "checked");
      document.getElementById("Interaktive Medien").setAttribute("checked", "checked");
      document.getElementById("Konvergent Arbeiten").setAttribute("checked", "checked");
      document.getElementById("Markt- & Medienforschung").setAttribute("checked", "checked");
      document.getElementById("Medien BWL").setAttribute("checked", "checked");
      document.getElementById("Medienethik").setAttribute("checked", "checked");
      document.getElementById("Medienrecht").setAttribute("checked", "checked");
      document.getElementById("Schreiben & Sprechen").setAttribute("checked", "checked");
      document.getElementById("Visualisieren").setAttribute("checked", "checked");
    }


  });

</script>
</body>
</html>
