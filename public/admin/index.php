<!-- Configuration-->
<?php require_once("../../resources/config.php"); ?>


<?php include(TEMPLATE_BACK . DS . "/header.php"); ?>
 
<?php 

if(!isset($_SESSION['username'])) {


redirect("../../index.php");

}


 ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading ONLY dispalying in admin_content.php -->

                <!-- /.row -->
				
				<?php
				
					/* DIFFERENCE BETWEEN A SUPER GLOBAL $_SERVER THAT SHOWS THE PATH AND __DIR__ which takes the entire path starting from var
					
					echo $_SERVER['REQUEST_URI']; 
	
					echo __DIR__;
					
					*/
				
					if($_SERVER['REQUEST_URI'] == "/ecom/public/admin/" || $_SERVER['REQUEST_URI'] == "/ecom/public/admin/index.php")
					{
							include(TEMPLATE_BACK . DS . "/admin_content.php");
					}
						
					if(isset($_GET['orders']))
					{
							include(TEMPLATE_BACK . DS . "/orders.php");
					}
					if(isset($_GET['products']))
					{
							include(TEMPLATE_BACK . DS . "/products.php");
					}
					if(isset($_GET['add_product']))
					{
							include(TEMPLATE_BACK . DS . "/add_product.php");
					}
					if(isset($_GET['categories']))
					{
							include(TEMPLATE_BACK . DS . "/categories.php");
					}
					if(isset($_GET['users']))
					{
							include(TEMPLATE_BACK . DS . "/categories.php");
					}
					
				?>
				
				


<?php include(TEMPLATE_BACK . DS . "/footer.php"); ?>
