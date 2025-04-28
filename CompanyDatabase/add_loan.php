<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Loan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <h1>Add New Loan</h1>
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
            <form action="save_loan.php" method="post">
                <div class="form-group">
                    <label for="eid">Employee:</label>
                    <select id="eid" name="eid" required>
                        <option value="">Select Employee</option>
                        <?php
                        $sql = "SELECT * FROM EmployeeInfo";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='".$row["Eid"]."'>".$row["Name"]." (ID: ".$row["Eid"].")</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="loanamount">Loan Amount:</label>
                    <input type="number" step="0.01" id="loanamount" name="loanamount" required>
                </div>
                
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required>
                </div>
                
                <button type="submit" class="btn">Save Loan</button>
            </form>
            
            <a href="loans.php" class="back-link">Back to Loan List</a>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>