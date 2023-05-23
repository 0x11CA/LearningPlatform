<?php
session_start();

$studid = $_SESSION['studid'];

$servername = "localhost";
$username = "abc";
$password = "abc123";
$dbname = "learning";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$courses_id = $_GET['courses_id'];
$selectedChoice = $_POST['choise'];

$q = "SELECT correct_answer FROM courses WHERE courses_id = '$courses_id'";
$res = mysqli_query($conn, $q) or die("Error in the query: $q" . mysqli_error($conn));

$row = mysqli_fetch_assoc($res);
$correctAnswer = $row['correct_answer'];

if ($selectedChoice == $correctAnswer) {
    echo "<script>alert('Congratulations! Your answer is correct.')</script>";
    echo '<script type="text/javascript">'; 
    $URL="view.php?course_id=$courses_id";
    echo "location.href='$URL'";
    echo '</script>';
} else {
    echo "<script>alert('Oops! Your answer is incorrect. Please try again.')</script>";
    echo '<script type="text/javascript">'; 
    $URL="view.php?course_id=$courses_id";
    echo "location.href='$URL'";
    echo '</script>';
}
?>
