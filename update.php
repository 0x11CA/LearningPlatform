<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['adminid'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: adminlogin.php");
    exit;
}

$adminid = $_SESSION['adminid'];

// Database connection code here
$servername = "localhost";
$username = "abc";
$password = "abc123";
$dbname = "learning";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET['id'])) {
        $courses_id = $_GET['id'];

        $stmt = $conn->prepare("SELECT * FROM courses WHERE courses_id=?");
        $stmt->bind_param("s", $courses_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $courses_name = $row['courses_name'];
            $courses_level = $row['courses_level'];
            $planguage = $row['planguage'];
            $image = $row['image'];
            $imageFile = 'uploads/' . $image;
            $video_link = $row['video'];
            $explanation = $row['explanation'];
            $prerequisites = $row['prerequisites'];
            $Test_question = $row['Test_question'];
            $choise_one = $row['choise_one'];
            $choise_tow = $row['choise_tow'];
            $choise_three = $row['choise_three'];
            $correct_answer = $row['correct_answer'];
        } else {
            // Handle course not found
            // Redirect or display an error message
        }
    } else {
        // Handle invalid or missing course ID
        // Redirect or display an error message
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" enctype="multipart/form-data">
    <title>Update Course</title>
    <link rel="stylesheet" href="./logincss.css">
    <link rel="icon" href="ico.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .alb {
            text-align: center;
            margin-top: 20px;
        }

        .course-image {
            width: 100px;
            /* Set the desired width */
            height: auto;
            /* Automatically adjust the height */
        }
        .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .form-container {
        width: 500px;
        height: 500px;
        padding: 20px;
        background-color: #f2f2f2;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    .table-container {
    height: 410px; /* Adjust the height as needed */
    overflow: auto;
}
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<header id="header">
    <a href="#" class="logo">Programming Platform</a>
    <ul>
    <li><a href="addcourse.php">Add</a></li>
        <li><a href="updatecourse.php" class="active">Update</a></li>
        <li><a href="deletecourse.php">Delete</a></li>
        <li><a href="editprofile.php">Edit profile</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</header>

<div id="container">
    <div>
        <form method="post" action="update.php" enctype="multipart/form-data">
            <h1>Update</h1>
            <div class="form-element">
            <div class="table-container">

                <table>
                    <tr>
                        <td>
                            <input type="text" name="courses_id" placeholder="ID" readonly
                                   value="<?php if (!empty($courses_id)) echo htmlspecialchars($courses_id); ?>">
                        </td>
                        <td>
                            <input type="text" name="courses_name" placeholder="Course name" required
                                   value="<?php if (!empty($courses_name)) echo htmlspecialchars($courses_name); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="courses_level" placeholder="Course level" required>
                                <option value="Beginner" <?php if (!empty($courses_level) && $courses_level == "Beginner") echo "selected"; ?>>Beginner</option>
                                <option value="Intermediate" <?php if (!empty($courses_level) && $courses_level == "Intermediate") echo "selected"; ?>>Intermediate</option>
                                <option value="Advanced" <?php if (!empty($courses_level) && $courses_level == "Advanced") echo "selected"; ?>>Advanced</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" name="planguage" placeholder="Language" required
                                   value="<?php if (!empty($planguage)) echo htmlspecialchars($planguage); ?>">
                        </td>
                    </tr>
                    <tr>
    <td colspan="2">
        <div class="alb">
            <img src="<?php echo htmlspecialchars($imageFile ?? ''); ?>" alt="Course Image" class="course-image">
        </div>
    </td>
</tr>
                    <tr>
                        <td>
        <input type="text" name="video_link" placeholder="YouTube Video Link" required value="<?php if (!empty($video_link)) echo htmlspecialchars($video_link); ?>">
    </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <textarea name="explanation" placeholder="Description" rows="4" required><?php if (!empty($explanation)) echo htmlspecialchars($explanation); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <textarea name="prerequisites" placeholder="prerequisites" rows="4" required><?php if (!empty($prerequisites)) echo htmlspecialchars($prerequisites); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <textarea name="Test_question" placeholder="Test Question" rows="4" required><?php if (!empty($Test_question)) echo htmlspecialchars($Test_question); ?></textarea>
                            </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="choise_one" placeholder="Choice One" required
                                   value="<?php if (!empty($choise_one)) echo htmlspecialchars($choise_one); ?>">
                        </td>
                        <td>
                            <input type="text" name="choise_tow" placeholder="Choice Two" required
                                   value="<?php if (!empty($choise_tow)) echo htmlspecialchars($choise_tow); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="choise_three" placeholder="Choice Three" required
                                   value="<?php if (!empty($choise_three)) echo htmlspecialchars($choise_three); ?>">
                        </td>
                        <td>
                            <input type="text" name="correct_answer" placeholder="Correct Answer" required
                                   value="<?php if (!empty($correct_answer)) echo htmlspecialchars($correct_answer); ?>">
                        </td>
                    </tr>
                </table>
                <button type="submit" name="update">Update Course</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
<?php
// Handle form submission and update the database
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Get form data
  $courses_id = $_POST['courses_id'];
  $courses_name = $_POST['courses_name'];
  $courses_level = $_POST['courses_level'];
  $planguage = $_POST['planguage'];
  $video_link = $_POST['video_link'];
  $explanation = $_POST['explanation'];
  $prerequisites = $_POST['prerequisites'];
  $Test_question = $_POST['Test_question'];
  $choise_one = $_POST['choise_one'];
  $choise_tow = $_POST['choise_tow'];
  $choise_three = $_POST['choise_three'];
  $correct_answer = $_POST['correct_answer'];


  // Check if new course chapter image is uploaded
  $updateRequired = !empty($video_link) ||
                    !empty($explanation) ||
                    !empty($prerequisites) ||
                    !empty($Test_question) ||
                    !empty($choise_one) ||
                    !empty($choise_tow) ||
                    !empty($choise_three) ||
                    !empty($correct_answer);

  // Prepare and execute the update statement if required
  if ($updateRequired) {
    if (empty($video_link)) {
        // Insert into database
        $stmt = $conn->prepare("INSERT INTO courses ( video, explanation, prerequisites, Test_question, choise_one, choise_tow, choise_three, correct_answer) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $video_link, $explanation, $prerequisites, $Test_question, $choise_one, $choise_tow, $choise_three, $correct_answer);
    } else {
        // Update in database
        $stmt = $conn->prepare("UPDATE courses SET courses_name=?, courses_level=?, planguage=?, video=?, explanation=?, prerequisites=?, Test_question=?, choise_one=?, choise_tow=?, choise_three=?, correct_answer=? WHERE courses_id=?");
        $stmt->bind_param("ssssssssssss", $courses_name, $courses_level, $planguage, $video_link, $explanation, $prerequisites, $Test_question, $choise_one, $choise_tow, $choise_three, $correct_answer, $courses_id);
    }

    $stmt->execute();

    // Check if the insert/update was successful
    if ($stmt->affected_rows === 1) {
        // Redirect to a success page or display a success message
        echo '<script type="text/javascript">'; 
        $URL="updatecourse.php";
        echo "location.href='$URL'";
        echo '</script>';
                        exit;
    } else {
        // Handle update error
        // Redirect or display an error message
    }
  } else {
    // No update required, redirect to success page
    echo '<script type="text/javascript">'; 
    $URL="updatecourse.php";
    echo "location.href='$URL'";
    echo '</script>';
        exit;
  }
}
?>