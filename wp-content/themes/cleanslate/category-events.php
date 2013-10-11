<?php
/**
 * The template for the Spaces category page.
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
            <div id="events-calendar">
        <?php
                $requestDate = date("Y-m-d");
                get_calendar_custom($requestDate);
        ?>
            </div>
        <?php
            else :
                
                // Content Not Found Template
                include('content-not-found.php');
                
            endif;
        ?>
        
        <?php get_sidebar(); ?>
        
    </section>
    
<?php get_footer(); ?>