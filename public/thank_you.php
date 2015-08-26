<!-- Configuration-->
<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

<?php

		
		report();
		
		/* destroy the current session to erase customer previous purchase was moved to cart.php*/
		//session_destroy();
	
?>

    <!-- Page Content -->
    <div class="container">

		<h3 class="text-center">Thank you for shopping with us!</h3>
	
    </div>
    <!-- /.container -->

    <div class="container">

        <hr>


<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>