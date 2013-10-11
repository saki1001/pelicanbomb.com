$j(document).ready(function() {
    
    var ajaxRequest = function(requestDate) {
        
        $j.ajax({
            type: 'GET',
            url: templateDirectoryUrl + '/php/get-adjacent-calendar.php',
            data: {
                request_date : requestDate
            },
            dataType: 'html',
            success: function(data){
                $j('#events-calendar').html(data);
            },  
            error: function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
            }
        });
        
    };
    
    var getAdjacentCalendar = function() {
        $j(this).unbind('click', getAdjacentCalendar);
        
        // Make ajax request, includes Fade In
        
        var requestDate = $j(this).attr('data-date');
        ajaxRequest(requestDate);
        
        // Rebind click handler
        $j(this).live('click', getAdjacentCalendar);
        
        return false;
    };
    
    $j('#prev-link').live('click', getAdjacentCalendar);
    $j('#next-link').live('click', getAdjacentCalendar);
    
});