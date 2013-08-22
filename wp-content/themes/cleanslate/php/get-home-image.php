<?php
function get_home_image($category, $size) {
    
    wp_reset_postdata();
    
    // Set Category
    if (!$category) {
        $category = 'home';
    }
    
    // Set Image Size
    if (!$size) {
        $size = 'large';
    }
    
    // Set Arguments
    $home_args = array(
        'category_name' => $category,
        'tag' => 'home',
        'posts_per_page' => '1',
        'order'    => 'DESC'
    );
    
    $home_query = new WP_Query( $home_args );
    
    if ( $home_query->have_posts() ) :
        
        while ( $home_query->have_posts() ) : $home_query->the_post();
            
            $postID = get_the_id();
            
            // Set Arguments
            $image_args = array(
                'post_parent' => $postID,
                'post_type' => 'attachment',
                'post_mime_type' => 'image',
                'orderby' => 'menu_order',
                'order' => 'ASC'
            );
            
            // Get image attachments
            $attachments = get_children( $image_args );
            
            // Featured Image
            $featImg = wp_get_attachment_image_src( get_post_thumbnail_id($postId), $size );
            
            if ( $featImg || $attachments ) :
                
                if ( has_post_thumbnail($postID) ) :
                    // Use Featured Image URL
                    $image = $featImg;
                    
                else :
                    // Use only first value in array
                    $attachment = array_shift( $attachments );
                    
                    // Get Image URL
                    $image = wp_get_attachment_image_src( $attachment->ID, $size );
                    
                endif;
            else :
                
                $image = '';
                
            endif;
            
            return $image;
            
        endwhile;
        
    else :
        return '';
    endif;
    
    wp_reset_postdata();
}
?>