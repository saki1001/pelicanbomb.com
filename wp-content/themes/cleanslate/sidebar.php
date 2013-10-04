<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php
    
    if ( is_single() && in_category('see') || in_category('events') ) {
        
        $featuredCat = 'read';
        $featuredName = 'Featured Article';
        $showAds = true;
        
    } elseif ( is_page() ) {
        
        $featuredCat = 'read';
        $featuredName = 'Featured Product';
        $showAds = false;
        
    } elseif ( is_home() ) {
        _log('home');
        $featuredCat = 'see';
        $featuredName = 'Featured Exhibition';
        $showAds = true;
        
    } else {
        
        $featuredCat = 'events';
        $featuredName = 'Upcoming Event';
        $showAds = true;
        
    }
?>

<div id="sidebar">

<?php
    // ELEMENT 1
    // Related Posts
    if( is_single() && (in_category('see') || in_category('read')) ){
        
        $sectionTite = ( in_category('see') ? 'events' : 'articles' );
        
        $relatedPostsIDs = get_field('related-posts');
        
        $related_posts_args = array(
            'post__in' => $relatedPostsIDs,
            'orderby' => 'date'
        );
        
        $related_posts_query = new WP_Query( $related_posts_args );
        
        if ( $relatedPostsIDs != '' && $related_posts_query->have_posts() ) :
?>
        <section id="related">
            <h3>Related <?php echo ucfirst($sectionTite); ?></h3>
<?php
            while ( $related_posts_query->have_posts() ) : $related_posts_query->the_post();
                get_template_part( 'content-related', get_post_format() );
            endwhile;
?>
        </section>
<?php
        else :
            // do nothing
        endif;
    }
?>

<?php
    // ELEMENT 2
    // Featured Post/Product
?>
    <section class="featured-post">
        <h3>
            <?php echo $featuredName; ?>
        </h3>
        
<?php
    // For Pages
    // Content loaded dynamically
    if( is_page() ){
?>
        
        <div class="loading"></div>
        
<?php
    // For Everything else
    // Get Featured Post
    } else {
        
        echo get_featured_posts($featuredCat, 1, 'content-feature');
        
    }
?>
    </section>
    
<?php
    // ELEMENT 3
    // Advertisements
    if( $showAds === true ) :
        
        $page = get_page_by_title( 'Advertisements' );
        $ads = get_field('advertisement', $page->ID);
        
        if( $ads != '' ) {
?>
        <div class="ads">
<?php
        $i = 0;
        
        // Iterate throught Ads
        foreach( $ads as $ad ) :
            
            // Find odd or even
            if( $i %2 == 0) {
                $class = 'left';
            } else {
                $class = 'right';
            }
            
            $thumb = array(
                'url' => $ad['ad-image']['sizes']['small-thumbnail'],
                'width' => $ad['ad-image']['sizes']['small-thumbnail-width'],
                'height' => $ad['ad-image']['sizes']['small-thumbnail-height']
            );
?>
            <div class="ad <?php echo $class; ?>">
                <a href="<?php echo $ad['ad-link']; ?>" title="<?php echo $ad['ad-title']; ?>" target="_blank">
                    <img src="<?php echo $thumb['url']; ?>" width="<?php echo $thumb['width']; ?>" height="<?php echo $thumb['height']; ?>" alt="<?php echo $ad['ad-title']; ?>" />
                </a>
            </div>
<?php
            $i++;
        
        endforeach;
?>
        </div>
<?php
        }
    endif;
?>
</div><!-- #sidebar -->