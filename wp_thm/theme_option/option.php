<?php

$themename = "Theme Option";
$shortname = "we";
$options = array (
 
array( "name" => $themename." Options",
	"type" => "title"),
 

array( "name" => "General",
	"type" => "section","id"=>"1"),
array( "type" => "open"),
 

array( "name" => "Logo Upload",
	"desc" => "Upload Your Site Logo",
	"id" => $shortname."_logos",
	"type" => "upload",
	"std" => ""),
array( "name" => "Custom CSS",
	"desc" => "Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}",
	"id" => $shortname."_custom_css",
	"type" => "textarea",
	"std" => ""),

array( "type" => "close"),
array( "name" => "Footer",
	"type" => "section","id"=>"3"),
array( "type" => "open"),
	
array( "name" => "Footer copyright text",
	"desc" => "Enter copyright text used in the footer. ",
	"id" => $shortname."_footer_copy",
	"type" => "text",
	"std" => ""),
array( "name" => "Footer License Number",
	"desc" => "Enter License text used in the footer. ",
	"id" => $shortname."_footer_license",
	"type" => "text",
	"std" => ""),
array( "name" => "Footer Address",
	"desc" => "Enter Address text used in the footer. ",
	"id" => $shortname."_footer_address",
	"type" => "text",
	"std" => ""),
array( "name" => "Footer Address2",
	"desc" => "Enter Address2 text used in the footer. ",
	"id" => $shortname."_footer_address2",
	"type" => "text",
	"std" => ""),
array( "name" => "Footer Email Address",
	"desc" => "Enter Email Address used in the footer. ",
	"id" => $shortname."_footer_email",
	"type" => "text",
	"std" => ""),
array( "name" => "Footer Phone Number",
	"desc" => "Enter Phone used in the footer. ",
	"id" => $shortname."_footer_phone",
	"type" => "text",
	"std" => ""),
array( "name" => "Footer Link",
	"desc" => "Enter Link for address in footer. ",
	"id" => $shortname."_footer_link",
	"type" => "text",
	"std" => ""),
array( "name" => "Google Analytics Code",
	"desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.",
	"id" => $shortname."_ga_code",
	"type" => "textarea",
	"std" => ""),	
	
	
	

 
array( "type" => "close")
 
);


