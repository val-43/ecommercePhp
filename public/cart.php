<?php require_once("../resources/config.php"); ?>

<?php

if(isset($_GET['add'])){

        $query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['add']) . " ");
        confirm($query);

        while($row = fetch_array($query)){
            if ( ($row['product_quantity'] !== $_SESSION['product_' . $_GET['add']]) && ($row['product_quantity'] > $_SESSION['product_' . $_GET['add']]) ) {
                ++$_SESSION['product_' . $_GET['add']];
            } else {
                set_message("We only have ". $row['product_quantity'] . " " ."{$row['product_title']} available");
            }
            redirect("checkout.php");

        }

    //    ++$_SESSION['product_' . $_GET['add']];
    //    redirect("index.php");
    }

if(isset($_GET['remove'])){

        $_SESSION['product_' . $_GET['remove']]--;
        redirect("checkout.php");
}

if(isset($_GET['delete'])){

    $_SESSION['product_' . $_GET['delete']] = '0';
    redirect("checkout.php");
}

function cart()
{

    foreach ($_SESSION as $name => $value) {

        if(($value > 0) && strpos($name, "product_") === 0) {

            $length = strlen(is_numeric($name) - 8);
            $id = substr($name, 8, $length);

            $query = query("SELECT * FROM products WHERE product_id = " .escape_string($id). " ");
            confirm($query);

            while ($row = fetch_array($query)) {

                $product = <<<DELIMITER
        <tr>
           <td>{$row['product_title']}</td>
           <td>{$row['product_price']} €</td>
           <td>{$row['product_quantity']}</td>
           <td>2</td>
           <td><a class="btn btn-warning" href="cart.php?remove={$row['product_id']}"><span class="glyphicon glyphicon-minus"></span></a> 
           <a class="btn btn-success" href="cart.php?add={$row['product_id']}"><span class="glyphicon glyphicon-plus"></span></a>
           <a class="btn btn-danger" href="cart.php?delete={$row['product_id']}"><span class="glyphicon glyphicon-trash"></span></a>
           </td>
             
        </tr>

DELIMITER;

        echo $product;
    }
}
    }
}
?>

