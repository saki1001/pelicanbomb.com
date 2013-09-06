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
                
                $readImage = get_home_image('read', 'large');
                $collectImage = get_home_image('collect', 'large');
                $seeImage = get_home_image('see', 'large');
        ?>
            
            <div id="primary">
                <span class="angle"></span>
                <section class="column read">
                    <a href="<?php echo get_category_link($readCategoryID); ?>">
                        <div class="title">
                            <h2>Read</h2>
                        </div>
                        <img src="<?php echo $readImage[0]; ?>" width="<?php echo $readImage[1]; ?>" height="<?php echo $readImage[2]; ?>" alt="Read" />
                    </a>
                </section>
                
                <section class="column collect">
                    <a href="http://www.thedropnola.com/">
                        <div class="title">
                            <h2>Collect</h2>
                        </div>
                        <img src="<?php echo $collectImage[0]; ?>" width="<?php echo $collectImage[1]; ?>" height="<?php echo $collectImage[2]; ?>" alt="Collect" />
                    </a>
                </section>
                
                <section class="column see">
                    <a href="<?php echo get_category_link($seeCategoryID); ?>">
                        <div class="title">
                            <h2>See</h2>
                        </div>
                        <img src="<?php echo $seeImage[0]; ?>" width="<?php echo $seeImage[1]; ?>" height="<?php echo $seeImage[2]; ?>" alt="See" />
                    </a>
                </section>
            </div>
            
            <div id="secondary">
                
                <?php get_sidebar(); ?>
                
                <section class="featured articles">
                    <h3>Featured Articles</h3>
                    
                    <?php
                        // Get Featured Read Articles
                        echo get_featured_posts('read', 3, 'content-preview');
                    ?>
                    
                </section>
                
                <section class="featured products">
                    <h3>Collect from The Drop</h3>
                    
                    <p>Content will be filled in dynamically from Big Cartel site.</p>
                    
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