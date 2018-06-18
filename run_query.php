<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Query Runner</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php
    require "../database_connection.php";
    $query_text = $_REQUEST["query"];
    $query_resource = mysql_query(trim($query_text));


    if (!$query_resource) {
      die("<h3>Ошибка выполнения SQL запроса '{$query_text}': ".mysql_error().
          "</h3>");
    }
    $return_rows = false;
    $lowcase_text = trim(strtolower($query_text));
    $location = strpos($lowcase_text, "create");
    if ($location===false||$location>0) {
      $location = strpos($lowcase_text, "insert");
      if ($location===false||$location>0) {
        $location = strpos($lowcase_text, "update");
        if ($location===false||$location>0) {
          $location = strpos($lowcase_text, "delete");
          if ($location===false||$location>0) {
            $location = strpos($lowcase_text, "drop");
            if ($location===false||$location>0) {
              $return_rows = true;
            }
          }
        }
      }
    }
    if($return_rows){
      echo "<h3>Результат вашего запроса <span>'{$query_text}' :</span></h3>";
      echo "<ul>";
      while ($row = mysql_fetch_row($query_resource)) {
        echo "<li>{$row[0]}</li>";
      }
      echo "</ul>";
    }
    else {
      echo "<h3>Переданный запрос вида: <span>'{$query_text}' был обработан
            успешно</span></h3>";
    }

  ?>
</body>
</html>
