<?php
/**
 * The template to display thumbnails.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php include('php/get-post-meta.php'); ?>

<article class="preview feature">
    <a href="<?php the_permalink(); ?>">
        <div class="caption">
            <p class="post-category">
                <?php echo $categoryName; ?>
            </p>
            <p class="post-date">
                <?php echo get_the_date(); ?>
            </p>
            <h4 class="post-title">
                <?php the_title(); ?>
            </h4>
            <p class="post-author">
                By <?php echo $author; ?>
            </p>
        </div>
        
        <figure class="post-thumb">
            <?php
                $thumb = get_thumbnail_custom($post->ID, 'feature-thumbnail');
            ?>
            <img src="<?php echo $thumb[0]; ?>" width="<?php echo $thumb[1]; ?>" height="<?php echo $thumb[2]; ?>" alt="<?php the_title(); ?>" />
        </figure>
    </a>
</article>