// sidebar behavior
$(document).ready(function() {
	var wrapH = $('.wrap').height();
	
	$('#left-sidebar').css('height', wrapH);
	
	if ( $(window).width() > 1024 ) {
		$('.icon.search').addClass('search-large');
	}	
});
$(window).resize(function() {
	if ( $(window).width() > 1024 ) {
		$('.icon.search').addClass('search-large');
	}
});


// header behavior
$('.icon.menu').click(function() {
	if ( $('#top-search-drawer').hasClass('open') || $('#right-menu-drawer').hasClass('open') ) {	
	} else {
		$('.icon.menu').toggleClass('active');
		$('#left-menu-drawer').toggleClass('open');
	}
});
$('.icon.search').click(function() {
	if ( $('#left-menu-drawer').hasClass('open') ) {	
	} else {
		
		if ( $('.icon.search').hasClass('search-large') ) {
		} else {
			$('.icon.search').toggleClass('active');
		}
		
		$('#top-search-drawer').toggleClass('open');
		$('header').toggleClass('search-open');
		$('.top-drawer-search').focus();
	}
});
$('.icon.share').click(function() {
	if ( $('#top-search-drawer').hasClass('open') || $('#left-menu-drawer').hasClass('open') ) {	
	} else {
		$('.icon.share').toggleClass('active');
		$('#right-menu-drawer').toggleClass('open');
	}
});


$(document).ready( function($) {
	//// Social Sharing Functionality ////
    var content = window.location.href;   // Default modal content

	// Create modal
	var modal =
		'<div class="remodal" data-remodal-id="modal">' +
			'<button data-remodal-action="close" class="remodal-close"></button>' +
			'<h1></h1>' +

            '<textarea></textarea><br/>' +
            '<button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>' +
        '</div>';

	// Append modal to HTML body
	$('body').append( modal );

	//// Click Functionality
	$('div.share a.nav-item.social').click(function () {
        // Get name of item clicked on
        var type = $(this).text().trim();

        if( type == "Copy Link" ) {
            // Dynamically populate modal header
            $('[data-remodal-id=modal] h1').text( type );

            // Dynamically populate modal content
            $('[data-remodal-id=modal] textarea').text( content );

            // Automatically select text, when textarea is clicked
            $("div.remodal textarea").focus( function() {
                var textarea = $(this);
                textarea.select();

                // Work around Chrome's little problem
                textarea.mouseup(function() {
                    // Prevent further mouseup intervention
                    textarea.unbind("mouseup");
                    return false;
                });
            });

            // Open modal
            $('[data-remodal-id=modal]').remodal().open();
        }
	});
});
