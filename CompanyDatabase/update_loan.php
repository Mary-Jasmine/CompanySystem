<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loanid = $_POST['loanid'];
    $eid = $_POST['eid'];
    $loanamount = $_POST['loanamount'];
    $date = $_POST['date'];
    
    $sql = "UPDATE Loan 
            SET Eid='$eid', LoanAmount='$loanamount', Date='$date'
            WHERE LoanID=$loanid";
    
    if ($conn->query($sql)) {
        header("Location: loans.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>