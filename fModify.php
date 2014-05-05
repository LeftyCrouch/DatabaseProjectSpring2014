<!DOCTYPE html>
<html>
  <head>
    <title>Supplier-Specific Product Reorder</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="Author" content="Christopher Crouch">
    <meta name="Author" content="Kyle Hughes">
  </head>
  <body>
    <h3> Reordering Adds 10 to the Amount </h3>
    <form name="modifySupplierProduct" method="post" action="modifyF.php">
      UPC<select name="UPC">
      <?php 
	require_once('/home/crouch59/public_html/db/Connect.php');

        $supplierID=$_POST['supplierID'];	
	$dbh = ConnectDB();
	$query = "select UPC from suppliedby where supplierID = :supplierID";
	$stmt = $dbh->prepare($query);
        $stmt->bindParam('supplierID',$supplierID);
	$stmt->execute();
	$categoryData = $stmt->fetchAll(PDO::FETCH_OBJ);
	$stmt = null;
	foreach ( $categoryData as $category ) {
	  echo "<option value=\"$category->UPC\">$category->UPC</option>";
	}
      ?>
      </select><br>
      <input type="hidden" value="<?php echo $supplierID; ?>" name="supplierID">
      <input type="submit">
    </form>

     <?php
       $query = "SELECT UPC, Pname, amount, reorderlevel From (select * from suppliedby where supplierID = :supplierID ) as S join product using (UPC)";
       $stmt = $dbh->prepare($query);
       $stmt->bindParam('supplierID',$supplierID);
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
       echo " <th> Amount </th>";
       echo "<th> Reorder Level </th></tr>";
    foreach ($categoryData as $category) {
      echo "<tr><td>$category->UPC</td>";
      echo "<td>$category->Pname</td>";
      echo "<td>$category->amount</td>";
      echo "<td>$category->reorderlevel</td></tr>";
  }

 echo "</table>";

     ?>

  </body>
</html>
