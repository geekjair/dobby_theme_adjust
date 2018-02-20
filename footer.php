<?php

/**
 * The template for footer
 *
 * @author Vtrois <seaton@vtrois.com>
 * @license GPL-3.0
 * @since 1.0
 */
?>
        <footer class="footer text-center"> 
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php if ( has_nav_menu('footer_menu') ) { wp_nav_menu( array( 'theme_location' => 'footer_menu', 'depth' => 1, 'container' => 'div', 'container_class' => 'footer-more-list text-center mb-3 d-none d-sm-block', 'menu_class' => null, 'container_id' => null) ); } ?>
                        <div class="text-center text-muted">
                            <div class="copyright">
                                <small>© 2018 <?php bloginfo('name'); ?>. All Rights Reserved.</small>
                                <small class="license mt-2">Theme Dobby Made By Vtrois.</small>
                            </div>
                            <div class="miitbeian mt-2">
                                <?php if( dobby_option('footer_icp_num') ) {?>
                                <small class="mx-1 text-muted"><a href="http://www.miitbeian.gov.cn/" rel="external nofollow" target="_blank"><?php echo dobby_option( 'footer_icp_num' ); ?></a></small>
                                <?php } if( dobby_option('footer_gov_num') ) {?>
                                <small class="mx-1 text-muted"><a href="<?php echo dobby_option( 'footer_gov_link' ); ?>" rel="external nofollow" target="_blank"><?php echo dobby_option( 'footer_gov_num' ); ?></a></small>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div class="gotop-box">
            <a href="#" class="gotop-btn"><i class="dobby v3-packup"></i></a>
        </div>
        <?php wp_footer(); ?>
	</body>
</html>