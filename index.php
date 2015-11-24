<?php
$themepath = 'theme/';
include $themepath.'header.php' ?>

<?php
include 'install.php';
include 'customers.php';
include 'drugs.php';

# SQL Creds
$SQL_servername = "localhost";
$SQL_username = "RxProject";
$SQL_password = "rxpassword";
$SQL_dbname = "RxProject";

$SQL_connection = mysqli_connect(
  $SQL_servername,
  $SQL_username,
  $SQL_password,
  $SQL_dbname
);

if (!$SQL_connection) {die("Connection failed: " . mysqli_connect_error());}

if ($_GET["function"] == "install") {
  create_customerdb($SQL_connection);
  create_drugdb($SQL_connection);
} elseif ($_GET["function"] == "reset") {
  reset_db($SQL_connection);
} elseif ($_GET["function"] == "customers") {
  list_customers($SQL_connection);
} elseif ($_GET["function"] == "drugs") {
  list_drugs($SQL_connection);
} else {
  $MyVariable = "I have nothing to do. Maybe
  <a href=\"index.php?function=install\">Install</a>";
  echo $MyVariable;
}
mysqli_close($SQL_connection);
?>
<?php include $themepath.'footer.php' ?>
