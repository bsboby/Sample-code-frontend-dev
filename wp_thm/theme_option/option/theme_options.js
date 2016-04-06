jQuery(document).ready(function($){
    var custom_uploader;
    $('.button-upload').click(function(e) {
        e.preventDefault();
		var input_text = $(this).attr("id");
		 //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#'+input_text).val(attachment.url);
			$('img#'+input_text).attr('src', attachment.url);
			
        });
        //Open the uploader dialog
        custom_uploader.open();
   });
			$(".upload a").click(function() {
	      var value = $(this).attr("id");
		  
	   $('.upload input.text-upload_' + value ).val("");
	   
	   var fval = $('.upload img#' + value ).css('display','none');
	   
	   
	  
});
});