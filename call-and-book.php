<?php 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
Plugin Name: Call&Book Mobile Bar
Plugin URI: http://www.massimosalerno.it
Description: Call&Book Mobile Bar is a plug-in that will help to improve conversion rates for responsive web sites. The main buttons normally used for contact, buy a service/product all in one: an easy and user friendly bar with call to action: call, send email, book.
Version: 1.2
Author: Massimo Salerno
Author URI: http://www.massimosalerno.it
 */



require_once( 'lib/class.php' );
$settings = new CallBook_Settings( __FILE__ );


/* Bottom bar html */

function cb_callbook_add_bar()
{  


	if (get_option('cb_callbook_love') == 'on'){
  	  echo '<div id="callbook" style="bottom:20px" class="mobile-call">';
  			echo '<a id="cb_call" class="actioncall" href="tel:'.get_option('cb_callbook_call_number').'">';
 					echo '<span style="padding:0 5px 0 0;" class="callbook-icona-telefono"></span>';
  					echo '<span class="callbook-align">'.get_option('cb_callbook_call_title').'</span>';
 			echo '</a>';
 			echo '<a id="cb_book" class="actionbook" target="_blank" href="'.get_option('cb_callbook_book_link').'">';
					echo '<span class="callbook-align">'.get_option('cb_callbook_book_title').'</span>';
  					echo '<span style="padding:0 0 0 5px;" class="'.get_option('cb_callbook_icon').'"></span>';
  			echo '</a>';
	  echo '<div class="callbook_logo">';
  			echo '<a id="cb_mail" class="icon" href="mailto:'.get_option('cb_callbook_mail_text').'">';
  				echo '<span class="callbook-icona-busta-lettera"></span>';
  			echo '</a>';
 	  echo '</div>';
  	  echo '<div class="callbook_under"></div>';
    echo '</div>';
  
  	echo'<div class="cb_powered"><a target="_blank" title="Massimo Salerno" alt="Webdesigner, webdeveloper e esperto wordpress" href="http://www.massimosalerno.it">Powered by Massimo Salerno</a></div>';
  }
  else {


  echo '<div id="callbook" class="mobile-call">';
  			echo '<a id="cb_call" class="actioncall" href="tel:'.get_option('cb_callbook_call_number').'">';
 					echo '<span style="padding:0 5px 0 0;" class="callbook-icona-telefono"></span>';
  					echo '<span class="callbook-align">'.get_option('cb_callbook_call_title').'</span>';
 			echo '</a>';
 			echo '<a id="cb_book" class="actionbook" target="_blank" href="'.get_option('cb_callbook_book_link').'">';
					echo '<span class="callbook-align">'.get_option('cb_callbook_book_title').'</span>';
  					echo '<span style="padding:0 0 0 5px;" class="'.get_option('cb_callbook_icon').'"></span>';
  			echo '</a>';
	  echo '<div class="callbook_logo">';
  			echo '<a id="cb_mail" class="icon" href="mailto:'.get_option('cb_callbook_mail_text').'">';
  				echo '<span class="callbook-icona-busta-lettera"></span>';
  			echo '</a>';
 	  echo '</div>';
  	  echo '<div class="callbook_under"></div>';
  echo '</div>';
  
  }
}

add_action('wp_head', 'cb_callbook_add_bar');

load_plugin_textdomain( 'call_book', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );



	/* DYNAMIC CSS */

	add_action('wp_head', 'dynamic_css');
	
	function dynamic_css()
	{

	  $text_hover = get_option('cb_callbook_color_text_hover');
	  $mail_icon_hover = get_option('cb_callbook_mail_icon_hover');
	  $color_bg = get_option('cb_callbook_color_bg');
	  $color_text = get_option('cb_callbook_color_text');
	  $icon_size = get_option('cb_callbook_icon_size');
	  $font_size = get_option('cb_callbook_font_size');
	  $mail_icon_color = get_option('cb_callbook_mail_icon_color');
	  $color_mail_bg = get_option('cb_callbook_color_mail_bg');
	 $font_name = get_option('cb_callbook_font_name');
	?>
	
	   

		<style type="text/css"> #callbook > a:hover,a:hover.icon {color: <?php
		echo $text_hover?> !important; text-decoration:none; }
		span.callbook-icona-busta-lettera:hover { color:<?php echo
		$mail_icon_hover ?> !important; } #callbook{ background:<?php echo
		$color_bg ?>; } a.actioncall, a.actionbook, a.icon{ color:<?php echo $color_text ?>; }
		span.callbook-icona-telefono, span.callbook-icona-calendario,span.callbook-icona-offerte,
		span.callbook-icona-acquista,span.callbook-icona-mappa-localita,span.callbook-icona-gallery,span.callbook-icona-info{
		font-size:<?php echo $icon_size ?>; }span.callbook-align{ font-size:<?php echo $font_size ?>; }
		span.callbook-icona-busta-lettera { color:<?php echo $mail_icon_color
		?>; }.callbook_under{ background:<?php echo $color_mail_bg ?>;
		!important; } .cb_powered a:hover{color:<?php
		echo $text_hover?>;} #callbook > a > span.callbook-align, .cb_powered a {font-family:<?php echo $font_name
		?>}</style>
	<?php
	}
	


/**
 * REGISTER STYLE
 */
function callbook_scripts() {
	wp_register_style('cb_callbook-style', WP_PLUGIN_URL . '/callbook-mobile-bar/assets/css/style.css');
	wp_register_style('headers_font', 'http://fonts.googleapis.com/css?family='. urlencode(get_option('cb_callbook_font_name')).'', false, null);
	wp_enqueue_style('cb_callbook-style');
	wp_enqueue_style('headers_font');

}

add_action( 'wp_enqueue_scripts', 'callbook_scripts' );



// REGISTER GOOGLE ANALYTICS SCRIPT
	add_action('init', 'register_my_script');
	add_action('wp_head', 'print_my_script');
		
	function register_my_script() {
		wp_register_script('ana-track', WP_PLUGIN_URL . '/callbook-mobile-bar/assets/js/ana-track.js', array('jquery'), '1.0', true);
	}

	function print_my_script() {
		wp_print_scripts('ana-track');	
	}


?>