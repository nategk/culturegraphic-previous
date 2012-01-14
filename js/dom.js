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
	  $('.addthis_toolbox').css({opacity: 0.0, visibility: "visible"}).animate({ opacity: 1.0 }, 400);
		$('.content img').css({opacity: 0.0, visibility: "visible"}).animate({ opacity: 1.0 }, 200);
	  $('.content iframe').css({opacity: 0.0, visibility: "visible"}).animate({ opacity: 1.0 }, 200);
	});

	// GRID

	if ($('.container').length) {
		var COLUMNS = 15;
		function showGrid() {
			$('.container').append('<div class="show_grid" />');
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
