<?php
/**
 * The template to display thumbnails.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php include('php/get-post-meta.php'); ?>

<article class="search">
    <a href="<?php the_permalink(); ?>">
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
        <p class="post-excerpt">
            <?php echo the_excerpt_max_charlength(180, get_the_excerpt()); ?>
        </p>
    </a>
</article>