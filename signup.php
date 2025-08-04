<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Signup</title>
    <style>
        body {
      background-image: url("soft-blue-abstract-texture-background-with-watercolor_65186-2640.avif");
      background-size: cover;                 
      background-repeat: no-repeat;          
      background-position: center center;    
      height: 100%;
      margin: 0;
      background-attachment: fixed;
    }
       .signup-link {
    color: #0d6efd;
    text-decoration: none;
    font-size: 18px;
    transition: all 0.2s ease;
  }

  .signup-link:hover {
    font-weight: bold;
    text-decoration: underline;
    color: #0a58ca;
  }
  .error {color:rgb(207, 4, 4);}
    </style>
</head>
<body>
    <?php
session_start();

$nameErr = $passwordErr = $emailErr = $mobileErr = $birthdateErr = $genderErr = $cityErr = $provinceErr = $semesterErr = $cgpaErr = $departmentErr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name       = $_POST["username"];
    $password   = $_POST["password"];
    $mobile     = $_POST["mobile"];
    $city       = $_POST["city"];
    $email      = $_POST["email"];
    $birthdate  = $_POST["birthdate"];
    $province   = $_POST["province"];
    $gender     = $_POST["gender"];
    $department = $_POST["department"];
    $semester   = $_POST["semester"];
    $cgpa       = $_POST["cgpa"];
       if (empty($name)) {
        $nameErr = "* Username is required";
    } 
    else if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
    else if (empty($password)) {
        $passwordErr = "* Password is required";
    }
    else if (empty($mobile)) {
        $mobileErr = "* Mobile No. is required";
    }
    else if (!preg_match("/^[0-9]{4}-?[0-9]{7}$/", $mobile)) {
    $mobileErr = "Invalid mobile number. Use XXXX-XXXXXXX format";
    }
    else if (empty($email)) {
        $emailErr = "* Email is required";
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
    else if (empty($birthdate)) {
        $birthdateErr = "* Birthdate is required";
    }
    else if (empty($gender)) {
        $genderErr = "* Gender is required";
    }
    else if (empty($city)) {
        $cityErr = "* City is required";
    }
    else if (!preg_match("/^[a-zA-Z-' ]*$/",$city)) {
      $nameErr = "Only letters and white space allowed";
    }
    else if (empty($province)) {
        $provinceErr = "* Province is required";
    }
    else if (!preg_match("/^[a-zA-Z-' ]*$/",$province)) {
      $nameErr = "Only letters and white space allowed";
    }
    else if (empty($semester)) {
        $semesterErr = "* Semester is required";
    }
    else if (empty($semester) || $semester == "Choose Semester..."){
    $semesterErr = "* Semester is required";
  }
    else if (empty($cgpa)) {
        $cgpaErr = "* CGPA is required";
    }
    else if (!is_numeric($cgpa) || $cgpa < 0 || $cgpa > 4) {
    $cgpaErr = "CGPA must be a number between 0.00 and 4.00";
}

  else if (empty($department) || $department == "Choose Department..."){
    $departmentErr = "* Department is required";
  }
   else {
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'sa_form';
    $conn = mysqli_connect($host, $user, $pass, $dbname);
    $sql = "INSERT INTO users (name, password, email, mobile, city, province, birthdate, gender, semester, cgpa, department)
            VALUES ('$name', '$password', '$email', '$mobile', '$city', '$province', '$birthdate', '$gender', '$semester', '$cgpa', '$department')";
    if (mysqli_query($conn, $sql)) {
        header("Location: login.php");
        exit();
    } 
    mysqli_close($conn);
  }
}
$action = htmlspecialchars($_SERVER["PHP_SELF"]);
$button = "SIGN UP";
if ($_SERVER["REQUEST_METHOD"] != "POST") {
  $host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'sa_form';
$conn = mysqli_connect($host, $user, $pass, $dbname);
$name = $password = $email = $mobile = $city = $province = $birthdate = $gender = $semester = $department = $cgpa = "";
if (isset($_POST['sno']) || isset($_SESSION["sno"])) {
    $sno = isset($_POST['sno']) ? mysqli_real_escape_string($conn, $_POST['sno']) : $_SESSION['sno'];
    $action="edit.php";
    $button = "SAVE DATA";
    $sql = "SELECT sno,name,password,email,mobile,city,province,birthdate,gender,semester,cgpa,department from users WHERE sno = '$sno'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $name = $row["name"];
        $password = $row["password"];
        $email = $row["email"];
        $mobile = $row["mobile"];
        $city = $row["city"];
        $province = $row["province"];
        $birthdate = $row["birthdate"];
        $gender = $row["gender"];
        $semester = $row["semester"];
        $cgpa = $row["cgpa"];
        $department = $row["department"];
        
    } else {
        echo "<strong>Data not found for edit.</strong>";
        // This is a test change
    }
} 
mysqli_close($conn);
}
?>
    <div class="d-flex justify-content-center align-items-center min-vh-100 py-5">
    <form class="needs-validation <?php echo ($_SERVER["REQUEST_METHOD"] == "POST") ? 'was-validated' : ''; ?>" action="<?php echo $action; ?>" method="post" novalidate>
    <div class="p-5 rounded shadow"  style="width: 550px; height: 800px; background-color: rgba(255, 255, 255, 0.45); color: black;">
    <legend class="text-center mb-0"><h1 class="text-secondary fw-bold mb-1" style="font-size: 35px;">Application form</h1></legend><br><br>
    <?php if(isset($sno)){?>
    <input type="hidden" name="sno" value="<?php echo $sno; ?>">
    <?php } ?>
     <?php $nameClass = $nameErr ? 'is-invalid' : ($name ? 'is-valid' : ''); ?>
          <input type="text" name="username" value="<?php echo $name; ?>" class="form-control <?php echo $nameClass; ?>" placeholder="Username" required>
     <span class="invalid-feedback"><?php echo $nameErr; ?></span><br>
    <?php $passwordClass = $passwordErr ? 'is-invalid' : ($password ? 'is-valid' : ''); ?>
 <input type="password" name="password" value="<?php echo $password; ?>" class="form-control <?php echo $passwordClass; ?>" placeholder="Password" required>
    <span class="invalid-feedback"><?php echo $passwordErr; ?></span><br>
    <?php $mobileClass = $mobileErr ? 'is-invalid' : ($mobile ? 'is-valid' : ''); ?>
 <input type="text" name="mobile" value="<?php echo $mobile; ?>" class="form-control <?php echo $mobileClass; ?>" placeholder="Mobile" required>
 <span class="invalid-feedback"> <?php echo $mobileErr;?></span><br>
    <?php $emailClass = $emailErr ? 'is-invalid' : ($email ? 'is-valid' : ''); ?>
      <input type="text" name="email" value="<?php echo $email; ?>" class="form-control <?php echo $emailClass; ?>" placeholder="Email" required>
      <span class="invalid-feedback"> <?php echo $emailErr;?></span><br>
    <div class="row mb-0">
  <div class="col-6">
     <?php $birthdateClass = $birthdateErr ? 'is-invalid' : ($birthdate ? 'is-valid' : ''); ?>
    <input type="date" name="birthdate" value="<?php echo $birthdate; ?>" class="form-control <?php echo $birthdateClass; ?>" placeholder="Birthdate" required>
    <span class="invalid-feedback"> <?php echo $birthdateErr;?></span>
  </div>
  <div class="col-6">
    <input type="radio" id="male" name="gender" value="male" <?php echo ($gender=='male')? 'checked' : '' ; ?> checked>
    <label for="male">Male</label>
    <input type="radio" id="female" name="gender" value="female" <?php echo ($gender=='female')? 'checked' : '' ; ?> >
    <label for="female">Female</label>
    <span class="error"> <?php echo $genderErr;?></span>
  </div>
