jQuery(document).ready(function(){

jQuery('#upload_image_button').click(function()
{
formfield = jQuery(this).prev().attr('name');
inp_id = jQuery(this).prev().attr('id');
jQuery('#img_txt_id').val(inp_id);
tb_show('', 'media-upload.php?post_id=<?php  echo $post->ID; ?>&type=image&amp;TB_iframe=true');
return false;
});

window.send_to_editor = function(html) {
img_cont = jQuery('#img_txt_id').val();
//console.log(html);
var imgurl =jQuery(html).attr("href");
jQuery('#'+img_cont).val(imgurl);
tb_remove();
};
} ) ;