 jQuery(function() {
  jQuery(".rm_opts div.rm_section").click(function(){
		if (!jQuery(this).hasClass('active')) {
			var val = jQuery(this).attr("ID");
	
			jQuery('.rm_opts div.rm_section').removeClass('active');		
			jQuery('.rm_opts div#'+val).addClass('active');

			jQuery('.rm_opts  div.rm_options').slideUp("slow");
			jQuery('.rm_opts div#'+val).slideDown( "slow" );
		}
			});
				});

