<?php
session_start();
include 'config.php';
if (!isset($_SESSION['student_name'])) {
    header('Location: index.php');
    exit;
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM student WHERE id = " . $_SESSION['user_id'];
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    </style>
    <title>View Records</title>
</head>
<body>

    
<div class="container">
    <div class="box form-box1">
    <h2 style="text-align: center;">Student View Record</h2>
    
    <div class="filter">

    </div>

    <table>
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Email</th>
            <th>GPA</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["age"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["gpa"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No records found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    
    <div class="logout-container">
    <form action="logout.php" method="post">
        <input type="submit" name="logout" class="btn" value="Logout">
    </form>
    </div>
    </div>
</div>

</body>
</html>
