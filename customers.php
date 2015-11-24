<?php

function list_customers($SQL_connection) {
  $TableName = "Customers";
  echo "here are the customers:<br>\n";
  $query = "SELECT * FROM $TableName";
  $result = mysqli_query($SQL_connection, $query);
  if (!$SQL_connection) {die("Connection failed: " . mysqli_connect_error());}
  while($row=mysqli_fetch_assoc($result)) {
    echo "<a href=\"mailto:" .$row["email"] . "\">" . $row["lastname"] .
    ", " . $row["firstname"] . "</a><br>\n";
  }
  mysqli_close($SQL_connection);
}

?>
