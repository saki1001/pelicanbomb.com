<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<!DOCTYPE html>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width" />
        <title>
            <?php
            /*
             * Print the <title> tag based on what is being viewed.
             */
            global $page, $paged;
            
            wp_title( '|', true, 'right' );
            
            // Add the blog name.
            bloginfo( 'name' );
            
            // Add the blog description for the home/front page.
            $site_description = get_bloginfo( 'description', 'display' );
            if ( $site_description && ( is_home() || is_front_page() ) )
                echo " | $site_description";
            
            ?>
        </title>
        <meta name="description" content="<?php echo $site_description; ?>" />
        
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/style.css" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        
        <!--[if lt IE 9]>
            <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
        <![endif]-->
        
        <?php wp_enqueue_scripts(); ?>
        
        <?php wp_head(); ?>
        
        <?php /*Custom JS Files*/ ?>
            <script type="text/javascript">
                var $j = jQuery.noConflict();
                var templateDirectoryUrl = '<?php echo get_template_directory_uri(); ?>';
            </script>
            <!-- <script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.js" type="text/javascript"></script> -->
            <script src="<?php echo get_template_directory_uri(); ?>/js/main.js" type="text/javascript"></script>
        <?php
            if ( is_single() ) {
        ?>
            <script src="<?php echo get_template_directory_uri(); ?>/js/slideshow.js" type="text/javascript"></script>
        <?php
            }
        ?>
        
        <?php
            if ( is_category('spaces') ) {
        ?>
            <script type="text/javascript"src="http://maps.google.com/maps/api/js?sensor=true"></script>
            <script src="<?php echo get_template_directory_uri(); ?>/js/map.js" type="text/javascript"></script>
            <script src="<?php echo get_template_directory_uri(); ?>/js/googlemap-infobox.js" type="text/javascript"></script>
        <?php
            }
        ?>
        
        <!-- Google Analytics -->
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-23807545-1']);
            _gaq.push(['_trackPageview']);
            
            (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>
    </head>
    
    <body <?php body_class();?>>
    
    <?php include_once('analytics/ga.php'); ?>
    
    <div id="page">
        <header id="branding" role="banner">
            <div class="wrapper">
                
                <div id="logo">
                    <h1 id="site-title">
                        <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><span><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></span></a>
                    </h1>
                </div>
                
                <?php
                    if( is_home() ) :
                        // no menu
                    else :
                ?>
                
                <nav id="main-menu" role="navigation">
                    <?php
                        // default menu
                        wp_nav_menu( array( 'theme_location' => 'primary' ) );
                    ?>
                </nav>
                
                <?php
                    endif;
                ?>
                
            </div>
        </header>
        
        <div id="main">