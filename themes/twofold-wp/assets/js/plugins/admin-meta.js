jQuery(document).ready(function($){
	
	// Demo Content Import
	var importBtn = $('#import-demo-content');
		
	importBtn.on("click", function(e){
		e.preventDefault();
		var demo = $('input[name="option_tree[demo-select]"]:checked').val();

		
		importBtn.addClass('disabled').attr('disabled', 'disabled').unbind('click');
		

		var data = new FormData();
				data.append( 'action', 'ocdi_import_demo_data' );
				data.append( 'security', ocdi.ajax_nonce );
				data.append( 'selected', demo );
		
				// AJAX call.
				$.ajax({
					method:     'POST',
					url:        ocdi.ajax_url,
					data:       data,
					contentType: false,
					processData: false,
					beforeSend: function() {
						$('#thb-import-messages').addClass('active').append( '<div class="notice notice-success"><p><strong>' + ocdi.loader_text + '</strong></p></div>' );
					},
					complete:   function() {
						
					}
				})
				.done( function( response ) {
					if ( 'undefined' !== typeof response.message ) {
						$('#thb-import-messages').append( '<p>' + response.message + '</p>' );
					} else {
						$('#thb-import-messages').append( '<div class="error  below-h2"><p>' + response + '</p></div>' );
					}
				})
				.fail( function( error ) {
					$('#thb-import-messages').append( '<div class="error thb-failed below-h2"> Error: ' + error.statusText + ' (' + error.status + ')' + '</div>' );
				});
	});
});