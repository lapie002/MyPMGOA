<!-- Configuration-->
<?php require_once("../../resources/config.php"); ?>


<?php include(TEMPLATE_BACK . DS . "/header.php"); ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Statistics Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				
				<?php
				
					if($_SERVER['REQUEST_URI'] == "/ecom/public/admin/" || $_SERVER['REQUEST_URI'] == "/ecom/public/admin/index.php")
						{
							include(TEMPLATE_BACK . DS . "/admin_content.php");
						}
					
					
					/* DIFFERENCE BETWEEN A SUPER GLOBAL $_SERVER THAT SHOWS THE PATH AND __DIR__ which takes the entire path starting from var
					
					echo $_SERVER['REQUEST_URI']; 
	
					echo __DIR__;
					
					*/
					
				?>
				
				


<?php include(TEMPLATE_BACK . DS . "/footer.php"); ?>
