<!-- begin footer -->
		<div id="footer-wrap">
		
			<div class="footer-block">
				<div class="centering">
					<div class="box studies">
						<h3><?php echo of_get_option('left_footer_title');?></h3>
						<p><?php echo of_get_option('left_footer_content');?></p>
					</div>
					<div class="box menu">						
						
						<?php dynamic_sidebar('footer_sidebar');?>
						
					</div>
					<div class="box contact">
						<h3>CONTACT</h3>
						<p><?php echo nl2br(of_get_option('contact_us'));?></p>
						<p>Tel: <a href="tel:<?php echo of_get_option('phone_number');?>"><?php echo of_get_option('phone_number');?></a></br>
						E-mail: <a href="mailto:<?php echo of_get_option('email_here');?>"><?php echo of_get_option('email_here');?></a></br> </p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<!-- finish footer -->
		
	</div>
	<!-- finish page wrap -->
	
</div>
<!-- finish section -->

<?php wp_footer(); ?>

</body>
</html>
