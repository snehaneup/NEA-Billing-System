<!DOCTYPE html>
<html>
<head>
    <title>Payment Options</title>
</head>
<body>
    <h2>The information you entered is: </h2>
    <?php
    include("dbconnect.php");
    $POID = $_POST["poid"];
    $Name = $_POST["poname"];
    $Status = $_POST["status"];
    ?>
    <p>POID: <?php echo $POID; ?><br>
    <p>P.O. Name: <?php echo $Name; ?><br>
    <p>Status: <?php echo $Status; ?><br>
    <?php
    include("dbconnect.php");
    $query = "INSERT into payment_option (POID,Name,Status) VALUES('$POID','$Name','$Status');";
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