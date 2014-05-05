<!DOCTYPE html>
<html>
  <head>
    <title>Supplier-Specific Product Inforation</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="Author" content="Christopher Crouch">
    <meta name="Author" content="Kyle Hughes">
  </head>
  <body>
    <h2> Supplier-Specific Product Information </h2>
    <h4> View Supplier-Specific Product Information </h4> 

    <form name = "viewSupplierProduct" method = "post" action ="viewD.php">
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
    <br>

    <h4> Add New Supplier-Specific Product to the inventory </h4>
    <form name="addProductToInventory" method="post" action="addD.php">
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
      UPC<select name="UPC">
      <?php 
	require_once('/home/crouch59/public_html/db/Connect.php');
	
	$dbh = ConnectDB();
	$query = "select UPC from product";
	$stmt = $dbh->prepare($query);
	$stmt->execute();
	$categoryData = $stmt->fetchAll(PDO::FETCH_OBJ);
	$stmt = null;
	foreach ( $categoryData as $category ) {
	  echo "<option value=\"$category->UPC\">$category->UPC</option>";
	}
      ?>
      </select><br>
      Price<input type="text" name="price"><br>
      Shipping Cost<input type="text" name="shippingcost"><br>
      Amount<input type="text" name="amount"><br>
      Reorder Level<input type="text" name="reorderlevel"><br>
      <input type="submit">
    </form>

    <h4> Delete a Supplier-Specific Product </h4>
    <h5> Pick Supplier First </h5>
    <form name = "removeSupplierProduct" method = "post" action ="dDelete.php">
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
    <br>

    <h4> Modify a Supplier-Specific Product's Price </h4>
    <h5> Pick Supplier First </h5>
  <form name = "modifyProductPrice" method = "post" action ="dModify.php">
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
