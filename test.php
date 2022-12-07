<?php
  require "config.php";
  $_SESSION['db'] = $config['test_db'];
  echo $_SESSION['db'];
?>
<a href="anotherpage.php">go to another page</a>