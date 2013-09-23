// THE DROP PRODCUTS API
// Display products from the Big Cartel store

// Declare content selector
var selector;

// Get products from Big Cartel API
var productsFeed = function(options, limit) {
    
    var store = 'thedrop';
    var productsRequestURL = 'http://api.bigcartel.com/' + store + '/products.json?limit=100';
    
    $j.getJSON(productsRequestURL, function(feeds) {
        
        // Check manually if error or no results
        if( feeds.errors ){
            
            
        } else if( feeds.length > 1 ){
            
            showProductsFeed(feeds, options, limit);
            
        } else {
            
        }
        
    }).error(function(jqXHR, textStatus, errorThrown) {
        // alert(textStatus + " - " + errorThrown);
    });
    
};

// Loop through results
// Show only up to the limit number of products
var showProductsFeed = function(feeds, options, limit) {
    
    for (var i=0; i<feeds.length; i++) {
        
        var categories = feeds[i]['categories'][0];
        
        if( categories != undefined && categories['name'] === 'BUILD-A-BOX' ) {
            
            var templateURL = templateDirectoryUrl + '/php/get-product-template.php';
            
            $j.ajax({
              url: templateURL,
              data: {
                  'options' : options,
                  'category' : 'The Drop',
                  'date' : feeds[i]['created_at'],
                  'title' : feeds[i]['name'],
                  'description' : feeds[i]['description'],
                  'price' : feeds[i]['price'],
                  'url' : feeds[i]['url'],
                  'images' : {
                      'url' : feeds[i]['images'][0]['url'],
                      'width' : feeds[i]['images'][0]['width'],
                      'height' : feeds[i]['images'][0]['height']
                  }
              },
              success: function( html ) {
                
                // Append elements (up to limit)
                if( $j(selector + ' .preview').length < limit ) {
                    $j(selector).append(html);
                    
                // Hide loader and show elements
                } else if ( $j(selector + ' .preview').length = limit ) {
                    $j(selector + ' .loading').hide();
                    $j(selector + ' .preview').fadeIn();
                    
                } else {
                    // do nothing
                }
                
              },
              dataType: 'html'
            });
            
        } // end if
        
    } // end for
    
};

var getProducts = function(type, width, height, limit) {
    
    if( !type ) {
        type = 'preview';
    }
    
    if( !width ) {
        width = 190;
    }
    
    if( !height ) {
        height = 150;
    }
    
    if( !limit ) {
        limit = 3;
    }
    
    var options = {
        'type' : type,
        'size' : {
            'w' : width,
            'h' : height
        }
    }
    
    productsFeed(options, limit);
};

$j(document).ready(function() {
    
    if( $j('body.home').length > 0 ) {
        
        selector = '.featured.products';
        
        getProducts('preview', 190, 150, 6);
    }
    
    if( $j('body.page').length > 0 ) {
        selector = '#sidebar .featured-post';
        
        getProducts('preview feature', 240, 170, 1);
    }
    
});