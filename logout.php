<?php
session_start();
include("db-connection.php");
session_destroy();

echo 'You have cleaned session';
   header("Location: index.php?errorCode='bedankt en tot de volgende keer!'");  
   header('Refresh: 0; URL = index.php');
?>