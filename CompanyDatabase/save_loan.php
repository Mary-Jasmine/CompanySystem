<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eid = $_POST['eid'];
    $loanamount = $_POST['loanamount'];
    $date = $_POST['date'];
    
    $sql = "INSERT INTO Loan (Eid, LoanAmount, Date)
            VALUES ('$eid', '$loanamount', '$date')";
    
    if ($conn->query($sql)) {
        header("Location: loans.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>