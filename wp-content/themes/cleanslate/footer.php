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
    
    <?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
    
    <div>
        Author &copy;2013
    </div>
</footer><!-- #footer -->

<?php wp_footer(); ?>

</body>
</html>