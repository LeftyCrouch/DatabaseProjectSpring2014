<!DOCTYPE html>
<html>
  <head>
    <title>Choose Products to Order</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="Author" content="Christopher Crouch">
    <meta name="Author" content="Kyle Hughes">
  </head>
  <body>
    <form name="productOrder" method="post" action="makeOrderH.php">
      UPC<select name="UPC">
      <?php 
	require_once('/home/crouch59/public_html/db/Connect.php');

        $customerID=$_POST['customerID'];
	$dbh = ConnectDB();
	$query = "select distinct UPC from suppliedby";
	$stmt = $dbh->prepare($query);
	$stmt->execute();
	$categoryData = $stmt->fetchAll(PDO::FETCH_OBJ);
	$stmt = null;
	foreach ( $categoryData as $category ) {
	  echo "<option value=\"$category->UPC\">$category->UPC</option>";
	}
      ?>
      </select><br>
      SupplierID<select name="supplierID">
      <?php 
	require_once('/home/crouch59/public_html/db/Connect.php');

	$dbh = ConnectDB();
	$query = "select distinct supplierID from suppliedby";
	$stmt = $dbh->prepare($query);
	$stmt->execute();
	$categoryData = $stmt->fetchAll(PDO::FETCH_OBJ);
	$stmt = null;
	foreach ( $categoryData as $category ) {
	  echo "<option value=\"$category->supplierID\">$category->supplierID</option>";
	}
      ?>
      </select><br>
      Quantity<input type="text" name="quantity">
      <input type="hidden" value="<?php echo $customerID; ?>" name="customerID">
      <input type="submit" value="Next" name="action">
      <input type="submit" value="Complete" name="action">
    </form>

     <?php
       $query = "SELECT UPC, Pname, supplierID, Sname, price, shippingcost From (select * from suppliedby left join product using(UPC)) as S left join supplier using (supplierID)";
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
       echo "<table><tr><th> UPC </th>";
       echo " <th> Product Name </th>";
       echo " <th> SupplierID </th>";
       echo " <th> Supplier Name </th>";
       echo " <th> Price </th>";
       echo "<th> Shipping Cost </th></tr>";
    foreach ($categoryData as $category) {
      echo "<tr><td>$category->UPC</td>";
      echo "<td>$category->Pname</td>";
      echo "<td>$category->supplierID</td>";
      echo "<td>$category->Sname</td>";
      echo "<td>$category->price</td>";
      echo "<td>$category->shippingcost</td></tr>";
  }

 echo "</table>";

     ?>

  </body>
</html>
