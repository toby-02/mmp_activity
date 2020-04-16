<!-- CONTROLLER -->
<?php
session_start();
require_once('../system/config.php');
require_once('../system/data.php');

if(isset($_SESSION['einstellungen'])){
  $einstellungen = $_SESSION['einstellungen'];
  $t = $einstellungen['0'];
  $modus = $einstellungen['1'];
  $kategorien = $einstellungen['2'];
}
$alle_begriffe_beschreibungen_kategorien=[];
foreach($kategorien as $kategorie){
    $kategorie=selektiere_begriffe_beschreibung_anhand_kategorie($kategorie);
      foreach($kategorie as $zwischenarray){
        array_push($alle_begriffe_beschreibungen_kategorien, $zwischenarray);
      }
  }
shuffle($alle_begriffe_beschreibungen_kategorien);
// $angezeigt = $alle_begriffe_beschreibungen_kategorien['0'];
// print_r($angezeigt);
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

  <div class="box_mitte">
    <div class="mitte">
      <!-- Badge mit Spielmodus -->
      <h3><span class="badge badge-success badge-lg">Pantomime/Erkläre/Zeichne:</span></h3></br>

      <!-- Angezeigter Begriff -->
      <h1 id= "angezeigter_begriff" class= angezeigter_begriff></h1></br>

      <!-- Kategorie -->
      <span id="angezeigte_kategorie" class="badge badge-pill badge-dark"></span></br></br>

      <!-- Timer -->
      <h4>0:30s</h4></br>

      <!-- Button Erklärung anzeigen -->
      <button type="button" class="btn btn-primary">Erklärung anzeigen</button>

      <!-- Button Nächster Begriff -->
      <button type="button" id="next" class="btn btn-secondary">Nächster Begriff</button></br></br>

      <!-- Beschreibung -->
      <p id="angezeigte_beschreibung"> </p>


      <!-- Button Spiel beenden -->
      <a href="<?php echo $base_url; ?>">
        <button type="button" class="btn btn-danger">Spiel beenden</button>
      </a>
    </div>
  </div>



<?php include_once('../templates/footer.php'); ?>

<script>

    // Array mit allen Daten aus PHP in JS nehmen und ersten Wert in angezeigt laden
    var alles =<?php echo json_encode($alle_begriffe_beschreibungen_kategorien );?>;
    var angezeigt = alles['0'];

    // Erster Begriff ausgeben
    var begriff= angezeigt['begriff'];
    document.getElementById("angezeigter_begriff").innerHTML = begriff;

    // Erste Kategorie ausgeben
    var kategorie= angezeigt['kategorie_name'];
    document.getElementById("angezeigte_kategorie").innerHTML = kategorie;

    // Erste Beschreibung ausgeben
    var beschreibung = angezeigt['beschreibung'];
    document.getElementById("angezeigte_beschreibung").innerHTML = beschreibung;

    // Mit dem Counter den nächste Begriff im Array ansteuern, wenn auf den Button geklickt wird
    var counter = 0;
    document.querySelector("#next").addEventListener("click", function(){
      counter = counter + 1;
      var angezeigt = alles[counter];
      var begriff= angezeigt['begriff'];
      document.getElementById("angezeigter_begriff").innerHTML = begriff;

      var beschreibung = angezeigt['beschreibung'];
      document.getElementById("angezeigte_beschreibung").innerHTML = beschreibung;

      var kategorie= angezeigt['kategorie_name'];
      document.getElementById("angezeigte_kategorie").innerHTML = kategorie;

      });

</script>
</body>


</html>
