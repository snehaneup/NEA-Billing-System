<!DOCTYPE html>
<html>
<head>
    <title>Bill Details Form</title>
</head>
<body>
    <h2>The information you entered is: </h2>
    <?php
    include("dbconnect.php");
    $BID = $_POST["bid"];
    $BDate = $_POST["bdate"];
    $BYear = $_POST["byear"];
    $BMonth = $_POST["bmonth"];
    $CUSID = $_POST["cusid"];
    $Current = $_POST["currentreading"];
    $Previous = $_POST["previousreading"];
    $BAmount = $_POST["bamount"];
    ?>
    <p>Bill ID: <?php echo $BID; ?><br>
    <p>Bill Date: <?php echo $BDate; ?><br>
    <p>Bill Year: <?php echo $BYear; ?><br>
    <p>Bill Month: <?php echo $BMonth; ?><br>
    <p>Customer ID: <?php echo $CUSID; ?><br>
    <p>Current Reading: <?php echo $Current; ?><br>
    <p>Previous Reading: <?php echo $Previous; ?><br>
    <p>Bill Amount: <?php echo $BAmount; ?><br>
    <?php
    include("dbconnect.php");
    $query = "INSERT INTO bill (BID, BDate, BYear, BMonth, CUSID, Current_Reading, Prev_Reading, Bamount) VALUES ( '$BID', '$BDate', '$BYear', '$BMonth', '$CUSID', '$Current', '$Previous', '$BAmount')";
    $result = mysqli_query($conn, $query);
    if($result)
    {
        echo "Data Inserted Successfully";
    }
    else
    {
        echo "ERROR: " . $query . ":-" . mysqli_error($conn);
    }
    mysqli_close($conn);
    ?>
</body>
</html>
