<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
    <?php
    $sno = $_POST["sno"];
    $name= $_POST["username"];
    $password= $_POST["password"];
    $mobile= $_POST["mobile"];
    $city=  $_POST["city"];
    $email= $_POST["email"];
    $birthdate= $_POST["birthdate"];
    $province= $_POST["province"];
    $gender= $_POST["gender"];
    $department= $_POST["department"];
    $semester= $_POST["semester"];
    $cgpa= $_POST["cgpa"];
echo "<h1>Your data has been Edited ," . $name . "</h1>";
echo "Your Password is: " .$password. "<br>";
echo "Mobile No.: " .$mobile. "<br>";
echo "Email Address: " .$email. "<br>";
echo "Birthdate: " .$birthdate. "<br>";
echo "City: " .$city. "<br>";
echo "State/Province: " .$province. "<br>";
echo "Gender: " .$gender. "<br>";
echo "Department: " .$department. "<br>";
echo "Semester: " .$semester. "<br>";
echo "Current CGPA: " .$cgpa. "<br>";
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'sa_form';
$conn = mysqli_connect($host,$user,$pass,$dbname);
$sql = "UPDATE users SET 
 name='$name',password='$password',email='$email',mobile='$mobile',city='$city',province='$province',birthdate='$birthdate',gender='$gender',semester='$semester',cgpa='$cgpa',department='$department'
WHERE sno=$sno";
mysqli_query($conn,$sql);
mysqli_close($conn);
?>
</body>
</html>