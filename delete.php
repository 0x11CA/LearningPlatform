<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Delete Course</title>
</head>

<body>

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
session_start();

$servername = "localhost";
$username = "abc";
$password = "abc123";
$dbname = "learning";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $stmt = $conn->prepare("DELETE FROM courses WHERE courses_id = ?");
  $stmt->bind_param("s", $id);
  
  if ($stmt->execute()) {
    header("Location: deletecourse.php");
    exit();
  } else {
    echo "Error deleting course: " . $stmt->error;
  }
  
  $stmt->close();
}

$conn->close();
?>