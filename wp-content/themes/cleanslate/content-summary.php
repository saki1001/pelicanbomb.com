<?php
/**
 * The template to display post summary boxes.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php include('php/get-post-meta.php'); ?>

<?php
    if( !$categoryName ) {
        $categoryName = 'Exhibition';
    }
?>

<article class="summary">
    <a href="<?php the_permalink(); ?>">
        <figure class="post-thumb">
            <?php
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
                <?php
                    // Get Start and End dates
                    if( in_category('see') ) {
                        $startDate = date('F j, Y', strtotime(get_field('start-date')));
                        
                        if( get_field('end-date') ) {
                            $endDate = date('F j, Y', strtotime(get_field('end-date')));
                            
                            $date = $startDate . ' - ' . $endDate;
                        } else {
                            $date = $startDate;
                        }
                    } else {
                        $date = get_the_date();
                    }
                    
                    echo $date;
                ?>
            </p>
            <p class="post-excerpt">
                <?php echo the_excerpt_max_charlength(200); ?>
            </p>
        </div>
    </a>
</article>