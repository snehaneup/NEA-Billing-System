<!DOCTYPE html>
<html>
<head>
    <title>Branch Form</title>
</head>
<body>
    <h2>The information you entered is: </h2>
    <?php
    include("dbconnect.php");
    $BID=$_POST["bid"];
    $BName=$_POST["bname"];
    $bstatus=$_POST["status"];
    ?>
    <p>Branch ID: <?php echo $BID;?> <br> </p>
    <p>Branch Name: <?php echo $BName;?> <br> </p>
    <p>Status : <?php echo $bstatus;?> <br> </p>
    <?php
    include("dbconnect.php");
    $query = "INSERT into branch (Branch_ID,Name,status) VALUES('$BID','$BName','$bstatus')";
    $result = mysqli_query($conn,$query);
    if($result)
    {
        echo "Data Inserted Successfully!";
    }
    else
    {
        echo "Error: ".$query.":-".mysqli_error($conn);
    }
    mysqli_close($conn);
    ?>
</body>
</html>