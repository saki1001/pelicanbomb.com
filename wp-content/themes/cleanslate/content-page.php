<?php
/**
 * The general template used for displaying page content in page.php.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php
        // Get masthead for 'About' page
        $masthead = get_field('about-masthead');
    ?>
    
    <div id="text" class="text-container">
        <?php the_content(); ?>
    </div>
    
</article>


<?php
    if( is_page('about') ) :
?>
    <div id="sidebar" class="masthead">
        <?php 
            echo $masthead;
        ?>
    </div>
<?php
    else :
        get_sidebar();
    endif;
?>