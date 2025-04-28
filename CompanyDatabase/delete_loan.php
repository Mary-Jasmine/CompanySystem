<?php
include 'config.php';

$loanid = $_GET['id'];
$sql = "DELETE FROM Loan WHERE LoanID = $loanid";

if ($conn->query($sql)) {
    header("Location: loans.php");
    exit();
} else {
    echo "Error deleting loan: " . $conn->error;
}

$conn->close();
?>