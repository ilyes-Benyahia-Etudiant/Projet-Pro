
<?php 
        
    try 
    {
        $bdd = new PDO('mysql:host=localhost;dbname=contact_db; charset=utf8', 'root', '');
    }
    catch(PDOException $e)
    {
        die('Erreur : '.$e->getMessage());
    }

?>