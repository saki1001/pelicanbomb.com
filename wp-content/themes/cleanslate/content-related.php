<?php
/**
 * The template to display Related Events in sidebar.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php include('php/get-event-meta.php'); ?>

<article class="related">
    <a href="<?php the_permalink(); ?>">
        <div class="caption">
            <p class="post-date">
                <?php echo $date; ?>
            </p>
            <h4 class="post-title">
                <?php the_title(); ?>
            </h4>
            <p class="location">
                <?php echo $address; ?>
            </p>
        </div>
    </a>
</article>