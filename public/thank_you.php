<!-- Configuration-->
<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

<?php

	if(isset($_GET['tx']))
	{
		$amount = $_GET['amt'];
		$currency = $_GET['cc'];
		$transaction = $_GET['tx'];
		$status = $_GET['st'];
		
		


	}
	else
	{
		redirect("index.php");
	}
	
?>

    <!-- Page Content -->
    <div class="container">

		<h3 class="text-center">Thank you for shopping with us!</h3>
	
    </div>
    <!-- /.container -->

    <div class="container">

        <hr>


<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>