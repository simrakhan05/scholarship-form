<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Details</title>
</head>
<body>
    <?php
    session_start();
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'sa_form';
$sno = $_SESSION['sno'];
$conn = mysqli_connect($host,$user,$pass,$dbname);
$sql = "SELECT name,password,email,mobile,city,province,birthdate,gender,semester,cgpa,department from users WHERE sno = '$sno'";
        $result = $conn-> query($sql);
        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
                echo "<h1>".$row["name"] . "</h1>";
echo "Your Password is: " .$row["password"]. "<br>";
echo "Mobile No.: " .$row["mobile"]. "<br>";
echo "Email Address: " .$row["email"]. "<br>";
echo "Birthdate: " .$row["birthdate"]. "<br>";
echo "City: " .$row["city"]. "<br>";
echo "State/Province: " .$row["province"]. "<br>";
echo "Gender: " .$row["gender"]. "<br>";
echo "Department: " .$row["department"]. "<br>";
echo "Semester: " .$row["semester"]. "<br>";
echo "Current CGPA: " .$row["cgpa"]. "<br>";
            }
        
?>
</body>
</html>