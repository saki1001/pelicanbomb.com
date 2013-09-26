<?php
    
    require_once('../../../../wp-load.php');
    require_once('../functions.php');
    
    // Set variables
    $url = 'http://thedrop.bigcartel.com' . $_GET['url'];
    $categoryName = $_GET['category'];
    $date = date('F j, Y', strtotime($_GET['date']));
    $title = $_GET['title'];
    $rawDescription = $_GET['description'];
    $description = strip_tags($rawDescription);
    $price = $_GET['price'];
    $thumb = $_GET['images'];
    $options = $_GET['options'];
    
    
    // THUMBNAIL
    // Set width and height to size
    if( $thumb['width'] > $options['size']['w'] ) {
        
        $ratioW = $thumb['width'] / $options['size']['w'];
        
        // Reset width and height
        $thumb['width'] = $options['size']['w'];
        $thumb['height'] = round($thumb['height'] / $ratioW);
        
    }
    
    // After initial values set,
    // Check height and then set to size
    if( $thumb['height'] < $options['size']['h'] ) {
        
        $ratioH =  $options['size']['h'] / $thumb['height'];
        
        // Reset width and height
        $thumb['height'] = $options['size']['h'];
        $thumb['width'] = round($thumb['width'] * $ratioH);
    }
    
?>

<article class="<?php echo $options['type']; ?> product">
    <a href="<?php echo $url; ?>">
        <div class="caption">
            <p class="post-category">
                <?php echo $categoryName; ?>
            </p>
            <p class="post-date">
                <?php echo $date; ?>
            </p>
            <h4 class="post-title">
                <?php echo $title; ?>
            </h4>
            <p class="post-author">
                Price: $<?php echo $price; ?>
            </p>
        </div>
        
        <figure class="post-thumb">
            <img src="<?php echo $thumb['url']; ?>" width="<?php echo $thumb['width']; ?>" height="<?php echo $thumb['height']; ?>" alt="<?php echo $title; ?>" />
        </figure>
    </a>
</article>