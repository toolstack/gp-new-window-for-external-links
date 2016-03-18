<?php
/*
Plugin Name: GP New Window for External Links
Plugin URI: http://glot-o-matic.com/gp-new-window-for-external-links
Description: Open a new window any time an external link is selected in GlotPress.
Version: 1.0
Author: Greg Ross
Author URI: http://toolstack.com
Tags: glotpress, glotpress plugin 
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

class GP_New_Window_for_External_Links {
	public $id = 'new-window-for-external-links';

	public function __construct() {
		wp_register_script( 'new-window-for-external-links', plugins_url( 'new-window-for-external-links.js', __FILE__ ), array( 'jquery' ) );
		
		add_action( 'gp_pre_tmpl_load', array( $this, 'gp_pre_tmpl_load'), 10, 2 );
	}

	public function gp_pre_tmpl_load( $template, $args ) {

		$url = gp_url_public_root();

		if ( is_ssl() ) {
			$url = gp_url_ssl( $url );
		}

		gp_enqueue_script( 'new-window-for-external-links' );

	}

}

// Add an action to WordPress's init hook to setup the plugin.  Don't just setup the plugin here as the GlotPress plugin may not have loaded yet.
add_action( 'gp_init', 'gp_new_window_for_external_links_init' );

// This function creates the plugin.
function gp_new_window_for_external_links_init() {
	GLOBAL $gp_new_window_for_external_links;
	
	$gp_new_window_for_external_links = new GP_New_Window_for_External_Links;
}
