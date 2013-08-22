<?php
/**
 * The general template for displaying content.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php

$author = get_post_meta( get_the_ID(), 'read-author' );
echo $author[0];

$image1 = get_post_meta( get_the_ID(), 'image-1' );
echo htmlspecialchars($image1[0]);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-post-id="<?php echo date('m-d-Y', strtotime(get_the_date())); ?>">
    <?php
    // Set Arguments
    $args = array(
        'post_parent' => $post->ID,
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );
    
    // Get image attachments
    $attachments = get_children( $args );
    
    // print_r($attachments);
    
    foreach( $attachments as $image ) :
        // print_r($image);
        $imageURL =  wp_get_attachment_image_src( $image->ID, 'medium' );
        
    ?>
    
        <img src="<?php echo $imageURL[0]; ?>" width="<?php echo $imageURL[1]; ?>" height="<?php echo $imageURL[2]; ?>" />
    
    <?php
        
    endforeach;
    ?>
    
    <div class="post-header">
        <h2 class="post-title">
            <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
        </h2>
        
        <p class="post-date">
            <?php the_date(); ?>
        </p>
    </div>
    
    <div class="text-container">
        <?php the_content(); ?>
    </div>
    
</article>