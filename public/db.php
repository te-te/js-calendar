<?php
if($_POST['mode'] == "output"){

  $pdo = createPDO();

  $sql = "SELECT title, start_year, start_month,
  start_day, end_year, end_month, end_day FROM calendar";

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

  $pdo = createPDO();

  $title = $_POST['title'];

  $e1 = explode("-", $_POST['start']);
  $start_year = $e1[0];
  $start_month = $e1[1];
  $start_day = $e1[2];

  $e2 = explode("-", $_POST['end']);
  $end_year = $e2[0];
  $end_month = $e2[1];
  $end_day = $e2[2];

  $sql = "INSERT INTO calendar (title, start_year,
    start_month,start_day, end_year, end_month,
    end_day) VALUES ('{$title}', {$start_year},
      {$start_month}, {$start_day}, {$end_year},
      {$end_month}, {$end_day})";

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