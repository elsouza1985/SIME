<?php require_once 'config.php'; ?>
<?php include(HEADER_TEMPLATE) ?>

<!-- Contact Content -->

	<div class="contact_content">
		
		<div class="container">
			<div class="row">
				
				<div class="col-lg-8">
					<div class="contact_main_content">

						<div class="contact_subtitle">contact us</div>
						
						<!-- Contact Us Form -->
						<div class="contact_form_container">
							<form id="reply_form" action="post">
								<div>
									<input id="contact_form_name" class="input_field contact_form_name" type="text" placeholder="Name" required="required" data-error="Name is required.">
									<input id="contact_form_email" class="input_field contact_form_email" type="email" placeholder="E-mail" required="required" data-error="Valid email is required.">
									<input id="contact_form_subject" class="input_field contact_form_subject" type="text" placeholder="Subject" required="required" data-error="Subject is required.">
									<textarea id="contact_form_message" class="text_field contact_form_message" name="message"  placeholder="Message" rows="4" required data-error="Please, write us a message."></textarea>
								</div>
								<div>
									<button id="contact_form_submit" type="submit" class="contact_submit_btn trans_300" value="Submit">
										send<img src="images/arrow_right.svg" alt="">
									</button>
								</div>

							</form>
						</div>

					</div>
				</div>
				
				<!-- Sidebar -->
				<div class="col-lg-4">
					<div class="contact_sidebar">
						
						<!-- Contact Info -->
						<div class="sidebar_section">
							<div class="sidebar_contact_info">
								<div class="sidebar_title">contact info</div>
								<ul>
									<li>Rosia Road , No234/56
									<br>
									Gibraltar , UK</li>
									<li>contact@cocoontemplate.com</li>
									<li>+5463 834 53 2245</li>
								</ul>
							</div>
						</div>

					</div>
				</div>

			</div>

			

	<!-- Contact -->

    <?php include(FOOTER_TEMPLATE);?>