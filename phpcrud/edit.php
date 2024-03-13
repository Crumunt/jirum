<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "update") {
    $update_id = $_POST["update_id"];
    $name = $_POST["name"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $gpa = $_POST["gpa"];

    $update_sql = "UPDATE student SET name='$name', age='$age', email='$email', gpa='$gpa' WHERE id=$update_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    header("Location: ".$_SERVER['REQUEST_URI']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Edit Record</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
<?php

if (isset($_GET["id"])) {
    $update_id = $_GET["id"];
    $sql = "SELECT * FROM student WHERE id = $update_id";
    $query_result = $conn->query($sql);
    if ($query_result && $query_result->num_rows > 0) {
        $row = $query_result->fetch_assoc();
        ?>
        
        <div class="container">
        <div class="box form-box">
            <h2>Edit Record</h2>
            <form action="" method="post">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="update_id" value="<?php echo $row['id']; ?>">
                
                <div class = "field input">
                <h3>Full name</h3>
                <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>"><br>
                </div>

                <div class = "field input">
                <h3>Age</h3>
                <input type="text" id="age" name="age" value="<?php echo $row['age']; ?>"><br>
                </div>
                
                <div class = "field input">
                <h3>Email</h3>
                <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>"><br>
                </div>
                
                <div class = "field input">
                <h3>GPA</h3>
                <input type="text" id="gpa" name="gpa" value="<?php echo $row['gpa']; ?>"><br>
                </div>

                <input type="submit" value="Update" class="btn">
            </form>
        </div>
        </div>

        
    <div class="logout-container">
    <form action="admincrud.php" method="post">
        <input type="submit" name="logout" class="btn" value="Go Back">
    </form>
    </div>

        <?php
    } else {
        echo "No record found for ID: $update_id";
    }
}
?>

</body>
</html>
