<?php
/* code to put in your functions.php file */

// removed $initial = true
function get_calendar_custom($catid, $requestDate, $currentPostDate) {
    global $wpdb, $m, $monthnum, $year, $wp_locale, $posts;
    
    if ($requestDate) {
        $monthnum = date('m', mktime(0, 0 , 0, $requestDate));
        $year = date('Y', mktime(0, 0 , 0, $requestDate));
    }
    
    $key = md5( $m . $monthnum . $year );
    if ( $cache = wp_cache_get( 'get_calendar_custom', 'calendar_custom' ) ) {
        if ( isset( $cache[ $key ] ) ) {
            echo $cache[ $key ];
            return;
        }
    }
    
    
    ob_start();
    // Quick check. If we have no posts at all, abort!
    if ( !$posts ) {
        $gotsome = $wpdb->get_var("SELECT ID from $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' ORDER BY post_date DESC LIMIT 1");
        if ( !$gotsome )
            return;
    }

    if ( isset($_GET['w']) )
        $w = ''.intval($_GET['w']);

    // week_begins = 0 stands for Sunday
    $week_begins = intval(get_option('start_of_week'));

    // Let's figure out when we are
    if ( !empty($monthnum) && !empty($year) ) {
        $thismonth = ''.zeroise(intval($monthnum), 2);
        $thisyear = ''.intval($year);
    } elseif ( !empty($w) ) {
        // We need to get the month from MySQL
        $thisyear = ''.intval(substr($m, 0, 4));
        $d = (($w - 1) * 7) + 6; //it seems MySQL's weeks disagree with PHP's
        $thismonth = $wpdb->get_var("SELECT DATE_FORMAT((DATE_ADD('${thisyear}0101', INTERVAL $d DAY) ), '%m')");
    } elseif ( !empty($m) ) {
        $thisyear = ''.intval(substr($m, 0, 4));
        if ( strlen($m) < 6 )
                $thismonth = '01';
        else
                $thismonth = ''.zeroise(intval(substr($m, 4, 2)), 2);
    } else {
        $thisyear = gmdate('Y', current_time('timestamp'));
        $thismonth = gmdate('m', current_time('timestamp'));
    }

    $unixmonth = mktime(0, 0 , 0, $thismonth, 1, $thisyear);

    // // Get the next and previous month and year with at least one post
    // $previous = $wpdb->get_row("SELECT DISTINCT MONTH(post_date) AS month, YEAR(post_date) AS year
    //     FROM $wpdb->posts
    //     LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id) 
    //     LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id) 
    //     
    //     WHERE post_date < '$thisyear-$thismonth-01'
    // 
    //     AND $wpdb->term_taxonomy.term_id IN ($catid) 
    //     AND $wpdb->term_taxonomy.taxonomy = 'category' 
    // 
    //     AND post_type = 'post' AND post_status = 'publish'
    //         ORDER BY post_date DESC
    //         LIMIT 1");
    // 
    // $next = $wpdb->get_row("SELECT    DISTINCT MONTH(post_date) AS month, YEAR(post_date) AS year
    //     FROM $wpdb->posts
    //     LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id) 
    //     LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    //     
    //     WHERE post_date >    '$thisyear-$thismonth-01'
    // 
    //     AND $wpdb->term_taxonomy.term_id IN ($catid) 
    //     AND $wpdb->term_taxonomy.taxonomy = 'category' 
    // 
    //     AND MONTH( post_date ) != MONTH( '$thisyear-$thismonth-01' )
    //     AND post_type = 'post' AND post_status = 'publish'
    //         ORDER    BY post_date ASC
    //         LIMIT 1");
    
    $prevMonth = date('m', mktime(0, 0, 0, date("m", strtotime($requestDate))-1,1,date("Y")) );
    $prevMonthDays = date('t', mktime(0, 0, 0, $prevMonth, 1, date('Y')) );
    
    $prevFirstDayUTS = mktime (0, 0, 0, $prevMonth,1,date("Y"));
    $prevLastDayUTS = mktime (0, 0, 0, $prevMonth,$prevMonthDays,date("Y"));
    
    $prevFirstDay = date("Y-m-d", $prevFirstDayUTS);
    $prevLastDay = date("Y-m-d", $prevLastDayUTS);
    
    $firstDayUTS = mktime (0, 0, 0, date("m", strtotime($requestDate)), 1, date("Y"));
    $lastDayUTS = mktime (0, 0, 0, date("m", strtotime($requestDate)), date('t'), date("Y"));
    
    $firstDay = date("Y-m-d", $firstDayUTS);
    $lastDay = date("Y-m-d", $lastDayUTS);
    
    $nextMonth = date('m', mktime(0, 0, 0, date("m", strtotime($requestDate))+1,1,date("Y")) );
    $nextMonthDays = date('t', mktime(0, 0, 0, $nextMonth, 1, date('Y')) );
    
    $nextFirstDayUTS = mktime (0, 0, 0, $nextMonth,1,date("Y"));
    $nextLastDayUTS = mktime (0, 0, 0, $nextMonth,$nextMonthDays,date("Y"));
    
    $nextFirstDay = date("Y-m-d", $nextFirstDayUTS);
    $nextLastDay = date("Y-m-d", $nextLastDayUTS);
    
    _log($prevFirstDay);
    _log($prevLastDay);
    
    _log($nextFirstDay);
    _log($nextLastDay);
    
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    
    $previous_args = array(
        'category_name' => 'events',
        'paged' => $paged,
        'meta-key' => 'start-date',
        'meta_query' => array(
            array(
                'key' => 'start-date',
                'value' => array($firstDay, $lastDay),
                'compare' => 'BETWEEN',
            )
        ),
        'post_status' => 'publish',
        'orderby'    => 'meta-value',
        'order' => 'DESC'
    );
    
    $previous = get_posts( $previous_args );
    
    // _log($previous);
    // echo '<ul class="cal-date-nav">';
    // 
    // // Month Title
    // echo "\n\t\t". '<li class="cal-date">' . sprintf(_c('%1$s %2$s|Used as a calendar caption'), $wp_locale->get_month($thismonth), date('Y', $unixmonth)) . '</li>';
    // 
    // // Next Link
    // if ( $next ) {
    //     echo "\n\t\t".
    //     '<li class="next">
    //     <a href="#" id="next-link" title="' . sprintf(__('View posts for %1$s %2$s'), $wp_locale->get_month($next->month),
    //         date('Y', mktime(0, 0 , 0, $next->month, 1, $next->year))) . '" data-adjacent-calendar="'.$next->month.', 1, '. $next->year.'"></a>
    //     </li>';
    // } else {
    //     echo "\n\t\t".'<li class="next empty"></li>';
    // }
    // 
    // // Previous Link
    // if ( $previous ) {
    //     echo "\n\t\t".
    //     '<li class="prev">
    //     <a href="#" id="prev-link" title="' . sprintf(__('View posts for %1$s %2$s'), $wp_locale->get_month($previous->month),
    //         date('Y', mktime(0, 0 , 0, $previous->month, 1, $previous->year))) . '" data-adjacent-calendar="'.$previous->month.', 1, '. $previous->year.'"></a>
    //     </li>';
    // } else {
    //     echo "\n\t\t".'<li class="prev empty"></li>';
    // }
    // 
    // echo '</ul>';
    // 
    // $output = ob_get_contents();
    // ob_end_clean();
    // echo $output;
    // $cache[ $key ] = $output;
    // wp_cache_set( 'get_calendar_custom', $cache, 'calendar_custom' );
}
?>