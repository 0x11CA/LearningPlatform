<?php
session_start();

if (!isset($_SESSION['studid'])) {
    header("Location: login.php");
    exit;
}
$courses_id = $_GET['course_id'];

if (isset($_POST['submit'])) {
    $studid = $_SESSION['studid'];
    $courses_id = $_POST['courses_id'];
    $msg = $_POST['msg'];

    $servername = "localhost";
    $username = "abc";
    $password = "abc123";
    $dbname = "learning";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO feedback (studid, courses_id, msg) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $studid, $courses_id, $msg);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header("Location: view.php?course_id=$courses_id");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Feedback</title>
  <link rel="stylesheet" href="./logincss.css">
  <link rel="icon" href="ico.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <header id="header">
        <a href="#" class="logo">Programming Platform</a>
        <ul>
            <li><a href="courses.php">Courses</a></li>
            <li><a href="feedback.php" class="active">Feedback</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </header>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="feedback.php" method="POST">
                <h1>Feedback</h1>
                <br>
                <input type="hidden" name="courses_id" value="<?php echo $_GET['course_id']; ?>">
                <textarea name="msg" placeholder="Enter your feedback" style="width: 300px; height: 150px;"required></textarea>
                <br>
                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1>Leave Your Feedback</h1>
                    <p>Share your thoughts about the course.</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>