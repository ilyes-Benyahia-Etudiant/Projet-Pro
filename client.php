<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['user_role'] === 'admin') {
    // Display admin dashboard
    echo '<h1>Welcome Admin ' . $_SESSION['username'] . '</h1>';
    echo '<a href="admin_page.php">Admin Page</a>';
} else {
    // Display user dashboard
    echo '<h1>Welcome ' . $_SESSION['username'] . '</h1>';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Burger Code</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
        <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>-->

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        

        <!-- Styled icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        

        <link rel="stylesheet" href="./CSS/styles.css">

    </head>


    <body>

        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <img src="./images/logo.png" alt="Logo" width="250" height="100" class="d-inline-block align-text-top">
                <a href="deconnexion.php" class="btn btn-danger btn-lg">Déconnexion</a>
                <button class="btn btn-outline-success" type="submit" id="reservation"><a href="./Reservation.php">Reserver !</a></button>
                <a href="cart.php" class="nav-link" role="button"><i class="bi-cart-fill"></i><span class="badge badge-danger" id="cart-item"></span>Pannier</a>
                
            
            </div>
        </nav>
        
            <div class="text-center" >
                <?php
                    //@include 'conf.php';
                    @include 'conf_log.php';
                    //$stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
                    //$stmt = $conn->prepare('SELECT * FROM utilisateur WHERE pseudo = ?');
                    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
                    $stmt->execute(array($_SESSION['username']));
                    //$data = $req->fetch();
                    //$stmt->execute();
                    $result = $stmt->get_result();
                    while($row = $result->fetch_assoc()):

                ?>
     
                <h2 class="p-5">Bonjour <?php echo $row['username']; ?> !</h2>
                
            </div>
            <?php endwhile; ?> 
            


            <div id="message"></div>
            

            <div class="container">
                <div class="row">
                    
                <?php
                
                    @include 'conf.php';
                    $stmt = $conn->prepare("SELECT * FROM items");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while($row = $result->fetch_assoc()):
                        
                ?>

                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="img-thumbnail">
                            
                            <img src="images/<?php echo $row['image']; ?>" class="img-fluid" alt="...">
                            
                            <div class="price"><?= number_format($row['price'],2) ?> €</div>

                            <div class="caption">

                                <h4><?= $row['name']?></h4>

                                <p><?= $row['description']?></p>
                                
                    
                            </div>

                            <form action="" class="form-submit">
                                <input type="hidden" class="pid" value="<?= $row['id']?>">
                                <input type="hidden" class="pname" value="<?= $row['name']?>">
                                <input type="hidden" class="pprice" value="<?= $row['price']?>">
                                <input type="hidden" class="pimage" value="<?= $row['image']?>">
                                
                                <!--<button class="btn btn-info"><span class="bi-cart-fill"></span>add</button>-->
                                <button class="btn btn-info addItemBtn" role="button"><span class="bi-cart-fill"></span> Commander</button>
                            </form>
                            
                        </div>


                    </div>
                    <?php endwhile; ?> 

                </div>

            </div>
                       
        

        <script type="text/javascript">
            $(document).ready(function(){
                $(".addItemBtn").click(function(e){
                    e.preventDefault();
                    var $form = $(this).closest(".form-submit");
                    var pid = $form.find(".pid").val();
                    var pname = $form.find(".pname").val();
                    var pprice = $form.find(".pprice").val();
                    var pimage = $form.find(".pimage").val();
                    
                    

                    $.ajax({
                        url: 'action.php',
                        method: 'post',
                        data: {pid:pid,pname:pname,pprice:pprice,pimage:pimage},
                        success:function(response){
                            $("#message").html(response);
                            window.scrollTo(0,0);
                            load_cart_item_number();
                        }
                    });
                });

                load_cart_item_number();

                function load_cart_item_number(){
                    $.ajax({
                        url: 'action.php',
                        method: 'get',
                        data: {cartItem:"cart_item"},
                        success: function(response){
                            $("#cart-item").html(response);
                        }
                    });
                }

            });
            

        </script>

    </body>
</html>