</div><br>
<div class="row mb-2">
  <div class="col-6">
        <?php $cityClass = $cityErr ? 'is-invalid' : ($city ? 'is-valid' : ''); ?>
         <input type="text" name="city" value="<?php echo $city; ?>" class="form-control <?php echo $cityClass; ?>" placeholder="City" required>
  <span class="invalid-feedback"> <?php echo $cityErr;?></span>
        </div>
  <div class="col-6">
     <?php $provinceClass = $provinceErr ? 'is-invalid' : ($province ? 'is-valid' : ''); ?>
 <input type="text" name="province" value="<?php echo $province; ?>" class="form-control <?php echo $provinceClass; ?>" placeholder="Province" required>
  <span class="invalid-feedback"> <?php echo $provinceErr;?></span><br>
</div>
    </div>
    <?php $departmentClass = $departmentErr ? 'is-invalid' : ($department ? 'is-valid' : ''); ?>
<select name="department" class="form-control <?php echo $departmentClass; ?>" required>
    <option value="" <?php echo ($department=="") ? "selected" : ""; ?>>Choose Department...</option>
    <option value="BBA" <?php echo ($department=="BBA")? "selected" : "" ; ?>>BBA</option>
    <option value="engineering" <?php echo ($department=="engineering")? "selected" : "" ; ?>>Engineering</option>
    <option value="mathematics" <?php echo ($department=="mathematics")? "selected" : "" ; ?>>Mathematics</option>
</select>
<span class="invalid-feedback"> <?php echo $departmentErr;?></span><br>
  <div class="row mb-2">
  <div class="col-6">
   <?php $semesterClass = $semesterErr ? 'is-invalid' : ($semester ? 'is-valid' : ''); ?>
<select name="semester" class="form-control <?php echo $semesterClass; ?>" required>
    <option value="">Choose Semester...</option>
    <?php
    for ($i = 1; $i <= 7; $i++) {
        $selected = ($semester == $i) ? "selected" : "";
        echo "<option value='$i' $selected>$i</option>";
    }
    ?>
</select>
<span class="invalid-feedback"> <?php echo $semesterErr;?></span>
  </div>
  <div class="col-6">
    <?php $cgpaClass = $cgpaErr ? 'is-invalid' : ($cgpa ? 'is-valid' : ''); ?>
    <input type="number" name="cgpa" value="<?php echo $cgpa; ?>" class="form-control <?php echo $cgpaClass; ?>" placeholder="CGPA"  step="0.01" required>
  <span class="invalid-feedback"> <?php echo $cgpaErr;?></span><br>
  </div>
</div>
    <button type="submit" class="btn btn-outline-primary w-100 rounded"><?php echo $button; ?></button><br><br>
    <div class="text-center">
        <p class="text-secondary" style="font-size: 18px; margin: 0;" >Already have an account?</p>
        <a href="login.php" class="signup-link" >Login In</a>
    </div>
</div>
</form>
</div>
</body>
</html>