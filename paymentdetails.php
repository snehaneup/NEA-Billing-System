<!DOCTYPE html>
<html lang="en">
<head>
  <title>Payment Details</title>
  <style>
    table 
    {
      border-spacing: 0;
      border: 1px solid black;
      margin-bottom: 10px;
    }
    th, td 
    {
      border: 1px solid black;
      padding: 5px;
    }
    h3 
    {
      margin-top: 20px;
    }
  </style>
</head>
<body>
<?php
  // Check if the 'bid' parameter is present in the URL
  if (isset($_GET['bid'])) 
  {
    $bid = $_GET['bid'];
    $servername = "localhost";
    $dbname = "nea";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $paymentQuery = "SELECT * FROM Payment WHERE BID = '$bid'";
    $paymentResult = $conn->query($paymentQuery);
    if ($paymentResult->num_rows > 0) 
    {
      echo "<h3>Payment Details</h3>";
      echo "<table>";
      echo "<tr><th>PID</th><th>BID</th><th>PDate</th><th>PAmount</th><th>Payment_Type_ID</th><th>Rebate_Amt</th><th>Fine_Amt</th></tr>";
      while ($paymentRow = $paymentResult->fetch_assoc()) 
      {
        echo "<tr>";
        echo "<td>" . $paymentRow['PID'] . "</td>";
        echo "<td>" . $paymentRow['BID'] . "</td>";
        echo "<td>" . $paymentRow['PDate'] . "</td>";
        echo "<td>" . $paymentRow['PAmount'] . "</td>";
        echo "<td>" . $paymentRow['POID'] . "</td>";
        echo "<td>" . $paymentRow['Rebate_Amt'] . "</td>";
        echo "<td>" . $paymentRow['Fine_Amt'] . "</td>";
        echo "</tr>";
      }
      echo "</table>";
    } 
    else 
    {
      echo "<h3>Error</h3>";
      echo "<p>No payment details found for the given bill ID.</p>";
    }
    $conn->close();
  } 
  else 
  {
    echo "<h3>Error</h3>";
    echo "<p>Invalid request. Please provide a valid bill ID.</p>";
  }
?>
</body>
</html>
