<?php
/**
 * The template for displaying image attachments.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */

get_header(); ?>
<section id="content" class="post-single" role="main">
    
    <h2 class="page-title">
        <?php
            the_title();
        ?>
    </h2>
    
    <?php while ( have_posts() ) : the_post(); ?>
    
    <div class="entry-content">

        <div class="entry-attachment">
            <div class="attachment">
                <?php
                    /**
                     * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
                     * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
                     */
                    $attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
                    foreach ( $attachments as $k => $attachment ) {
                        if ( $attachment->ID == $post->ID )
                            break;
                    }
                    $k++;
                    // If there is more than 1 attachment in a gallery
                    if ( count( $attachments ) > 1 ) {
                        if ( isset( $attachments[ $k ] ) )
                            // get the URL of the next image attachment
                            $next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
                        else
                            // or get the URL of the first image attachment
                            $next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
                    } else {
                        // or, if there's only 1 image, get the URL of the image
                        $next_attachment_url = wp_get_attachment_url();
                    }
                ?>

                <a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
                $attachment_size = apply_filters( 'toolbox_attachment_size', 1200 );
                echo wp_get_attachment_image( $post->ID, array( $attachment_size, $attachment_size ) ); // filterable image width with, essentially, no limit for image height.
                ?></a>
            </div><!-- .attachment -->

            <?php if ( ! empty( $post->post_excerpt ) ) : ?>
            <div class="entry-caption">
                <?php the_excerpt(); ?>
            </div>
            <?php endif; ?>
        </div><!-- .entry-attachment -->

        <?php the_content(); ?>

    </div><!-- .entry-content -->


<?php endwhile; // end of the loop. ?>

</section><!-- #content -->

<?php get_footer(); ?>