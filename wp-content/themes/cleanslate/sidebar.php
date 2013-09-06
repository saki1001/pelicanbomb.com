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
        
    } else {
        
        $featuredCat = 'events';
        $featuredName = 'Upcoming Event';
        $showAds = true;
        
    }
?>
    <div id="sidebar">
        
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