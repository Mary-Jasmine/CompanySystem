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
    
    $sql = "UPDATE EmployeeInfo 
            SET Name='$name', Position='$position', Salary='$salary', 
                Age='$age', Address='$address', DeptCode='$deptcode'
            WHERE Eid=$eid";
    
    if ($conn->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>  