<?php
/**
 * The template to display thumbnails.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php include('php/get-post-meta.php'); ?>
<?php include('php/get-event-meta.php'); ?>

<article class="preview feature">
    <a href="<?php the_permalink(); ?>">
        <div class="caption">
            <p class="post-category">
                <?php echo $categoryName; ?>
            </p>
            <p class="post-date">
                <?php echo $date; ?>
            </p>
            <h4 class="post-title">
                <?php the_title(); ?>
            </h4>
        <?php
            if( in_category('read') ) {
        ?>
            <p class="post-author">
                By <?php echo $author; ?>
            </p>
        <?php
            }
            
            if( in_category('events') ) {
        ?>
            <p class="post-description">
                <?php echo $address; ?>
            </p>
        <?php
            }
        ?>
        </div>
        
        <figure class="post-thumb">
            <?php
                echo $dateBox;
                $thumb = get_thumbnail_custom($post->ID, 'feature-thumbnail');
            ?>
            <img src="<?php echo $thumb[0]; ?>" width="<?php echo $thumb[1]; ?>" height="<?php echo $thumb[2]; ?>" alt="<?php the_title(); ?>" />
        </figure>
    </a>
</article>