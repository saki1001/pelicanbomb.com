<?php
    // Include this file to get varibles
    // And insert into the post
    
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
    
    // Find post author
    $authorMeta = get_post_meta($post->ID, 'read-author');
    
    if( count($authorMeta) > 0 ) :
        $author = $authorMeta[0];
    else :
        $author = get_the_author();
    endif;
?>