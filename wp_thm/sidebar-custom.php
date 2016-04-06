<?php
/**
 * The sidebar containing the secondary widget area, displays on posts and pages.
 *
 * If no active widgets in this sidebar, it will be hidden completely.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

$options = get_post_custom($post->ID);
global $options;
$sidebar_choice = $options['custom_sidebar'][0];
echo $sidebar_choice;
 
?>
<aside id="sidebar" class="floatleft">
     
    <ul class="widgets">

       <?php 
            dynamic_sidebar($sidebar_choice); ?>
     
    </ul>
 
</aside>