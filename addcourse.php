<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Course</title>
  <link rel="stylesheet" href="./logincss.css">
  <link rel="icon" href="ico.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<header id="header">
    <a href="#" class="logo">Programming Platform</a>
    <ul>
      <li><a href="addcourse.php" class="active">Add</a></li>
      <li><a href="updatecourse.php">Update</a></li>
      <li><a href="deletecourse.php">Delete</a></li>
      <li><a href="editprofile.php">Edit profile</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
</header>
<style>

form {
  margin: 25px center;
    padding: 20px center;
    border: 5px solid #ffffff;
    width: 500px center;
    background:#ffffff;
}




</style>

<div class="container" id="container">
  <form method="post" action="addcourse.php" enctype="multipart/form-data">
    <div class="form-element">
      <label>Courses Name</label>
      <input type="text" name="courses_name" required />
    </div>
    <div class="form-element">
      <label>Courses Language</label>
      <input type="text" name="planguage" required />
    </div>
    <div class="form-element">
      <label>Courses Level</label>
      <select name="courses_level" id="courses_level" required>
        <option value="">Select</option>
        <option value="Beginner">Beginner</option>
        <option value="Intermediate">Intermediate</option>
        <option value="Advanced">Advanced</option>
      </select>
    </div>
    <br>
    <div class="form-element">
      <label>Choose Picture</label>
      <input type="file" name="my_image" />
    </div>
    <br>

    <div class="form-element">

      <button type="submit" name="Register">Add</button>
      <button type="reset" name="Cancel">Cancel</button>
    </div>
  </form>
</div>

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

session_start();

if (isset($_POST['Register'])) {
  $courses_name = $_POST['courses_name'];
  $courses_level = $_POST['courses_level'];
  $planguage = $_POST['planguage'];

  $img_name = $_FILES['my_image']['name'];
  $img_size = $_FILES['my_image']['size'];
  $tmp_name = $_FILES['my_image']['tmp_name'];
  $error = $_FILES['my_image']['error'];

  if ($error === 0) {
    if ($img_size > 125000) {
      echo "<script>alert('Sorry, your file is too large.')</script>";
    } else {
      $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
      $img_ex_lc = strtolower($img_ex);
      $allowed_exs = array("jpg", "jpeg", "png");

      if (in_array($img_ex_lc, $allowed_exs)) {
        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
        $img_upload_path = 'uploads/' . $new_img_name;
        move_uploaded_file($tmp_name, $img_upload_path);

        $stmt = $conn->prepare("INSERT INTO courses (courses_name, courses_level, planguage, image) VALUES (?, ?, ?, ?)");
        
        $stmt->bind_param("ssss", $courses_name, $courses_level, $planguage, $new_img_name);

        if ($stmt->execute()) {
          echo "<script>alert('Course registration successful.')</script>";
        } else {
          echo "<script>alert('Error: " . $stmt->error . "')</script>";
        }
      } else {
        echo "<script>alert('You can't upload files of this type.')</script>";
      }
    }
  } else {
    echo "<script>alert('Unknown error occurred!')</script>";
  }

}

$conn->close();
?>