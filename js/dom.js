jQuery.noConflict();
jQuery(document).ready(function($) {
  // Code that uses jQuery's $ can follow here.
  
  // PAGE TRANSITION
  
  // js running so we'll do masonry
	$('body.JS .content').imagesLoaded( function(){
	
		if ($('.home').length) {
		  $('.home .content').masonry({
		    itemSelector : '.half'
		  }).masonry('reload');
	  }
	  
	  $('.twitter-follow-button-container').css({opacity: 0.0, visibility: "visible"}).animate({ opacity: 1.0 }, 200);

    var delay = 0;
    // queue all
    $('.content img').each(function() {
      $(this).css({opacity: 0.0, visibility: "visible"}).delay(delay).animate({ opacity: 1.0 }, 100);
      delay += 300;
    });
    $('.content iframe').each(function() {
      $(this).css({opacity: 0.0, visibility: "visible"}).delay(delay).animate({ opacity: 1.0 }, 100);
      delay += 300;
    });


	});

	// GRID

	if ($('.container').length) {
		var COLUMNS = 15;
		function showGrid() {
			$('.container').append('<div class="show_grid" />');
			for (i=0;i<COLUMNS;i++) {
				$('.show_grid').append('<div class="column">'+(i+1)+'</div>');
		  }
		  $('.show_grid').fadeIn(50);
		}
		function hideGrid() {

        $('.show_grid').fadeOut(100, function() {
          // Animation complete.
          $('.show_grid').remove();
        });

		}
    $(".grid_hover a").hover(
      function () {
        showGrid();
      }, 
      function () {
        hideGrid();
      }
    );
  };
	
	// ARROW NAV
	
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

});