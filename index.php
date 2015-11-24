<?php
$themepath = 'theme/';
include $themepath.'header.php' ?>

<?php
include 'install.php';
include 'customers.php';
include 'drugs.php';

$SQL_servername = "localhost";
$SQL_username = "RxProject";
$SQL_password = "rxpassword";
$SQL_dbname = "RxProject";

if ($_GET["function"] == "install") {
  $SQL_connection = mysqli_connect(
    $SQL_servername,
    $SQL_username,
    $SQL_password,
    $SQL_dbname
  );
  create_customerdb($SQL_connection);
  $SQL_connection = mysqli_connect(
    $SQL_servername,
    $SQL_username,
    $SQL_password,
    $SQL_dbname
  );
  create_drugdb($SQL_connection);
} elseif ($_GET["function"] == "reset") {
  $SQL_connection = mysqli_connect(
    $SQL_servername,
    $SQL_username,
    $SQL_password,
    $SQL_dbname
  );
  reset_db($SQL_connection);
} elseif ($_GET["function"] == "customers") {
  $SQL_connection = mysqli_connect(
    $SQL_servername,
    $SQL_username,
    $SQL_password,
    $SQL_dbname
  );
  list_customers($SQL_connection);
} elseif ($_GET["function"] == "drugs") {
  $SQL_connection = mysqli_connect(
    $SQL_servername,
    $SQL_username,
    $SQL_password,
    $SQL_dbname
  );
  list_drugs($SQL_connection);
} else {
  $MyVariable = "I have nothing to do. Maybe
  <a href=\"index.php?function=install\">Install</a>";
  echo $MyVariable;
}

?>
<?php include $themepath.'footer.php' ?>
