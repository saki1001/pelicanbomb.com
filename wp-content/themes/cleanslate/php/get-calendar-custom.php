<?php
/* code to put in your functions.php file */

function get_calendar_custom($requestDate) {
    
    // PREVIOUS MONTH DATES
    $prevFirstDayUTS = strtotime('first day of -1 month', strtotime($requestDate));
    $prevLastDayUTS = strtotime('last day of -1 month', strtotime($requestDate));
    
    $prevFirstDay = date("Y-m-d", $prevFirstDayUTS);
    $prevLastDay = date("Y-m-d", $prevLastDayUTS);
    
    // NEXT MONTH DATES
    $nextFirstDayUTS = strtotime('first day of +1 month', strtotime($requestDate));
    $nextLastDayUTS = strtotime('last day of +1 month', strtotime($requestDate));
    
    $nextFirstDay = date("Y-m-d", $nextFirstDayUTS);
    $nextLastDay = date("Y-m-d", $nextLastDayUTS);
    
    // THIS MONTH DATES
    $firstDayUTS = strtotime('first day of this month', strtotime($requestDate));
    $lastDayUTS =  strtotime('last day of this month', strtotime($requestDate));
    
    $firstDay = date("Y-m-d", $firstDayUTS);
    $lastDay = date("Y-m-d", $lastDayUTS);
    
    
    function get_query($firstDate, $lastDate, $reset){
        
        $args = array(
            'category_name' => 'events',
            'meta-key' => 'start-date',
            'meta_query' => array(
                array(
                    'key' => 'start-date',
                    'value' => array($firstDate, $lastDate),
                    'compare' => 'BETWEEN',
                )
            ),
            'post_status' => 'publish',
            'orderby'    => 'meta_value',
            'order' => 'ASC'
        );
        
        $posts_query = new WP_Query( $args );
        
        return $posts_query;
        
        if( $reset === true ) {
            wp_reset_postdata();
        }
    }
    
    $previous_query = get_query($prevFirstDay, $prevLastDay, true);
    $next_query = get_query($nextFirstDay, $nextLastDay, true);
    $this_query = get_query($firstDay, $lastDay, false);
?>
        <nav>
            <h3><?php echo date('F Y', $firstDayUTS); ?></h3>
    
<?php
        if( $previous_query->have_posts() ) {
?>
            <a href="#" id="prev-link" class="month" title="View events for <?php echo date('F Y', $prevFirstDayUTS); ?>" data-date="<?php echo date('Y-m-d', $prevFirstDayUTS); ?>">&larr;</a>
<?php
        }
        
        if( $next_query->have_posts() ) {
?>
            <a href="#" id="next-link" class="month" title="View events for <?php echo date('F Y', $nextFirstDayUTS); ?>" data-date="<?php echo date('Y-m-d', $nextFirstDayUTS); ?>">&rarr;</a>
<?php
        }
?>
    </nav>
    
    <div id="articles">
<?php
    if( $this_query->have_posts() ) :
        
        while ( $this_query->have_posts() ) : $this_query->the_post();
            
            get_template_part( 'content-preview', get_post_format() );
            
        endwhile;
        
    else :
?>
        <p class="not-found">Sorry, no events this month.
<?php
    endif;
?>
    </div>
<?php
        wp_reset_postdata();
}
?>