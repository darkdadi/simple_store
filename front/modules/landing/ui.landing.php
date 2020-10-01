<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Template</title>
  <link rel="stylesheet" href="front/modules/landing/style.main.css">
  <script src="front/dependencies/jquery-3.5.1.js"></script>
</head>
<body>
  <div id="app">
    <?php
      session_start();
      
      if(isset($_SESSION['auth']) && $_SESSION['auth'] === true){
        include "front/modules/sample_module/ui.sample_module.php";
      } else {
        include "front/modules/login/ui.login.php";
      }
    ?>
  </div>
</body>
</html>