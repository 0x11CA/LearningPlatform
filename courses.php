<?php
session_start();

// Check if student is logged in
if (!isset($_SESSION['studid'])) {
    // Redirect to login page or handle unauthorized access
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Courses</title>
  <link rel="stylesheet" href="./courses.css">
  <link rel="icon" href="ico.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'poppins', sans-serif;
        font-size: 18px;
    }
    body {
        margin: 20vh;
        
    }
    .container {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .sidebar {
        width: 25%;
        border-radius: 3px;
        padding: 15px;
        height: 120vh;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .fa-circle {
        color: #191671;
    }
    .searchBar {
        width: 100%;
        background-color: #fff;
        border-radius: 3px;
        padding: 3px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: 3px solid #000;

    }
    input {
        border: none;
        outline: none;
        background: none;
    }
    .glass:hover {
        color: #191671;
        cursor: pointer;
    }
    .social-icons {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .fa-brands {
        font-size: 25px;
        margin: 0 10px;
        color: #333;
        cursor: pointer;
    }
    .fa-brands:hover {
        color: #191671;
    }
    .data {
        width: 73%;
        border-radius: 3px;
        height: 121vh;
        overflow-y: auto;
    }
    
    #root {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 2px;
    }
    .box {
        margin: 1px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        border: 1px solid #333;
        border-radius: 5px;
        padding: 15px;
    }
    .img-box {
        width: 100%;
        height: 176px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .images {
        max-height: 90%;
        max-width: 90%;
        object-fit: cover;
        object-position: center;
    }
    .bottom {
        margin-top: 20px;
        width: 100%;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        height: 110px;
    }
    h2 {
        font-size: 20px;
        color: #191671;
    }
    button {
        width: 100%;
        position: relative;
        border: none;
        border-radius: 5px;
        background-color: #191671;
        padding: 7px 25px;
        cursor: pointer;
        color: #e5e6ed;
    }
    button:hover {
        background-color: #191671;
    }
    ::-webkit-scrollbar {
        display: none;
    }
    .search-bar {
        margin-bottom: 20px;
    }
    .search-bar input[type="text"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
    }
    .search-bar button {
        padding: 10px 15px;
        background-color: #191671;
        border: none;
        border-radius: 5px;
        color: #fff;
        cursor: pointer;
    }
    
</style>
<script src="https://kit.fontawesome.com/e8fa2e31b4.js" crossorigin="anonymous"></script>
<script>
    function searchCourses() {
      var input, filter, boxes, box, title, i;
      input = document.getElementById("searchInput");
      filter = input.value.toUpperCase();
      boxes = document.getElementsByClassName("box");

      for (i = 0; i < boxes.length; i++) {
        box = boxes[i];
        title = box.getElementsByTagName("p")[0];
        if (title.innerHTML.toUpperCase().indexOf(filter) > -1) {
          box.style.display = "";
        } else {
          box.style.display = "none";
        }
      }
    }
  </script>
</head>
<body>
<header id="header">
    <a href="#" class="logo">Programming Platform </a>
    <ul>
      <li><a href="courses.php" class="active">Courses</a></li>
      <li><a href="stueditprofile.php">Edit Profile</a></li>
      <li><a href="logout.php" >Logout</a></li>
    </ul>
  </header>
  <div class="search-bar">
    <input type="text" id="searchInput" onkeyup="searchCourses()" placeholder="Search courses...">
    <button onclick="searchCourses()">Search</button>
  </div>
  <link rel="stylesheet" href="./courses.css">
<link rel="icon" href="ico.ico" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>

  <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
  <script src="./script.js"></script>
	
  <div class='learning' align='center'>
<?php 
$q = "SELECT * FROM courses";  
$res = mysqli_query($conn, $q) or die("Error in the query: $q" . mysqli_error($conn));

while ($row = mysqli_fetch_assoc($res)) {
    $courses_id = $row['courses_id'];
    $courses_name = $row['courses_name'];
    $courses_level = $row['courses_level'];
    $planguage = $row['planguage'];
    $image = $row['image'];
    $imageFile = 'uploads/' . $image;

    echo "<div class='box'>";
    echo "<div class='img-box'>";
    echo "<img src='" . htmlspecialchars($imageFile ?? '') . "' alt='Course Image' class='images'>";
    echo "</div>";
    echo "<div class='bottom'>";
    echo "<p>$courses_name</p>";
    echo "<button onclick=\"window.location.href='view.php?course_id=$courses_id'\">View</button>";
    echo "</div>";
    echo "</div>";
}
?>
</div>

</body>
</html>
