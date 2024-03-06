<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['user_type'])) 
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];
    $conn = mysqli_connect("localhost", "root", "", "nea");
    if (!$conn) 
   {
        die("Database connection failed: " . mysqli_connect_error());
    }
    $escaped_username = mysqli_real_escape_string($conn, $username);
    $escaped_password = mysqli_real_escape_string($conn, $password);
    if ($user_type === 'admin') 
         {
        $query = "SELECT * FROM Admin WHERE username = '$escaped_username' AND password = '$escaped_password'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) === 1) 
 {
            $_SESSION['user_type'] = 'admin';
            header("Location: admin.php");
            exit();
        } 
  else 
 {
            echo "Provide valid credentials";
            exit();
        }
    } 
else if ($user_type === 'customer') 
{
        $query = "SELECT * FROM customer WHERE FullName = '$escaped_username' AND Password = '$escaped_password'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) === 1) 
  {
            $_SESSION['user_type'] = 'customer';
            header("Location: customer.php");
            exit();
        } 
  else
       {
            echo "Provide valid credentials";
            exit();
        }
    }
    mysqli_close($conn);
    header("Location: index.html?login_error=true");
    exit();
} 
else 
{
    header("Location: index.html");
    exit();
}
?>
