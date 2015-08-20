<!-- Configuration-->
<?php require_once("../resources/config.php"); ?>



<!-- Header-->
<?php include(TEMPLATE_FRONT .  "/header.php");?>

         <!-- Contact Section -->

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contact Us</h2>
                    <h3 class="section-subheading text-muted"> <?php display_message(); ?></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
				    <!--    <form method="post" action="php/action.php" name="cform" id="cform"> -->
                    <form name="sentMessage" id="contactForm" method="post">
                        <!-- Method action dans function.php to send emails -->
						<?php send_message(); ?>
						<div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name *" id="name" name="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Your Email *" id="email" name="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Subject *" id="phone" name="subject" required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Your Message *" id="message" name="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-xl" name="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
					
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->
    <div class="container">
	<hr>
		<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>