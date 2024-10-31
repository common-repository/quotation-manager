
(function(){

	document.addEventListener( 'DOMContentLoaded', () => {
		// it is a copy of the inline edit function
		var wp_inline_edit_function = inlineEditPost.edit;
	
		// we overwrite the it with our own
		inlineEditPost.edit = function( post_id ) {
	
			// let's merge arguments of the original function
			wp_inline_edit_function.apply( this, arguments );
	
			// get the post ID from the argument
			var id = 0;
			if ( typeof( post_id ) == 'object' ) { // if it is object, get the ID number
				id = parseInt( this.getId( post_id ) );
			}
	
			//if post id exists
			if ( id > 0 ) {
	
				// add rows to variables
				var //specific_post_edit_row = $( '#edit-' + id ),
					specific_post_edit_row = document.querySelector( '#edit-' + id ),
					//specific_post_row = $( '#post-' + id ),
					specific_post_row = document.querySelector( '#post-' + id ),
					//product_price = $( '.column-price', specific_post_row ).text(),
					product_price = specific_post_row.querySelector( '.column-price' ).innerHTML

					console.log( specific_post_edit_row )

	
				// populate the inputs with column data
				//$( ':input[name="price"]', specific_post_edit_row ).val( product_price );
				specific_post_edit_row.querySelector( 'input[name="price"]' ).value = product_price
			}
		}
	} )

})()