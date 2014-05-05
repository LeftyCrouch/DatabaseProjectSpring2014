<!DOCTYPE html>
<html>
  <head>
    <title>Supplier-Specific Product Reordering</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="Author" content="Christopher Crouch">
    <meta name="Author" content="Kyle Hughes">
  </head>
  <body>
    <h4> Reorder a Supplier-Specific Product </h4>
    <h5> Pick Supplier First </h5>
  <form name = "modifyProductPrice" method = "post" action ="fModify.php">
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
      </select>
      <input type = "submit">
    </form>


  </body>
</html>
