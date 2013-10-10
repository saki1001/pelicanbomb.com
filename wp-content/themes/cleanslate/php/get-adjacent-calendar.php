<?php
/**
 * The main template file.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php
    require_once('../../../../wp-load.php');
    
    if( isset($_GET['cal_date']['post_date'])) {
        
        $cal_date = $_GET['cal_date'];
        $post_date = $_GET['post_date'];
        
        // $current_year = mysql2date('Y', $cal_date);
        // $current_month = mysql2date('m', $cal_date);
        
    } else {
        $current_year = date('Y', current_time('timestamp'));
        $current_month = date('m', current_time('timestamp'));
        $current_day = date('d', current_time('timestamp'));
        
        $cal_date = $current_month.'-'.$current_day.'-'.$current_year;
        $post_date = $cal_date;
    }
    
    $category = '26';
    get_calendar_custom($category, $cal_date, $post_date);
?>