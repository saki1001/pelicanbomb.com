<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php get_header(); ?>
    
    <?php if ( have_posts() ) : ?>
        
        <section id="content">
            
            <h2>
                Posts by <?php wp_title(''); ?>
            </h2>
            
            <div id="articles">
            
            <?php
                while ( have_posts() ) : the_post();
                    
                    get_template_part( 'content-search', get_post_format() );
                    
                endwhile;
            ?>
            
            </div>
            
            <?php get_sidebar(); ?>
            
            <?php get_template_part( 'content-pagination' ); ?>
            
        </section>
        
    <?php
        else :
            // Content Not Found Template
            include('content-not-found.php');
            
        endif;
    ?>
    
<?php get_footer(); ?>