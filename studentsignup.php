<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
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
      <li><a href="login.php" class="active" >Student</a></li>
    </ul>
  </header>

  <div class="container" id="container">
    <div class="form-container sign-in-container">
      <form action="#" method="POST">
        <h1>Sign Up</h1>
        <div class="social-container">
          <a href="https://www.facebook.com/login/" class="social"><i class="fa fa-facebook"></i></a>
          <a href="https://mail.google.com/" class="social"><i class="fa fa-google"></i></a>
          <a href="https://www.linkedin.com/login" class="social"><i class="fa fa-linkedin"></i></a>
        </div>
        <span>or use your account</span>
        <input type="text" name="sname" placeholder="Name" required>
        <input type="email" name="semail" placeholder="Email" required>
        <input type="password" name="spassword" placeholder="Password" required>
        <a href="login.php">have an account? Sign in</a>
        <button type="submit" name="SLogin">Sign Up</button>
      </form>
    </div>
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-right">
          <h1>Welcome, Student!</h1>
          <p>Ready to take the first step towards a brighter future? Sign up now and gain access to our comprehensive learning resources.</p>
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
$servername = "localhost";
$username = "abc";
$password = "abc123";
$dbname = "learning";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['SLogin'])) {
  $fname = $_POST['sname'];
  $email = $_POST['semail'];
  $pass = $_POST['spassword'];

  $email_query = "SELECT * FROM STUDTBL WHERE email='$email'";
  $result = $conn->query($email_query);

  if ($result->num_rows > 0) {
    echo "<script>alert('This email is already registered. Please use a different email.')</script>";
  } elseif (!preg_match('/^[a-zA-Z0-9]{8,}$/', $pass)) {
    echo "<script>alert('Password must be at least 8 letters or numbers.')</script>";
  } else {
    $sql = "INSERT INTO STUDTBL (fname, email, pass) VALUES ('$fname', '$email', '$pass')";

    if ($conn->query($sql) === TRUE) {
      echo "<script>alert('Registered Successfully.')</script>";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}

$conn->close();
?>