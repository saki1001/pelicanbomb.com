<?php
/**
 * The template to display pagination.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>


<div class="pagination">
    
    <?php
        
        global $wp_query;
        
        $big = 999999999; // need an unlikely integer
        
        $args = array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'prev_text'    => __('&larr; Previous'),
            'next_text'    => __('Next &rarr;'),
            'total' => $wp_query->max_num_pages
        );
        echo paginate_links( $args );
    ?>
    
</div>