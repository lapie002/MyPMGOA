<?php
/****** directory for the images *******/
$upload_directory = "uploads";


/******************************** helper function **************************/

function redirect($location)
{
	header("LOCATION: $location");
}

function query($sql)
{
	global $connection;
	
	return mysqli_query($connection,$sql);
}

function confirm($result)
{
	global $connection;
	
	if(!$result)
	{
		die("QUERY FAILED" . mysqli_error($connection));
	}
}

function escape_string($string)
{
	global $connection;
	
	return mysqli_real_escape_string($connection,$string);
}

function fetch_array($result)
{
	return mysqli_fetch_array($result);
}

function set_message($msg)
{
	if(!empty($msg))
	{
		$_SESSION['message'] = $msg; 
	}
	else
	{
		$msg = "";
	}
}

function display_message()
{
	if(isset($_SESSION['message']))
	{
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
}

function last_id()
{
	global $connection;

	return mysqli_insert_id($connection);
} 

/******************************** FRONT END FUNCTION **************************/


//get products 

 function get_products()
 {
	$result = query("SELECT * FROM products");
	
	confirm($result);
	
	while($row = fetch_array($result))
	{
		$product_image = dislay_image($row['product_image']);
		
		$product = <<<DELIMETER
		<div class="col-sm-4 col-lg-4 col-md-4">
			<div class="thumbnail">
			<!-- actual image tag -->
			<a href="item.php?id={$row['product_id']}"><img width="320" height="150" src="../resources/{$product_image}" alt=""></a>
			<!-- future image tag SUPER IMPORTANT DONT SKIP IT !!!!-->
			<!-- <img src="/resources/...?add={$row['product_id']}" alt=""> -->
			
				<div class="caption">
					<h4 class="pull-right">&#36;{$row['product_price']}</h4>
					<h4><a href='item.php?id={$row['product_id']}'>{$row['product_title']}</a></h4>
					<p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
					<a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add to cart</a>
				</div>
			</div>
		</div>
DELIMETER;
		echo $product;
		
	}	
 }
 
 
 
 //get categories
 
 function get_categories()
 {
	$query = query("SELECT * FROM categories");
	
	confirm($query);
	
	while($row = fetch_array($query))
	{
		$categories_links = <<<DELIMETER
		
		<a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>
DELIMETER;
echo $categories_links;
		
	}
 
 }
 
 
 // get products by category
 
 function get_products_in_cat_page()
 {
	$query = query("SELECT * FROM products where product_category_id = ". escape_string($_GET['id']) ." ");
	
	confirm($query);
	
	while($row = fetch_array($query))
	{
		$product_image = dislay_image($row['product_image']);
	
		$product = <<<DELIMETER
		     <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <a href="item.php?id={$row['product_id']}"><img width="800" height="500" src="../resources/{$product_image}" alt=""></a>
                    <div class="caption">
						<h3><a href='item.php?id={$row['product_id']}'>{$row['product_title']}</a></h3>
                        <p>{$row['short_desc']}</p>
                        <p>
                            <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add to cart</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default"> More Info</a>
                        </p>
                    </div>
                </div>
            </div>
DELIMETER;
		echo $product;
		
	}	
 }
 
// get category title
 
 function get_category_title()
 {
	$query = query("SELECT cat_title FROM categories WHERE cat_id = ". escape_string($_GET['id']) ." ");
	
	confirm($query);
	
	while($row = fetch_array($query))
	{
		$categories_title = <<<DELIMETER
		
		<h3>{$row['cat_title']}</h3>
DELIMETER;
echo $categories_title;
		
	}
 
 }
 
 // shop
 function get_products_in_shop_page()
 {
	$query = query("SELECT * FROM products");
	
	confirm($query);
	
	while($row = fetch_array($query))
	{
		$product_image = dislay_image($row['product_image']);
		
		$product = <<<DELIMETER
		     <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <a href="item.php?id={$row['product_id']}"><img width="800" height="500" src="../resources/{$product_image}" alt=""></a>
                    <div class="caption">
						<h3><a href='item.php?id={$row['product_id']}'>{$row['product_title']}</a></h3>
                        <p>{$row['short_desc']}</p>
                        <p>
							 <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
DELIMETER;
		echo $product;
		
	}	
 }
 
 // function login
 
 function login_user()
 {
	if(isset($_POST['submit']))
	{
		$username = escape_string($_POST['username']);
		$password = escape_string($_POST['password']);
		
		$query = query("SELECT * FROM users where username = '{$username}' AND  password='{$password}' ");
		confirm($query);
		
		if(mysqli_num_rows($query) == 0)
		{
			set_message("There was a problem with your request. Please re-enter your login information and password !");
			redirect("login.php");
		}
		else
		{
			$_SESSION['username'] = $username;
			redirect("admin");
		}
		
	}
 }
 
// Customer can send Message
// Configuration option.
// Enter the email address that you want to emails to be sent to.
// Example $address = "joe.doe@yourdomain.com";
//$address = "example@example.net";

 function send_message()
 {
	if(isset($_POST['submit']))
	{

		$to      = "lapierre.bruno@gmail.com";
		$from_name    = $_POST['name'];
		$email   = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];

		$headers = "from: {$from_name} {$email}";

		$result = mail($to,$subject,$message,$headers);

		if(!$result)
		{
			set_message("Error, please fill up the contact form again.");
		}
		else
		{
			set_message("Email Sent Successfully.");
		}
	}
 }
 
 
 
 
 /******************************** BACK END FUNCTION **************************/
 
 //function to display orders in the admin panel 
 function display_orders()
 {
	 $query = query("SELECT * FROM orders");
	 confirm($query);
	 
	 while($row = fetch_array($query))
	 {
		$orders = <<<DELIMETER
		
		<tr>
            <td>{$row['order_id']}</td>
            <td>{$row['order_amount']}</td>
            <td>{$row['order_transaction']}</td>
            <td>{$row['order_status']}</td>
			<td>{$row['order_currency']}</td>
			<td><a class="btn btn-danger" href="../../resources/templates/back/delete_order.php?id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
		
DELIMETER;

		echo $orders;
	 }
 
 }
 
 function show_product_category_title($product_category_id)
 {
	$query = query("SELECT * FROM categories WHERE cat_id = '{$product_category_id}' ");
	confirm($query);
	
	while($category_row  = fetch_array($query))
	{
		return $category_row['cat_title'];
	}	
 }
 
 /*******************************Admin products.php*****************/
 //function for the image directory 
 function dislay_image($picture)
 {
	global $upload_directory;
	return $upload_directory . DS . $picture;
 }
 

 function get_products_in_admin()
 {
	$result = query("SELECT * FROM products");
	confirm($result);
	
	while($row = fetch_array($result))
	{
		$category = show_product_category_title($row['product_category_id']);
		$product_image = dislay_image($row['product_image']);
		
		$product_in_admin_page = <<<DELIMETER
		  <tr>
		    <td>{$row['product_id']}</td>
            <td>{$row['product_title']} <br>
              <a href="index.php?edit_product&id={$row['product_id']}"><img height="62" width="62" src="../../resources/{$product_image}" alt=""></a>
            </td>
            <td> {$category} </td>
            <td>{$row['product_price']}</td>
			<td>{$row['product_quantity']}</td>
			<td><a class="btn btn-danger" href="../../resources/templates/back/delete_product.php?id={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
		 </tr>
DELIMETER;
		echo $product_in_admin_page;
		
	}	
 }
 
  /*******************************Add products in Admin *****************/
 
 function add_product()
 {
 
	if(isset($_POST['publish']))
	{
	
		$product_title        = escape_string($_POST['product_title']);
		$product_category_id  = escape_string($_POST['product_category_id']);
		$product_price        = escape_string($_POST['product_price']);
		$product_quantity     = escape_string($_POST['product_quantity']);
		$product_description  = escape_string($_POST['product_description']);
		$short_desc           = escape_string($_POST['short_desc']);
		
		
		$product_image        = $_FILES['file']['name'];
		$image_temp_location  = $_FILES['file']['tmp_name'];
		
		move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);
		
		$query = query("INSERT INTO products (product_title, product_category_id, product_price, product_quantity, product_description, short_desc , product_image) VALUES('{$product_title}', '{$product_category_id}','{$product_price}','{$product_quantity}','{$product_description}','{$short_desc}','{$product_image}')");
		$last_id = last_id();
		confirm($query);
		set_message("New Product with id: {$last_id} was successfully added!");
		redirect("index.php?products");
	}
 
 
 }


 
