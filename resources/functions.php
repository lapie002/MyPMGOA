<?php
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


/******************************** FRONT END FUNCTION **************************/
//get products 

 function get_products()
 {
	$result = query("SELECT * FROM products");
	
	confirm($result);
	
	while($row = fetch_array($result))
	{
		$product = <<<DELIMETER
		<div class="col-sm-4 col-lg-4 col-md-4">
			<div class="thumbnail">
			<!-- actual image tag -->
			<a href="item.php?id={$row['product_id']}"><img src="{$row['product_image']}" alt=""></a>
			<!-- future image tag SUPER IMPORTANT DONT SKIP IT !!!!-->
			<!-- <img src="/resources/...?add={$row['product_id']}" alt=""> -->
			
				<div class="caption">
					<h4 class="pull-right">&#36;{$row['product_price']}</h4>
					<h4><a href='item.php?id={$row['product_id']}'>{$row['product_title']}</a></h4>
					<p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
					<a class="btn btn-primary" target="_blank" href="item.php?id={$row['product_id']}">Add to cart</a>
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
		$product = <<<DELIMETER
		     <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <a href="item.php?id={$row['product_id']}"><img src="{$row['product_image_medium']}" alt=""></a>
                    <div class="caption">
						<h3><a href='item.php?id={$row['product_id']}'>{$row['product_title']}</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a class="btn btn-primary" target="_blank" href="item.php?id={$row['product_id']}">Add to cart</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default"> More Info</a>
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
		$product = <<<DELIMETER
		     <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <a href="item.php?id={$row['product_id']}"><img src="{$row['product_image_medium']}" alt=""></a>
                    <div class="caption">
						<h3><a href='item.php?id={$row['product_id']}'>{$row['product_title']}</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a class="btn btn-primary" target="_blank" href="item.php?id={$row['product_id']}">Add to cart</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default"> More Info</a>
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
?>