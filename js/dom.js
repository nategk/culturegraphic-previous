jQuery(document).ready(function($) {
  // Code that uses jQuery's $ can follow here.
  
	$('.home .content .half').imagesLoaded( function(){
	  $('.home .content').masonry({
	    itemSelector : '.half'
	  }).masonry('reload');;
	});

	if ($('.container_15').length) {
		var COLUMNS = 15;
		function showGrid() {
			$('.container_15').append('<div class="show_grid" />');
			for (i=0;i<COLUMNS;i++) {
				$('.show_grid').append('<div class="column">'+(i+1)+'</div>');
				}
		}
		function hideGrid() {
			if ($('.show_grid').length) {
				$('.show_grid').remove();
			}
		}
		$(document).keydown(function(e) {		
			if (e.shiftKey) {
				showGrid();
			}
		});
		$(document).keyup(function(event){
			hideGrid();
		});
	}
	
	// Arrow project nav
	if ($(".project").data()) {
		var projectData = $(".project").data();
		if ( projectData.next ) {
			$(document).keydown(function(e){
			    if (e.keyCode == 37) { 
			       window.location.href = projectData.next;
			       return false;
			    }
			});
		}
		if ( projectData.prev ) {
			$(document).keydown(function(e){
			    if (e.keyCode == 39) { 
			       window.location.href = projectData.prev;
			       return false;
			    }
			});
		}
	}


    // jQuery SmoothScroll | Version 10-04-30
    $('a[href*=#]').click(function() {

        // duration in ms
        var duration = 500;

        // easing values: swing | linear
        var easing = 'swing';

        // get / set parameters
        var newHash = this.hash;
        var target = $(this.hash).offset().top;
        var oldLocation = window.location.href.replace(window.location.hash, '');
        var newLocation = this;

        // make sure it's the same location
        if (oldLocation + newHash == newLocation) {
            // set selector
            if ($.browser.safari) var animationSelector = 'body:not(:animated)';
            else var animationSelector = 'html:not(:animated)';

            // animate to target and set the hash to the window.location after the animation
            $(animationSelector).animate({
                scrollTop: target
            }, duration, easing, function() {

                // add new hash to the browser location
                window.location.href = newLocation;
            });

            // cancel default click action
            return false;
        }
    });

});
