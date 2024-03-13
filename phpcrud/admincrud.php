<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if (!isset($_SESSION['admin_name'])) {
    header("location: index.php");
    exit();
}

// Pagination variables
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 5;
$start = ($page - 1) * $limit;

$result = null;

$sql = "SELECT * FROM student LIMIT $start, $limit";
$query_result = $conn->query($sql);

if ($query_result) {
    $result = $query_result;
} else {
    echo "Error executing query: " . $conn->error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "delete") {
    $delete_id = $_POST["delete_id"];
    $delete_sql = "DELETE FROM student WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "update") {
    $update_id = $_POST["update_id"];
    $name = $_POST["name"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $gpa = $_POST["gpa"];

    $update_sql = "UPDATE student SET name='$name', age='$age', email='$email', gpa='$gpa' WHERE id=$update_id";

    if ($conn->query($update_sql) === TRUE) {
        $_SESSION['updateState'] = "confirmed";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Records</title>
    <link rel="stylesheet" href="style.css">
    <style>
         .pagination-container {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            display: inline-block;
            padding: 8px 16px;
            text-decoration: none;
            color: #000;
            background-color: #f2f2f2;
            border-radius: 5px;
            margin: 0 5px;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }

    </style>
</head>

<body>

    <?php
    if (isset($_SESSION['updateState'])) {
        echo "<script>alert('Record updated successfully');</script>";
    }
    ?>

    <h1 style="text-align: center;">Manage Records</h1>

    <div class="container">
        <div class="form form-box1">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>GPA</th>
                    <th>Action</th>
                </tr>

                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["age"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["gpa"] . "</td>";
                        echo "<td>
                        <form action='edit.php' method='get'>
                            <input type='hidden' name='id' value='" . $row["id"] . "'>
                            <input type='submit' class='update' value='Update'>
                        </form>
                        <form action='' method='post'>
                            <input type='hidden' name='action' value='delete'>
                            <input type='hidden' name='delete_id' value='" . $row["id"] . "'>
                            <input type='submit' class='delete' value='Delete'>
                        </form>
                    </td>";
                    };
                } else {
                    echo "<tr><td colspan='7'>No records found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <div class="pagination-container">
        <?php
        $sql = "SELECT COUNT(id) AS total FROM student";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $total_pages = ceil($row["total"] / $limit);
        ?>
        <div class="pagination">
            <?php if ($page > 1) : ?>
                <a href="?page=<?php echo ($page - 1); ?>">Previous</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                <a <?php if ($page == $i) echo 'class="active"' ?> href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
            <?php if ($page < $total_pages) : ?>
                <a href="?page=<?php echo ($page + 1); ?>">Next</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="logout-container">
        <form action="logout.php" method="post">
            <input type="submit" name="logout" class="btn" value="Logout">
        </form>
    </div>

</body>

</html>