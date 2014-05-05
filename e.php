<?php
  // access information in directory with no web access
  require_once('/home/crouch59/public_html/db/Connect.php');

  $dbh = ConnectDB();

  $query = "SELECT UPC, Pname, supplierID, Sname, price, shippingcost, amount, reorderlevel FROM (select * from suppliedby left join product using (UPC)) as S left join supplier using (supplierID)";
  $stmt = $dbh->prepare($query);
  $stmt->execute();
  $categoryData = $stmt->fetchAll(PDO::FETCH_OBJ);
		
  $stmt = null; 
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
     echo "<h2> Inventory </h2>";
     echo "<table><tr><th>UPC </th>";
     echo " <th>Product name </th>";
     echo " <th>SupplierID </th>";
     echo " <th>Supplier Name </th>";
     echo "<th> Price </th>";
     echo "<th> Shipping Cost </th>";
     echo "<th> Amount </th>";
     echo "<th> Reorder Level </th></tr>";
  foreach ( $categoryData as $category ) {
    echo "<tr><td> $category->UPC</td>";
    echo "<td>$category->Pname</td>";
    echo "<td>$category->supplierID</td>";
    echo "<td>$category->Sname</td>";
    echo "<td>$category->price</td>";
    echo "<td>$category->shippingcost</td>";
    echo "<td>$category->amount</td>";
    echo "<td>$category->reorderlevel</td></tr>";
  }

 echo "</table>";
?>
