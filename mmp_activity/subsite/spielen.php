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

  <div class="box_mitte">
    <div class="mitte">
      <!-- Badge mit Spielmodus -->
      <h3><span class="badge badge-success badge-lg">Pantomime/Erkläre/Zeichne:</span></h3></br>

      <!-- Zu erklärender Begriff -->
      <h1>Begriff</h1></br>

      <!-- Timer -->
      <h4>0:30s</h4></br>

      <!-- Button Erklärung anzeigen -->
      <button type="button" class="btn btn-primary">Erklärung anzeigen</button>

      <!-- Button Nächster Begriff -->
      <button type="button" class="btn btn-secondary">Nächster Begriff</button></br></br>

      <!-- Button Spiel beenden -->
      <a href="<?php echo $base_url; ?>">
        <button type="button" class="btn btn-danger">Spiel beenden</button>
      </a>
    </div>
  </div>



<?php include_once('../templates/footer.php'); ?>

</body>
</html>
