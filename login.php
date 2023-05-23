<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Log in</title>
  <link rel="stylesheet" href="./logincss.css">
  <link rel="icon" href="ico.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<header id="header">
    <a href="#" class="logo">Programming Platform </a>
    <ul>
      <li><a href="index.html">Home</a></li>
      <li><a href="adminlogin.php">Admin</a></li>
      <li><a href="login.php" class="active">Student</a></li>
    </ul>
  </header>

  <div class="container" id="container">
    <div class="form-container sign-in-container">
      <form action="#" method="POST">
        <h1>Sign In</h1>
        <div class="social-container">
          <a href="https://www.facebook.com/login/" class="social"><i class="fa fa-facebook"></i></a>
          <a href="https://mail.google.com/" class="social"><i class="fa fa-google"></i></a>
          <a href="https://www.linkedin.com/login" class="social"><i class="fa fa-linkedin"></i></a>
        </div>
        <span>or use your account</span>
        <input type="email" name="semail" placeholder="Email" required>
        <input type="password" name="spassword" placeholder="Password" required>
        <a href="studentsignup.php">Don't have an account? Sign up</a>
        <a href="studentforgotpass.php">Forgot Your Password</a>
        <button type="submit" name="SLogin">Sign In</button>
      </form>
    </div>
    <div class="overlay-container">
      <div class="overlay">
      <div class="overlay-panel overlay-right">
          <h1>Welcome Back Student!</h1>
          <p>Access the tools and resources you need to achieve your goals.</p>
        </div>
      </div>
    </div>
  </div>
  <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
  <script src="./script.js"></script>
</body>
</html>
<?php
session_start();
$servername = "localhost";
$username = "abc";
$password = "abc123";
$dbname = "learning";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['SLogin'])) {
  $email = $_POST['semail'];
  $password = $_POST['spassword'];

  $sql = "SELECT * FROM STUDTBL WHERE email='$email' AND pass='$password'"; 
  $result = $conn->query($sql); 

  if ($result->num_rows == 1) { 
    $row = $result->fetch_assoc();
    $studid = $row['studid'];
  
    $_SESSION['studid']=$studid;
    $_SESSION['email'] = $email;
    $_SESSION['fname'] = $fname;
    header("Location: courses.php");
  } else {
    echo "<script>alert('Invalid email or password for students.')</script>";
  }
}

$conn->close(); 
?>