<?php

function list_drugs($SQL_connection) {
  $TableName = "Drugs";
  echo "here are the drugs:<br>\n";
  $query = "SELECT * FROM $TableName";
  $result = mysqli_query($SQL_connection, $query);
  if (!$SQL_connection) {die("Connection failed: " . mysqli_connect_error());}
  while($row=mysqli_fetch_assoc($result)) {
    echo $row["drugname"] . "<br>\n";
  }
  mysqli_close($SQL_connection);
}

?>
