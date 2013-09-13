<?php
/**
 * The general template for displaying single Events.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php include('php/get-post-meta.php'); ?>
<?php include('php/get-event-meta.php'); ?>

<h2 class="post-title">
    <span><?php the_title();?></span>
</h2>

<article id="post-<?php the_ID(); ?>" class="post event">
    
    <?php include('content-slideshow.php'); ?>
    
    <div class="post-main">
        
        <div class="column post-info">
            <h4>Event Info</h4>
            <div class="text-container">
                <?php the_content(); ?>
            </div>
        </div>
        
        <div class="post-footer">
            <p class="post-categories">
                <span>See More:</span>
                <?php the_category(', '); ?>
            </p>
        
        <?php
            if( get_the_tags() ) {
        ?>
            <p class="post-tags">
                <span>Tagged with:</span>
                <?php the_tags('', ', '); ?>
            </p>
        <?php
            }
        ?>
        
            <div class="post-nav">
                <p class="prev">
                    <?php previous_post_link('%link', '<span class="label">&larr; Previous</span><span class="title">%title</span>', TRUE); ?> 
                </p>
                <p class="next">
                    <?php next_post_link('%link', '<span class="label">Next &rarr;</span><span class="title">%title</span>', TRUE); ?> 
                </p>
            </div>
        </div>
        
    </div>
    
    <div class="post-sidebar">
        <div class="column post-share">
            <h4>Share</h4>
            <?php
                // Social Media Sharing
                $title = urlencode(get_the_title());
                $url = urlencode(get_permalink());
                $desc = urlencode(get_the_excerpt());
                $thumb = get_thumbnail_custom($post->ID, 'post-thumbnail');
                $image = urlencode($thumb[0]);
            ?>
            
            <div class="post-social">
                <a onClick="window.print()" class="print" title="Print"></a>
                <a href="mailto:?subject=<?php echo 'Pelican Bomb: ' . $title; ?>&amp;body=Check out this article on Pelican Bomb: <?php echo $url; ?>" class="email" title="Share by Email" target="_blank"></a>
                <a onClick="window.open('http://twitter.com/intent/tweet?text=%23PelicanBomb%20<?php echo $title . ', ' . $url; ?>%20%40PelicanBomb','sharer','toolbar=0,status=0,width=548,height=225');" href="javascript: void(0)" class="twitter" title="Tweet this" target="_blank"></a>
                <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title . ' | Pelican Bomb'; ?>&amp;p[summary]=<?php echo $desc;?>&amp;p[url]=<?php echo $url; ?>&amp;&amp;p[images][0]=<?php echo $image;?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)" class="facebook" title="Share on Facebook." target="_blank"></a>
            </div>
        </div>
        
        <div class="column post-details">
            <h4>Details</h4>
            
            <ul class="date">
                <li class="label">Date</li>
                <li><?php echo $date; ?></li>
            </ul>
            
            <ul class="time">
                <li class="label">Time</li>
                <li><?php echo $time; ?></li>
            </ul>
            
            <ul class="addy" data-coord="" data-address="<?php echo $address;?>">
                <li class="label">Location</li>
                <li class="address">
                    <?php echo $address; ?>
                </li>
            </ul>
            
            <div id="mapBox"></div>
            
        </div>
    </div>
    
</article>