<?php
function get_thumbnail_custom($postId, $thumbType) {
    
    // Set Thumbnail Type
    if (!$thumbType) {
        $thumbType = 'thumbnail';
    }
    
    // Set Arguments
    $args = array(
        'post_parent' => $postId,
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );
    
    // Get image attachments
    $attachments = get_children( $args );
    
    // Featured Image
    $featImg = wp_get_attachment_image_src( get_post_thumbnail_id($postId), $thumbType );
    
    if ( $featImg || $attachments ) :
        
        if ( has_post_thumbnail($postId) ) :
            // Use Featured Image URL
            $image = $featImg;
        else :
            // Use only first value in array
            $attachment = array_shift( $attachments );
            
            // Get thumbnail URL
            $image = wp_get_attachment_image_src( $attachment->ID, $thumbType );
            
        endif;
    else :
        
        $url = get_template_directory_uri() . '/images/default-image-' . $thumbType . '.jpg';
        
        $image = array($url,get_option( $thumbType . '_size_w' ),get_option( $thumbType . '_size_h' ));
        
    endif;
    
    return $image;
    
}
?>