<!-- CONTROLLER -->
<?php
session_start();
require_once('../system/config.php');
require_once('../system/data.php');

if(isset($_POST['beenden'])){

}

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

  <div class="box_mitte">
    <div class="mitte">
      <!-- Badge mit Spielmodus -->
      <h3><span id="modus" class="badge badge-success badge-lg"></span></h3></br>

      <!-- Angezeigter Begriff -->
      <h1 id= "angezeigter_begriff" class= angezeigter_begriff></h1></br>

      <!-- Kategorie -->
      <span id="angezeigte_kategorie" class="badge badge-pill badge-dark">#</span></br></br></br>

      <!-- Timer -->
      <h4><span id="countdowntimer"></span></h4>
      <p id="sekunden">Sekunden</p>

      <!-- Button neue Runde -->
      <button style="visibility: hidden" type="button" id="new" class="btn btn-warning">Neue Runde</button></br>

      <!-- Button Erklärung anzeigen -->
      <button type="button" id="show" class="btn btn-primary">Erklärung anzeigen</button>

      <!-- Button Nächster Begriff -->
      <button type="button" id="next" class="btn btn-secondary">Nächster Begriff</button></br></br>

      <!-- Beschreibung -->
      <p id="angezeigte_beschreibung" visible="false"> </p>

    </div>
  </div>
  <!-- Button Spiel beenden -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <a href="<?php echo $base_url; ?>">
    <button type="button" class="beenden btn btn-danger">Spiel beenden</button>
  </a>
</form>

<!-- <?php include_once('../templates/footer.php'); ?> -->

