<?php
function get_featured_posts($category, $number, $template) {
    
    wp_reset_postdata();
    
    // Set Category
    if (!$category) {
        $category = 'read';
    }
    
    // Set Number
    if (!$number) {
        $number = 1;
    }
    
    if ($number === 1) {
        $orderBy = 'rand';
    } else {
        $orderBy = 'date';
    }
    
    if ($number === 5) {
        $order = 'ASC';
    } else {
        $order = 'DESC';
    }
    
    
    $article_args = array(
        'category_name' => $category,
        'meta-key' => 'featured',
        'meta_query' => array(
            array(
                'key' => 'featured',
                'value' => 1,
                'compare' => 'IN',
            )
        ),
        'post_status' => array( 'publish', 'draft' ),
        'posts_per_page' => $number,
        'orderby'    => $orderBy,
        'order' => $order
    );
    
    $article_query = new WP_Query( $article_args );
    
    if ( $article_query->have_posts() ) :
        
        $articleHTML = '';
        
        while ( $article_query->have_posts() ) : $article_query->the_post();
            
            $articleHTML .= get_template_part($template);
            
        endwhile;
        
        return $articleHTML;
        
    else :
        return '';
    endif;
    
    wp_reset_postdata();
}
?>