<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <?php
    session_start();
    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_unset();
    session_destroy();
    header("Location: login.php"); 
    exit();
}

if (!isset($_SESSION['sno'])) {
    header('Location: login.php');
    exit();
}

    $sno = $_SESSION["sno"];
    $host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'sa_form';
$conn = mysqli_connect($host,$user,$pass,$dbname);
$sql = "SELECT name from users WHERE sno = '$sno'";
        $result = $conn-> query($sql);
        if($result-> num_rows>0){
            while($row = $result->fetch_assoc()) {
                echo "<legend><h1>Welcome, " . $row["name"] . "</h1></legend>";
            }
        }
                echo "<a href='signup.php'>Edit Profile</a><br><br>";
                echo "<a href='user_details.php'>Application Details</a><br><br>";
                echo "<a href='dashboard.php?action=logout'>Log Out</a><br><br>";
?>
</body>
</html>