<script>
  //Array mit dem Spielmodus aus PHP in JS nehmen und ersten Wert ausgeben
  var modus =<?php echo json_encode($modus );?>;
  var art = modus['0'];
  document.getElementById("modus").innerHTML = art;

  // Array mit allen Begriffen etc. aus PHP in JS nehmen und ersten Wert in angezeigt laden
  var alles =<?php echo json_encode($alle_begriffe_beschreibungen_kategorien );?>;
  var angezeigt = alles['0'];

  // Erster Begriff ausgeben
  var begriff= angezeigt['begriff'];
  document.getElementById("angezeigter_begriff").innerHTML = begriff;

  // Erste Kategorie ausgeben
  var kategorie= angezeigt['kategorie_name'];
  document.getElementById("angezeigte_kategorie").innerHTML = "#" + kategorie;

  // Erste Beschreibung ausgeben
  var beschreibung = angezeigt['beschreibung'];
  document.getElementById("angezeigte_beschreibung").innerHTML = beschreibung;

  // Mit dem Counter den nächste Begriff im Array ansteuern, wenn auf den Button nächster Begriff geklickt wird
  var counter = 0;
  document.querySelector("#next").addEventListener("click", function(){
    counter = counter + 1;
    //Neuer Begriff anzeigen
    //Zuerst überprüfen, ob noch etwas im array drin ist
    //wenn nicht, dann blendet es alles aus und es gibt eine Benachrichtigung
    if(counter >= alles.length){
      document.getElementById("angezeigter_begriff").innerHTML = "Du hast alle Begriffe der gewählten Kategorien durchgespielt";
      document.getElementById("angezeigte_beschreibung").style.visibility = "hidden";
      document.getElementById("next").style.visibility = "hidden";
      document.getElementById("show").style.visibility = "hidden";
      document.getElementById("modus").style.visibility = "hidden";
      document.getElementById("angezeigte_kategorie").style.visibility = "hidden";
      document.getElementById("countdowntimer").style.visibility = "hidden";
      document.getElementById("sekunden").style.visibility = "hidden";
    }else{
      //Wenn es noch Begriffe hat, dann wird der nächste Begriff angezeigt
      var angezeigt = alles[counter];
      var begriff= angezeigt['begriff'];
      document.getElementById("angezeigter_begriff").innerHTML = begriff;

      //Neue Beschreibung anzeigen & Beschreibung wieder verstecken
      var beschreibung = angezeigt['beschreibung'];
      document.getElementById("angezeigte_beschreibung").innerHTML = beschreibung;
      document.getElementById("angezeigte_beschreibung").style.visibility = "hidden";

      //Neue Kategorie anzeigen
      var kategorie= angezeigt['kategorie_name'];
      document.getElementById("angezeigte_kategorie").innerHTML = "#" + kategorie;

      //Neue zufällige Spielart auswählen
      // var mod_count = Math.floor(Math.random() * modus.length);
      // var art = modus[mod_count];
      // document.getElementById("modus").innerHTML = art;
    }
    });

  //Beschreibung anzeigen, sobald auf Button geklickt wird
  document.querySelector("#show").addEventListener("click", function(){
    document.getElementById("angezeigte_beschreibung").style.visibility = "visible";
  });



  //Eingegeben Zeit aus PHP in JS laden
  var t =<?php echo json_encode($t );?>;

  if(t>0){
    //Timer, sobald auf 0, dann blendet es Erklärung und Nächster Begriff-Button aus
    //und den Button neue Runde ein
    var timeLeft = t;
        var elem = document.getElementById('countdowntimer');
        var timerId = setInterval(countdown, 1000);

        function countdown() {
          if (timeLeft <= -1) {
            clearTimeout(timerId);
            document.getElementById("new").style.visibility = "visible";
            document.getElementById("next").style.visibility = "hidden";
            document.getElementById("show").style.visibility = "hidden";
            document.getElementById("angezeigte_beschreibung").style.visibility = "hidden";
          } else {
            elem.innerHTML = timeLeft;
            timeLeft--;
          }
        }

    //Sobald auf neue Runde geklickt, verschwindet Button und die anderen werden wieder angezeigt
    //Neuer Begriff wird geladen und Countdown startet neu
    document.querySelector("#new").addEventListener("click", function(){
      //Buttons aus und einblenden
      document.getElementById("new").style.visibility = "hidden";
      document.getElementById("next").style.visibility = "visible";
      document.getElementById("show").style.visibility = "visible";

      //Neuer Begriff anzeigen
      //Zuerst überprüfen, ob noch etwas im array drin ist
      //wenn nicht, dann blendet es alles aus und es gibt eine Benachrichtigung
      counter = counter + 1;
      if(counter >= alles.length){
        document.getElementById("angezeigter_begriff").innerHTML = "Du hast alle Begriffe der gewählten Kategorien durchgespielt";
        document.getElementById("angezeigte_beschreibung").style.visibility = "hidden";
        document.getElementById("next").style.visibility = "hidden";
        document.getElementById("show").style.visibility = "hidden";
        document.getElementById("modus").style.visibility = "hidden";
        document.getElementById("angezeigte_kategorie").style.visibility = "hidden";
        document.getElementById("countdowntimer").style.visibility = "hidden";
        document.getElementById("sekunden").style.visibility = "hidden";
      }else{
        //Wenn es noch Begriffe hat, dann wird der nächste Begriff angezeigt
        var angezeigt = alles[counter];
        var begriff= angezeigt['begriff'];
        document.getElementById("angezeigter_begriff").innerHTML = begriff;

        //Neue Beschreibung anzeigen & Beschreibung wieder verstecken
        var beschreibung = angezeigt['beschreibung'];
        document.getElementById("angezeigte_beschreibung").innerHTML = beschreibung;
        document.getElementById("angezeigte_beschreibung").style.visibility = "hidden";

        //Neue Kategorie anzeigen
        var kategorie= angezeigt['kategorie_name'];
        document.getElementById("angezeigte_kategorie").innerHTML = "#" + kategorie;

        //Neue zufällige Spielart auswählen
        var mod_count = Math.floor(Math.random() * modus.length);
        var art = modus[mod_count];
        document.getElementById("modus").innerHTML = art;
      }

      //Timer neu starten
      var timeLeft = t;
          var elem = document.getElementById('countdowntimer');
          var timerId = setInterval(countdown, 1000);

          function countdown() {
            if (timeLeft <= -1) {
              clearTimeout(timerId);
              document.getElementById("new").style.visibility = "visible";
              document.getElementById("next").style.visibility = "hidden";
              document.getElementById("show").style.visibility = "hidden";
            } else {
              elem.innerHTML = timeLeft;
              timeLeft--;
            }
          }
    });
  }else {
    document.getElementById("sekunden").style.visibility = "hidden";
  }
</script>
</body>


</html>
