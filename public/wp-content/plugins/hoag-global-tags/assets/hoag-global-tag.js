jQuery(document).ready(function($) {	
	//experiementing
	$('#hoag_local_custom_metabox_display_name').autoComplete({
		source: function(name, response) {
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: '/wp-admin/admin-ajax.php',
				data: 'action=get_listing_names&name='+name,
				success: function(data) {
					response(data);
				}
			});
		}
   });
   
   //cant get it to work on the taxonomy fields.
   //body taxonomy-marketing-owner-tag
   $('.taxonomy-marketing-owner-tag #tag-name').autoComplete({
		source: function(name, response) {
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: '/wp-admin/admin-ajax.php',
				data: 'action=get_listing_names&name='+name,
				success: function(data) {
					response(data);
				}
			});
		}
   });

});