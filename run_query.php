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
    $query_resource = mysql_query($query_text);


    if (!$query_resource) {
      die("<h3>Ошибка выполнения SQL запроса '{$query_text}': ".mysql_error().
          "</h3>");
    }

    // $lowcase_text = $query_text;

    //Проверка без регулярного выражения
    // $location = strpos($lowcase_text, "create");
    // if ($location===false||$location>0) {
    //   $location = strpos($lowcase_text, "insert");
    //   if ($location===false||$location>0) {
    //     $location = strpos($lowcase_text, "update");
    //     if ($location===false||$location>0) {
    //       $location = strpos($lowcase_text, "delete");
    //       if ($location===false||$location>0) {
    //         $location = strpos($lowcase_text, "drop");
    //         if ($location===false||$location>0) {
    //           $return_rows = true;
    //         }
    //       }
    //     }
    //   }
    // }

    //Проверка с регулярным выражением
    //\s- эквивалентно [ \t\n\r]
    $reg = "/^\s*(insert|update|delete|drop)/i";
    $return_rows = true;
    if(preg_match($reg, $query_text)){
      $return_rows = false;
    }



    if($return_rows){
      echo "<h3>Результат вашего запроса <span>'{$query_text}' :</span></h3>";
      echo "<ul>";
      while ($row = mysql_fetch_row($query_resource)) {
        echo "<li> {$row[0]} {$row[1]} {$row[2]} </li>";
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
