<?php

// fonctions utiles

function set_message($msg){
    if(!empty($msg)){
        $_SESSION['message'] = $msg;
    }else{
        $msg = "";
    }
}

function display_message(){
    if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}


function redirect($location){
    header("Location: $location");
}

function query($sql){
    global $connection;
    return mysqli_query($connection, $sql);
}

function confirm($result){
    global $connection;
    if(!$result){
        die("QUERY FAILED" . mysqli_error($connection));
    }
}

function escape_string($string): string{
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}

function fetch_array($result){

    return mysqli_fetch_array($result);
}

/***************************** FRONT END FUNCTIONS********************/

// get products

function get_products(){

    $query=query(" SELECT * FROM products ");
    confirm($query);

    while ($row = fetch_array($query)){
    $product = <<<DELIMETER

         <div class="col-sm-4 col-lg-4 col-md-4">
                                <div class="thumbnail">
                                    <a href="item.php?id={$row['product_id']}"><img src="{$row['product_image']}" alt=""></a>
                                    <div class="caption">
                                        <h4 class="pull-right">{$row['product_price']} &#8364</h4>
                                        <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                                        </h4>
                                        <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                                        <a class="btn btn-primary" target="_blank" href="cart.php?add={$row['product_id']}">Add to cart</a>
                                    </div>
                                </div>
                            </div>

DELIMETER;

echo $product;
    }

}

function get_categories(){

    $query = query("SELECT * FROM categories");
    confirm($query);

    while($row = fetch_array($query)){

        $category_links = <<<DELIMETER

         <a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>

DELIMETER;

echo $category_links;
    }
}

function get_products_in_cat_page(){

    //error running this line of code
    $id = escape_string($_GET['id']);
    $query = query("SELECT * FROM products WHERE product_category_id = " . $id);

    confirm($query);
    while ($row = fetch_array($query)) {
        $product = <<<DELIMETER
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$row['product_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
DELIMETER;
        echo $product;
    }
}



function get_products_in_shop_page(){

    //error running this line of code
    //$id = escape_string($_GET['id']);
    $query = query("SELECT * FROM products");

    confirm($query);
    while ($row = fetch_array($query)) {
        $product = <<<DELIMETER
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$row['product_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
DELIMETER;
        echo $product;
    }
}


function login_user(){
    if(isset($_POST['submit'])){
        $username = escape_string($_POST['username']);
        $password = escape_string($_POST['password']);

        $query = query("SELECT * FROM users WHERE username = '$username' AND password = '$password' ");
        confirm($query);

        if (mysqli_num_rows($query) === 0){
            set_message("Votre nom d'utilisateur ou votre mot de passe sont incorrects,<br> looser...");
            redirect("login.php");
        }else{
            set_message("Je vous attendais Mr. Bond... <br> Ah! Vous êtes $username, procédez. ");
            redirect("admin");
        }
    }
}

function send_message(){

    if(isset($_POST['submit'])){

        $to = "test.test@gmail.com";
        $form_name = $_POST['name'];
        $form_email = $_POST['email'];
        $form_subject = $_POST['subject'];
        $form_message = $_POST['message'];

        $headers = "From: $form_name $form_email";

        $result = mail($to, $form_subject,$form_message,$headers);
        if(!$result){
            set_message("Message non envoyé");
            redirect("contact.php");
        }else{
            set_message("Message envoyé");
        }
    }
}
/***************************** BACK END FUNCTIONS********************/




