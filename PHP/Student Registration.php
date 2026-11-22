CREATE DATABASE student_db;
USE student_db;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    email VARCHAR(50),
    phone VARCHAR(15),
    course VARCHAR(30)
);
<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
</head>
<body>
    <h2>Student Registration Form</h2>

    <form method="POST" action="">
        Name:
        <input type="text" name="name"
               value="<?php echo htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES); ?>">
        <br><br>

        Email:
        <input type="email" name="email"
               value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES); ?>">
        <br><br>

        Phone:
        <input type="text" name="phone"
               value="<?php echo htmlspecialchars($_POST['phone'] ?? '', ENT_QUOTES); ?>">
        <br><br>

        Course:
        <input type="text" name="course"
               value="<?php echo htmlspecialchars($_POST['course'] ?? '', ENT_QUOTES); ?>">
        <br><br>

        <input type="submit" name="submit" value="Register">
    </form>

    <?php
    $conn = mysqli_connect("localhost", "root", "", "student_db");

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $course = $_POST['course'];

        $sql = "INSERT INTO students (name, email, phone, course)
                VALUES (?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $course);

            if (mysqli_stmt_execute($stmt)) {
                echo "<p>Registration successful.</p>";
            } else {
                echo "<p>Registration failed.</p>";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "<p>Could not prepare the registration query.</p>";
        }
    }

    mysqli_close($conn);
    ?>
</body>
</html>
