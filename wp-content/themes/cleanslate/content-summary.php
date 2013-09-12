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
    if( is_category('events') ) {
        $categoryName = get_field('event-type');
    } elseif( is_category('see') && !$categoryName ) {
        $categoryName = 'Exhibition';
    }
    
    // Get Start and End dates
    if( in_category('see') || in_category('events') ) {
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
    
    // Set date box
    $dateBox = '';
    
    if( in_category('events') ) {
        $dateBox .= '<span class="date-box">';
        $dateBox .= date('d', strtotime(get_field('start-date')));
        $dateBox .= '</span>';
    }
?>

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
                <?php echo $date; ?>
            </p>
            <p class="post-excerpt">
                <?php echo the_excerpt_max_charlength(200); ?>
            </p>
        </div>
    </a>
</article>