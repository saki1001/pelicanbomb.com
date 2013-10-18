$(document).ready(function() {
    
    /* POSITION IMAGES
    ------------------------------------------- */
    
    var imagesArray = [];
    var fullWidth = 0;
    
    // get full width
    $('#scroll .image-container').each(function() {
        
        w = $(this).outerWidth();
        // adding w + 1 because width is rounded
        fullWidth += w + 1;
    });
    
    // set correct width
    $('#scroll').css('width', fullWidth);
    
    // resize images
    $('#scroll .image-container img').each(function(i) {
        
        var imageWidth = $(this).width();
        var imageHeight = $(this).height();
        var containerWidth = $('.image-container figure').width();
        var containerHeight = $('.image-container figure').height();
        
        if( imageWidth > containerWidth ){
          $(this).attr('width', containerWidth);
          $(this).attr('height', imageHeight/(imageWidth/containerWidth));
        } else if( imageHeight > containerHeight ){
          $(this).attr('height', containerHeight);
          $(this).attr('width', imageWidth/(imageHeight/containerHeight));
        } else {
          // do nothing
        }
        
    });
    
    // now determine positions
    $('#scroll .image-container').each(function(i) {
        
        var position = $(this).position();
        
        $(this).attr('data-index', i);
        
        imagesArray.push({
            pos: position.left,
            w: $(this).width(),
            h: $(this).height()
        });
    
    });
    
    // add pager elements
    $.each(imagesArray, function(i) {
      
      if( imagesArray.length > 1 ){
          var pagerNumber = i + 1;
          var imgPosition = this.pos;
          $('#pager').append('<a href="#" class="page" data-index="' + i + '" data-position="' + imgPosition + '">' + pagerNumber + '</a>');
        
          if(pagerNumber < imagesArray.length) {
              $('#pager a').last().after('<span>&nbsp;|&nbsp;</span>')
          }
      }
      
    });
    
    // get pager width
    var pagerWidth = 0;
    $('#pager').children().each(function() {
        var pw = $(this).outerWidth(true);
        pagerWidth += pw;
    });
    
    // now set width of pager element
    // for centering pager links
    $('#pager').css('width', pagerWidth);
    
    // find first and last image
    $('.image-container').each(function(i) {
        
        var imageIndex = $(this).attr('data-index');
        var lastIndex = String(imagesArray.length - 1);
        
        if(imageIndex === '0') {
            $(this).addClass('firstSlide');
        }
        
        if(imageIndex === lastIndex) {
            $(this).addClass('lastSlide');
        }
    });
    
    var labelCurrentPosition = function(num) {
        
        // remove old previousSlide class
        $('.previousSlide').removeClass('previousSlide');
        
        // add new previousSlide
        $('.currentSlide').addClass('previousSlide');
        
        // remove old currentSlide
        $('.currentSlide').removeClass('currentSlide');
        
        // add new currentSlide
        $('.page[data-index="' + num +'"]').addClass('currentSlide');
        $('#scroll .image-container[data-index="' + num +'"]').addClass('currentSlide');
        
        // clear any inactive classes
        $('.nav.inactive').removeClass('inactive');
        
        // make arrows inactive for first/last slide
        if ($('.currentSlide').hasClass('firstSlide')) {
            $('.nav.prev').addClass('inactive');
        }
        
        if ($('.currentSlide').hasClass('lastSlide')) {
            $('.nav.next').addClass('inactive');
        }
        
    };
    
    // for document load
    labelCurrentPosition(0);
    
    var animateScroll = function(pos, time) {
        
        $('#scroll .image-container.previousSlide').animate({
            opacity: 0.25
        }, 200 , function() {
            // animation complete
        });
        
        $('#scroll').animate({
            left: pos
        }, time , function() {
            // animation complete
            $('#scroll .image-container.currentSlide').animate({
                opacity: 1
            }, 200 , function() {
                // animation complete
            });
            
        });
        
    };
    
    var showImage = function() {
        
        var curDataIndex = $(this).attr('data-index');
        labelCurrentPosition(curDataIndex);
        
        var positionLeft = '-' + $(this).attr('data-position') + 'px';
        var curPosition = $('#scroll').position();
        
        // base animation time on ratio of how far you're moving
        var animTime = Math.abs(Math.abs(parseInt(curPosition.left)) - Math.abs(parseInt(positionLeft)))/2;
        
        animateScroll(positionLeft, animTime);
        
        return false;
    };
    
    var showPrevNext = function() {
        
        var curDataIndex = parseInt($('.page.currentSlide').attr('data-index'));
        
        if ($(this).hasClass('prev')) {
            var newDataIndex = curDataIndex - 1;
        } else {
            var newDataIndex = curDataIndex + 1;
        }
        
        var showImage = '.page[data-index="' + newDataIndex + '"]';
        
        if ( $(showImage)[0] != null ) {
            
            var positionLeft = '-' + $(showImage).attr('data-position') + 'px';
            
            labelCurrentPosition(newDataIndex);
            animateScroll(positionLeft, 300);
            
        }
        
        return false;
    };
    
    var showNav = function() {
        $(this).children('.arrow').fadeIn(100);
        
    };
    
    var hideNav = function() {
        $(this).children('.arrow').fadeOut(100);
    };
    
    
    /* CENTER IMAGES
    ------------------------------------------- */
    
    // Set Image Width and Margin
    // for centering images in portfolio pages
    $('#media .image-container figure img').each(function(i) {
        
        var width = $(this).width();
        var height = $(this).height();
        var containerHeight = $('.image-container figure').height();
        var containerWidth = $('.image-container figure').width();
        var marginTop = (containerHeight - height)/2 + 'px';
        
        if( height > containerHeight ) {
            $(this).css({
                'height': '570px'
            });
        } else {
            // add marginTop and negative marginTop to bottom
            // to prevent container from becoming too large
            $(this).css({
                'width': width,
                'padding-top': marginTop
            });
        }
        
    });
    
    $('#pager .page').on('click', showImage);
    $('#media .border .arrow').on({
        'click': showPrevNext
    });
    $('#media .border').on({
        'mouseenter': showNav,
        'mouseleave': hideNav
    });
});