function show_categories_add_product_page()
 {
	$query = query("SELECT * FROM categories");
	confirm($query);
	
	while($row = fetch_array($query))
	{
		$categories_options = <<<DELIMETER
		
		<option value="{$row['cat_id']}">{$row['cat_title']}</option>
		
DELIMETER;
echo $categories_options;
		
	}
 
 }
 
 
 
/*******************************Edit product in Admin *****************/
 
function update_product()
 {
	
	if(isset($_POST['update']))
	{
		
		
		$product_title        = escape_string($_POST['product_title']);
		$product_category_id  = escape_string($_POST['product_category_id']);
		$product_price        = escape_string($_POST['product_price']);
		$product_quantity     = escape_string($_POST['product_quantity']);
		$product_description  = escape_string($_POST['product_description']);
		$short_desc           = escape_string($_POST['short_desc']);
		
		$product_image        = $_FILES['file']['name'];
		$image_temp_location  = $_FILES['file']['tmp_name'];
		
	if(empty($product_image))
	{
		$get_pic = query("SELECT product_image FROM products WHERE product_id= " . escape_string($_GET['id']) . " ");
		confirm($get_pic);
		
		while($row = fetch_array($get_pic))
		{
			$product_image = $row['product_image'];
		}
	}
		
		
		move_uploaded_file($image_temp_location  , UPLOAD_DIRECTORY . DS . $product_image);
		
		$query = "UPDATE products SET ";
		$query .= "product_title            = '{$product_title}'        , ";
		$query .= "product_category_id      = '{$product_category_id}'  , ";
		$query .= "product_price            = '{$product_price}'        , ";
		$query .= "product_description      = '{$product_description}'  , ";
		$query .= "short_desc               = '{$short_desc}'           , ";
		$query .= "product_quantity         = '{$product_quantity}'     , ";
		$query .= "product_image            = '{$product_image}'          ";
		$query .= "WHERE product_id=" . escape_string($_GET['id']);
		
		$send_update_query = query($query);
		confirm($send_update_query);
		set_message("The product has been updated!");
		redirect("index.php?products");
	}
 
 
 }
 
 
 
 
 
 
 
 
 
 
?>