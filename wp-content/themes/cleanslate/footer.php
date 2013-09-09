<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

    </div><!-- #main -->
    <div class="push"></div>
</div><!-- #page -->

<footer id="footer" role="contentinfo">
    
    <div class="footer-wrapper">
        
        <div class="column links">
            <h3>Links</h3>
            <?php wp_nav_menu( array( 'theme_location' => 'footer-pages' ) ); ?>
            <?php wp_nav_menu( array( 'theme_location' => 'footer-cats' ) ); ?>
        </div>
        
        <div class="column newsletter">
            <form action="#" method="post" id="newsletter-form" name="mc-embedded-subscribe-form" target="_blank" novalidate>
                <input type="email" value="Enter your email" name="EMAIL" class="email" id="n" placeholder="Enter your email" required>
                <input type="submit" id="newsletter-form-submit" name="subscribe" value="Sign Up" />
            </form>
            <p>Sign up to get updates from Pelican Bomb.</p>
        </div>
        
    <?php
        if( !is_search() ) {
    ?>
        <div class="column search">
            <?php get_search_form(); ?>
        </div>
    <?php
        }
    ?>
        
    </div>
    
</footer><!-- #footer -->

<?php wp_footer(); ?>

</body>
</html>