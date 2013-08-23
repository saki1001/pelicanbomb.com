<?php
/**
 * The template for routing Category posts to their respective pages.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php get_header(); ?>
    
    <section id="content">
        
        <?php get_sidebar('sort'); ?>
        
        <?php
            // Query Category Object
            $cat_obj = $wp_query->get_queried_object();
            
            if ( is_category( 'see' ) || $cat_obj->parent === get_cat_ID('see') ) :
                $template = 'content-summary';
            else :
                $template = 'content-preview';
            endif;
            
            if ( have_posts() ) :
        ?>
                <div id="articles">
                
        <?php
                while ( have_posts() ) : the_post();
                    get_template_part( $template, get_post_format() );
                endwhile;
        ?>
                
                </div>
                
        <?php
            else :
                
                // Content Not Found Template
                include('content-not-found.php');
                
            endif;
        ?>
        
        <div class="pagination">
            <div id="next-page"><?php next_posts_link('Next &rarr;','') ?></div>
        </div>
        
    </section>
    
<?php get_footer(); ?>