<?php 
include("dbconnect.php");
$searchTerm = $_POST['cusid'];
$sql = "SELECT * FROM customer WHERE CUSID LIKE '%$searchTerm%'";
$result = mysqli_query($conn, $sql); if (mysqli_num_rows($result) > 0) 
{
echo "<br>"."<h1>"."Customer Details"."</h1>"."<br>"; 
echo "<table border = 1>";
echo "<tr><th>Customer ID</th><th>Name</th><th>Address</th><th>Mobile No.</th><th>Registered Branch</th><th>Demand Type</th></tr>";
while ($row = mysqli_fetch_assoc($result)) 
{ 
echo "<tr>";
echo "<td>" . $row['CUSID'] . "</td>"; 
echo "<td>" . $row['FullName'] . "</td>";
echo "<td>" . $row['Address'] . "</td>"; 
echo "<td>" . $row['MobileNo'] . "</td>";
echo "<td>" . $row['Branch_ID'] . "</td>";
echo "<td>" . $row['Demand_type_ID'] . "</td>"; 
echo "</tr>";
}
echo "</table>";
$sql = "SELECT * FROM bill WHERE CUSID LIKE '%$searchTerm%'";
$result = mysqli_query($conn, $sql); if (mysqli_num_rows($result) > 0) 
{
echo "<br>"."<h1>"."Bill Details"."</h1>"."<br>"; 
echo "<table border = 1>";
echo "<tr><th>Bill ID</th><th>CustomerID</th><th>BDate</th><th>BMonth</th> <th>BYear</th><th>Current Reading</th><th>Previous Reading</th><th>Bill Amount</th></tr>";
while ($row = mysqli_fetch_assoc($result)) 
{ 
echo "<tr>";
echo "<td>" . $row['BID'] . "</td>"; 
echo "<td>" . $row['CUSID'] . "</td>"; 
echo "<td>" . $row['BDate'] . "</td>";
echo "<td>" . $row['BMonth'] . "</td>";
echo "<td>" . $row['BYear'] . "</td>";
echo "<td>" . $row['Current_Reading'] . "</td>"; 
echo "<td>" . $row['Prev_Reading'] . "</td>"; 
echo "<td>" . $row['Bamount'] . "</td>"; 
echo "</tr>";
}
echo "</table>";
}
$sql ="SELECT * FROM payment INNER JOIN bill ON payment.BID = bill.BID WHERE bill.CUSID LIKE '%$searchTerm%'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) 
{
echo "<br>"."<h1>"."Payment Details"."</h1>"."<br>"; 
echo "<table border = 1>";
echo "<tr><th>Payment ID</th><th>Bill ID</th><th>PDate</th><th>Payment Amount</th><th>Payment Type ID</th><th>Rebate Amount</th><th>Fine Amount</th></tr>";
while ($row = mysqli_fetch_assoc($result)) 
{ 
echo "<tr>";
echo "<td>" . $row['PID'] . "</td>";
echo "<td>" . $row['BID'] . "</td>";
echo "<td>" . $row['PDate'] . "</td>";
echo "<td>" . $row['PAmount'] . "</td>";
echo "<td>" . $row['POID'] . "</td>"; 
echo "<td>" . $row['Rebate_Amt'] . "</td>"; 
echo "<td>" . $row['Fine_Amt'] . "</td>";
echo "</tr>";
}
echo "</table>";
}
else
{
echo "No results found.";
}
}
mysqli_close($conn);
?>
