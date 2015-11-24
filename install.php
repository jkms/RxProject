<?php

function create_customerdb($SQL_connection)
{
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
        $handle = fopen('./junkdata/randomnames.csv', "r");
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $import="INSERT into $TableName(firstname,lastname,email)values('$data[0]','$data[1]','$data[3]')";
            echo $import . "<br>\n";
            mysqli_query($SQL_connection, $import) or die(mysql_error());
        }
        fclose($handle);
    } else {
        echo "Error creating table: " . mysqli_error($SQL_connection); # Error
    }
  } else {
    echo "Table \"$TableName\" already exists<br>\n";
  }
}

function create_drugdb($SQL_connection)
{
  $TableName = "Drugs";
  # sql to create table
  $sql = "CREATE TABLE $TableName (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  drugname VARCHAR(30) NOT NULL,
  drugtype VARCHAR(30) NOT NULL,
  ndc VARCHAR(50) NOT NULL,
  drugid VARCHAR(50) NOT NULL
  )";

  $query = "SELECT * FROM $TableName";
  $result = mysqli_query($SQL_connection, $query);

  if (empty($result)) { # Check if the table exists
    echo "Table \"$TableName\" Does not exist. Attempting Creation.<br>\n";
    if (mysqli_query($SQL_connection, $sql)) { # Create the table
        echo "Table \"$TableName\" created successfully<br>\n";
        //Import some junk
        $handle = fopen('./junkdata/product.csv', "r");

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $import="INSERT into $TableName(drugname,drugtype,ndc,drugid)values('$data[3]','$data[2]','$data[1]','$data[0]')";
            echo $import . "<br>\n";
            mysqli_query($SQL_connection, $import) or die(mysql_error());
        }
        fclose($handle);
    } else {
        echo "Error creating table: " . mysqli_error($SQL_connection); # Error
    }
  } else {
    echo "Table \"$TableName\" already exists<br>\n";
  }
}

function reset_db($SQL_connection)
{
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
}

?>
