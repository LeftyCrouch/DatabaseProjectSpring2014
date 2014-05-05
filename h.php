<!DOCTYPE html>
<html>
  <head>
    <title>Place an Order</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="Author" content="Christopher Crouch">
    <meta name="Author" content="Kyle Hughes">
  </head>
  <body>
    <h2> Customer Information </h2>
    <h4> Select CustomerID </h4> 

    <br>
  <form name = "selectCustomer" method = "post" action ="orderH.php">
      CustomerID<select name="customerID">
      <?php
        require_once('/home/crouch59/public_html/db/Connect.php');

        $dbh = ConnectDB();
        $query = "select customerID from customer";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $categoryData = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt = null;
        foreach ( $categoryData as $category ) {
          echo "<option value=\"$category->customerID\">$category->customerID</option>";
        }
      ?>
      </select>
      <input type = "submit">
    </form>

  </body>
</html>
