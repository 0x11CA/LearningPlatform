<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link rel="stylesheet" href="./courses.css">
    <link rel="icon" href="ico.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .image {
            width: 318px;
            height: 420px;
            border: 10px dotted crimson;
        }

        .all {
            background-color: aliceblue;
            padding: 20px;
        }

        .Details {
            justify-content: space-around;
            align-items: auto;

        }

        .Details .text {
            width: 675px;
        }

        h6 {
            font-size: 30px;
            margin: 5px;
            color: #191671;
            font-family: math;
        }

        p {
            padding-left: 20px;
        }

        video {
            margin: 20px 269px 30px;
        }

        h2 {
            margin-left: 397px;
            color: #716d6d;
        }

        .landing {
            min-height: 50px !important;
        }

        .btn {
            margin-left: 582px;
            margin-top: 20px;
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

        a {
            text-decoration: none;
        }

        .grid {
            max-width: 1300px;
            height: 100%;
            margin: 0 auto;
            padding: 10px 1em;
            display: -ms-grid;
            display: block;
            -ms-grid-columns: (1fr)[3];
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .grid iframe {
            width: 100%;
            height: 500px;
        }
    </style>
</head>

<body>
    <header id="header">
        <a href="#" class="logo">Programming Platform</a>
        <ul>
            <li><a href="courses.php" class="active">Courses</a></li>
            <li><a href="feedback.php?course_id=<?php echo $_GET['course_id']; ?>">Feedback</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </header>
    <div class="landing">
        <div class="overlay"> </div>
        <div class="text">
        </div>
    </div>
    <br /><br /><br /><br />

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

    $courses_id = $_GET['course_id'];

    $q = "SELECT * FROM courses WHERE courses_id = '$courses_id'";
    $res = mysqli_query($conn, $q) or die("Error in the query: $q" . mysqli_error($conn));

    while ($row = mysqli_fetch_assoc($res)) {
        $courses_name = $row['courses_name'];
        $courses_level = $row['courses_level'];
        $planguage = $row['planguage'];
        $image = $row['image'];
        $imageFile = 'uploads/' . $image;
        $video = $row['video'];
        $final = str_replace('watch?v=', 'embed/', $video);
        $explanation = $row['explanation'];
        $prerequisites = $row['prerequisites'];
        $Test_question = $row['Test_question'];
        $choise_one = $row['choise_one'];
        $choise_tow = $row['choise_tow'];
        $choise_three = $row['choise_three'];
        $correct_answer = $row['correct_answer'];
    }
    ?>
    <div class="container" id="container">
        <div class="data">
            <div class="all">
                <div class="Details">
                    <div class="text">
                        <h6>Course Name:</h6>
                        <p>
                            <?php echo $courses_name; ?>
                        </p>
                        <h6>Course Level:</h6>
                        <p>
                            <?php echo $courses_level; ?>
                        </p>
                        <h6>Programming Language:</h6>
                        <p>
                            <?php echo $planguage; ?>
                        </p>
                        <h6>Course Description:</h6>
                        <p>
                            <?php echo $explanation; ?>
                        </p>
                        <h6>Prerequisites:</h6>
                        <p>
                            <?php echo $prerequisites; ?>
                        </p>
                    </div>
                </div>
                <hr />

                <div class="grid">
                    <?php echo "
                    <iframe
                        src='$final'
                        frameborder='0'
                        allow='autoplay; encrypted-media'
                        allowfullscreen>
                    </iframe>
                ";
                    ?>
                </div>
                <h2>The Video Explanation More About :
                    <?php echo $courses_name ?>
                </h2>
                <br /><br />
                <hr />

                <br /><br />
                <div class="container" id="container">
                    <div class="form-container sign-in-container">
                    <h6>Question:</h6>
                    <p>
                        <?php echo $Test_question ?>??
                    </p>
                    <form action="check_Answer.php?id=<?php echo $courses_id ?>&amp;courses_id=<?php echo $courses_id ?>" method="POST">
                        <p><input type="radio" name="choise" value="<?php echo $choise_one ?>" required> <?php echo $choise_one ?></p>
                        <p><input type="radio" name="choise" value="<?php echo $choise_tow ?>" required> <?php echo $choise_tow ?></p>
                        <p><input type="radio" name="choise" value="<?php echo $choise_three ?>" required> <?php echo $choise_three ?></p>
                        <button type="submit" value="Submit">Submit</button>
                        <hr />
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</body>

</html>