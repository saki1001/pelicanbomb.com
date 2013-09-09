<?php
/**
 * The template for the Browse category.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php get_header(); ?>
    
    <section id="content">
        
        <h2>
            <?php wp_title(''); ?>
        </h2>
        
    <?php
        
        if ( have_posts() ) :
    ?>
            <div id="articles">
            
    <?php
            while ( have_posts() ) : the_post();
                get_template_part( 'content-preview', get_post_format() );
            endwhile;
    ?>
            
            </div>
            
    <?php
        else :
            // Content Not Found Template
            include('content-not-found.php');
            
        endif;
    ?>
        
        <?php get_sidebar('sort'); ?>
        
        <?php get_template_part( 'content-pagination' ); ?>
        
    </section>
    
<?php get_footer(); ?>