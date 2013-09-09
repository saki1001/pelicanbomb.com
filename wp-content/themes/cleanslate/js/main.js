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
                
            } else if (thisID === 'n') {
                submitNewsletter(value);
                
            } else {
                // do nothing
            }
            
            $j(this).bind('keypress', submitOnEnter);
            
            return false;
        }
        
    };
    
    $j('#n').bind('focus', clearOnFocus);
    $j('#n').bind('keypress', submitOnEnter);
    
    $j('#s').bind('focus', clearOnFocus);
    $j('#s').bind('keypress', submitOnEnter);
    
});