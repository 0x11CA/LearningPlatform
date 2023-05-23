<?php
session_start();

if (!isset($_SESSION['studid'])) {
    header("Location: login.php");
    exit;
}

$studid = $_SESSION['studid'];

$servername = "localhost";
$username = "abc";
$password = "abc123";
$dbname = "learning";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM studtbl WHERE studid=?");
$stmt->bind_param("s", $studid);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $email = $row['email'];
    $pass = $row['pass'];
    $fname = $row['fname'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile</title>
  <link rel="stylesheet" href="./logincss.css">
  <link rel="icon" href="ico.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<header id="header">
    <a href="#" class="logo">Programming Platform</a>
    <ul>
      <li><a href="courses.php" >Courses</a></li>
      <li><a href="stueditprofile.php" class="active">Edit Profile</a></li>
      <li><a href="logout.php" >Logout</a></li>
    </ul>
</header>

<div class="container" id="container">
    <div class="form-container sign-in-container">
        <form action="stueditprofile.php" method="POST">
            <h1>Edit Profile</h1>
            <input type="text" name="studid" placeholder="ID" readonly value="<?php if (!empty($studid)) echo $studid; ?>">
            <input type="text" name="fname" placeholder="Phone number" required value="<?php if (!empty($fname)) echo $fname; ?>">
            <input type="email" name="email" placeholder="Email" required value="<?php if (!empty($email)) echo $email; ?>">
            <input type="text" name="pass" placeholder="Password" required value="<?php if (!empty($pass)) echo $pass; ?>">
            <br>
            <button type="submit" name="update">Update Details</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>Welcome, Student!</h1>
                <p>Here you can edit your details!</p>
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
if (isset($_POST['update'])) {
    if (!empty($_POST['studid']) &&
        !empty($_POST['email']) &&
        !empty($_POST['pass']) &&
        !empty($_POST['fname'])
    ) {
        $studid = $_POST['studid'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $fname = $_POST['fname'];

        $sql = "UPDATE studtbl SET email=?, pass=?, fname=? WHERE studid=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $email, $pass, $fname, $studid);
        $stmt->execute();

        header("Location:stueditprofile.php");
    }
}
?>