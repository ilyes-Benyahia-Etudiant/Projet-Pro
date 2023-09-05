<?php
    //$bdd = new PDO('mysql:host=localhost;dbname=contact_db; charset=utf8', 'root', '');
    $con=mysqli_connect("localhost","root","","data"); 
    session_start();
    //if(!$_SESSION['user'])
    if(!$_SESSION['role']=="admin")
    {
        header('Location:index.php');
    }

    $query = "SELECT * from tb_resa";
    $result = mysqli_query($con,$query);

    
        
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Afficher les membres</title>

    <style>
        #a {
            color: azure;      
            text-decoration: none;  
        }
    </style>
     
</head>
<body>

    <div class="container">
            <h1 class="text-logo"><span class="bi-shop"></span> Restaurant Quai Antique - Panel Admin <span class="bi-shop"><a href="./deconnexionAdmin.php" class="btn btn-danger btn-lg">Déconnexion</a></span></h1>
            <h2>Reservation tables :</h2>
            <button type="button" class="btn btn-warning btn-lg"><a id="a" href="index.php">Produits/Menu</a></button>
            <button type="button" class="btn btn-warning btn-lg"><a id="a" href="membres.php">Afficher  les Membres</a></button>
            <button type="button" class="btn btn-warning btn-lg"><a id="a" href="messages.php">Afficher les Messages</a></button>
            
    </div>
    <div class="container">
        
        <table class="table table-striped">
            <tr>
                <th scope="col">    User ID             </th>
                <th scope="col">    Nom                 </th>
                <th scope="col">    Prenom              </th>
                <th scope="col">    Nbr Couverts        </th>
                <th scope="col">    Date                </th>
                <th scope="col">    Allergique          </th>
                <th scope="col">    Mention allergie    </th>
                <th scope="col">    Heure               </th>
                <th scope="col">    Edit                </th>
                <th scope="col">    Delete              </th>
            </tr>

            <?php 
                    
                while($row=mysqli_fetch_assoc($result))
                {
                $UserID = $row['id'];
                $UserNom = $row['Nom'];
                $UserPrenom = $row['Prenom'];
                $Couverts = $row['Couverts'];
                $Date = $row['Date'];
                $Allergique = $row['Allergique'];
                $Mention = $row['message'];
                $Heure = $row['btnradio'];
                
               
            ?>
                <tr>
                    <td><?php echo $UserID ?>    </td>
                    <td><?php echo $UserNom ?></td>
                    <td><?php echo $UserPrenom ?> </td>
                    <td><?php echo $Couverts ?>  </td>
                    <td><?php echo $Date ?>  </td>
                    <td><?php echo $Allergique ?>  </td>
                    <td><?php echo $Mention ?>  </td>
                    <td><?php echo $Heure ?>  </td>
                    <td><a href="#"><button type="button" class="btn btn-secondary">Edit</button></td>
                    <td><a href="#" class="btn btn-danger">Delete</a></td>
                </tr>
                
                
            <?php 
                }  
            ?>                                                                    
                        
        </table>
            
            
    </div>

    

    
</body>
</html>