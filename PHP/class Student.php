
<?php
class Student
{
    // Constructor
    function __construct()
    {
        echo "Constructor is called.<br>";
    }

    // Display function
    function display()
    {
        echo "Welcome to PHP Programming.<br>";
    }

    // Destructor
    function __destruct()
    {
        echo "Destructor is called.";
    }
}

$obj = new Student();
$obj->display();
?>
