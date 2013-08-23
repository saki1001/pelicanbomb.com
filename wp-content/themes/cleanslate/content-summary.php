<?php
/**
 * The template to display post summary boxes.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<article class="summary">
    <a href="<?php the_permalink(); ?>">
        <div class="caption">
            <h4 class="post-title">
                <?php the_title(); ?>
            </h4>
            <p class="post-date">
                <?php echo get_the_date(); ?>
            </p>
            <p class="post-excerpt">
                <?php echo substr(get_the_excerpt(), 0,225); ?>
            </p>
        </div>
    
        <figure class="post-thumb">
            <?php
                $thumb = get_thumbnail_custom($post->ID, 'thumbnail');
            ?>
            <img src="<?php echo $thumb[0]; ?>" width="<?php echo $thumb[1]; ?>" height="<?php echo $thumb[2]; ?>" alt="<?php the_title(); ?>" />
        </figure>
    </a>
</article>