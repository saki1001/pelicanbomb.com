<?php
    // Set date
    if( in_category('press') ) {
        $startDate = date('F j, Y', strtotime(get_field('press-date')));
    } else {
        $startDate = date('F j, Y', strtotime(get_field('start-date')));
    }
    
    if( !get_field('start-date') ) {
        $date = get_the_date();
    } elseif( get_field('end-date') ) {
        $endDate = date('F j, Y', strtotime(get_field('end-date')));
        
        $date = $startDate . ' - ' . $endDate;
    } else {
        $date = $startDate;
    }
    
    // Set time
    $time = get_field('event-time');
    
    if (preg_match('/^\d{2}:\d{2}:\d{2}$/', $time)) {
        // Format time string
        $time = date('g:i a', strtotime( $time ) );
    } else {
        // Already manually formatted
    }
    
    // Set date box
    $dateBox = '';
    
    if( in_category('events') ) {
        $dateBox .= '<span class="date-box">';
        $dateBox .= date('d', strtotime(get_field('start-date')));
        $dateBox .= '</span>';
    }
    
    // Set city if none supplied
    if( !get_field('location-city') ) {
        $city = 'New Orleans, LA';
    } else {
        $city = get_field('location-city');
    }
    
    // Formatted address
    $address = get_field('location-address') . ' ' . $city . ' ' . get_field('location-zip');
    
?>