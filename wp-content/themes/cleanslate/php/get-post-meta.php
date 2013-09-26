<?php
    // Include this file to get varibles
    // And insert into the post
    
    $categoryName = '';
    
    // Get the Category
    if( is_category('events') ) {
        $categoryName = get_field('event-type');
    } else {
        
        // Query Category Object
        $categories = get_the_category();
        
        foreach( $categories as $category ) :
            
            // For 'Read' and 'See'
            // Only show child catergories
            if( $category->category_nicename === 'read' || $category->category_nicename === 'see' ) {
                
                if( $category->parent != 0 ) {
                    $categoryName = $category->cat_name;
                }
                
            } else {
                $categoryName = $category->cat_name;
            }
            
        endforeach;
        
        if( in_category('see') && $categoryName === '' ) {
            $categoryName = 'Exhibition';
        }
    }
    
    // Find post author
    $authorMeta = get_post_meta($post->ID, 'read-author');
    
    if( count($authorMeta) > 0 ) :
        $author = $authorMeta[0];
    else :
        $author = get_the_author();
    endif;
    
    if( in_category('press') ){
        $permalink = get_field('press-link');
    } else {
        $permalink = get_permalink();
    }
?>