<?php
/**
 * The template to display Related Events in sidebar.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php include('php/get-post-meta.php'); ?>
<?php include('php/get-event-meta.php'); ?>

<article class="related">
    <a href="<?php the_permalink(); ?>">
        <div class="caption">
            <p class="post-category">
                <?php echo $categoryName; ?>
            </p>
            <h4 class="post-title">
                <?php the_title(); ?>
            </h4>
            <p class="post-date">
                <?php echo $date; ?>
            </p>
        </div>
    </a>
</article>