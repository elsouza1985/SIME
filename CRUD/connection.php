<?php

$db=mysqli_connect("localhost","root","sine903") or
  die('Could not connect to the database!');

// $db=mysql_connect("localhost","root","", "PHL");
mysqli_select_db($db, "dbcrud") or
  die('No database selected!');
?>