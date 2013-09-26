<?php
/**
 * The Sidebar for sorting by sub-categories.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php
    // Query Category Object
    $cat_obj = $wp_query->get_queried_object();
    $currentCategory = $cat_obj->cat_name;
    $class = '';
    
    // For Child Categories
    if( $cat_obj->parent ) :
        $parentCategoryID = $cat_obj->parent;
        
    // For the Parent Category
    else :
        $parentCategoryID =  $cat_obj->term_id;
        $class = "class='current'";
    endif;
?>

<section id="sidebar">
    
    <h3>Sort by</h3>
    
    <ul>
        <li <?php echo $class; ?>>
            <a href="<?php echo get_category_link( $parentCategoryID ); ?>">View All</a>
        </li>
        
    <?php
        
        
        if( get_cat_ID('press') === $parentCategoryID ) {
            $order = 'DESC';
        } else {
           $order = 'ASC';
        }
        
        // Get categories, exclude misc. Read categories
        $args = array(
            'child_of' => $parentCategoryID,
            'exclude' => '7,10,11,12,13,14,15,19,20',
            'hide_empty'  => 1,
            'order' => $order
        );
        
        $childCategories = get_categories( $args );
        
        foreach( $childCategories as $childCategory ) :
            $class = '';
            
            if ($currentCategory === $childCategory->cat_name) :
                $class = "class='current'";
            endif;
        ?>
            <li <?php echo $class; ?>>
                <a href="<?php echo get_category_link( $childCategory->cat_ID ); ?>"><?php echo $childCategory->cat_name; ?></a>
            </li>
    <?php
        endforeach;
    ?>
    </ul>
</section><!-- #sidebar -->