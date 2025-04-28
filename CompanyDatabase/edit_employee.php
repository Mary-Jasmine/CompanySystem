<?php
include 'config.php';

$eid = $_GET['id'];
$sql = "SELECT * FROM EmployeeInfo WHERE Eid = $eid";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <h1>Edit Employee</h1>
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
            <form action="update_employee.php" method="post">
                <input type="hidden" name="eid" value="<?php echo $row['Eid']; ?>">
                
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $row['Name']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="position">Position:</label>
                    <input type="text" id="position" name="position" value="<?php echo $row['Position']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="salary">Salary:</label>
                    <input type="number" step="0.01" id="salary" name="salary" value="<?php echo $row['Salary']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" value="<?php echo $row['Age']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo $row['Address']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="deptcode">Department:</label>
                    <select id="deptcode" name="deptcode" required>
                        <?php
                        $dept_sql = "SELECT * FROM DepartmentInfo";
                        $dept_result = $conn->query($dept_sql);
                        while($dept_row = $dept_result->fetch_assoc()) {
                            $selected = ($dept_row["DeptCode"] == $row["DeptCode"]) ? "selected" : "";
                            echo "<option value='".$dept_row["DeptCode"]."' $selected>".$dept_row["DeptDescription"]."</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <button type="submit" class="btn">Update Employee</button>
            </form>
            
            <a href="index.php" class="back-link">Back to Employee List</a>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>