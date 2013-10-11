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
    
    if( isset($_GET['request_date']) ) {
        $requestDate = $_GET['request_date'];
    } else {
        $requestDate = date("Y-m-d");
    }
    
    get_calendar_custom($requestDate);
?>