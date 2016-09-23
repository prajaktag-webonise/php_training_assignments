<?php
include_once('product_functions.php');
include_once('cart_functions.php');

if($_GET['request']==1 && $_SERVER['REQUEST_METHOD']== "GET") {
   echo getProducts();
}
else if($_GET['request']==1 && $_SERVER['REQUEST_METHOD']== "POST") {

    echo addProduct($_POST['id'],$_POST['name'],$_POST['price']);
}
else if($_GET['request']==2 && $_SERVER['REQUEST_METHOD']== "DELETE") {

    echo deleteProduct($_GET['id']);

}
else if($_GET['request']==2 && $_SERVER['REQUEST_METHOD']== "PUT") {

    parse_str(file_get_contents("php://input"),$post_vars);
    echo updateProduct($_GET['id'],$post_vars['name'],$post_vars['price']);

}
if($_GET['request']==3 && $_SERVER['REQUEST_METHOD']== "GET") {
    echo getCart();
}
if($_GET['request']==4 && $_SERVER['REQUEST_METHOD']== "GET") {
    echo getOrder();
}

 ?>
