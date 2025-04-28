<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <h1>Add New Employee</h1>
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
            <br><br>
            <form action="save_employee.php" method="post">
                <div class="form-group">
                    <label for="eid">Employee ID:</label>
                    <input type="number" id="eid" name="eid" required>
                </div>
                
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="position">Position:</label>
                    <input type="text" id="position" name="position" required>
                </div>
                
                <div class="form-group">
                    <label for="salary">Salary:</label>
                    <input type="number" step="0.01" id="salary" name="salary" required>
                </div>
                
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" required>
                </div>
                
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required>
                </div>
                
                <div class="form-group">
                    <label for="deptcode">Department:</label>
                    <select id="deptcode" name="deptcode" required>
                        <option value="">Select Department</option>
                        <?php
                        $sql = "SELECT * FROM DepartmentInfo";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='".$row["DeptCode"]."'>".$row["DeptDescription"]."</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <button type="submit" class="btn">Save Employee</button>
            </form>
            
            <a href="index.php" class="back-link">Back to Employee List</a>
        </div>
    </div>
</body>
</html>