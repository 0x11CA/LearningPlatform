<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Course</title>
  <link rel="stylesheet" href="./logincss.css">
  <link rel="icon" href="ico.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    table {
      width: 70%;
      margin: 0 auto;
      background: #FFFFFF;
    }
    table th, table td {
      padding: 5px;
      border: 3px solid #000000;
      text-align: center;
    }
    table th {
      background: #FFFFFF;
    }
    table td a {
      color: red;
    }
  </style>
</head>
<body>
<header id="header">
    <a href="#" class="logo">Programming Platform</a>
    <ul>
      <li><a href="addcourse.php">Add</a></li>
      <li><a href="updatecourse.php"class="active">Update</a></li>
      <li><a href="deletecourse.php">Delete</a></li>
      <li><a href="editprofile.php">Edit profile</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
</header>

<br /><br /><br /><br />

<table>
  <tr>
    <th>Course id</th>
    <th>Course Name</th>
    <th>Course Level</th>
    <th>Language</th>
    <th>Action</th>
  </tr>
  
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
  
  $q = "SELECT * FROM courses";  
  $res = mysqli_query($conn, $q) or die("Error in the query: $q" . mysqli_error($conn));
  
  while ($row = mysqli_fetch_assoc($res)) {
    $courses_id = $row['courses_id'];
    $courses_name = $row['courses_name'];
    $courses_level = $row['courses_level'];
    $planguage = $row['planguage'];
  
    echo "<tr>";
    echo "<td>$courses_id</td>";
    echo "<td>$courses_name</td>";
    echo "<td>$courses_level</td>";
    echo "<td>$planguage</td>";
    echo "<td><a href='update.php?id={$row['courses_id']}' onclick=\"return confirm('Are you sure you want to update this course?');\">Update</a></td>";
    echo "</tr>";
  }
  
  ?>
  
</table>

</body>
</html>