<?php
function get_featured_posts($category, $number) {
    
    wp_reset_postdata();
    
    // Set Category
    if (!$category) {
        $category = 'read';
    }
    
    // Set Number
    if (!$number) {
        $number = 1;
    }
    
    // Set Arguments
    $article_args = array(
        'category_name' => $category,
        'tag' => 'featured',
        'posts_per_page' => $number,
        'order'    => 'DESC'
    );
    
    $article_query = new WP_Query( $article_args );
    
    if ( $article_query->have_posts() ) :
        
        $articleHTML = '';
        
        while ( $article_query->have_posts() ) : $article_query->the_post();
            
            $articleHTML .= get_template_part('content-preview');
            
        endwhile;
        
        return $articleHTML;
        
    else :
        return '';
    endif;
    
    wp_reset_postdata();
}
?>