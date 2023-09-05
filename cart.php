<?php
    session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Quai Antique - Panier</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
        <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>-->

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        

        <!-- Styled icons 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">-->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
        

        <link rel="stylesheet" href="./CSS/styles.css">

    </head>


    <body>

        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                
                <img src="./images/logo.png" alt="Logo" width="250" height="100" class="d-inline-block align-text-top">
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="client.php">Acceuil</a>
                        </li>
                        <li class="nav-item">
                            <a href="cart.php" class="nav-link" role="button"><i class="bi-cart-fill"></i><span class="badge badge-danger" id="cart-item"></span>Pannier</a>
                        </li>
                    </ul>
                </div>
                
            </div>
            
        </nav>
        

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div style="display:<?php if(isset($_SESSION['showAlert'])){echo $_SESSION['showAlert'];}else { echo 'none'; } unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong><?php if(isset($_SESSION['message'])){echo $_SESSION['message'];} unset($_SESSION['showAlert']); ?></strong> 
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                <td colspan="7">
                                        <h4 class="text-center text-info m-0">Products in your cart</h4>
                                </td>
                                </tr>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total price</th>
                                    <th>
                                        <a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('vider le panier ?')"><i class="fa fa-trash-o"></i> clear cart</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    require 'conf.php';
                                    $stmt = $conn->prepare("SELECT * FROM cart");
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $grand_total = 0;
                                    while($row = $result->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?= $row['id']?></td>
                                    <input type="hidden" class="pid" value="<?= $row['id']?>">

                                    <td><img src="images/<?php echo $row['image']; ?>" class="img-fluid" width="80"></td>

                                    <td><?= $row['name']?></td>

                                    <td><?= number_format($row['price'],2) ?> €</td>

                                    <input type="hidden" class="pprice" value="<?= $row['price'] ?>">

                                    <td>
                                        
                                        <input type="number" class="form-control itemQty" value="<?= $row['qty'] ?>" style="width:75px;">
                                    </td>
                                    

                                    <td><?= number_format($row['total_price'],2) ?> €</td>

                                    <td><a class="btn btn-danger" href="action.php?remove=<?= $row['id']?>" onclick="return confirm('supprimer article ?');"><span class="fa fa-trash-o"></span></a></td>
                                </tr>
                                <?php $grand_total +=$row['total_price']; ?>
                                <?php endwhile; ?> 
                                <tr>
                                    <td colspan="3">
                                        <a class="btn btn-info" href="client.php">Ajouter d'autres produits</a>
                                    </td>
                                    <td colspan="2">
                                        <p><b>Montant total</b></p>
                                        
                                    </td>
                                    <td>
                                        <b><p><?= number_format($grand_total,2); ?> €</p></b>
                                    </td>
                                    <td>
                                    <a class="btn btn-success <?= ($grand_total>1)?"":"disabled"; ?>" href="check_commande.php"><i class="fa fa-credit-card"></i> Finaliser commande</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
                       
            
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>    
        <script type="text/javascript">
           $(document).ready(function(){

            $(".itemQty").on('change', function() {
                var $el = $(this).closest('tr');

                var pid = $el.find(".pid").val();
                var pprice = $el.find(".pprice").val();
                var qty = $el.find(".itemQty").val();
                //location.reload(true);
                $.ajax({
                    url: 'action.php',
                    method: 'post',
                    cache: false,
                    data: {
                    qty: qty,
                    pid: pid,
                    pprice: pprice
                    },
                    success: function(response) {
                    console.log(response);
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