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
        $featuredName = 'Featured Article';
        $showAds = false;
        
    } elseif ( is_home() ) {
        
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
            // Related Events
            if( is_single() && in_category('see') ){
                
                $relatedEventsIDs = get_field('related_events');
                
                $related_events_args = array(
                    'category_name' => 'events',
                    'post__in' => $relatedEventsIDs,
                    'meta-key' => 'start-date',
                    'orderby' => 'meta-value'
                );
                
                $related_events_query = new WP_Query( $related_events_args );
                
                if ( $related_events_query->have_posts() ) :
        ?>
                <section class="related-events">
                    <h3>Related Events</h3>
        <?php
                    while ( $related_events_query->have_posts() ) : $related_events_query->the_post();
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
        
        <section class="featured-post">
            <h3>
                <?php echo $featuredName; ?>
            </h3>
            
            <?php
                // Get Featured Post
                echo get_featured_posts($featuredCat, 1, 'content-feature');
            ?>
            
        </section>
<?php
    if( !is_page() ) :
?>
        <div class="ads">
            
            <div class="ad left"></div>
            <div class="ad right"></div>
            <div class="ad left"></div>
            <div class="ad right"></div>
            
        </div>
<?php
    endif;
?>
    </div><!-- #sidebar -->