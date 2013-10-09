<?php
/**
 * The general template for displaying content.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php include('php/get-post-meta.php'); ?>

<h2 class="post-title">
    <span><?php the_title();?></span>
</h2>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
<?php
      // Include Video or Slideshow
      if( get_field('read-video') ) {
?>
      <div id="media" class="video">
<?php
            the_field('read-video');
?>
      </div>
<?php
      } else {
            include('content-slideshow.php');
      }
?>
    
    <div class="post-header">
        <div>
            <p class="post-author">
                <span>By</span><?php echo $authorLink; ?>
            </p>
            
            <p class="post-date">
                <?php the_date(); ?>
            </p>
        </div>
        
        <?php include('content-social.php'); ?>
        
    </div>
    
    <div class="text-container">
        <?php the_content(); ?>
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
    
</article>