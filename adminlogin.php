<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Log in</title>
  <link rel="stylesheet" href="./logincss.css">
  <link rel="icon" href="ico.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<header id="header">
    <a href="#" class="logo">Programming Platform </a>
    <ul>
      <li><a href="index.html">Home</a></li>
      <li><a href="adminlogin.php" class="active">Admin</a></li>
      <li><a href="login.php" >Student</a></li>
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
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <a href="adminforgotpass.php">Forgot Your Password</a>
        <button type="submit" name="ALogin">Sign In</button>
      </form>
    </div>
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-right">
          <h1>Welcome, Admin!</h1>
          <p>Login now to access our powerful platform and manage your organization with ease.</p>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    const container = document.getElementById('container');
  </script>
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

if (isset($_POST['ALogin'])) {
  $email = $_POST['email'];
  $password = $_POST['password']; 
 

  $sql = "SELECT * FROM admins WHERE email='$email' AND pass='$password'"; 
  $result = $conn->query($sql); 

if ($result->num_rows == 1) { 
  $row = $result->fetch_assoc();
  $adminid = $row['adminid'];

  $_SESSION['adminid'] = $adminid;
  $_SESSION['email'] = $email;
  header("Location: addcourse.php");
  } else {
    echo "<script>alert('Invalid email or password.')</script>";
  }
}

$conn->close();
?>