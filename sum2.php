<?php

    //define('HOST', 'localhost');
    //define('DB_NAME', 'data');
    //define('USER', 'root');
    //define('PASS', '');

    //$isComplet = true;

    //$isComplet = 'error';
   
    try 
    {
        
        $conn = mysqli_connect ("localhost", "root", "", "data");
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    } 


    catch (PDOException $e) 
    {
        echo $e;
    }
    

    $query= "SELECT SUM(Couverts) AS sum FROM `tb_resa`";

    $query_result = mysqli_query($conn , $query);

    while($row = mysqli_fetch_assoc($query_result))
    {
        $output = $row['sum'];

    }


    if ($output > 30){
        //$isComplet = false;
        echo '<div class="container">
        <div class="row">
        <div class="col-md-6 col-lg-12 col-sm-3" id="error"><p class="text">Restaurant complet</p></div>
        </div>
        </div>';
        
        ?>
            
            <script language="javascript">
            alert("Désolé, Votre restaurant est complet !");
            </script>
        <?php
    }
        
?>        
            
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <style>
    	@import url('https://fonts.googleapis.com/css2?family=Dosis:wght@200&family=Hind+Madurai:wght@300&family=Lora&family=Montserrat:ital,wght@0,400;0,500;1,400&display=swap');

        #error 
        {
            
            display: flex;
            position: absolute;
            top: 18%;
            width: 1290px;
            height: 1200px;
            background-image: url(https://cdn.pixabay.com/photo/2016/10/17/14/31/background-1747792_1280.jpg);
            opacity: 0.75;
            background-size: cover;
            z-index: 1;
        }

        .text {
        color: white;
        font-family: 'Hind Madurai', sans-serif;
        font-weight: bold;
        font-size: 20px;
        background-color: #906427;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80%;
        padding: 20px;
        text-align: center;
        }

    </style>

    <title>Sum2</title>


</head>
<body>

    <INPUT type='text' SIZE='1' name="sum" id="txt" readonly value="<?php echo $output; ?>" onkeyup="manage(this)"/>

    <!--<input type="text" id="txt" onkeyup="manage(this)"/>-->

    
    
     

    </script>
    
    

    
    
</body>
</html>

