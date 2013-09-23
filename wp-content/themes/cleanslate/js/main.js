$j(document).ready(function() {
    
    // Clear fields on focus
    var clearOnFocus = function() {
        $j(this).val('');
    };
    
    var submitSearch = function(value) {
        
        // Make sure the field isn't empty
        if (value =! '') {
            
            $j('#searchform').submit();
            
        } else {
            // do nothing
        }
    };
    
    var submitNewsletter = function(value) {
        
        // Make sure the field isn't empty
        if (value =! '') {
            
            $j('#newsletter-form').submit();
            
        } else {
            // do nothing
        }
        
    };
    
    
    // Bind the submit event for your form
    var submitOnEnter = function(e) {
        
        if (e.which == 13) {
            
            $j(this).unbind('keypress', submitOnEnter);
            
            // Get the input value
            var value = $j(this).val();
            var thisID = $j(this).attr('id');
            
            if (thisID === 's') {
                submitSearch(value);
                
            } else if (thisID === 'uudyw-uudyw') {
                submitNewsletter(value);
                
            } else {
                // do nothing
            }
            
            $j(this).bind('keypress', submitOnEnter);
            
            return false;
        }
        
    };
    
    // Newsletter signup
    $j('#uudyw-uudyw').bind('focus', clearOnFocus);
    $j('#uudyw-uudyw').bind('keypress', submitOnEnter);
    
    // Search form
    $j('#s').bind('focus', clearOnFocus);
    $j('#s').bind('keypress', submitOnEnter);
    
});