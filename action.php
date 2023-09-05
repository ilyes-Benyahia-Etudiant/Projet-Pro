<?php
    session_start();

    require 'conf.php';

    if(isset($_POST['pid'])){
        $pid = $_POST['pid'];
        $pname = $_POST['pname'];
        $pprice = $_POST['pprice'];
        $pimage = $_POST['pimage'];
        $qty = '1';

        $stmt = $conn->prepare("SELECT name FROM cart WHERE name=?");
        $stmt->bind_param("s",$pname);
        $stmt->execute();
        $res = $stmt->get_result();
        $r = $res->fetch_assoc();
        //$code = $r['name'];


        if(!$r){
            $query = $conn->prepare("INSERT INTO cart (name,price,image,qty,total_price) VALUES (?,?,?,?,?)");
            $query->bind_param("sssis",$pname,$pprice,$pimage,$qty,$pprice);
            $query->execute();

            echo'
                    <div class="alert alert-success">
                        <strong>Item added sucess!</strong>
                    </div>
                ';
        }
        else{
            echo'
                    <div class="alert alert-danger">
                        <strong>Allready added</strong>
                    </div>
                ';

        }
    }

    if(isset($_GET['cartItem']) AND isset($_GET['cartItem']) == 'cart_item'){
        $stmt = $conn->prepare("SELECT * FROM cart");
        $stmt->execute();
        $stmt->store_result();
        $rows = $stmt->num_rows;

        echo $rows;

    }

    if(isset($_GET['remove'])){
        $id = $_GET['remove'];

        $stmt = $conn->prepare("DELETE FROM cart WHERE id=?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        
        $_SESSION['showAlert'] = 'block';
        $_SESSION['message'] = 'Item removed from cart!';
        header('location:cart.php');

    }

    // Set total price of the product in the cart table
	if (isset($_POST['qty'])) {
        $qty = $_POST['qty'];
        $pid = $_POST['pid'];
        $pprice = $_POST['pprice'];
  
        $tprice = $qty * $pprice;
  
        $stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
        $stmt->bind_param('isi',$qty,$tprice,$pid);
        $stmt->execute();
    }

    if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $products = $_POST['products'];
        $grand_total = $_POST['grand_total'];
        $address = $_POST['address'];
        $pmode = $_POST['pmode'];
  
        $data = '';
  
        $stmt = $conn->prepare('INSERT INTO orders (name,email,phone,address,pmode,products,amount_paid)VALUES(?,?,?,?,?,?,?)');
        $stmt->bind_param('sssssss',$name,$email,$phone,$address,$pmode,$products,$grand_total);
        $stmt->execute();
        $stmt2 = $conn->prepare('DELETE FROM cart');
        $stmt2->execute();
        $data .= '
                <div class="text-center">
                    <h1 class="display-4 mt-2 text-danger">Thank You!</h1>
                    <h2 class="text-success">Your Order Placed Successfully!</h2>
                    <h4 class="bg-danger text-light rounded p-2">Items Purchased : ' . $products . '</h4>
                    <h4>Your Name : ' . $name . '</h4>
                    <h4>Your E-mail : ' . $email . '</h4>
                    <h4>Your Phone : ' . $phone . '</h4>
                    <h4>Total Amount Paid : ' . number_format($grand_total,2) . '</h4>
                    <h4>Payment Mode : ' . $pmode . '</h4>
                </div>';
        echo $data;
    }
    

    
    
?>