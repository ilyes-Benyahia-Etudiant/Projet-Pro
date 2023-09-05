<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/CSS/style_test.css">
    
</head>
<body>

<?php
session_start();
require 'conf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = 'user'; // Default role is user

    if ($username === 'admin') {
        $role = 'admin'; // Set role as admin for username "admin"
    }
    
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<p>Username already exists. Please choose a different username.</p>';
    } else {
        if (strlen($username) <= 100 && strlen($email) <= 100 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $passwordValue = $_POST['password'];
            if (strlen($passwordValue) >= 8) {
                // Insert the user into the database
                $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $username, $email, $password, $role);

                if ($stmt->execute()) {
                    $_SESSION['message'] = 'Registration successful. You can now login.';
                    header('Location: login.php');
                    exit();
                } else {
                    echo '<p>Registration failed. Please try again.</p>';
                }
            } else {
                echo '<p>Password must be at least 8 characters long.</p>';
            }
        } else {
            echo '<p>Invalid username or email format.</p>';
        }
    }
}
?>

    <div class="container">
        <form action="Tregister.php" method="post" id="form" onsubmit="return validateForm();">
            <h1>Registration</h1>
            <div class="input-control">
                <label for="username">Username</label>
                <input id="username" name="username" type="text">
                
                <div class="error"></div>
            </div>
            <div class="input-control">
                <label for="email">Email</label>
                <input id="email" name="email" type="text" required>
                <div class="error"></div>
            </div>
            <div class="input-control">
                <label for="password">Password</label>
                <input id="password"name="password" type="password" required>
                <div class="error"></div>
            </div>
            <div class="input-control">
                <label for="password2">Password again</label>
                <input id="password2"name="password2" type="password" required>
                <div class="error"></div>
            </div>
            <div id="error-message" class="error-message"></div>

            <button type="submit" class="submit-btn">Register</button>
        </form>

        <div class="input-control">
    
        <div class="error"></div>

    
    </div>
    


<script type="text/javascript">
    
    function validateForm() {
    var username = document.getElementById("username").value;
    var usernameError = document.getElementById("username-error");
    var password1 = document.getElementById("password1").value;
    var password2 = document.getElementById("password2").value;
    var errorDiv = document.getElementById("error-message");



    errorDiv.textContent = ""; // Clear previous error messages
    usernameError.textContent = ""; // Clear previous username error

    

    if (!username) {
        errorDiv.textContent = "Please enter a username.";
        return false;
    }

    if (!password1 || !password2) {
        errorDiv.textContent = "Please enter both passwords.";
        return false;
    }

    if (password1 !== password2) {
        errorDiv.textContent = "Passwords do not match.";
        return false;
    }

    if (!username || !password1 || !password2) {
        errorDiv.textContent = "Please fill out all fields.";
        return false;
    }

    

    return true;

    
}


</script>


   




   

    

</body>
</html>