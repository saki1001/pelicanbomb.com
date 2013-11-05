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
            <h4><?php echo $label; ?> Info</h4>
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
            
            <?php include('content-social.php'); ?>
            
        </div>
        
        <div class="column post-details">
            <h4>Details</h4>
            
            <ul class="date">
                <li class="label">Date:</li>
                <li><?php echo $date; ?></li>
            </ul>
            
        <?php
            if( $time ) {
        ?>
            <ul class="time">
                <li class="label">Time:</li>
                <li><?php echo $time; ?></li>
            </ul>
        <?php
            }
        ?>
            
            <ul class="addy" data-coord="" data-address="<?php echo $dataAddress;?>">
            <?php
                if( $address ) {
            ?>
                <li class="label">Place:</li>
                <li class="address">
                    <?php echo $address; ?>
                </li>
            <?php
                }
            ?>
            </ul>
            
            <div id="mapBox"></div>
            
        </div>
    </div>
    
</article>