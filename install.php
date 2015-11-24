<?php

function create_customerdb($SQL_connection)
{
  if (!$SQL_connection) {die("Connection failed: " . mysqli_connect_error());}
  $TableName = "Customers";
  # sql to create table
  $sql = "CREATE TABLE $TableName (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(30) NOT NULL,
  lastname VARCHAR(30) NOT NULL,
  email VARCHAR(50),
  reg_date TIMESTAMP
  )";

  $query = "SELECT * FROM $TableName";
  $result = mysqli_query($SQL_connection, $query);

  if (empty($result)) { # Check if the table exists
    echo "Table \"$TableName\" Does not exist. Attempting Creation.<br>\n";
    if (mysqli_query($SQL_connection, $sql)) { # Create the table
        echo "Table \"$TableName\" created successfully<br>\n";
        //Import some junk
        $randomnames = fopen('./randomnames.csv', "r");

        while (($data = fgetcsv($randomnames, 1000, ",")) !== FALSE) {
            $import="INSERT into $TableName(firstname,lastname,email)values('$data[0]','$data[1]','$data[3]')";
            echo $import . "<br>\n";
            echo $data[0] . ", " . $data[1] . ", " . $data[3] . "<br>\n";
            mysqli_query($SQL_connection, $import) or die(mysql_error());
        }
        fclose($randomnames);
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

function reset_db($SQL_connection)
{
  if (!$SQL_connection) {die("Connection failed: " . mysqli_connect_error());}
  $SQL_connection->query('SET foreign_key_checks = 0');
  if ($result = $SQL_connection->query("SHOW TABLES"))
  {
    while($row = $result->fetch_array(MYSQLI_NUM))
    {
      echo "dropping \"".$row[0]."\"<br>\n";
      $SQL_connection->query('DROP TABLE IF EXISTS '.$row[0]);
    }
  }
  $SQL_connection->query('SET foreign_key_checks = 1');
  mysqli_close($SQL_connection);
}

?>
