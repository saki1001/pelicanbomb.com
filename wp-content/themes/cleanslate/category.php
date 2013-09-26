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
        
        <?php
            // Query Category Object
            $cat_obj = $wp_query->get_queried_object();
            
            if ( is_category('read') || $cat_obj->parent === get_cat_ID('read') ) :
        ?>
            <div id="features">
                <?php echo get_featured_posts('read', 5, 'content-preview'); ?>
            </div>
            
        <?php
            endif;
        ?>
        
        <h2>
            <?php wp_title(''); ?>
        </h2>
        
        <?php
            if ( have_posts() ) :
        ?>
                <div id="articles">
                
        <?php
                if ( is_category('press') ){
                  $template = 'content-preview';
                } else {
                  $template = 'content-summary';
                }
                
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
        
        <?php get_sidebar('sort'); ?>
        
        <?php get_template_part( 'content-pagination' ); ?>
        
    </section>
    
<?php get_footer(); ?>