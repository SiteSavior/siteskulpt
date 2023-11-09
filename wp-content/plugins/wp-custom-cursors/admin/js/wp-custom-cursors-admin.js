/*!
 * WP Custom Cursors | WordPress Cursor Plugin
 * Author: Web_Trendy
 * Copyright © Web_Trendy 
 *
 * "Open your hands if you want to be held." -Rumi
 *
 */ 


jQuery(document).ready(function($){
    // Form Wizard Initialization
    let addNewForm = $('#add_new_form');
	addNewForm.formToWizard({
	    nextBtnClass: 'btn btn-primary next btn-sm',
	    prevBtnClass: 'btn btn-default prev me-2 btn-sm',
	    buttonTag:    'button',
	    validateBeforeNext: function(form, step) {
	        var stepIsValid = true;
	        // var validator = form.validate();
	        // $(':input', step).each( function(index) {
	        //     var xy = validator.element(this);
	        //     stepIsValid = stepIsValid && (typeof xy == 'undefined' || xy);
	        // });
	        return stepIsValid;
	    },
	    progress: function (i, count) {
	        $('.progress-complete').width(''+(i/(count-1)*100)+'%');
	    }
	});

	// Preview Cursor Scripts
	let getMousePosition = (e) => {
	    let posx = 0;
	    let posy = 0;
	    posx = e.clientX;
	    posy = e.clientY;
	    return { x : posx, y : posy }
	},
	mousePosition = {x:0, y:0},
	previewWrapper = $('#wt-preview'),
	calcTop = 0, calcLeft = 0, paddingTop = 0, paddingLeft = 0,
	body = $('body'),
	svgIcons = ['<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"/><path d="M10 6v2H5v11h11v-5h2v6a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h6zm11-3v9l-3.794-3.793-5.999 6-1.414-1.414 5.999-6L12 3h9z"/></g></svg>',
		'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"/><path d="M13.172 12l-4.95-4.95 1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/></g></svg>',
		'<svg width="17px" height="10px" viewBox="0 0 17 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="arrow-left-right-line" transform="translate(-4.000000, -12.000000)"><polygon id="Shape" points="0 0 24 0 24 24 0 24"></polygon><polygon id="Shape" fill="#000000" fill-rule="nonzero" points="16.05 12.05 21 17 16.05 21.95 14.636 20.536 17.172 17.999 4 18 4 16 17.172 16 14.636 13.464"></polygon></g></g></svg>',
		'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"/><path d="M14 12l-4 4V8z"/></g></svg>',
		'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"/><path d="M16.004 9.414l-8.607 8.607-1.414-1.414L14.589 8H7.004V6h11v11h-2V9.414z"/></g></svg>',
		'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"/><path d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/></g></svg>',
		'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"/><path d="M10.13 15.842l-.788 2.94-1.931-.518.787-2.939a10.988 10.988 0 0 1-3.237-1.872l-2.153 2.154-1.415-1.415 2.154-2.153a10.957 10.957 0 0 1-2.371-5.07l.9-.165A16.923 16.923 0 0 0 12 10c3.704 0 7.131-1.185 9.924-3.196l.9.164a10.957 10.957 0 0 1-2.37 5.071l2.153 2.153-1.415 1.415-2.153-2.154a10.988 10.988 0 0 1-3.237 1.872l.787 2.94-1.931.517-.788-2.94a11.072 11.072 0 0 1-3.74 0z"/></g></svg>',
		'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"/><path d="M1.181 12C2.121 6.88 6.608 3 12 3c5.392 0 9.878 3.88 10.819 9-.94 5.12-5.427 9-10.819 9-5.392 0-9.878-3.88-10.819-9zM12 17a5 5 0 1 0 0-10 5 5 0 0 0 0 10zm0-2a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></g></svg>',
		'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"/><path d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2zm0 5c-.513 0-1.007.077-1.473.22a2.5 2.5 0 1 1-3.306 3.307A5 5 0 1 0 12 7z"/></g></svg>',
		'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"/><path d="M18.031 16.617l4.283 4.282-1.415 1.415-4.282-4.283A8.96 8.96 0 0 1 11 20c-4.968 0-9-4.032-9-9s4.032-9 9-9 9 4.032 9 9a8.96 8.96 0 0 1-1.969 5.617zm-2.006-.742A6.977 6.977 0 0 0 18 11c0-3.868-3.133-7-7-7-3.868 0-7 3.132-7 7 0 3.867 3.132 7 7 7a6.977 6.977 0 0 0 4.875-1.975l.15-.15z"/></g></svg>',
		'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"/><path d="M13 14h-2a8.999 8.999 0 0 0-7.968 4.81A10.136 10.136 0 0 1 3 18C3 12.477 7.477 8 13 8V3l10 8-10 8v-5z"/></g></svg>',
		'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"/><path d="M13.576 17.271l-5.11-2.787a3.5 3.5 0 1 1 0-4.968l5.11-2.787a3.5 3.5 0 1 1 .958 1.755l-5.11 2.787a3.514 3.514 0 0 1 0 1.458l5.11 2.787a3.5 3.5 0 1 1-.958 1.755z"/></g></svg>',
		'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-1-5h2v2h-2v-2zm2-1.645V14h-2v-1.5a1 1 0 0 1 1-1 1.5 1.5 0 1 0-1.471-1.794l-1.962-.393A3.501 3.501 0 1 1 13 13.355z"/></g></svg>',
		'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM11 7h2v2h-2V7zm0 4h2v6h-2v-6z"/></g></svg>',
		'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"/><path d="M4.52 5.934L1.393 2.808l1.415-1.415 19.799 19.8-1.415 1.414-3.31-3.31A10.949 10.949 0 0 1 12 21c-5.392 0-9.878-3.88-10.819-9a10.982 10.982 0 0 1 3.34-6.066zm10.237 10.238l-1.464-1.464a3 3 0 0 1-4.001-4.001L7.828 9.243a5 5 0 0 0 6.929 6.929zM7.974 3.76C9.221 3.27 10.58 3 12 3c5.392 0 9.878 3.88 10.819 9a10.947 10.947 0 0 1-2.012 4.592l-3.86-3.86a5 5 0 0 0-5.68-5.68L7.974 3.761z"/></g></svg>'];

	body.on('pointermove', function(ev) {mousePosition = getMousePosition(ev)});
	createCursor();
	function createCursor() {
		let cursorWrapper = $('<div class="wpcc-cursor">'),
			cursorEl1 = $('<div class="cursor-el1">'), 
			cursorEl2 = $('<div class="cursor-el2">'),
			cursorTypeInput = $('#cursor_type_input');

		cursorWrapper.append(cursorEl1);
		cursorWrapper.append(cursorEl2);
		previewWrapper.append(cursorWrapper);

		let cursorShape = 1,
		cursorWidth = $('#cursor_size_input').val(),
		cursorColor = $('#cursor_color').val(),
		blendingMode = $('#blending_mode').find(":selected").val();

		let cursorShapeRadius = $('[name = cursor_shape]');
		cursorShapeRadius.each(function(index, el) {
			if ($(this).is(':checked')) {
				cursorShape = $(this).val();
			}
		});

		let isCreatedCursor = cursorShape.includes('created'),
			currentCreatedCursorId = cursorShape.substring(8);
		if (isCreatedCursor) {
			$('#shape_cursor_options').fadeOut();
			[...cursors].forEach(function(createdCursor){
				if(createdCursor.cursor_id == currentCreatedCursorId) {
					cursorWrapper.addClass('cursor-created-' + createdCursor.cursor_id);
					switch(createdCursor.cursor_type){
						case 'shape':
							cursorWrapper.css({'--fe-width' : `${createdCursor.cursor_options.fe_width}px` , '--fe-height' : `${createdCursor.cursor_options.fe_height}px` , '--fe-color' : `${createdCursor.cursor_options.fe_color}` , '--fe-radius' : `${createdCursor.cursor_options.fe_radius}px`, '--fe-border' : `${createdCursor.cursor_options.fe_border_width}px`, '--fe-border-color' : `${createdCursor.cursor_options.fe_border_color}`, '--fe-duration' : `${createdCursor.cursor_options.fe_duration}ms`, '--fe-timing' : `${createdCursor.cursor_options.fe_timing}`, '--fe-blending' : `${createdCursor.cursor_options.fe_blending}`, '--fe-zindex' : `${createdCursor.cursor_options.fe_zindex}`, '--se-width' : `${createdCursor.cursor_options.se_width}px` , '--se-height' : `${createdCursor.cursor_options.se_height}px` , '--se-color' : `${createdCursor.cursor_options.se_color}` , '--se-radius' : `${createdCursor.cursor_options.se_radius}px`, '--se-border' : `${createdCursor.cursor_options.se_border_width}px`, '--se-border-color' : `${createdCursor.cursor_options.se_border_color}`, '--se-duration' : `${createdCursor.cursor_options.se_duration}ms`, '--se-timing' : `${createdCursor.cursor_options.se_timing}`, '--se-blending' : `${createdCursor.cursor_options.se_blending}`, '--se-zindex' : `${createdCursor.cursor_options.se_zindex}`});
						break;
						case 'image':
							let imageCursor = $('<img>'),
							clickPointOption = createdCursor.cursor_options.click_point.split(','),
							clickPointX = ( Number(clickPointOption[0]) * Number(createdCursor.cursor_options.width) ) / 100,
							clickPointY = ( Number(clickPointOption[1]) * Number(createdCursor.cursor_options.height) ) / 100;
							imageCursor.prop('src', createdCursor.cursor_options.image_url);
							cursorEl1.append(imageCursor);
							cursorWrapper.addClass('cursor-image');

							if (createdCursor.cursor_options.background != 'off') {
								paddingTop = createdCursor.cursor_options.padding;
								paddingLeft = createdCursor.cursor_options.padding;
							}

							calcTop = ( Number(paddingTop) + clickPointY ) * -1;
							calcLeft = ( Number(paddingLeft) + clickPointX ) * -1;

							cursorWrapper.css({'--width' : `${createdCursor.cursor_options.width}px` , '--color' : `${createdCursor.cursor_options.color}` , '--radius' : `${createdCursor.cursor_options.radius}px` , '--padding' : `${createdCursor.cursor_options.padding}px`, '--blending' : `${createdCursor.cursor_options.blending}` });
						break;
						case 'text':
							if (createdCursor.cursor_options.text_type == 'horizontal') {
								let hrTextCursor = $(`<div class="horizontal-text">${createdCursor.cursor_options.hr_text}</div>`);
						    	cursorEl1.html(hrTextCursor);
						    	cursorWrapper.addClass('cursor-text');

						    	hrTextCursor.css({'--hr-padding' : `${createdCursor.cursor_options.hr_padding}px` , '--hr-width' : `${createdCursor.cursor_options.hr_width}px` , '--hr-transform' : `${createdCursor.cursor_options.hr_transform}` , '--hr-weight' : `${createdCursor.cursor_options.hr_weight}`, '--hr-color' : `${createdCursor.cursor_options.hr_color}`, '--hr-size' : `${createdCursor.cursor_options.hr_size}px`, '--hr-spacing' : `${createdCursor.cursor_options.hr_spacing}px`, '--hr-radius' : `${createdCursor.cursor_options.hr_radius}px`, '--bg-color' : `${createdCursor.cursor_options.hr_bgcolor}`, '--hr-backdrop' : `${createdCursor.cursor_options.hr_backdrop}(${createdCursor.cursor_options.hr_backdrop_amount})` });
							}
							else {
								let svgTextCursor = $(`<svg viewBox="0 0 500 500"><path d="M50,250c0-110.5,89.5-200,200-200s200,89.5,200,200s-89.5,200-200,200S50,360.5,50,250" id="textcircle" fill="none"></path><text dy="25" style=" font-size:70px;"><textPath xlink:href="#textcircle">${createdCursor.cursor_options.text}</textPath></text><circle cx="250" cy="250" r="10" id="svg_circle_node"/></svg>`);
						    	cursorEl1.html(svgTextCursor);
						    	cursorWrapper.addClass('cursor-text');

						    	svgTextCursor.css({'--dot-fill' : `${createdCursor.cursor_options.dot_color}` , '--text-width' : `${createdCursor.cursor_options.width}px` , '--text-transform' : `${createdCursor.cursor_options.text_transform}` , '--font-weight' : `${createdCursor.cursor_options.font_weight}`, '--text-color' : `${createdCursor.cursor_options.text_color}`, '--font-size' : `${createdCursor.cursor_options.font_size}px`, '--word-spacing' : `${createdCursor.cursor_options.word_spacing}px`, '--animation-name' : `${createdCursor.cursor_options.animation}`, '--animation-duration' : `${createdCursor.cursor_options.animation_duration}s`, '--dot-width' : `${createdCursor.cursor_options.dot_width}px`});
					    	}
						break;
					}
				}
			});
		}
		else {
			cursorWrapper.css({'--fe-width' : `${cursorWidth}px` , '--fe-height' : `${cursorWidth}px` , '--se-width' : `${cursorWidth}px` , '--se-height' : `${cursorWidth}px` , '--fe-color' : `${cursorColor}` , '--se-color' : `${cursorColor}` , '--fe-blending' : `${blendingMode}` , '--se-blending' : `${blendingMode}`, '--fe-border-radius' : '50%' });
			cursorWrapper.addClass('cursor-' + cursorShape);
		}

		previewWrapper.on('mouseenter', function() {
			cursorWrapper.addClass('active');
		});

		previewWrapper.on('mouseleave', function() {
			cursorWrapper.removeClass('active');
		}); 

		previewWrapper.on('pointermove', function() {
			requestAnimationFrame(function() {renderCursor()});
			function renderCursor() {
	   			cursorEl1.css('transform' , `translate(${mousePosition.x + calcLeft}px, ${mousePosition.y + calcTop}px)`);
	   			cursorEl2.css('transform' , `translate(${mousePosition.x}px, ${mousePosition.y}px)`);
				requestAnimationFrame(function() { renderCursor()});
			}
		});

		// Change Cursor Shape
		$('[name=cursor_shape]').on('click', function(){
			calcTop = 0; paddingTop = 0; calcLeft = 0; paddingLeft = 0;
			cursorWrapper.removeClass();
			if (cursorEl1.children()) {
				cursorEl1.empty();
			}
			cursorWrapper.addClass(`wpcc-cursor cursor-${$(this).val()}`);

			// This is a custom created cursor
			if ($(this).attr('data-type')) {
				let dataType = $(this).attr('data-type'),
					cursorId = $(this).attr('data-id'),
					isCreatedCursor = true;
					currentCreatedCursorId = cursorId; 
				$('#shape_cursor_options').fadeOut();
				switch(dataType){
				  case 'shape':
				    cursors.forEach(function(el){
						if( el.cursor_id == cursorId ) {
							cursorWrapper.css({'--fe-width' : `${el.cursor_options.fe_width}px` , '--fe-height' : `${el.cursor_options.fe_height}px` , '--fe-color' : `${el.cursor_options.fe_color}` , '--fe-radius' : `${el.cursor_options.fe_radius}px`, '--fe-border' : `${el.cursor_options.fe_border_width}px`, '--fe-border-color' : `${el.cursor_options.fe_border_color}`, '--fe-duration' : `${el.cursor_options.fe_duration}ms`, '--fe-timing' : `${el.cursor_options.fe_timing}`, '--fe-blending' : `${el.cursor_options.fe_blending}`, '--fe-zindex' : `${el.cursor_options.fe_zindex}`, '--se-width' : `${el.cursor_options.se_width}px` , '--se-height' : `${el.cursor_options.se_height}px` , '--se-color' : `${el.cursor_options.se_color}` , '--se-radius' : `${el.cursor_options.se_radius}px`, '--se-border' : `${el.cursor_options.se_border_width}px`, '--se-border-color' : `${el.cursor_options.se_border_color}`, '--se-duration' : `${el.cursor_options.se_duration}ms`, '--se-timing' : `${el.cursor_options.se_timing}`, '--se-blending' : `${el.cursor_options.se_blending}`, '--se-zindex' : `${el.cursor_options.se_zindex}`});
							$('#cursor_size_input, #cursor_size_range').val(el.cursor_options.fe_width);
							$('#blending_mode').val('normal');
						}
					});
					cursorTypeInput.val('shape');
					cursorTypeInput.attr('value', 'shape');
				  break;
				  case 'image':
				  	cursors.forEach(function(el){
						if( el.cursor_id == cursorId ) {
							let imageCursor = $('<img>'),
							clickPointOption = el.cursor_options.click_point.split(','),
							clickPointX = ( Number(clickPointOption[0]) * Number(el.cursor_options.width) ) / 100,
							clickPointY = ( Number(clickPointOption[1]) * Number(el.cursor_options.height) ) / 100;
							imageCursor.prop('src', el.cursor_options.image_url);
							cursorEl1.append(imageCursor);
							cursorWrapper.addClass('cursor-image');

							if (el.cursor_options.background != 'off') {
								paddingTop = el.cursor_options.padding;
								paddingLeft = el.cursor_options.padding;
							}

							calcTop = ( Number(paddingTop) + clickPointY ) * -1;
							calcLeft = ( Number(paddingLeft) + clickPointX ) * -1;

							cursorWrapper.css({'--width' : `${el.cursor_options.width}px` , '--color' : `${el.cursor_options.color}` , '--radius' : `${el.cursor_options.radius}px` , '--padding' : `${el.cursor_options.padding}px`, '--blending' : `${el.cursor_options.blending}` });
							$('#cursor_size_input, #cursor_size_range').val(el.cursor_options.width);
							$('#blending_mode').val(el.cursor_options.blending);
						}
					});
					cursorTypeInput.val('image');
					cursorTypeInput.attr('value', 'image');
				  break;
				  case 'text':
				  	 cursors.forEach(function(el){
						if( el.cursor_id == cursorId ) {
							if (el.cursor_options.text_type == 'horizontal') {
								let hrTextCursor = $(`<div class="horizontal-text">${el.cursor_options.hr_text}</div>`);
						    	cursorEl1.html(hrTextCursor);
						    	cursorWrapper.addClass('cursor-text');

						    	hrTextCursor.css({'--hr-padding' : `${el.cursor_options.hr_padding}px` , '--hr-width' : `${el.cursor_options.hr_width}px` , '--hr-transform' : `${el.cursor_options.hr_transform}` , '--hr-weight' : `${el.cursor_options.hr_weight}`, '--hr-color' : `${el.cursor_options.hr_color}`, '--hr-size' : `${el.cursor_options.hr_size}px`, '--hr-spacing' : `${el.cursor_options.hr_spacing}px`, '--hr-radius' : `${el.cursor_options.hr_radius}px`, '--bg-color' : `${el.cursor_options.hr_bgcolor}`, '--hr-backdrop' : `${el.cursor_options.hr_backdrop}(${el.cursor_options.hr_backdrop_amount})` });
							}
							else {
								let svgTextCursor = $(`<svg viewBox="0 0 500 500"><path d="M50,250c0-110.5,89.5-200,200-200s200,89.5,200,200s-89.5,200-200,200S50,360.5,50,250" id="textcircle" fill="none"></path><text dy="25" style=" font-size:70px;"><textPath xlink:href="#textcircle">${el.cursor_options.text}</textPath></text><circle cx="250" cy="250" r="10" id="svg_circle_node"/></svg>`);
						    	cursorEl1.html(svgTextCursor);
						    	cursorWrapper.addClass('cursor-text');

						    	svgTextCursor.css({'--dot-fill' : `${el.cursor_options.dot_color}` , '--text-width' : `${el.cursor_options.width}px` , '--text-transform' : `${el.cursor_options.text_transform}` , '--font-weight' : `${el.cursor_options.font_weight}`, '--text-color' : `${el.cursor_options.text_color}`, '--font-size' : `${el.cursor_options.font_size}px`, '--word-spacing' : `${el.cursor_options.word_spacing}px`, '--animation-name' : `${el.cursor_options.animation}`, '--animation-duration' : `${el.cursor_options.animation_duration}s`, '--dot-width' : `${el.cursor_options.dot_width}px`});
								$('#cursor_size_input, #cursor_size_range').val(el.cursor_options.width);
								$('#blending_mode').val(el.cursor_options.blending);
							}
						}
					});
				  	cursorTypeInput.val('text');
				  	cursorTypeInput.attr('value', 'text');
				  break;
				}
			}
			
			// This is a plugin default cursor
			else {
				isCreatedCursor = false;
				$('#cursor_size_input, #cursor_size_range').val(30);
				let cursorWidth = $('#cursor_size_input').val(),
					cursorColor = $('#cursor_color').val(),
					blendingMode = $('#blending_mode').find(":selected").val();
				cursorWrapper.css({'--fe-width' : `${cursorWidth}px` ,  '--fe-height' : `${cursorWidth}px` , '--se-width' : `${cursorWidth}px` , '--se-height' : `${cursorWidth}px` , '--fe-color' : `${cursorColor}` , '--se-color' : `${cursorColor}` , '--fe-blending' : `${blendingMode}` , '--se-blending' : `${blendingMode}` ,  '--fe-border-radius' : '50%'});
				$('#shape_cursor_options').fadeIn();
				cursorTypeInput.val('shape');
		    	cursorTypeInput.attr('value', 'shape');
			}
		});

		// Change Show Default Cursor
		$('#default_cursor').on('change', function(){
			if($(this).is(':checked')) {
				previewWrapper.removeClass('no-cursor');
			}
			else {
				previewWrapper.addClass('no-cursor');	
			}
		});

		// Change Cursor Size
		$('#cursor_size_input, #cursor_size_range').on('input', function(){
			let newWidth = $(this).val();
			if (isCreatedCursor) {
				[...cursors].forEach(function(createdCursor){
					if(createdCursor.cursor_id == currentCreatedCursorId) {
						let feWidth, seWidth, feHeight, seHeight;
						if (createdCursor.fe_width >= createdCursor.se_width) {
							feWidth = newWidth;
							seWidth = (createdCursor.se_width * newWidth) / createdCursor.fe_width;
							feHeight = (createdCursor.fe_width * newWidth) / createdCursor.fe_height;
							seHeight = (createdCursor.se_height * newWidth) / createdCursor.fe_width;
						}
						else {
							seWidth = newWidth;
							feWidth = (createdCursor.fe_width * newWidth) / createdCursor.se_width;
							seHeight = (createdCursor.se_height * newWidth) / createdCursor.se_width;
							feHeight = (createdCursor.fe_height * newWidth) / createdCursor.se_width;
						}
						cursorWrapper.css({'--fe-width' : `${feWidth}px` , '--se-width' : `${seWidth}px`, '--fe-height' : `${feHeight}px`, '--se-height' : `${seHeight}px`});
					}
				});
			}
			else {
				cursorWrapper.css({'--fe-width' : `${$(this).val()}px` , '--se-width' : `${$(this).val()}px` , '--fe-height' : `${$(this).val()}px` , '--se-height' : `${$(this).val()}px`});
			}
		});

		// Change Color
		$('#cursor_color').on('change', function(){
			cursorWrapper.css({'--fe-color' : `${$(this).val()}` , '--se-color' : `${$(this).val()}`});
		});

		// Change Blending Mode
		$('#blending_mode').on('change', function(){
			cursorWrapper.css({'--fe-blending' : `${$(this).find(":selected").val()}` , '--se-blending' : `${$(this).find(":selected").val()}`});
		});
			
	}

	// Select Cursor
	let cursorWrapper = $('.wpcc-cursor');


	// Cursor Size Change
	let cursorSizeRange = $('#cursor_size_range'),
		cursorSizeInput = $('#cursor_size_input');

	cursorSizeRange.on('input', function(){
		cursorSizeInput.val($(this).val());
	});

	cursorSizeInput.on('input', function(){
		cursorSizeRange.val($(this).val());
	});

	// Create Hover Cursor Button
	let createHoverBtn = $('#create_hover_btn');
	createHoverBtn.on('click', function(e){
		$('#hover_cursor_wrapper').fadeIn(0);
		$(this).fadeOut(0);
	});

	// Cancel Hover Cursor Button
	let cancelHoverBtn = $('#cancel_hover_btn');
	cancelHoverBtn.on('click', function(e){
		$('#hover_cursor_wrapper').fadeOut(0);
		createHoverBtn.fadeIn(0);
	});
	

	// Hover Cursor Select
	let hoverInputs = $('.hover-cursor-radio');
	hoverInputs.each(function() {
		if ($(this).prop('checked')) {
			showTextIconInput($(this));
		}
	});
	hoverInputs.on('click', function() {
		showTextIconInput($(this));
	});

	// Link/Button Toggle Buttons
	let hoverTriggerCustomBtn = $('#hover_trigger_custom'),
		hoverTriggerCustomWrapper = $('#hover_trigger_custom_wrapper'),
		hoverTriggerLinks = $('#hover_trigger_link'),
		hoverTriggerButtons = $('#hover_trigger_button');

	hoverTriggerLinks.on('click', function() {toggleOffCheckboxes($(this), [hoverTriggerCustomBtn])});
	hoverTriggerButtons.on('click', function() {toggleOffCheckboxes($(this), [hoverTriggerCustomBtn])});

	toggleElementVisibility($(this), hoverTriggerCustomWrapper);
	hoverTriggerCustomBtn.on('change', function(){
		toggleElementVisibility($(this), hoverTriggerCustomWrapper);
		toggleOffCheckboxes($(this), [hoverTriggerLinks, hoverTriggerButtons]);
	});

	// Hover Type Change
	let hoverType = $('[name=hover_type]');
	hoverType.on('click', function(){
		switch ($(this).val()) {
			case 'default':
				$('#available_hover_cursors').fadeOut();
			break;
			case 'snap':
				$('#available_hover_cursors').fadeOut();
			break;
			case 'available':
				$('#available_hover_cursors').fadeIn();
			break;
		}
	});

	// Hover Cursor Width
	let hoverCursorRange = $('#hover_cursor_width_range'),
		hoverCursorInput = $('#hover_cursor_width_input');

	hoverCursorRange.on('input', function(){
		hoverCursorInput.val($(this).val());
	});

	hoverCursorInput.on('input', function(){
		hoverCursorRange.val($(this).val());
	});

	// Custom Icon Upload
	let iconUploadBtn = $('#hover_cursor_icon_wrapper'),
		iconElement = $('#hover_cursor_icon'), 
		iconInputValue = $('#hover_cursor_icon_url'), 
		iconMediaUploader;

	iconUploadBtn.click(function(e){
		e.preventDefault();
		if (iconMediaUploader) {
			iconMediaUploader.open();
			return;
		}
		iconMediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Icon',
			button: {
				text: 'Select Icon'
			}, 
			multiple: false }
		);
		iconMediaUploader.on('select', function() {
			var attachment = iconMediaUploader.state().get('selection').first().toJSON();
			iconElement.attr('src', attachment.url);
			iconInputValue.val(attachment.url);

		});
		iconMediaUploader.open();
	});


	// Save Hover Cursor
	let cursorArray = $('#hover_cursors').val()? JSON.parse($('#hover_cursors').val()) : [];
	$('#save_hover_btn').on('click', function(){
		const HOVEROBJECT = {};
		let selector = [];

		if (hoverTriggerLinks.prop('checked')) {
			selector.push('a');
		}
		if (hoverTriggerButtons.prop('checked')) {
			selector.push('button');
		}
		if (hoverTriggerCustomBtn.prop('checked')) {
			if ($('#hover_trigger_selector').val()) {
				selector.push($('#hover_trigger_selector').val());
			}
		}

		if (cursorArray.length) {
			let cursorExists = false;
			cursorArray.some(function(oldCursor){
				if (oldCursor.selector) {
					cursorExists =  oldCursor.selector.some(r => selector.includes(r));	
				}
				else { cursorExists = 0; }
				return cursorExists;
			});
			if (cursorExists) {
				showError(strings[0]);
				return false;
			}
		}

		HOVEROBJECT.selector = selector;

		hoverInputs.each(function() {
			if ($(this).prop('checked')) {
				HOVEROBJECT.cursor = $(this).val();
			}
		});

		hoverType.each(function(){
			if($(this).prop('checked')) {
				HOVEROBJECT.hoverType = $(this).val();
			}
		});

		if ($('#hover_cursor_text').val()) {
			HOVEROBJECT.cursorText = $('#hover_cursor_text').val();
		}
		if ($('#hover_cursor_text').val()) {
			HOVEROBJECT.cursorText = $('#hover_cursor_text').val();
		}

		if (iconInputValue.val()) {
			HOVEROBJECT.cursorIcon = iconInputValue.val();
		}

		if ($('#hover_background_color').val()) {
			HOVEROBJECT.bgColor = $('#hover_background_color').val();
		}

		if ($('#hover_cursor_width_range').val()) {
			HOVEROBJECT.width = $('#hover_cursor_width_range').val();
		}
		
		let cursorArrayLength = cursorArray.push(HOVEROBJECT), 
			cursorArrayIndex = cursorArrayLength - 1;
		
		$('#hover_cursors').val(JSON.stringify(cursorArray));
		let hoverListType;
		if (HOVEROBJECT.hoverType !== 'available') {
			hoverListType = `<div class="col-md-2"><span class="badge text-bg-primary">${HOVEROBJECT.hoverType}</span></div>`;
		}
		else {
			hoverListType = `<div class="col-md-2"><img src="${wpcc_image_path[0]}/cursors/hover-${HOVEROBJECT.cursor}.svg" class="img" /></div><div class="col-md-3"><div class="bg-color">${strings[1]}<div style="background-color: ${HOVEROBJECT.bgColor};"></div></div></div><div class="col-md-3"><div class="width">${strings[2]}<div class="text-muted">${HOVEROBJECT.width} px</div></div></div>`;
		}
		$('.hover-cursors-list-wrapper').append($(`<div class="hover-list-item title-normal row position-relative">${hoverListType}<div class="col-md-3"><div class="activation">${strings[3]}<div class="text-muted">${HOVEROBJECT.selector}</div></div></div><div class="remove-hover" data-id="${cursorArrayIndex}"><i class="ri-close-fill ri-lg"></i></div></div>`));
		$('#hover_cursor_wrapper').fadeOut(0);
		createHoverBtn.fadeIn(0);
	});

	// Functions
	$(document).on('click','.remove-hover',function(index){
		let id = $(this).attr('data-id');
		cursorArray[id] = 'del';
		
		$(this).parents('.hover-list-item').remove();
	});
	addNewForm.on('submit', function(){
		let updatedCursorArray = [];
		cursorArray.forEach(function(item, index){
			if (item != 'del') {
				updatedCursorArray.push(item);
			}
		});
		$('#hover_cursors').val(JSON.stringify(updatedCursorArray));
	});

	function showTextIconInput(element) {
		if (element.attr('id') !== 'hover_cursor_1') {
			$('#hover_text_icon_wrapper').fadeOut();
		}
		else {
			$('#hover_text_icon_wrapper').fadeIn();
		}
	}

	function toggleElementVisibility(toggler, element) {
		if (toggler.prop('checked')) {
			element.fadeIn();
		}
		else {
			element.fadeOut();
		}
	}

	function toggleOffCheckboxes(toggler, checkboxes) {
		if (toggler.prop('checked')) {
			checkboxes.forEach(function(checkbox){
				checkbox.prop('checked', false).trigger('change');
			});
		}
	}

	function showError(message) {
		$('#alert_message').html(message);
		$('#alert_container').removeClass('d-none');
		$('#alert_container').addClass('d-flex show');
		setTimeout(function(){
			$('#alert_container').removeClass('d-flex show');
			$('#alert_container').addClass('d-none');
		}, 10000);
	}

	// Activation
	toggleElementVisibility($('#activate_on_element'), $('#select_element_group'));
	$('#activate_on_page').on('click', function(){
		$('#select_element_group').fadeOut();
	});

	$('#activate_on_section').on('click', function(){
		$('#select_element_group').fadeIn();
	});

	// Color Picker Initialization
    $('.wp-custom-cursor-color-picker').spectrum({
		type: "component"
	});

});
