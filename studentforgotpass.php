<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title> Reset Password </title>
  <link rel="stylesheet" href="./logincss.css">
  <link rel="icon" href="ico.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Learning Platform</title>

</head>
<body>
<header id="header">
    <a href="#" class="logo">Programming Platform </a>
    <ul>
      <li><a href="index.html">Home</a></li>
      <li><a href="adminlogin.php" >Admin</a></li>
      <li><a href="login.php" class="active">Student</a></li>
    </ul>
  </header>

  <div class="container" id="container">
  <div class="form-container sign-in-container">
    <form method="POST">
      <h1>Reset</h1>
      <span>Enter your email and we'll send you an email to get back into your account.</span>
      <input type="email" name="email" placeholder="Email">
      <a href="login.php">Login Page</a>
      <button name="ALogin">Reset</button>
    </form>
  </div>
  <div class="overlay-container">
    <div class="overlay">
      <div class="overlay-panel overlay-right">
        <h1>Welcome, Student!</h1>
        <p>Forgot your password? No worries! Reset it here.</p>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  const container = document.getElementById('container');
</script>
<?php 
$servername = "localhost";
$username = "abc";
$password = "abc123";
$dbname = "learning";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['ALogin'])) {
  $email = $_POST['email'];

  $stmt = $conn->prepare("SELECT * FROM STUDTBL WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();

  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $fname = $row['fname'];
    $pass = $row['pass'];

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Port = "587";
    $mail->Username = "Learning"; // Your Gmail Without @Gmail.com , Example Learning@gmail.com
    $mail->Password = "GmailAppPassword"; // Your Gmail App Password , You Can Get This Password From Gmail Security Section.
    $mail->Subject = "Password Reset Request";
    $mail->setFrom('Learning@gmail.com','Code Learning Support'); // 'Your Gmail With @Gmail.com' , 
    $mail->isHTML(true);
    $mail->Body = "<h1>Password Reset Request</h1><p>Hi Admin,<br>Please Check your saved details and you can reset by logging in to the website:<br>Here is your account Details : <br>Email : $email <br>Password : $pass</p>";
    $mail->addAddress($email);
    

    if ($mail->send()) {
      echo "<script>alert('Email Sent..!')</script>";
  } else {
      echo "<script>alert('Message could not be sent. Mailer Error: '. $mail->ErrorInfo)</script>";
  }

    $mail->smtpClose();
    
  } else {
    echo "<script>alert('Email not found.')</script>";

  }
}
$conn->close(); 
?>
