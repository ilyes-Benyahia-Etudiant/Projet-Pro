<?php

    //define('HOST', 'localhost');
    //define('DB_NAME', 'data');
    //define('USER', 'root');
    //define('PASS', '');


   
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
        
        ?>
            
            <script language="javascript">
            //alert("Désolé, Votre restaurant est complet !");
            alert("Hello world!");
            
            var error = document.getElementById('error');
            function manage(txt) 
            {
                
                if (txt.value >30) 
                {
                    alert("Hello world!");
                    error.innerHTML="Hello World!"
                    error.style.display="block";
                }
                
            }   
            
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
    <title>Document</title>
    <style>
    	* { font: 17px Calibri; }
        #error {
            border: 2px solid black;
            display: none;
            

        }
    </style>
</head>
<body>
    <!--<input type="text" class="amount" name="sum" id="totalordercost" readonly />-->
    <!--<label for="" class="form-label">Nombres actuelle de reservations / 30</label>-->
    <!-- VRAI <p><INPUT type='text' SIZE='1' name="sum" id="totalordercost" readonly VALUE=""/> /30</p>-->

    

    <input type="text" id="txt" onkeyup="manage(this)" value="<?php echo $output; ?>"/>

    
    

    <script language="javascript">

            var error = document.getElementById('error');

            function manage(txt) {
                
                //if (txt.value != '31') 
                if (txt.value >30) 
                {
                    alert("Hello world!");
                    error.innerHTML="Hello World!"
                    //error.style.display="block";
                }
                else {
                    bt.disabled = true;
                }
            } 

    </script>
    
    
</body>
</html>

