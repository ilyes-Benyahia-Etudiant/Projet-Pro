<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['user_role'] === 'admin') {
    // Display admin dashboard
    echo '<div class="container">
    <h2 class="p-5" style="color: #fff;">Welcome ' . $_SESSION['username'] . '</h2>
    <button class="btn btn-hamburger mx-auto"><a href="./admin/index.php"><span class="bi-shop"></span> Admin</button>
</div>';
} else {
    // Display user dashboard
    echo '<div class="container">
    <h2 class="p-5" style="color: #fff;">Welcome ' . $_SESSION['username'] . '</h2>
    <button class="btn btn-hamburger mx-auto"><a href="Monfiltre.php"><span class="bi-shop"></span><br>Accèder à mon espace<br><span class="bi-shop"></span></button>
</div>';
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Burger Code</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./CSS/Dashboard.css">
    


    <style>
        /* Réinitialisation des styles du navigateur */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            background-image: url(https://cdn.pixabay.com/photo/2014/10/19/20/59/hamburger-494706_1280.jpg);
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* Style pour centrer verticalement et horizontalement */
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        
        /* Style pour un bouton hamburger avec icône de nourriture */
        .btn-hamburger {
            background-color: #906427;
            border-radius: 50%;
            width: 158px;
            height: 158px;
            font-size: 24px;
            /*background-color: #FFC107;  Couleur jaune pour le hamburger */
            color: #fff; /* Couleur du texte en blanc */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        a {
            text-decoration: none;
            color: #fff;
        }

        a:hover {
            color: #392C1E;
        }


    </style>
</head>
<body><!--
    <a href="./admin/index.php">Admin Page</a>
    <a href="deconnexion.php" class="btn btn-danger btn-lg">Déconnexion</a>

    <div class="container">
        <h2 class="p-5">Welcome ' . $_SESSION['username'] . '</h2>
        <button class="btn btn-warning mx-auto"><a href="client.php"><span class="bi-shop"></span> Userpage</button>
        
    </div>-->

    
</body>
</html>
