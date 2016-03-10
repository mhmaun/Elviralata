</div><!--End Main Contain-->
<div id="footerContain">
	<div id="footer">
    	<div id="footerLeftContain">
        		<div id="footerMenuCont">
                	<?php 
                    	wp_nav_menu(array(
                        	 'theme_location' => 'footerMenu'
                    	)); 
                	?>             	
                </div>
                <div id="footerPrivacyPolicy">
                	<?php 
                    	wp_nav_menu(array(
                        	 'theme_location' => 'footerAdvertisementMenu'
                    	)); 
                	?> 
                	<ul>
                    	<li><a href="#">Advertisement</a></li>
                		<li><a href="#">Disclaimer</a></li>
                		<li><a href="#">Terms of Use</a></li>
                		<li><a href="#">Privacy Policy</a></li>
                    </ul>              	
                </div>
                
                <div id="copyRightCont">
                	<?php dynamic_sidebar( 'copy-right-widget-area' ); ?>
                	Copyright © 2014 ElViralata.com  |  All Rights Reserved.
                </div>
        
        </div><!--end footer Left Contain-->
        
        <div id="footerRightContain"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/footer-elviralata-logo.png" width="345" height="140" alt="Elviralata Footer Logo" /></a></div>
    
    </div><!--End Footer-->
</div><!--End Footer Contain-->
<?php
	wp_footer();
?>
</body>
</html>
