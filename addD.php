<?php
  require_once('/home/crouch59/public_html/db/Connect.php');

  $dbh = ConnectDB();
  $supplierID = $_POST['supplierID'];
  $UPC = $_POST['UPC'];
  $price = $_POST['price'];
  $shippingcost = $_POST['shippingcost'];
  $amount = $_POST['amount'];
  $reorderlevel = $_POST['reorderlevel'];
  
  
  // was a question and answer entered?
  if ( isset($_POST['price'])   &&  !empty($_POST['price'])   &&
       isset($_POST['shippingcost'])   &&  !empty($_POST['shippingcost'])   &&
       isset($_POST['amount'])   &&  !empty($_POST['amount'])   &&
       isset($_POST['reorderlevel'])   &&  !empty($_POST['reorderlevel'])) {
  
      echo "<h4>Adding Supplier-Specific Product with UPC  \"" . $_POST['UPC'] . "\" to database.</h4>";
  
      try {

       $query = 'INSERT INTO suppliedby (UPC, supplierID, price, shippingcost, amount, reorderlevel)
		     VALUES (:UPC, :supplierID, :price, :shippingcost, :amount, :reorderlevel)';
	$stmt = $dbh->prepare($query);

	// Note each parameter must be bound separately
	$stmt->bindParam(':UPC', $UPC);
	$stmt->bindParam(':supplierID', $supplierID);
	$stmt->bindParam(':price', $price);
	$stmt->bindParam(':shippingcost', $shippingcost);
	$stmt->bindParam(':amount', $amount);
	$stmt->bindParam(':reorderlevel', $reorderlevel);

	$stmt->execute();
	$stmt = null;
    
      } 
      catch(PDOException $e)
      {
        die ('PDO error inserting(): ' . $e->getMessage() );
      }
  }
  else {
  	echo "<h4>All fields must be filled in</h4>";
       }
 
	include('viewD.php');
?>
