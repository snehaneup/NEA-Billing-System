<!DOCTYPE html>
<html>
<head>
    <title>Demand Type</title>
</head>
<body>
    <h2>The information you entered is: </h2>
    <?php
    include("dbconnect.php");
    $Demand_type_ID = $_POST["demandtypeid"];
    $Description = $_POST["description"];
    $Status = $_POST["status"];
    ?>
    <p>Demand Type ID: <?php echo $Demand_type_ID; ?><br>
    <p>Description: <?php echo $Description; ?><br>
    <p>Status: <?php echo $Status; ?><br>
    <?php
    include("dbconnect.php");
    $query = "INSERT into demandtype (Demand_type_ID,Description,Status) VALUES('$Demand_type_ID','$Description','$Status');";
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