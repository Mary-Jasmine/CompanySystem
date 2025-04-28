<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eid = $_POST['eid'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $deptcode = $_POST['deptcode'];
    
    $sql = "INSERT INTO EmployeeInfo (Eid, Name, Position, Salary, Age, Address, DeptCode)
            VALUES ('$eid', '$name', '$position', '$salary', '$age', '$address', '$deptcode')";
    
    if ($conn->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>