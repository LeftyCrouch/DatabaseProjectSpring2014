<?php
  $UPC=$_POST['UPC'];
  $price=$_POST['price'];
  $supplierID=$_POST['supplierID'];

  require_once('/home/crouch59/public_html/db/Connect.php');

  $dbh = ConnectDB();
  
  if(isset($_POST['price']) && $_POST['price'] != null) { 
    $query ="update suppliedby set price = :price  WHERE UPC = :UPC and supplierID = :supplierID";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam('UPC',$UPC);
    $stmt->bindParam('supplierID',$supplierID);
    $stmt->bindParam('price',$price);
    $stmt->execute();
    $stmt = null;
    header("location:d.php");
  } else {
      echo "Category field was blank";
  }
?>
