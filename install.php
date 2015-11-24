<?php

function create_customerdb($SQL_connection)
{
  if (!$SQL_connection) {die("Connection failed: " . mysqli_connect_error());}

  # sql to create table
  $sql = "CREATE TABLE CUSTOMERS (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(30) NOT NULL,
  lastname VARCHAR(30) NOT NULL,
  email VARCHAR(50),
  reg_date TIMESTAMP
  )";

  $query = "SELECT * FROM CUSTOMERS";
  $result = mysqli_query($SQL_connection, $query);

  if (empty($result)) { # Check if the table exists
    echo "DB Does not exist. Attempting Creation.";
    if (mysqli_query($SQL_connection, $sql)) { # Create the table
        echo "Table MyGuests created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($SQL_connection); # Error
    }
  } else {
    echo "here are your results:<br>\n";
    while($row=mysqli_fetch_assoc($result)) {
      echo "<a href=\"mailto:" .$row["email"] . "\">" . $row["lastname"] .
      ", " . $row["firstname"] . "</a><br>\n";
    }
  }

  mysqli_close($SQL_connection);
}

?>
