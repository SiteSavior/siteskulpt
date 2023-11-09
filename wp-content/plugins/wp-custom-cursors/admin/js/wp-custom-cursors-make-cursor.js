/*!
 * WP Custom Cursors | WordPress Cursor Plugin
 * Author: Web_Trendy
 * Copyright © Web_Trendy (https://codecanyon.net/user/web_trendy/portfolio)
 * License: Envato (CodeCanyon) Licence
 * License URI: http://codecanyon.net/legal/licence
 *
 * "Open your hands if you want to be held." -Rumi
 *
 */ 

jQuery(document).ready(function($){
	// Main Object to hold cursor options
	let cursorObj = {}

	$('#create_cursor_form').on('submit', function(){
		let cursorType = $('#cursor_type').val();
		if (cursorType == 'text') {
			cursorType = $('#text_type').val()
		}
		let inputs = $(`#${cursorType}_options *[data-name]`);
		inputs.each(function(){
			cursorObj[$(this).attr('data-name')] = $(this).val();
		});
		$('#cursor_options').val(JSON.stringify(cursorObj));
	})

	// Functions
	function displayOptions (containerId, optionsId ) {
		jQuery('#'+containerId).children().fadeOut(0);
		jQuery('#'+optionsId).fadeIn();
	}

	// Editor
	$('#cursor_type').on('change', function(){
		if ($(this).val() == 'text') {
			let textType = $('#text_type').val();
			displayOptions('preview_container', textType + "_preview");
			displayOptions('options_container', textType + "_options");
		}
		else {
			displayOptions('preview_container', $(this).val() + "_preview");
			displayOptions('options_container', $(this).val() + "_options");
		}
	});

	// Image Cursor Upload File
	let uploadBtn = $('#image_upload_btn'),
		imageWrapper = $('#uploaded_image_wrapper'),
		uploadedImage = $('#uploaded_image'),
		imageUrlInput = $('#image_url_input'),
		delBtn = $('#wpcc_delete_image'),
		mediaUploader;

	uploadBtn.click(function(e){
		e.preventDefault();
		if (mediaUploader) {
			mediaUploader.open();
			return;
		}
		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Cursor Image',
			button: {
				text: 'Select Cursor'
			}, 
			multiple: false }
		);
		mediaUploader.on('select', function() {
			var attachment = mediaUploader.state().get('selection').first().toJSON();

			uploadBtn.addClass('visually-hidden');
			imageWrapper.removeClass('visually-hidden');
			uploadedImage.attr('src', attachment.url);
			delBtn.removeClass('visually-hidden');
			imageUrlInput.val(attachment.url);
			$('#click_point_info').removeClass('visually-hidden');
			setTimeout(function(){
				$('#image_height').val(uploadedImage.height());
			}, 1000);
		});
		mediaUploader.open();
	});

	// Delete Button
	delBtn.click(function(){
		uploadBtn.removeClass('visually-hidden');
		imageWrapper.addClass('visually-hidden');
		uploadedImage.attr('src', '');
		imageUrlInput.val('');
		$(this).addClass('visually-hidden');
		$('#click_point_info').addClass('visually-hidden');
		return false;
	});

	// Click Point
	let newImageEl, newImageElWidth, newImageElHeight,
		clickPointInput = $('#click_point_input');
	
	let position = { x: 0, y: 0 }
	interact('#click_point').draggable({
	  	listeners: {
		    start (event) {
		      	newImageEl = $('#uploaded_image');
		      	newImageElWidth = Math.round(newImageEl.width());
		      	newImageElHeight = Math.round(newImageEl.height());
		    },
	    	move (event) {
	      		position.x += event.dx
	      		position.y += event.dy
	      		event.target.style.transform =`translate(${position.x}px, ${position.y}px)`;
	      		let pEl = document.getElementById("image_preview"),
	      			cpx = Math.round((Math.round(position.x) * 100) / newImageElWidth),
	      			cpy = Math.round((Math.round(position.y) * 100) / newImageElHeight);
	        	clickPointInput.val(cpx + "," + cpy).trigger('change');
	        	pEl.style.setProperty('--click-point-x', (cpx * -1) + "%");
	        	pEl.style.setProperty('--click-point-y', (cpy * -1) + "%");
	    	},
	  	}
	});

	// Image Width Change Calculate and Set Height
	$('#image_width, #image_width_range').on('input', function(){
		$('#image_height').val(uploadedImage.height());
	});

	
	// Range/Number Change
	$('input[data-apply]:not([type=text]):not([data-attr])').on('input', function(){
		let element = $(this).attr('data-apply'),
		variable = $(this).attr('data-variable'),
		unit = $(this).attr('data-unit') || '';
		$('#' + element)[0].style.setProperty('--' + variable, $(this).val() + unit);
	});

	// Color Change
    $('.wp-custom-cursor-color-picker').spectrum({
		type: "component",
		move: function(color) {
			let element = $(this).attr('data-apply'),
			variable = $(this).attr('data-variable');
		    $('#' + element)[0].style.setProperty('--' + variable, color.toRgbString()); 
		}
	});

	// Select Change
	$('select[data-apply]').on('change', function(){
		let element = $(this).attr('data-apply'),
		variable = $(this).attr('data-variable');
		$('#' + element)[0].style.setProperty('--' + variable, $(this).val());
	});

	// Show/Hide Image Background
	$('#image_background').on('change', function(){
		if($(this).is(':checked')) {
			$(this).val('on');
			$(this).parent().next('.image-bg-options').removeClass('visually-hidden');
		}
		else {
			$(this).val('off');
			$(this).parent().next('.image-bg-options').addClass('visually-hidden');
			$("#image_background_color").val('transparent');
			$('#uploaded_image_wrapper')[0].style.setProperty('--image-background-color', 'transparent'); 
		}
	});

	// Change Text Type
	$('[data-select]').on('change', function(){
		let element = $(this).attr('data-select')
		displayOptions('preview_container', $(this).val() + "_preview");
		displayOptions('options_container', $(this).val() + "_options");
		$('#' + element).val($(this).val());
	});

	// Change Cursor Text 
	$('input[type=text]').on('input', function(){
		let element = $(this).attr('data-apply');
		$('#' + element).html($(this).val());
	});

	// Show/Hide Dot
	$('#show_dot').on('change', function(){
		let element = $(this).attr('data-apply');
		if($(this).is(':checked')) {
			$('#' + element)[0].style.setProperty('--dot-display', 'block'); 
			$(this).parent().next('#dot_options').fadeIn();
		}
		else {
			$('#' + element)[0].style.setProperty('--dot-display', 'none');
			$(this).parent().next('#dot_options').fadeOut();
		}
	});

	// Change Dot Width
	$('input[data-attr]').on('input', function(){
		let element = $(this).attr('data-apply'),
		variable = $(this).attr('data-variable');
		unit = $(this).attr('data-unit') || '';
		$('#' + element)[0].style.setProperty('--' + variable, $(this).val() + unit);
	});

	// Range Input Change
	$('input[type=range]').each(function(){
		if( $(this).next().attr('type') == 'number' ) {
			$(this).on('input', function(){
				$(this).next().val($(this).val());
			});

			$(this).next().on('input', function(){
				$(this).prev().val($(this).val());
			});
		}
	});

	// Enabling Bootstrap Tooltips
	const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
	const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

});
