<?php
/**
 * The template to display post summary boxes.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php include('php/get-post-meta.php'); ?>
<?php include('php/get-event-meta.php'); ?>

<article class="summary">
    <a href="<?php the_permalink(); ?>">
        <figure class="post-thumb">
            
            <?php
                echo $dateBox;
                
                $thumb = get_thumbnail_custom($post->ID, 'thumbnail');
            ?>
            <img src="<?php echo $thumb[0]; ?>" width="<?php echo $thumb[1]; ?>" height="<?php echo $thumb[2]; ?>" alt="<?php the_title(); ?>" />
        </figure>
        
        <div class="caption">
            <p class="post-category">
                <?php echo $categoryName; ?>
            </p>
            <h4 class="post-title">
                <?php the_title(); ?>
            </h4>
            <p class="post-date">
                <?php echo ( in_category('read') ? 'By ' . $author . ' on ' : '' ); ?>
                <?php echo $date; ?>
            </p>
            <p class="post-excerpt">
                <?php echo the_excerpt_max_charlength(200, get_the_excerpt()); ?>
            </p>
        </div>
    </a>
</article>