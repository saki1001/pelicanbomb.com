<?php
/**
 * The template for the Spaces category page.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php get_header(); ?>
    
    <section id="content">
        
        <h2>
            <?php wp_title(''); ?>
        </h2>
        
        <div id="mapBox">
        </div>
        
        <?php get_sidebar(); ?>
            
        <?php
            // $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
            
            $spaces_args = array(
                'nopaging' => 'true',
                'category_name' => 'spaces',
                // 'paged' => $paged,
                'orderby'    => 'title',
                'order' => 'ASC'
            );
            
            // Custom Query
            $spaces_query = new WP_Query( $spaces_args );
            
            if ( $spaces_query->have_posts() ) :
        ?>
                <div id="spaces">
                
        <?php
                while ( $spaces_query->have_posts() ) : $spaces_query->the_post();
                    get_template_part( 'content-space', get_post_format() );
                endwhile;
        ?>
                
                </div>
                
        <?php
            else :
                
                // Content Not Found Template
                include('content-not-found.php');
                
            endif;
        ?>
        
        <?php //get_template_part( 'content-pagination' ); ?>
        
        <?php wp_reset_postdata(); ?>
    </section>
    
<?php get_footer(); ?>