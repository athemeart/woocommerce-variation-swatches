/*
   Document   : frontend.js
   Author: Saiful
   Author e-mail: e2getway@gmail.com
   Version: 1.0.0
*/
;(function ( $ ) {
	'use strict';

	/**
	 * @TODO Code a function the calculate available combination instead of use WC hooks
	 */
	$.fn.atawc_variation_swatches_form = function () {
		return this.each( function() {
			var $form = $( this ),
				clicked = null,
				selected = [];

			$form
				.addClass( 'swatches-support' )
				.on( 'click', '.swatch,.swatch_radio', function ( e ) {
					e.preventDefault();
					var $el = $( this ),
						$select = $el.closest( '.value' ).find( 'select' ),
						attribute_name = $select.data( 'attribute_name' ) || $select.attr( 'name' ),
						value = $el.data( 'value' );

					$select.trigger( 'focusin' );
					$select.hide();
					// Check if this combination is available
					if ( ! $select.find( 'option[value="' + value + '"]' ).length ) {
						$el.siblings( '.swatch' ).removeClass( 'selected' );
						$select.val( '' ).change();
						$form.trigger( 'atawc_no_matching_variations', [$el] );
						return;
					}

					clicked = attribute_name;

					if ( selected.indexOf( attribute_name ) === -1 ) {
						selected.push(attribute_name);
					}
					
					if ( $el.hasClass( 'selected' ) ) {
						$select.val( '' );
						$el.removeClass( 'selected' );

						delete selected[selected.indexOf(attribute_name)];
					} else {
						$el.addClass( 'selected' ).siblings( '.selected' ).removeClass( 'selected' );
						$select.val( value );
					}

					$select.change();
				} )
				.on( 'click', '.reset_variations', function () {
					$( this ).closest( '.variations_form' ).find( '.swatch.selected' ).removeClass( 'selected' );
					selected = [];
				} )
				.on( 'atawc_no_matching_variations', function() {
					window.alert( wc_add_to_cart_variation_params.i18n_no_matching_variations_text );
				} );
		} );
	};

	$( function () {
		
		$( '.variations_form' ).atawc_variation_swatches_form();
		
		$( document.body ).trigger( 'atawc_initialized' );
		
		if( $('.masterTooltip').length ){
			$('.masterTooltip').hover(function(){
					// Hover over code
					var title = $(this).attr('title');
					if(title != ""){
					$(this).data('tipText', title).removeAttr('title');
					$('<span class="ed-tooltip"></span>')
					.text(title)
					.appendTo('body')
					//.appendTo($(this).parents('.ed_woo_variations_wrp'))
					.fadeIn('slow');
					}
					
			}, function() {
					// Hover out code
					$(this).attr('title', $(this).data('tipText'));
				   $('.ed-tooltip').remove();
			}).mousemove(function(e) {
					var mousex = e.pageX ; //Get X coordinates
					var mousey = e.pageY -50; //Get Y coordinates
					$('.ed-tooltip')
					.css({ top: mousey, left: mousex })
			});
		}
		
		/*--------------------------------------*/
		/*--------------------------------------*/
		 $('input.variation_id').change( function(){
			  var element = '';
			 if( $(smart_variable.__price_update_on).length ){
				 element = smart_variable.__price_update_on;
			 }else{
				   element = '.' + smart_variable.__price_update_on;
			 }
			
            //Correct bug, I put 0
           if( 0 != $('input.variation_id').val()){
				
                $(element).html($('div.woocommerce-variation-price > span.price').html()).html('<p class="availability">'+$('div.woocommerce-variation-availability').html()+'</p>');
                
            } else {
                $(element).html($('div.hidden-variable-price').html());
				
                if($('p.availability'))
                    $('p.availability').remove();
               
            }
        });
		
		/*--------------------------------------*/
		/*--------------------------------------*/
	} );
})( jQuery );