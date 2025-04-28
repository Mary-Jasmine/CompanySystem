<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Loan Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <h1>Loan Management</h1>
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
            <h2>Loan Records</h2>
            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Loan Amount</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT l.*, e.Name 
                            FROM Loan l 	
                            LEFT JOIN EmployeeInfo e ON l.Eid = e.Eid";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>".$row["Eid"]."</td>
                                <td>".$row["Name"]."</td>
                                <td>".$row["LoanAmount"]."</td>
                                <td>".$row["Date"]."</td>
                               <td class='action-links'>
    <a href='edit_employee.php?id=".$row["Eid"]."' class='btn'>Edit</a> | 
    <a href='delete_employee.php?id=".$row["Eid"]."' class='btn btn-danger' onclick='return confirm(\"Are you sure?\");'>Delete</a>
</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='empty-message'>No loan records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>