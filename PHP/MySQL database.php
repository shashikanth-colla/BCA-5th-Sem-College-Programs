CREATE DATABASE `college 1`;
USE `college 1`;

CREATE TABLE student (
    name VARCHAR(50),
    age INT
);
<!DOCTYPE html>
<html>
<head>
    <title>Student Form</title>
</head>
<body>
    <h2>Student Form</h2>

    <form method="POST" action="">
        Name: <input type="text" name="name" required><br><br>
        Age: <input type="number" name="age" required><br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $con = mysqli_connect("localhost", "root", "", "college 1");

        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $name = $_POST['name'];
        $age = (int) $_POST['age'];

        $stmt = mysqli_prepare(
            $con,
            "INSERT INTO student (name, age) VALUES (?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "si", $name, $age);

        if (mysqli_stmt_execute($stmt)) {
            echo "Record inserted successfully";
        } else {
            echo "Error inserting record";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($con);
    }
    ?>
</body>
</html>
