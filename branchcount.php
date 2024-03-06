<?php
    include("dbconnect.php");
    $sql = "SELECT * FROM branch";
    $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        echo "Choose a Branch to see the list of all the customers in that particular branch."."<br>";
        echo '<form method="GET">';
        echo "<select name='branch'>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["Branch_ID"] . "'>" . $row["Name"] . "</option>";
        }
        echo "</select>";
        echo '<input type="submit" value="Submit">';
        echo '</form>';
    } else {
        echo "No branches found.";
    }
$BName = $_GET['bname'];  
$sql = "SELECT * FROM customer WHERE Branch_ID = '$Branch_ID'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<br>"."<h1>"."Customer Details"."</h1>"."<br>";
    echo "<table border = 1>";
    echo "<tr><th>Customer ID</th><th>Name</th><th>Address</th><th>Branch</th></tr>";
    while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['CUSID'] . "</td>";
            echo "<td>" . $row['FullName'] . "</td>";
            echo "<td>" . $row['Address'] . "</td>";
            echo "<td>" . $row['Branch_ID'] . "</td>";
            echo "</tr>";
        }echo "</table>";}
 else {echo "<br>"."No customers found in the specified branch."."<br>" ;}
$customerCount = $result->num_rows;
echo "<br>". "Total Customers in this branch are: $customerCount"."<br>";

$sql = "SELECT bill.* FROM bill INNER JOIN customer ON bill.customerid = customer.CUSID INNER JOIN branch ON customer.Branch_ID = branch.Branch_ID WHERE branch.Branch_ID = '$Branch_ID' ";
$result = $conn->query($sql);
$totalBillAmountNotPaid = 0;
if (mysqli_num_rows($result) > 0) {
    echo "<br>"."<h1>"."Bill Details"."</h1>"."<br>";
echo "<table border = 1>";
echo "<tr><th>Bill ID</th><th>Customer ID</th><th>BDate</th><th>BMonth</th><th>BYear</th><th>Current Reading</th><th>Previous Reading</th><th>Bill Amount</th><th>Status</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['BID'] . "</td>";
    echo "<td>" . $row['CUSID'] . "</td>";
    echo "<td>" . $row['BDate'] . "</td>";
    echo "<td>" . $row['BMonth'] . "</td>";
    echo "<td>" . $row['BYear'] . "</td>";
    echo "<td>" . $row['Current_Reading'] . "</td>";
    echo "<td>" . $row['Prev_Reading'] . "</td>";
    echo "<td>" . $row['Bamount'] . "</td>";
    if($row['Status'] == 0)
    {
      echo "<td>".$row['Status']. "<p>Bills not paid." ."</td>";
      $totalBillAmountNotPaid += $row['Bamount'];
}
else
{
    echo "<td>" .$row['Status'] ."<p>Bills are paid.</td>";
}
    echo "</tr>";
    if($row['Status'] == 0)
    {
        $totalBillAmountNotPaid = $row['Bamount'];
        echo "<h3>Total Bill Amount not Paid by Customer ID: " . $row['CUSID'] . " is Rs." . $totalBillAmountNotPaid."</h3>"."<br>";
    }
  
}
echo "</table>"; 
 
echo "<br>";
echo "<h3>Total Bill Amount Not Paid in this Particular Branch is Rs.: " . $totalBillAmountNotPaid . "</h3>"; 
}

$conn->close();
?>
