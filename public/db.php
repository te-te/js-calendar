<?php

$pdo = createPDO();

if($_POST['mode'] == "del"){

  $sql = "DELETE FROM calendar
  WHERE num = {$_POST['num']}";

  $st = $pdo->prepare($sql);
  $st->execute();
}
else if($_POST['mode'] == "view"){

  $sql = "SELECT * FROM calendar
  WHERE num = {$_POST['num']}";

  $st = $pdo->prepare($sql);
  $st->execute();

  $result = $st->fetch();

  echo json_encode($result);
}
else if($_POST['mode'] == "output"){

  $sql = "SELECT * FROM calendar";

  $st = $pdo->prepare($sql);
  $st->execute();

  if($st->rowcount() == 0){
    echo json_encode("1");
  }
  else{
    while($row = $st->fetch()){
      $array_data[] = $row;
    }

    echo json_encode($array_data);
  }
}
else if($_POST['mode'] == "input"){

  $title = $_POST['title'];

  $e_start = explode("-", $_POST['start']);
  $start_year = $e_start[0];
  $start_month = $e_start[1];
  $e_start_daytime = explode(" ", $e_start[2]);
  $start_day = $e_start_daytime[0];
  $start_time = $e_start_daytime[1];
  $e_start_time = explode(":", $start_time);
  $start_hour = $e_start_time[0];
  $start_miute = $e_start_time[1];

  $e_end = explode("-", $_POST['end']);
  $end_year = $e_end[0];
  $end_month = $e_end[1];
  $e_end_daytime = explode(" ", $e_end[2]);
  $end_day = $e_end_daytime[0];
  $end_time = $e_end_daytime[1];
  $e_end_time = explode(":", $end_time);
  $end_hour = $e_end_time[0];
  $end_miute = $e_end_time[1];

  $sql = "INSERT INTO calendar VALUES (null,
    '{$title}', {$start_year}, {$start_month},
    {$start_day}, {$start_hour}, {$start_miute},
    {$end_year}, {$end_month}, {$end_day},
    {$end_hour}, {$end_miute})";

  $st = $pdo->prepare($sql);
  $st->execute();

  header("Location: /");
}

function createPDO(){
  $host = "localhost";
  $db = "calendar";
  $user = "root";
  $pass = "";

  try{
      $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
  }
  catch(Exception $e) {
      echo$e->getMessage();
  }

  return $pdo;
}

?>
