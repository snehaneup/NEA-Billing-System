<!DOCTYPE html>
<html lang="en">
<head>
  <title>Customer Details</title>
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
  <script src="https://khalti.com/static/khalti-checkout.js"></script>
</head>
<body>
<?php
  if ($_SERVER["REQUEST_METHOD"] === "POST") 
  {
    $servername = "localhost";
    $dbname = "nea";
    $username = "root";
    $password = "";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) 
    {
      die("Connection failed: " .mysqli_connect_error());
    }
    $CUSID = $_POST['CUSID'];
    $MobileNo = $_POST['MobileNo'];
    $customerQuery = "SELECT * FROM customer WHERE CUSID = '$CUSID' AND MobileNo = '$MobileNo'";
    $customerResult = $conn->query($customerQuery);
    if ($customerResult->num_rows > 0) 
    {
      echo "<h3>Customer Details</h3>";
      echo "<table>";
      echo "<tr><th>CUSID</th><th>SCNO</th><th>FullName</th><th>Address</th><th>MobilNo</th></tr>";
      while ($customerRow = $customerResult->fetch_assoc()) 
      {
        echo "<tr>";
        echo "<td>" . $customerRow['CUSID'] . "</td>";
        echo "<td>" . $customerRow['SCNO'] . "</td>";
        echo "<td>" . $customerRow['FullName'] . "</td>";
        echo "<td>" . $customerRow['Address'] . "</td>";
        echo "<td>" . $customerRow['MobileNo'] . "</td>";
        echo "</tr>";	
      }
      echo "</table>";
      $paymentQuery = "SELECT * FROM payment WHERE BID IN (SELECT BID FROM bill WHERE CUSID = '$CUSID')";
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
        echo "<p>No payment details found for the given customer ID.</p>";
      }
      $billQuery = "SELECT * FROM bill WHERE CUSID = '$CUSID'";
      $billResult = $conn->query($billQuery);
      if ($billResult->num_rows > 0) 
      {
        echo "<h3>Bill Details</h3>";
        echo "<table>";
        echo "<tr><th>BID</th><th>BDate</th><th>BYear</th><th>BMonth</th><th>Current Reading</th><th>Prev Reading</th><th>BAmount</th><th>Status</th><th>Action</th></tr>";
        while ($billRow = $billResult->fetch_assoc()) 
        {
          echo "<tr>";
          echo "<td>" . $billRow['BID'] . "</td>";
          echo "<td>" . $billRow['BDate'] . "</td>";
          echo "<td>" . $billRow['BYear'] . "</td>";
          echo "<td>" . $billRow['BMonth'] . "</td>";
          echo "<td>" . $billRow['Current_Reading'] . "</td>";
          echo "<td>" . $billRow['Prev_Reading'] . "</td>";
          echo "<td>" . $billRow['Bamount'] . "</td>";
          echo "<td>" . $billRow['Status'] . "</td>";
          if ($billRow['Status'] === "Paid") 
  {
            echo "<td><a href='paymentdetails.php?bid=" . $billRow['BID'] . "'>View</a></td>";
        } 
        else 
        {
            echo "<td><button onclick='payWithKhalti(" . $billRow['BID'] . ")'>Pay</button></td>";
        }
          echo "</tr>";
        }
        echo "</table>";
      } 
      else 
      {
        echo "<h3>Error</h3>";
        echo "<p>No bill details found for the given customer ID.</p>";
      }
    } 
    else 
    {
      echo "<h3>Error</h3>";
      echo "<p>No customer details found.</p>";
    }
    $conn->close();
  }
?>
<script>
function payWithKhalti(billID) 
{
  var config = 
  {
    // Public Key of your Khalti sandbox Merchant account
    "publicKey": "YOUR_PUBLIC_KEY",
    "productIdentity": billID.toString(),
    "productName": "Bill Payment",
    "productUrl": window.location.href,
    "eventHandler": 
{
      onSuccess(payload) 
      {
        window.location.href = "success.php?payment_id=" + payload.token;
      },
      onError(error) 
      {
        alert("Payment failed. Please try again.");
      },
      onClose() 
      {
      },
    },
  };
  var checkout = new KhaltiCheckout(config);
  checkout.show({ amount: 100 });
}
</script>
</body>
</html>
