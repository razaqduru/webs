<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Secure Website</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?>!</h1>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
        
        <div class="content">
            <p>This is a project done by our group members:</p>
            
            <table class="members-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Registration Number</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Member 1</td>
                        <td>REG001</td>
                    </tr>
                    <tr>
                        <td>Member 2</td>
                        <td>REG002</td>
                    </tr>
                    <tr>
                        <td>Member 3</td>
                        <td>REG003</td>
                    </tr>
                    <tr>
                        <td>Member 4</td>
                        <td>REG004</td>
                    </tr>
                </tbody>
            </table>
            
            <div class="project-info">
                <h2>About This Project</h2>
                <p>This secure website demonstrates user authentication with PHP and MySQL. It includes:</p>
                <ul>
                    <li>User registration with password validation</li>
                    <li>Secure login system</li>
                    <li>Password protection for the home page</li>
                    <li>Responsive design</li>
                    <li>Password visibility toggle</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>