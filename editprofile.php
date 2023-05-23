<?php
session_start();

if (!isset($_SESSION['adminid'])) {
    header("Location: adminlogin.php");
    exit;
}

$adminid = $_SESSION['adminid'];

$servername = "localhost";
$username = "abc";
$password = "abc123";
$dbname = "learning";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM admins WHERE adminid=?");
$stmt->bind_param("s", $adminid);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $email = $row['email'];
    $pass = $row['pass'];
    $phone_number = $row['phone_number'];
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
      <li><a href="addcourse.php">Add</a></li>
      <li><a href="updatecourse.php">Update</a></li>
      <li><a href="deletecourse.php">Delete</a></li>
      <li><a href="editprofile.php" class="active">Edit profile</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
</header>

<div class="container" id="container">
    <div class="form-container sign-in-container">
        <form action="editprofile.php" method="POST">
            <h1>Edit Profile</h1>
            <input type="text" name="adminid" placeholder="ID" readonly value="<?php if (!empty($adminid)) echo $adminid; ?>">
            <input type="email" name="email" placeholder="Email" required value="<?php if (!empty($email)) echo $email; ?>">
            <input type="text" name="pass" placeholder="Password" required value="<?php if (!empty($pass)) echo $pass; ?>">
            <input type="number" name="phone_number" placeholder="Phone number" required value="<?php if (!empty($phone_number)) echo $phone_number; ?>">
            <br>
            <button type="submit" name="update">Update Details</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>Welcome, Admin!</h1>
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
    if (!empty($_POST['adminid']) &&
        !empty($_POST['email']) &&
        !empty($_POST['pass']) &&
        !empty($_POST['phone_number'])
    ) {
        $adminid = $_POST['adminid'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $phone_number = $_POST['phone_number'];

        $sql = "UPDATE admins SET email=?, pass=?, phone_number=? WHERE adminid=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $email, $pass, $phone_number, $adminid);
        $stmt->execute();

        header("Location:editprofile.php");
        exit;
    }
}
?>