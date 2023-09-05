<?php
session_start();
require 'conf_log.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            $_SESSION['user_role'] = $user['role'];
            header('Location: Acceuil_user.php');
            exit();
        }
    }

    $_SESSION['message'] = 'Invalid login credentials. Please try again.';
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <style>

        @import url('https://fonts.googleapis.com/css2?family=Dosis:wght@200&family=Lora&family=Montserrat:ital,wght@0,400;0,500;1,400&display=swap');
        
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@700&family=Poppins:wght@400;500;600&display=swap');
        *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
        }
        body{
        margin: 0;
        padding: 0;
        /*background: linear-gradient(120deg,#2980b9, #8e44ad);*/
        height: 100vh;
        overflow: hidden;
        }
        .center{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        background: white;
        border-radius: 10px;
        box-shadow: 10px 10px 15px rgba(0,0,0,0.05);
        }
        .center h2{
        text-align: center;
        padding: 20px 0;
        border-bottom: 1px solid silver;
        font-size: 18px;
        }
        .center form{
        padding: 0 40px;
        box-sizing: border-box;
        }
        form .txt_field{
        position: relative;
        border-bottom: 2px solid #adadad;
        margin: 30px 0;
        }
        .txt_field input{
        width: 100%;
        padding: 0 5px;
        height: 40px;
        font-size: 16px;
        border: none;
        background: none;
        outline: none;
        }
        .txt_field span::before{
        content: '';
        position: absolute;
        top: 40px;
        left: 0;
        width: 0%;
        height: 2px;
        background: #2691d9;
        transition: .5s;
        }
        .txt_field input:focus ~ label,
        .txt_field input:valid ~ label{
        top: -5px;
        color: #2691d9;
        }
        .txt_field input:focus ~ span::before,
        .txt_field input:valid ~ span::before{
        width: 100%;
        }
        .pass{
        margin: -5px 0 20px 5px;
        color: #a6a6a6;
        cursor: pointer;
        }
        .pass:hover{
        text-decoration: underline;
        }
        input[type="submit"]{
        width: 100%;
        height: 50px;
        border: 1px solid;
        background: #2691d9;
        border-radius: 25px;
        font-size: 18px;
        color: #e9f4fb;
        font-weight: 700;
        cursor: pointer;
        outline: none;
        }
        input[type="submit"]:hover{
        border-color: #2691d9;
        transition: .5s;
        }
        .signup_link{
        margin: 30px 0;
        text-align: center;
        font-size: 16px;
        color: #666666;
        }
        .signup_link a{
        color: #2691d9;
        text-decoration: none;
        }
        .signup_link a:hover{
        text-decoration: underline;
        }



    </style>
</head>
<body>
    
    <?php
    if (isset($_SESSION['message'])) {
        echo '<p>' . $_SESSION['message'] . '</p>';
        unset($_SESSION['message']);
    }
    ?>
    


    <div class="center">
            <form action="login.php" method="post">
                    <h2>Connexion utilisateur</h2>
                    <span></span>
                    <div class="txt_field">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <span></span>
                    
                    <div class="txt_field">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    
                    
                    </div>
                    <span></span>
                    <button class="btn btn-success" type="submit">Login</button>
            </form>

            <div class="signup_link">
                <a href="Tregister.php">Inscription</a>
            </div>
            
            <!--<span class="badge rounded-pill text-bg-warning"><a class="nav-link" href="Log_admin.php">Admin</a></span>-->
        </div>
</body>
</html>
