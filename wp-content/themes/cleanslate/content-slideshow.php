<?php
/**
 * The template for displaying images in a slideshow.
 *
 * @package Toolbox
 */
?>

<?php
    // Define args to get attachments
    $args = array(
        'post_parent' => $post->ID,
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );

    // Get image attachments
    $attachments = get_children( $args );
    
    // Inserting attachments into HTML
    function insert_attachments( $attachments ) {
        global $post;
        
        if ( count($attachments) > 0 ) :
            
            foreach($attachments as $attachment) :
                // medium images set to be max 500px tall
                $image = wp_get_attachment_image( $attachment->ID, 'medium' );
        ?>
            <div class="image-container">
                <figure>
                    <?php
                        // Insert image description
                        echo $image;
                    ?>
                </figure>
                <figcaption>
                    <?php
                        // Insert image description
                        echo html_entity_decode($attachment->post_content);
                    ?>
                </figcaption>
            </div>
    <?php
            endforeach;
        else :
    ?>
            <div class="image-container">
                <figure>
                    <?php
                        $thumb = get_thumbnail_custom($post->ID, 'medium');
                    ?>
                    <img src="<?php echo $thumb[0]; ?>" width="<?php echo $thumb[1]; ?>" height="<?php echo $thumb[2]; ?>" alt="<?php the_title(); ?>" />
                </figure>
            </div>
    <?php
        endif;
    }
?>

<div id="media">
    <?php
        // For Many Images (Slideshow)
        if ( count($attachments) > 1 ) :
    ?>
    
    <div class="border left">
        <a href="#" class="nav arrow prev"></a>
    </div>
    <div class="border right">
        <a href="#" class="nav arrow next"></a>
    </div>
    
    <div class="pager-container">
        <div id="pager">
        <!-- filled dynamically -->
        </div>
    </div>
    
    <div class="scroll-container">
        <div id="scroll" class="entry-content">
            
            <?php insert_attachments( $attachments ); ?>
            
        </div>
    </div>
    
    <?php
        // For Single Image
        else :
    ?>
    
    <div class="border left"></div>
    <div class="border right"></div>
    
    <?php insert_attachments( $attachments ); ?>
    
    <?php
    endif;
    ?>
</div>