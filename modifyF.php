<?php
  $UPC=$_POST['UPC'];
  $supplierID=$_POST['supplierID'];

  require_once('/home/crouch59/public_html/db/Connect.php');

  $dbh = ConnectDB();
  
    $query ="update suppliedby set amount = amount+10 WHERE UPC = :UPC and supplierID = :supplierID";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam('UPC',$UPC);
    $stmt->bindParam('supplierID',$supplierID);
    $stmt->execute();
    $stmt = null;
    header("location:e.php");
?>
