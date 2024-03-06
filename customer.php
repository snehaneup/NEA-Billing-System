<?php
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'customer') 
{
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Page</title>
</head>
<body>
    <h2>Welcome!</h2>
    <h2>Customer Details</h2>
    <form action="customerdetails.php" method="POST">
      Customer ID: <input type="text" name="CUSID"><br/>
      Mobile No.: <input type="number" name="MobileNo"><br/>
      <input type="submit" value="Show Details">
    </form>
</body>
</html>
