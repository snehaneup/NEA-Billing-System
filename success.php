<!DOCTYPE html>
<html>
<head>
  <title>Payment Success</title>
</head>
<body>
  <h1>Payment Successful!</h1>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["pid"])) 
 {
    $paymentID = $_GET["pid"];
    echo "<p>Payment ID: " . $PID . "</p>";
  }
  ?>
</body>
</html>
