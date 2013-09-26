<?php
/**
 * The template to display thumbnails.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php include('php/get-event-meta.php'); ?>
<?php include('php/get-post-meta.php'); ?>

<?php
   if( in_category('press') ){
      $target = "_blank";
   } else {
      $target="_self";
   }
?>

<article class="preview">
    <a href="<?php echo $permalink; ?>" target="<?php echo $target; ?>">
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
            <p class="post-author">
                By <?php echo $author; ?>
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