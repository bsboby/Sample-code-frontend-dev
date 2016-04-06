<?php
/**
 * The template for displaying the footer

 */
?>
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-8 responsivetb">
        <ul class="ft-links">
          <li><?php echo stripslashes(get_option('we_footer_copy')); ?></li>
          <li>License <?php echo stripslashes(get_option('we_footer_license')); ?></li>
          <li><a href="<?php echo stripslashes(get_option('we_footer_link')); ?>"><?php echo stripslashes(get_option('we_footer_address')); ?></a></li>
          <li><a href="<?php echo stripslashes(get_option('we_footer_link')); ?>"><?php echo stripslashes(get_option('we_footer_address2')); ?></a></li>
          <li><a href="mailto:<?php echo stripslashes(get_option('we_footer_email')); ?>"><?php echo stripslashes(get_option('we_footer_email')); ?></a></li>
          <li><a href="tel:<?php echo stripslashes(get_option('we_footer_phone')); ?>"><?php echo stripslashes(get_option('we_footer_phone')); ?></a></li>
        </ul>
      </div>
      <div class="col-md-4 responsivetb">
        <div class="design-by clearfix">
        <p class="pull-left pj-ft"><?php echo stripslashes(get_option('we_footer_copy')); ?>  License <?php echo stripslashes(get_option('we_footer_license')); ?></p>
          
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- jQuery --> 
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js"></script> 
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.flexslider.js"></script>	
<script type="text/javascript">
   
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "fade",
		animationSpeed: 500,
		controlNav: false,           
		directionNav: false,
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>

<!-- Bootstrap Core JavaScript --> 
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script> 
<script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script> 

<!-- Script to Activate the Carousel --> 
<script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    });
	(function($){
$(document).ready(function() {
var get_title= $('.tab-pane h4').html();
$('#menu-button').html(get_title);
$(document).on("click","#password_submit",function(event){
var username =$('#post_username').val();
var password =$('#pwbox-197').val();
if(username==""){ $("input#post_username").addClass('needsfilled'); $('.passprourerror').removeClass('hide');}
if(password==""){$("input#pwbox-197").addClass('needsfilled') ;$('.passpropaserror').removeClass('hide');}
if ($(".protected-post-form :input").hasClass("needsfilled")) {return false;	}
else{return true;}

});
$(".protected-post-form :input").focus(function(){if ($(this).hasClass("needsfilled") ) {$(this).val("");$(this).removeClass("needsfilled");}});

});
})(jQuery);
window.addEventListener('load', detectOrientationMode, false);
function detectOrientationMode() {
  setTimeout(function() { window.scrollTo(0, 1); }, 10);
 var viewportWidth = window.innerWidth;
// alert(viewportWidth);
  if (viewportWidth > 414) {$('.page-banner321').removeClass('hide');$('.page-banner320').addClass('hide');}
  else { $('.page-banner320').removeClass('hide');$('.page-banner321').addClass('hide');}
}
//if (window.matchMedia("(orientation: portrait)").matches) {alert("you're in PORTRAIT mode");}
window.addEventListener('orientationchange', handleOrientation, false);
function handleOrientation() {
var viewportWidth = window.innerWidth;
if (viewportWidth <= 414) {
if (orientation == 0) {$('.page-banner320').removeClass('hide');$('.page-banner321').addClass('hide');}
else if (orientation == 90) {$('.page-banner321').removeClass('hide');$('.page-banner320').addClass('hide');}
else if (orientation == -90) {$('.page-banner321').removeClass('hide');$('.page-banner320').addClass('hide');}
else if (orientation == 180) {$('.page-banner320').removeClass('hide');$('.page-banner321').addClass('hide');}
}
}
$(window).resize(function() {
 if ($(window).width() > 414) {$('.page-banner321').removeClass('hide');$('.page-banner320').addClass('hide');}
  else { $('.page-banner320').removeClass('hide');$('.page-banner321').addClass('hide');}
});
    </script>
	
<script>
$(document).ready(function () {
    if(window.location.href.indexOf("bio-technology") > -1) {
       $('#menu-button').text('INDUSTRIES WE SERVE');
    }else if(window.location.href.indexOf("corporate") > -1) {
       $('#menu-button').text('INDUSTRIES WE SERVE');
    }else if(window.location.href.indexOf("higher-education") > -1) {
       $('#menu-button').text('INDUSTRIES WE SERVE');
    }else if(window.location.href.indexOf("hospitality") > -1) {
       $('#menu-button').text('INDUSTRIES WE SERVE');
    }else if(window.location.href.indexOf("healthcare") > -1) {
       $('#menu-button').text('INDUSTRIES WE SERVE');
    }else if(window.location.href.indexOf("restaurants-retail") > -1) {
       $('#menu-button').text('INDUSTRIES WE SERVE');
    }else if(window.location.href.indexOf("residential") > -1) {
       $('#menu-button').text('INDUSTRIES WE SERVE');
    }else if(window.location.href.indexOf("public-government") > -1) {
       $('#menu-button').text('INDUSTRIES WE SERVE');
    }
});
</script>
	<?php wp_footer(); ?>
 <?php echo stripslashes(get_option('we_ga_code')); ?>   
</body>
</html>
