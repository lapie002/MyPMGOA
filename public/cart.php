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
				$_SESSION['product_' . $_GET['add']] +=1;
				redirect("checkout.php");
			}
			else
			{
				set_message("We only have " . $row['product_quantity'] . " item(s) of " . $row['product_title'] . " available in our shop.");
				redirect("checkout.php");
			}
		}
		
	}
	
	//method to remove ONE item selected in shopping cart
	if(isset($_GET['remove']))
	{
		$_SESSION['product_' . $_GET['remove']] --;
		
		if($_SESSION['product_' . $_GET['remove']] < 1)
		{
			unset($_SESSION['item_total']);
			unset($_SESSION['item_quantity']);
			redirect("checkout.php");
		}
		else
		{
			redirect("checkout.php");
		}
	}
	
	//method to delete ALL item selected in shopping cart
	if(isset($_GET['delete']))
	{
		$_SESSION['product_' . $_GET['delete']] = '0';
		unset($_SESSION['item_total']);
		unset($_SESSION['item_quantity']);
		
		redirect("checkout.php");
	}
	
	//function to display item selected in checkout page
	function cartDisplayItem()
	{
		$total = 0;
		$item_quantity = 0;
		
		//varaibles for paypal checkout only
		$item_name = 1;
		$item_number = 1;
		$amount = 1;
		$quantity = 1;
	 
		foreach($_SESSION as $name => $value)
		{
		
			if($value>0)
			{
		
				if(substr($name, 0, 8) == "product_")
				{
					$length = strlen($name - 8);
					$id = substr($name, 8, $length);
					
					$query = query("SELECT * FROM products WHERE product_id = " . escape_string($id) . " ");
					confirm($query);
		
					while($row = fetch_array($query))
					{
						$sub = $row['product_price'] * $value;
						$item_quantity += $value;
						
						$productInCart = <<<DELIMETER
			
						<tr>
							<td>{$row['product_title']}</td>
							<td>&#36;{$row['product_price']}</td>
							<td>{$value}</td>
							<td>&#36;{$sub}</td>
							<td><a class='btn btn-danger' href="cart.php?delete={$row['product_id']}"><span class='glyphicon glyphicon-remove'></span></a>       <a class='btn btn-warning' href="cart.php?remove={$row['product_id']}"><span class='glyphicon glyphicon-minus'></span></a>         <a class='btn btn-success' href="cart.php?add={$row['product_id']}"><span class='glyphicon glyphicon-plus'></span></a></td>
						</tr>

						<input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
						<input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
						<input type="hidden" name="amount_{$amount}" value="{$row['product_price']}">
						<input type="hidden" name="quantity_{$quantity}" value="{$value}">
						
DELIMETER;

						echo $productInCart;
						
						$item_name++;
						$item_number++;
						$amount++;
						$quantity++;
						
						
					}
					
					$_SESSION['item_total'] =  $total += $sub;
					$_SESSION['item_quantity'] = $item_quantity;
				}
			}
		}
		
	}

 ?>