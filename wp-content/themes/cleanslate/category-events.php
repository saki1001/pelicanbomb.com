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
        
        <?php
            $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
            
            $events_args = array(
                'category_name' => 'events',
                'paged' => $paged,
                'meta-key' => 'start-date',
                // 'meta_query' => array(
                //     array(
                //         'key' => 'start-date',
                //         'value' => array($firstDay, $lastDay),
                //         'compare' => 'BETWEEN',
                //     )
                // ),
                'post_status' => 'publish',
                'orderby'    => 'meta-value',
                'order' => 'DESC'
            );
            
            // Custom Query
            $events_query = new WP_Query( $events_args );
            
            $thisMonth = date('m');
            $thisTime = mktime(0, 0, 0, $thisMonth, date('d'), date('Y'));
            
            if ( $events_query->have_posts() ) :
        ?>
                <div id="articles">
        <?php
                while ( $events_query->have_posts() ) : $events_query->the_post();
                    
                    $newTime = strtotime(get_field('start-date'));
                    $newMonth = date('m', $newTime);
                    
                    if( $events_query->current_post === 0 && $newMonth === $thisMonth ) {
        ?>
                    <h2><?php echo date('F', $thisTime); ?></h2>
        <?php
                    }
                    
                    if( $newMonth != $thisMonth ) {
        ?>
                        <h2><?php echo date('F', $newTime); ?></h2>
        <?php
                        $thisMonth = $newMonth;
                    }
                    
                    get_template_part( 'content-summary', get_post_format() );
                endwhile;
        ?>
                
                </div>
                
        <?php
            else :
                
                // Content Not Found Template
                include('content-not-found.php');
                
            endif;
        ?>
        
        <?php get_sidebar(); ?>
        
        <?php get_template_part( 'content-pagination' ); ?>
        
        <?php wp_reset_postdata(); ?>
    </section>
    
<?php get_footer(); ?>