<html>
  <head>
    <title>RxProject</title>
  </head>
  <body>

 <?php
 $SQL_servername = "localhost";
 $SQL_username = "RxProject";
 $SQL_password = "rxpassword";
 $SQL_dbname = "RxProject";
function create_customerdb(
  $SQL_servername,
  $SQL_username,
  $SQL_password,
  $SQL_dbname)
{
  $SQL_connection = mysqli_connect(
    $SQL_servername,
    $SQL_username,
    $SQL_password,
    $SQL_dbname
  );

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

  if (empty($result)) {
    echo "DB Does not exist. Attempting Creation.";
    if (mysqli_query($SQL_connection, $sql)) {
        echo "Table MyGuests created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($SQL_connection);
    }
  } else {
    echo "here are your results: ";
    echo $result;
  }



  mysqli_close($SQL_connection);
}

  create_customerdb(
    $SQL_servername,
    $SQL_username,
    $SQL_password,
    $SQL_dbname
  );

  $MyVariable = "Hello World";
  echo $MyVariable;
  echo "A bunch of changes";
 ?>

 </BODY>
</html>
