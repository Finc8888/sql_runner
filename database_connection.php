<?php
  require 'app_config.php';
  mysql_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD)
    or die("<h3>Error of connection to database: ".mysql_error()."</h3>");

  echo "<h3>Connection to upset succeceful!</h3>";

  mysql_select_db(DATABASE_NAME)
    or die("<h3>Error to select db, called ".DATABASE_NAME." ".mysql_error().
            "</h3>");
  echo "<h3>Database "."'".DATABASE_NAME."'"." was selected</h3>";
 ?>
