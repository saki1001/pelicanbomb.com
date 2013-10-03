<?php
    // Social Media Sharing
    $title = get_the_title();
    $url = urlencode(get_permalink());
    $desc = urlencode(get_the_excerpt());
    $thumb = get_thumbnail_custom($post->ID, 'post-thumbnail');
    $image = urlencode($thumb[0]);
?>

<div class="post-social">
    <a onClick="window.print()" class="print" title="Print"></a>
    <a href="mailto:?subject=<?php echo 'Pelican Bomb: ' . $title; ?>&amp;body=Check out this article on Pelican Bomb: <?php echo $url; ?>" class="email" title="Share by Email" target="_blank"></a>
    <a onClick="window.open('http://twitter.com/intent/tweet?text=%23PelicanBomb%20<?php echo $title . ', ' . $url; ?>%20%40PelicanBomb','sharer','toolbar=0,status=0,width=548,height=225');" href="javascript: void(0)" class="twitter" title="Tweet this" target="_blank"></a>
    <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title . ' | Pelican Bomb'; ?>&amp;p[summary]=<?php echo $desc;?>&amp;p[url]=<?php echo $url; ?>&amp;&amp;p[images][0]=<?php echo $image;?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)" class="facebook" title="Share on Facebook." target="_blank"></a>
</div>