function mytheme_add_admin() {
 
global $themename, $shortname, $options;
 if(!empty($_GET['page'])){
if ( $_GET['page'] == basename(__FILE__) ) {
 if(!empty($_REQUEST['action'])){
	if ( 'save' == $_REQUEST['action'] ) {
 
		foreach ($options as $value) {
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
 
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
 
	header("Location: admin.php?page=option.php&saved=true");
die;
 
} 
else if( 'reset' == $_REQUEST['action'] ) {
 
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
 
	header("Location: admin.php?page=option.php&reset=true");
die;
 
}
}
}
}
 
add_theme_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');
}

function curPageURL() {
 $pageURL = 'http';

 if ((!empty($_SERVER["HTTPS"])) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
function mytheme_add_init() {

$subs= get_site_url(); 
$scs = $subs.'/wp-admin/themes.php?page=option.php'; 
$scb = $subs.'/wp-admin/admin.php?page=option.php&saved=true';
$sdc =$subs.'/wp-admin/admin.php?page=option.php&reset=true';
//echo $scs; 

  $crturl = curPageURL();
//echo $crturl;

if($crturl == $scs )
{
$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("option", $file_dir."/theme_option/option/option.css", false, "1.0", "all");
wp_enqueue_script("rm_script", $file_dir."/theme_option/option/rm_script.js", false, "1.0");
wp_enqueue_style( 'thickbox' ); // Stylesheet used by Thickbox
     wp_enqueue_media();
        wp_register_script('theme_options', $file_dir . '/theme_option/option/theme_options.js', array('jquery'));
        wp_enqueue_script('theme_options');
}
if($crturl == $scb)
{
$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("option", $file_dir."/theme_option/option/option.css", false, "1.0", "all");
wp_enqueue_script("rm_script", $file_dir."/theme_option/option/rm_script.js", false, "1.0");

wp_enqueue_style( 'thickbox' ); // Stylesheet used by Thickbox
  wp_enqueue_media();
        wp_register_script('theme_options', $file_dir . '/theme_option/option/theme_options.js', array('jquery'));
        wp_enqueue_script('theme_options');}
if($crturl ==$sdc )
{
$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("option", $file_dir."/theme_option/option/option.css", false, "1.0", "all");
wp_enqueue_script("rm_script", $file_dir."/theme_option/option/rm_script.js", false, "1.0");
wp_enqueue_style( 'thickbox' ); // Stylesheet used by Thickbox
   wp_enqueue_media();
        wp_register_script('theme_options', $file_dir . '/theme_option/option/theme_options.js', array('jquery'));
        wp_enqueue_script('theme_options');
}
}

add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );
function mw_enqueue_color_picker() {
$file_dir=get_bloginfo('template_directory');
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', $file_dir . '/theme_option/option/my-script.js', array( 'wp-color-picker' ), false, true );
}
function mytheme_admin() {
 
global $themename, $shortname, $options;
$i=0;
 
if (!empty($_REQUEST['saved']) ) {echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';}
if (!empty($_REQUEST['reset']) ){ echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';}
 
?>
<div class="wrap rm_wrap">
<div class="icon32" id="icon-themes"><br></div>
<h2>Theme Option</h2>
 <br/>
<div class="rm_opts">

<form method="post">
<div class="top_save"><span class="submit"><input name="save<?php echo $i; ?>" type="submit" class="button-primary" value="Save changes" />
</span></div>
<div class="clear"></div>
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?>
 
<?php break;
 
case "close":
?>
 
</div>

<br />

 
<?php break;
 
case 'text':
?>

<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
<?php

break;
case 'upload':
?>
 <div class="rm_input rm_upload">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
    <div class="upload" style="float:left;">
 
        <input type='text' id='<?php echo $value['id']; ?>' class='regular-text text-upload_<?php echo $value['id']; ?>' name='<?php echo $value['id']; ?>' value='<?php echo esc_url(get_settings( $value['id'])); ?>'/>
    
        <input type='button' class='button button-upload' value='Upload an image' id="<?php echo $value['id']; ?>"/>
        <a id="<?php echo $value['id']; ?>" class='button hello' value='Delete image'>Delete</a>
        <br/>
        <span class="desc"><?php echo $value['desc']; ?></span>
        <?php if ( esc_url(get_settings( $value['id'])) == "") {
         ?>
         <style>.upload img{display:none;}</style>
			<?php  }?>
        <img id='<?php echo $value['id']; ?>' style='max-width: 250px;' src='<?php echo stripslashes(get_settings( $value['id'])); ?>' class='preview-upload  <?php if ( esc_url(get_settings( $value['id'])) == "") {
         echo "noimage";
         }
		 else{
			 echo "image";
			 }?>'/>
        <?php /*?> <?php if ( (get_option('we_logos')) != ""){ ?>
		 <?php }
		 ?><?php */?>
                
	 </div>
       
 <div class="clearfix"></div>
 
 </div>
<?php

break;
 
case 'textarea':
?>

<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
  
<?php
break;

case 'colorpicker':
?>

<div class="rm_input rm_color">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
   <input type="text" class="my-color-field" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>"/>
   
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
  
<?php
break;
 

 
case "section":

$i++;

?>

<div id="a_<?php echo $value['id']; ?>" class="rm_section">
<div class="rm_title"><h3><?php echo $value['name']; ?></h3><span class="img"></span><div class="clearfix"></div></div></div>
<div id="a_<?php echo $value['id']; ?>" class="rm_options">

 
<?php break;
 
}
}
?>
<div class="bottom_save"><span class="submit"><input name="save<?php echo $i; ?>" type="submit" class="button-primary" value="Save changes" />
</span></div> 
<input type="hidden" name="action" value="save" />
</form>
<form method="post">

<div class="reset_button"><span class="submit"><input name="reset" type="submit" class="button-primary" value="Reset" />
</span></div>

<input type="hidden" name="action" value="reset" />

</form>
 </div> 
 

<?php
}
   /*add_filter("attribute_escape", "myfunction", 10, 2);
function myfunction($safe_text, $text) {
    return str_replace("Insert into Post", "Use this image", $text);
}*/
?>
<?php

add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>
