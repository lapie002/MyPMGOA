<!-- Configuration-->
<?php require_once("../resources/config.php"); ?>

<?php
	// method to add item in shopping cart
	if(isset($_GET['add']))
	{
		//$_SESSION['product_' . $_GET['add']] += 1;
		//redirect("index.php");
		
		$query = query("SELECT * FROM products WHERE product_id = ".escape_string($_GET['add'])." ");
		confirm($query);
		
		while($row = fetch_array($query))
		{
			if($row['product_quantity'] != $_SESSION['product_' . $_GET['add']])
			{
				$_SESSION['product_' . $_GET['add']] += 1;
				redirect("checkout.php");
			}
			else
			{
				set_message("We only have " . $row['product_quantity'] . " item(s) of " . $row['product_title'] . " available in our shop.");
				redirect("checkout.php");
			}
		}
		
	}
	
	//method to remove item selected in shopping cart
	if(isset($_GET['remove']))
	{
		$_SESSION['product_' . $_GET['remove']] --;
		
		if($_SESSION['product_' . $_GET['remove']] < 1)
		{
			redirect("checkout.php");
		}
		else
		{
			redirect("checkout.php");
		}
	}
	
	//method to delete item selected in shopping cart
	if(isset($_GET['delete']))
	{
		$_SESSION['product_' . $_GET['delete']] = '0';
		redirect("checkout.php");
	}
	
	//function to display item selected in checkout page
	function cartDisplayItem()
	{
		$query = query("SELECT * FROM products");
		confirm($query);
		
		while($row = fetch_array($query))
		{
			$productInCart = <<<DELIMETER
			
            <tr>
                <td>{$row['product_title']}</td>
                <td>&#36;{$row['product_price']}</td>
                <td>3</td>
                <td>2</td>
				<td><a href="cart.php?remove=1">Remove</a></td>
				<td><a href="cart.php?delete=1">Delete</a></td>
            </tr>		
DELIMETER;

			echo $productInCart;
		}
		
		
	}

 ?>