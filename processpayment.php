<!DOCTYPE html>
<html>
<head>
    <title>Payment Details</title>
</head>
<body>
    <h2>The information you entered is: </h2>
    <?php
    include("dbconnect.php");
    $PID = $_POST["pid"];
    $BID = $_POST["bid"];
    $PDate = $_POST["pdate"];
    $PAmount = $_POST["pamount"];
    $POID = $_POST["paymenttypeid"];
    $Rebate_Amt = $_POST["rebateamount"];
    $Fine_Amt = $_POST["fineamount"];
    ?>
    <p>PID: <?php echo $PID; ?><br>
    <p>BID: <?php echo $BID; ?><br>
    <p>PDate: <?php echo $PDate; ?><br>
    <p>PAmount: <?php echo $PAmount; ?><br>
    <p>POID: <?php echo $POID; ?><br>
    <p>Rebate Amount: <?php echo $Rebate_Amt; ?><br>
    <p>Fine Amount: <?php echo $Fine_Amt; ?><br>
    <?php
    include("dbconnect.php");
    $query = "INSERT into payment (PID,BID,PDate,PAmount,POID,Rebate_Amt,Fine_Amt) VALUES('$PID', '$BID', '$PDate','$PAmount','$POID','$Rebate_Amt','$Fine_Amt');";
    $result = mysqli_query($conn,$query);
    if($result)
    {
        echo "Data Inserted Succesfully";
    }
    else
    {
        echo "ERROR: ".$query.":-".mysqli_error($conn);
    }
    mysqli_close($conn);
    ?>


</body>
</html>