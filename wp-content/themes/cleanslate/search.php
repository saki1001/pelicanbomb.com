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
        
        <div class="sub-header">
            <?php get_search_form(); ?>
        </div>
        
        <?php get_sidebar(); ?>
        
        <?php
            
            if ( have_posts() ) :
        ?>
        
        <div id="articles">
            
        <?php
                while ( have_posts() ) : the_post();
                    get_template_part('content-search' );
                endwhile;
        ?>
        
        </div>
        
        <?php
            else :
                // Content Not Found Template
                include('content-no-results.php');
                
            endif;
        ?>
        
        <?php get_template_part( 'content-pagination' ); ?>
        
    </section>
    
<?php get_footer(); ?>
