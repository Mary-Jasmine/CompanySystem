<?php
include 'config.php';

$loanid = $_GET['id'];
$sql = "SELECT * FROM Loan WHERE LoanID = $loanid";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Loan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <h1>Edit Loan</h1>
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
            <form action="update_loan.php" method="post">
                <input type="hidden" name="loanid" value="<?php echo $row['LoanID']; ?>">
                
                <div class="form-group">
                    <label for="eid">Employee:</label>
                    <select id="eid" name="eid" required>
                        <?php
                        $emp_sql = "SELECT * FROM EmployeeInfo";
                        $emp_result = $conn->query($emp_sql);
                        while($emp_row = $emp_result->fetch_assoc()) {
                            $selected = ($emp_row["Eid"] == $row["Eid"]) ? "selected" : "";
                            echo "<option value='".$emp_row["Eid"]."' $selected>".$emp_row["Name"]." (ID: ".$emp_row["Eid"].")</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="loanamount">Loan Amount:</label>
                    <input type="number" step="0.01" id="loanamount" name="loanamount" value="<?php echo $row['LoanAmount']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" value="<?php echo $row['Date']; ?>" required>
                </div>
                
                <button type="submit" class="btn">Update Loan</button>
            </form>
            
            <a href="loans.php" class="back-link">Back to Loan List</a>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>