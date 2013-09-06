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
    
    <?php include('content-slideshow.php'); ?>
    
    <div class="post-header">
        <p class="post-author">
            <span>By</span><?php echo $author; ?>
        </p>
        
        <p class="post-date">
            <?php the_date(); ?>
        </p>
        
        <div class="post-social">
            <a href="#" class="print" title="Print"></a>
            <a href="#" class="Facebook" title="Facebook"></a>
            <a href="#" class="Twitter" title="Twitter"></a>
            <a href="#" class="Email" title="Email"></a>
        </div>
    </div>
    
    <div class="text-container">
        <?php the_content(); ?>
    </div>
    
    <div class="post-footer">
        <p class="post-category">
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
                <?php previous_post_link('%link', '&larr; Previous', TRUE); ?> 
            </p>
            <p class="next">
                <?php next_post_link('%link', 'Next &rarr;', TRUE); ?> 
            </p>
        </div>
    </div>
    
</article>