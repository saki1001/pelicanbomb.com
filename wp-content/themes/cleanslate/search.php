<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php get_header(); ?>
    
    <section id="content">
        
        <h2>Search Results for <span>&ldquo;<?php the_search_query() ?>&rdquo;</span></h2>
        
        <?php
            
            if ( have_posts() ) :
                
                while ( have_posts() ) : the_post();
                    get_template_part('content-preview', get_post_format() );
                endwhile;
                
            else :
                // Content Not Found Template
                include('content-no-results.php');
                
            endif;
        ?>
        
    </section>
    
<?php get_footer(); ?>
