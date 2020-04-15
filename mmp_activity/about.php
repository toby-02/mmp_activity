<!-- CONTROLLER -->
<?php
session_start();
require_once('system/config.php');
require_once('system/data.php');

?>

<!-- VIEW -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>MMP Activity</title>

  <!-- Bootstrap & CSS Verlinkung -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
  <!-- Navigation -->


  <div class="container">
    <?php include_once('templates/menu.php'); ?>

    <h1>About</h1>
    
  </div>

<?php include_once('templates/footer.php'); ?>

</body>
</html>
