<?php
  session_start();
  // access information in directory with no web access
  require_once('/home/crouch59/public_html/db/Connect.php');

  $dbh = ConnectDB();

  $orderID=$_SESSION['orderID'];

  $query = "Select UPC, supplierID, quantity from contains where orderID = :orderID";
  $stmt = $dbh->prepare($query);
  $stmt->bindParam(':orderID',$orderID);
  $stmt->execute();
  $categoryData = $stmt->fetchAll(PDO::FETCH_OBJ);
		
  $stmt = null; 
  $pending = 0;
  $shipped = 0;
  foreach($categoryData as $category) {
    $UPC = $category->UPC;
    $supplierID = $category->supplierID;
    $quantity = $category->quantity;
    $pending = $pending+1;
    $query = "Select amount from suppliedby where UPC = :UPC and supplierID = :supplierID";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':UPC',$UPC);
    $stmt->bindParam(':supplierID',$supplierID);
    $stmt->execute();
    $categoryDataCheck = $stmt->fetchAll(PDO::FETCH_OBJ);
    $stmt = null; 
    foreach($categoryDataCheck as $check) {
      $amount = $check->amount;
    }
    if($amount >= $quantity) {
      $shipped = $shipped+1;
    }
  }
  
  $status = false;
  if($pending == $shipped) {
    foreach($categoryData as $category) {
      $UPC = $category->UPC;
      $supplierID = $category->supplierID;
      $quantity = $category->quantity;
      $query ="update suppliedby set amount = amount-:quantity WHERE UPC = :UPC and supplierID = :supplierID";
      $stmt = $dbh->prepare($query);
      $stmt->bindParam(':UPC',$UPC);
      $stmt->bindParam(':supplierID',$supplierID);
      $stmt->bindParam(':quantity',$quantity);
      $stmt->execute();
      $stmt = null;
    }
    $query ="update orders set shippingstatus = 'shipped' WHERE orderID = :orderID";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':orderID',$orderID);
    $stmt->execute();
    $stmt = null;
    $status = true;
  }



  $query = "SELECT UPC, Pname, supplierID, Sname, quantity From (select * from contains left join product using (UPC) where orderID = :orderID) as S left join supplier using (supplierID)";
  $stmt = $dbh->prepare($query);
  $stmt->bindParam(':orderID',$orderID);
  $stmt->execute();
  $categoryData = $stmt->fetchAll(PDO::FETCH_OBJ);
		
  $stmt = null; 
  $_SESSION['orderID'] = null;

  echo "<!DOCTYPE html>
<html>
  <head>
    <style>
      table, td, th {
        border: 1px solid black;
      }
    </style>
  </head>
  <body>";
  if($status) {
    echo "Order Status is Shipped";
  } else {
     echo "Order Status is Pending";
  }
     echo "<table><tr><th>UPC </th>";
     echo " <th> Product Name </th>";
     echo " <th> SupplierID </th>";
     echo "<th> Supplier Name </th>";
     echo "<th> Quantity </th></tr>";
  foreach ( $categoryData as $category ) {
    echo "<tr><td> $category->UPC</td>";
    echo "<td>$category->Pname</td>";
    echo "<td>$category->supplierID</td>";
    echo "<td>$category->Sname</td>";
    echo "<td>$category->quantity</td></tr>";
  }

 echo "</table>";
?>
