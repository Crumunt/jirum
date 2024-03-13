<?php
@include 'config.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"]) && $_POST["action"] == "insert") {
        
        if (!empty($_POST["email"]) && !empty($_POST["password"])) {
            $name = $_POST["name"];
            $age = $_POST["age"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); 

            $user_type = 'student';

            $check_email_query = "SELECT * FROM student WHERE email = '$email'";
            $check_email_result = $conn->query($check_email_query);
            if ($check_email_result->num_rows > 0) {
                echo "<div id='popup' style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f1f1f1; border: 2px solid #333; padding: 20px; border-radius: 10px; z-index: 9999; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);'>
                <p>Email is already taken. Please choose a different email.</p>
              </div>";
                echo "<script>
                setTimeout(function(){ 
                    document.getElementById('popup').style.display = 'none'; 
                    window.location.href = 'studentform.php'; // Replace 'your_form_page.php' with the URL of your form page
                }, 1000);
              </script>";
        
                exit();
            }

            if (ctype_upper(substr($password, 0, 1)) && preg_match('/^[a-zA-Z0-9]+$/', $password)) {
                $stmt_user = $conn->prepare("INSERT INTO student (name, age, email) VALUES (?, ?, ?)");
                $stmt_user->bind_param("sss", $name,  $age, $email);
                $stmt_user->execute();
                $stmt_user->close();

                $sql = "SELECT * FROM student WHERE email = '$email'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $student_id = $row['id'];

                    $stmt_form = $conn->prepare("INSERT INTO login (name, email, password, user_type, student_id) VALUES (?, ?, ?, ?, ?)");
                    $stmt_form->bind_param("sssss", $name, $email, $hashed_password, $user_type, $student_id);
                    $stmt_form->execute();
                    $stmt_form->close();

                    echo "<div id='popup' style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f1f1f1; border: 2px solid #333; padding: 20px; border-radius: 10px; z-index: 9999; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);'>
                            <span onclick='closePopup(\"popup\")' style='position: absolute; top: 5px; right: 10px; font-size: 20px; cursor: pointer;'>&times;</span>
                            <p>Sign up successful!</p>
                          </div>";
                    echo "<script>
                          setTimeout(function(){ 
                              document.getElementById('popup').style.display = 'none'; 
                              window.location.href = 'studentform.php'; 
                          }, 1000);
                        </script>";
                }
            } else {
                echo "<div id='popup' style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f1f1f1; border: 2px solid #333; padding: 20px; border-radius: 10px; z-index: 9999; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);'>
                        <span onclick='closePopup(\"popup\")' style='position: absolute; top: 5px; right: 10px; font-size: 20px; cursor: pointer;'>&times;</span>
                        <p>Password must start with a capital letter and contain only letters and numbers.</p>
                      </div>";
                      echo "<script>
                      setTimeout(function(){ 
                          document.getElementById('popup').style.display = 'none'; 
                          window.location.href = 'studentform.php'; 
                      }, 1000);
                    </script>";
            }
        } else {
            echo "<div id='popup' style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f1f1f1; border: 2px solid #333; padding: 20px; border-radius: 10px; z-index: 9999; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);'>
                    <span onclick='closePopup(\"popup\")' style='position: absolute; top: 5px; right: 10px; font-size: 20px; cursor: pointer;'>&times;</span>
                    <p>Email and password cannot be empty.</p>
                  </div>";
                  echo "<script>
                  setTimeout(function(){ 
                      document.getElementById('popup').style.display = 'none'; 
                      window.location.href = 'studentform.php'; 
                  }, 1000);
                </script>";
        }
    }
}
?>

<script>
    function closePopup(popupId) {
        var popup = document.getElementById(popupId);
        popup.style.display = 'none';
    }
</script>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    
    <title>Student Form</title>
</head>
<body>
<div class="container">
    <div class="box form-box">
    
        <h1>Sign Up</h1>
    
    <form action=" " method="POST">
           
                <div class="field input">
                <div>
                <h3>Full Name</h3>
                        <input type="text" id="name" name="name" placeholder="Full Name" pattern="[A-Za-z]+" title="Please enter only letters in the Full Name field." required><br>
                </div>
                
                <div class="field input">
                <h3>Age</h3>
                        <input type="number" id="age" name="age" placeholder="Enter your age">
                </div>
              
                <div class="field input">
                <h3>Email</h3>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="field input">
                        <h3>Password</h3>
                        <input type="text" name="password" id="password" placeholder="Enter your password" required>
                </div>

                <div class="field input">
                        <input type="hidden" name="action" id="action" value="insert">
                        <input type="submit" value="Submit" class="btn">
                        <a href="index.php">
                </div>

                <div class="links">
                    <p>Already have an account? <a href="index.php"></a></p>
                </div>
            
        </form>
    </div>
</div>
</div>
      
</body>

</html>
