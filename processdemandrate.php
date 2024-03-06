<!DOCTYPE html>
<html>
<head>
    <title>Demand Rate</title>
</head>
<body>
    <h2>The information you entered is: </h2>
    <?php
    include("dbconnect.php");
    $DRID = $_POST["drid"];
    $Demand_type_ID = $_POST["demandtypeid"];
    $Rate = $_POST["rate"];
    $Effective_Date = $_POST["effectivedate"];
    $IsCurrent = $_POST["iscurrent"];
    ?>
    <p>Demand Rate ID: <?php echo $DRID; ?><br>
    <p>Demand Type ID: <?php echo $Demand_type_ID; ?><br>
    <p>Rate: <?php echo $Rate; ?><br>
    <p>Effective Date: <?php echo $Effective_Date; ?><br>
    <p>IsCurrent: <?php echo $IsCurrent; ?><br>
    <?php
    include("dbconnect.php");
    $query = "INSERT into demandrate (DRID,Demand_type_ID,Rate,Effective_Date,IsCurrent) VALUES('$DRID','$Demand_type_ID','$Rate','$Effective_Date','$IsCurrent');";
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