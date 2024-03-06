<!DOCTYPE html>
<html>
<head>
    <title>Customer Details</title>
</head>
<body>
    <h2>The information you entered is: </h2>
    <?php
    include("dbconnect.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $SCNO = $_POST["scno"];
        $CUSID = $_POST["cusid"];
        $FullName = $_POST["fullname"];
        $Address = $_POST["address"];
        $MobileNo = $_POST["mobile"];
        $Branch_ID = $_POST["bid"];
        $Demand_Type_ID = $_POST["demandtype"];
        ?>
        <p>SCNO: <?php echo $SCNO; ?><br>
        <p>Customer ID: <?php echo $CUSID; ?><br>
        <p>Full Name: <?php echo $FullName; ?><br>
        <p>Address: <?php echo $Address; ?><br>
        <p>Mobile No.: <?php echo $MobileNo; ?><br>
        <p>Branch ID: <?php echo $Branch_ID; ?><br>
        <p>Demand Type ID: <?php echo $Demand_Type_ID; ?><br>
    <?php
    include("dbconnect.php");
    $query = "INSERT INTO customer (SCNO, CUSID, FullName, Address, MobileNo, Branch_ID, Demand_type_ID) VALUES ('$SCNO', '$CUSID', '$FullName', '$Address', '$MobileNo', '$Branch_ID', '$Demand_Type_ID')";
    $result = mysqli_query($conn, $query);
    if ($result) 
    {
        echo "Data Inserted Successfully";
    } 
    else 
    {
        echo "ERROR: " . $query . ":-" . mysqli_error($conn);
    }
    mysqli_close($conn);
    }
    ?>

</body>
</html>