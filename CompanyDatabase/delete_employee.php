<?php
include 'config.php';

$eid = $_GET['id'];

$delete_loans = "DELETE FROM Loan WHERE Eid = $eid";
$conn->query($delete_loans);

$delete_employee = "DELETE FROM EmployeeInfo WHERE Eid = $eid";

if ($conn->query($delete_employee)) {
    header("Location: index.php");
    exit();
} else {
    echo "Error deleting employee: " . $conn->error;
}

$conn->close();
?>