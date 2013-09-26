<?php
/**
 * The template to display 'Spaces' galleries.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<article class="space">
    
    <div class="column title">
        <p class="post-title"><?php the_title(); ?></p>
        <span class="tools">
            <a href="#" class="addy" title="<?php the_title(); ?>" data-coord="<?php the_field('location-coordinates'); ?>" data-address="<?php echo get_field('location-address') . ' ' . get_field('location-city'); ?>">+ VIEW ON THE MAP</a>
        </span>
    </div>
    
    <div class="column address">
        <p><?php the_field('location-address'); ?></p>
        <p><?php the_field('location-city') + ' ' + the_field('location-zip'); ?></p>
        <p>
            <a href="<?php the_field('gallery-website'); ?>" target="_blank"><?php the_field('gallery-website'); ?></a>
        </p>
    </div>
    
    <div class="column details">
        <p>
            <span class="label">Type</span>
            <span><?php the_field('gallery-type'); ?></span>
        </p>
        <p>
            <span class="label">Phone</span>
            <span><?php the_field('gallery-phone'); ?></span>
        </p>
        <p>
            <span class="label">Hours</span>
            <span><?php the_field('gallery-hours'); ?></span>
        </p>
    </div>
    
</article>