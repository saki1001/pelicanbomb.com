<?php
/**
 * The Template for displaying all single posts.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php get_header(); ?>
    
    <?php
        if( in_category('see') || in_category('events') ) {
            $template = 'content-event';
        } else {
            $template = 'content';
        }
        
    ?>
    
    <section id="content">
    
    <?php
        if ( have_posts() ) :
            
            while ( have_posts() ) : the_post();
                get_template_part( $template, get_post_format() );
            endwhile;
            
        else :
            // Content Not Found Template
            include('content-not-found.php');
        
        endif;
        
        get_sidebar();
    ?>
    
    </section>
    
<?php get_footer(); ?>