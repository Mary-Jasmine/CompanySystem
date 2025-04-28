<?php include 'config.php';

// Get employee ID from URL
$eid = isset($_GET['id']) ? $_GET['id'] : 0;

// Get employee details
$employee_sql = "SELECT e.*, d.DeptDescription 
                 FROM EmployeeInfo e 
                 LEFT JOIN DepartmentInfo d ON e.DeptCode = d.DeptCode 
                 WHERE e.Eid = $eid";
$employee_result = $conn->query($employee_sql);
$employee = $employee_result->fetch_assoc();

// Get loan details for this employee
$loan_sql = "SELECT * FROM Loan WHERE Eid = $eid ORDER BY Date DESC";
$loan_result = $conn->query($loan_sql);
$total_loan = 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Employee Loan Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <h1>Employee's Loan Information</h1>
            </div>
        </div>
    </header>
    
    <div class="container">
        <div class="nav">
            <a href="index.php">Employees</a>
            <a href="loans.php">Loans</a>
            <a href="add_employee.php">Add Employee</a>
            <a href="add_loan.php">Add Loan</a>
        </div>
        
        <div class="card">
            <h2>Employee Details</h2>
            
            <div class="employee-details">
                <p><strong>Employee ID:</strong> <?php echo $employee['Eid']; ?></p>
                <p><strong>Name:</strong> <?php echo $employee['Name']; ?></p>
                <p><strong>Department Code:</strong> <?php echo $employee['DeptCode']; ?></p>
                <p><strong>Department Description:</strong> <?php echo $employee['DeptDescription']; ?></p>
            </div>
            
            <h3>Loan Breakdown</h3>
            <table>
                <thead>
                    <tr>
                        <th>Loan Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($loan_result->num_rows > 0) {
                        while($loan = $loan_result->fetch_assoc()) {
                            $total_loan += $loan['LoanAmount'];
                            echo "<tr>
                                <td>₱".number_format($loan['LoanAmount'], 2)."</td>
                                <td>".$loan['Date']."</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>No loan records found</td></tr>";
                    }
                    ?>
                </tbody>
                <tfoot>
                       <div class="Loan-breakdown">
                        <th>Total Loan Amount</th>
                        <th>₱<?php echo number_format($total_loan, 2); ?></th>
                        </div>
                </tfoot>
            </table>
            
            <a href="index.php" class="back-link">Back to Employee List</a>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>