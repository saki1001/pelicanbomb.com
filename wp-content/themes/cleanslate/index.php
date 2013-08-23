<?php
/**
 * The main template file.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php get_header(); ?>
        
    <section id="content" role="main">
        
        <?php
            if ( have_posts() ) :
                
                $readCategoryID = get_cat_ID('read');
                $seeCategoryID = get_cat_ID('see');
                
                $readImage = get_home_image('read', 'full');
                // $collectImage = get_home_image('collect', 'large');
                // $seeImage = get_home_image('see', 'large');
        ?>
            
            <div id="primary">
                <section class="column read">
                    <a href="<?php echo get_category_link($readCategoryID); ?>">
                        <h2>Read</h2>
                        <img src="<?php echo $readImage[0]; ?>" width="<?php echo $readImage[1]; ?>" height="<?php echo $readImage[2]; ?>" alt="Read" />
                    </a>
                </section>
                
                <section class="column collect">
                    <a href="http://www.thedropnola.com/">
                        <h2>Collect</h2>
                        <!-- <img src="<?php echo $readImage[0]; ?>" width="<?php echo $readImage[1]; ?>" height="<?php echo $readImage[2]; ?>" alt="Read" /> -->
                    </a>
                </section>
                
                <section class="column see">
                    <a href="<?php echo get_category_link($seeCategoryID); ?>">
                        <h2>See</h2>
                        <!-- <img src="<?php echo $readImage[0]; ?>" width="<?php echo $readImage[1]; ?>" height="<?php echo $readImage[2]; ?>" alt="Read" /> -->
                    </a>
                </section>
            </div>
            
            <div id="secondary">
                
                <section class="featured articles">
                    <h2>Featured Articles</h2>
                    
                    <?php
                        // Get Featured Read Articles
                        echo get_featured_posts('read', 3);
                    ?>
                    
                </section>
                
                <section class="featured products">
                    <h2>Featured Products</h2>
                    
                    
                    
                </section>
                
            </div>
            
        <?php
            else :
            // Content Not Found Template
            include('content-not-found.php');
            
            endif;
        ?>
    </section>
    
<?php get_footer(); ?>