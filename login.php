<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
    <style>
    body {
      background-image: url("soft-blue-abstract-texture-background-with-watercolor_65186-2640.avif");
      background-size: cover;                 
      background-repeat: no-repeat;          
      background-position: center center;    
      height: 100vh;
      margin: 0;
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
    $nameErr = $passwordErr =  "";
if (isset($_SESSION['sno'])) {
    header("Location: dashboard.php");
    exit();
}
    $message = "";
    $name = $password = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name       = $_POST["username"];
    $password   = $_POST["password"];
    if (empty($name)) {
        $nameErr = "* Username is required";
    } 
    else if (empty($password)) {
        $passwordErr = "* Password is required";
    }
    else{
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $dbname = 'sa_form';
        $conn = mysqli_connect($host,$user,$pass,$dbname);
        $sql = "SELECT name,password,sno from users WHERE name = '$name' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if($row){
            $_SESSION["sno"] = $row["sno"];
            $_SESSION["name"] = $row["name"];
            $_SESSION["password"] = $row["password"];
            header("Location: dashboard.php");
            exit();
        }
        else{
            session_unset(); 
            session_destroy();
            $message = "Incorrect Username OR Password";
        }
        mysqli_close($conn);
    }
    
    }
?>
    <div class="d-flex justify-content-center align-items-center vh-100">
     <form 
    class="needs-validation <?php echo ($_SERVER["REQUEST_METHOD"] == "POST") ? 'was-validated' : ''; ?>" 
    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate >
     <div class="p-5 rounded shadow"  style="width: 500px; height: 500px; background-color: rgba(255, 255, 255, 0.45); color: black;">
     <legend class="text-center mb-0"><h1 class="text-secondary fw-bold mb-1" style="font-size: 35px;">Welcome Back</h1></legend>
    <div class="text-center"><p class="text-secondary" style="font-size: 18px; margin-top: 0;" >Log in to your account</p></div><br>
    <input type="hidden" name="sno">
    <?php $nameClass = $nameErr ? 'is-invalid' : ($name ? 'is-valid' : ''); ?>
        <input type="text" name="username" placeholder="Username" value="<?php echo $name; ?>" class="form-control <?php echo $nameClass; ?>" required>
        <span class="invalid-feedback"><?php echo $nameErr; ?></span><br>
    <?php $passwordClass = $passwordErr ? 'is-invalid' : ($password ? 'is-valid' : ''); ?>
        <input type="password" name="password" placeholder="Password" value="<?php echo $password; ?>" class="form-control <?php echo $passwordClass; ?>" required>
        <span class="invalid-feedback"><?php echo $passwordErr; ?></span><br>
    <div class="d-flex justify-content-between align-items-center mb-2">
    <div class="form-check mb-0">
    <input class="form-check-input" type="checkbox" id="inlineFormCheck">
    <label class="form-check-label" for="inlineFormCheck">
      Remember me
    </label>
    </div>
    <a href="#" class="signup-link" style="font-size: 14px;">Forgot password?</a>
  </div>
  <?php
echo "<strong>".$message."</strong>";
?>
    <button type="submit" class="btn btn-outline-primary w-100 rounded">LOG IN</button><br><br>
    <div class="text-center">
        <p class="text-secondary" style="font-size: 18px; margin: 0;" >New User?</p>
        <a href="signup.php" class="signup-link" >Sign up Now</a>
    </div>
</div>
</form>
</div>
</body>
</html>