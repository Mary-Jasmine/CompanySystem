<?php include 'config.php'; 
define('SEARCH_TERM', isset($_GET['search']) ? trim($_GET['search']) : '');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Employee Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <h1>Employee Management System</h1>
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
            
        <h2>Employee List</h2>
        <div class="card">
            <div class="search-container">
                <form method="GET" action="">
                    <input type="text" name="search" placeholder="Search by ID, Name, or DeptCode" 
                           value="<?php echo htmlspecialchars(SEARCH_TERM); ?>">
                    <button type="submit" class="btn">Search</button>
                    <?php if (!empty(SEARCH_TERM)): ?>
                        <a href="index.php" class="btn btn-clear">Clear</a>
                    <?php endif; ?>
                </form>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Salary</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_query = "SELECT e.*, d.DeptDescription 
                                 FROM EmployeeInfo e 
                                 LEFT JOIN DepartmentInfo d ON e.DeptCode = d.DeptCode";
                    
                    if (!empty(SEARCH_TERM)) {
                        $sql_query .= " WHERE e.Eid LIKE ? 
                                       OR e.Name LIKE ? 
                                       OR e.Position LIKE ?
                                       OR e.DeptCode LIKE ?";
                        $prepared_statement = $conn->prepare($sql_query);
                        $search_parameter = "%" . SEARCH_TERM . "%";
                        $prepared_statement->bind_param("ssss", $search_parameter, $search_parameter, $search_parameter, $search_parameter);
                        $prepared_statement->execute();
                        $query_result = $prepared_statement->get_result();
                    } else {
                        $query_result = $conn->query($sql_query);
                    }
                
                    if ($query_result->num_rows > 0) {
                        while($employee_record = $query_result->fetch_assoc()) {
                            echo "<tr>
                                <td>" . $employee_record["Eid"] . "</td>
                                <td>" . $employee_record["Name"] . "</td>
                                <td>" . $employee_record["Position"] . "</td>
                                <td>" . number_format($employee_record["Salary"], 2) . "</td>
                                <td>" . $employee_record["Age"] . "</td>
                                <td>" . $employee_record["Address"] . "</td>
                                <td>" . $employee_record["DeptDescription"] . "</td>
                                <td class='action-links'>
                                    <a href='employee_loans.php?id=" . $employee_record["Eid"] . "' class='btn btn-view'>View</a>
                                    <a href='edit_employee.php?id=" . $employee_record["Eid"] . "' class='btn'>Edit</a> | 
                                    <a href='delete_employee.php?id=" . $employee_record["Eid"] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='empty-message'>No employees found" . (!empty(SEARCH_TERM) ? " matching your search" : "") . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php 

if(isset($prepared_statement)) { 
    $prepared_statement->close(); 
}
$conn->close(); 
?>