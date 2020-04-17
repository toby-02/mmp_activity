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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <link href="styles.css" rel="stylesheet" type="text/css">


</head>
<body>
  <!-- Navigation -->


  <div class="container">
    <?php include_once('templates/menu.php'); ?>

    <div class="container">
      <h3>Popover Example</h3>
      <a href="#" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">Toggle popover</a>
    </div>


  </div>

<?php include_once('templates/footer.php'); ?>

<script type="text/javascript">
  $(document).ready(function(){
      $('[data-toggle="popover"]').popover();
  });
</script>

</body>
</html>
