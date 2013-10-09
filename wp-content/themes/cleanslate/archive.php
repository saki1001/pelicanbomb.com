<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php get_header(); ?>
    
    <?php if ( have_posts() ) : ?>
        
        <section id="content">
            
            <div id="articles">
            
            <?php
                while ( have_posts() ) : the_post();
                    
                    get_template_part( 'content-search', get_post_format() );
                    
                endwhile;
            ?>
            
            </div>
            
            <?php get_sidebar(); ?>
            
        </section>
        
    <?php
        else :
            // Content Not Found Template
            include('content-not-found.php');
            
        endif;
    ?>
    
<?php get_footer(); ?>