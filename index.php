<?php
$title = "RxProject";

include 'install.php';
?>

<html>
<head>
<title><?php echo $title; ?></title>
</head>
<body>

 <?php
 $SQL_servername = "localhost";
 $SQL_username = "RxProject";
 $SQL_password = "rxpassword";
 $SQL_dbname = "RxProject";

if ($_GET["function"] == "install") {
   create_customerdb(
     $SQL_servername,
     $SQL_username,
     $SQL_password,
     $SQL_dbname
   );
  } else {
   $MyVariable = "I have nothing to do. Maybe
   <a href=\"index.php?function=install\">Install</a>";
   echo $MyVariable;
#   echo $nothing;
 }

 ?>

 </body>
</html>
