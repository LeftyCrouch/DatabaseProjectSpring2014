<?php
  session_start();
  require_once('/home/crouch59/public_html/db/Connect.php');

  $dbh = ConnectDB();
  $customerID = $_POST['customerID'];
  $supplierID = $_POST['supplierID'];
  $UPC = $_POST['UPC'];
  $quantity = $_POST['quantity'];
  
  
  if($_POST['action'] == "Continue") {
      
      $query = "INSERT INTO orders (customerID, orderdate, shippingstatus) VALUES (:customerID, CURDATE(), 'pending')";
      $stmt = $dbh->prepare($query);
      $stmt->bindParam(':customerID',$customerID);
      $stmt->execute();
      $stmt = null;
      $query = "SELECT orderID from orders where customerID = :customerID order by orderID desc limit 1";
      $stmt = $dbh->prepare($query);
      $stmt->bindParam(':customerID',$customerID);
      $stmt->execute();
      $categoryData = $stmt->fetchAll(PDO::FETCH_OBJ);

      $stmt = null;
      foreach ($categoryData as $category) {
        $_SESSION['orderID'] = $category->orderID;
      }
      $orderID=$_SESSION['orderID'];

      $query = "INSERT INTO contains (orderID, UPC, supplierID, quantity) VALUES (:orderID, :UPC, :supplierID, :quantity)";
      $stmt = $dbh->prepare($query);
      $stmt->bindParam(':orderID',$orderID);
      $stmt->bindParam(':UPC',$UPC);
      $stmt->bindParam(':supplierID',$supplierID);
      $stmt->bindParam(':quantity',$quantity);
      $stmt->execute();
      $stmt = null;
      header("location:orderContinueH.php");
      
  } else if($_POST['action'] == "Finish") {
      
      $query = "INSERT INTO orders (customerID, orderdate, shippingstatus) VALUES (:customerID, CURDATE(), 'pending')";
      $stmt = $dbh->prepare($query);
      $stmt->bindParam(':customerID',$customerID);
      $stmt->execute();
      $stmt = null;
      $query = "SELECT orderID from orders where customerID = :customerID order by orderID desc limit 1";
      $stmt = $dbh->prepare($query);
      $stmt->bindParam(':customerID',$customerID);
      $stmt->execute();
      $categoryData = $stmt->fetchAll(PDO::FETCH_OBJ);

      $stmt = null;
      foreach ($categoryData as $category) {
        $_SESSION['orderID'] = $category->orderID;
      }
      $orderID=$_SESSION['orderID'];

      $query = "INSERT INTO contains (orderID, UPC, supplierID, quantity) VALUES (:orderID, :UPC, :supplierID, :quantity)";
      $stmt = $dbh->prepare($query);
      $stmt->bindParam(':orderID',$orderID);
      $stmt->bindParam(':UPC',$UPC);
      $stmt->bindParam(':supplierID',$supplierID);
      $stmt->bindParam(':quantity',$quantity);
      $stmt->execute();
      $stmt = null;
      header("location:orderFinishH.php");
      
  } else if($_POST['action'] == "Next") {
      $orderID=$_SESSION['orderID'];

      $query = "INSERT INTO contains (orderID, UPC, supplierID, quantity) VALUES (:orderID, :UPC, :supplierID, :quantity)";
      $stmt = $dbh->prepare($query);
      $stmt->bindParam(':orderID',$orderID);
      $stmt->bindParam(':UPC',$UPC);
      $stmt->bindParam(':supplierID',$supplierID);
      $stmt->bindParam(':quantity',$quantity);
      $stmt->execute();
      $stmt = null;
      header("location:orderContinueH.php");

  } else if($_POST['action'] == "Complete") {
      $orderID=$_SESSION['orderID'];

      $query = "INSERT INTO contains (orderID, UPC, supplierID, quantity) VALUES (:orderID, :UPC, :supplierID, :quantity)";
      $stmt = $dbh->prepare($query);
      $stmt->bindParam(':orderID',$orderID);
      $stmt->bindParam(':UPC',$UPC);
      $stmt->bindParam(':supplierID',$supplierID);
      $stmt->bindParam(':quantity',$quantity);
      $stmt->execute();
      $stmt = null;
      header("location:orderFinishH.php");

  } 
      

?>
