<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
</head>
<body>
    <h2>Applicants Data</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Password</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>City</th>
                <th>Province</th>
                <th>Birthdate</th>
                <th>Gender</th>
                <th>Semester</th>
                <th>cgpa</th>
                <th>Department</th>
            </tr>
        </thead>
        <?php
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $dbname = 'sa_form';
        $conn = mysqli_connect($host,$user,$pass,$dbname);
        if (isset($_POST['sno'])) {
            $sno = $_POST['sno'];
            $deleteQuery = "DELETE FROM users WHERE sno = '$sno'";
            $deleteResult = mysqli_query($conn, $deleteQuery);
        
            if ($deleteResult && mysqli_affected_rows($conn) == 1) {
                echo "<strong>Applicant Has Been Deleted</strong><br><br>";
            } else {
                echo "<strong>Deletion Failed</strong><br><br>";
            }
        }
        $sql = "SELECT sno,name,password,email,mobile,city,province,birthdate,gender,semester,cgpa,department from users";
        $result = $conn-> query($sql);
        if($result-> num_rows>0){
            while($row = $result->fetch_assoc()) {
                echo "<tr>
        <td>".$row["sno"]."</td>
        <td>".$row["name"]."</td>
        <td>".$row["password"]."</td>
        <td>".$row["email"]."</td>
        <td>".$row["mobile"]."</td>
        <td>".$row["city"]."</td>
        <td>".$row["province"]."</td>
        <td>".$row["birthdate"]."</td>
        <td>".$row["gender"]."</td>
        <td>".$row["semester"]."</td>
        <td>".$row["cgpa"]."</td>
        <td>".$row["department"]."</td>
        <td>
            <form method='post'>
                <input type='hidden' name='sno' value='".$row['sno']."'>
                <input type='submit' value='Delete'>
            </form>
        </td>
        <td>
            <form action='form1.php' method='post'>
                <input type='hidden' name='sno' value='".$row['sno']."'>
                <input type='submit' value='Edit'>
            </form>
        </td>
    </tr>";

            }
            
        }
        else{
            echo "0 Result";
        }
        $conn-> close();
        ?>
        
    </table>
</body>
</html>