<?php
/*
Plugin Name: Headway Views
Plugin URI: http://wp-types.com/documentation/views-inside/headway-views/
Description: Views Block for Headway 3.0. Integrating the Views plugin for creating custom Headway blocks listing your data in various ways. 
Version: 1.0
Author: OnTheGoSystems
Author URI: http://wp-types.com
License: GNU GPL v2
*/

define('VIEWS_BLOCK_VERSION', '1.0');

/**
 * Everything is ran at the after_setup_theme action to insure that all of Headway's classes and functions are loaded.
 **/
add_action('after_setup_theme', 'views_block_register');
function views_block_register() {

	/* Make sure that Headway is activated, otherwise don't register the block because errors will be thrown. */
	if ( !class_exists('Headway') )
		return;

	require_once 'block.php';
	require_once 'block-options.php';

	/**
	 * @param Class name in block.php.  
	 * @param Path to the folder that contains the block icons.  In this Views block it's this plugin's folder.
	 **/
	return headway_register_block('HeadwayViewsBlock', plugins_url(false, __FILE__));
}


/**
 * If you plan on adding your block to Headway Extend, then this will be the code that will enable auto-updates for the block/plugin.
 **/
add_action('init', 'views_block_extend_updater');
function views_block_extend_updater() {

	if ( !class_exists('HeadwayUpdaterAPI') )
		return;

	$updater = new HeadwayUpdaterAPI(array(
		'slug' => 'views-block',
		'path' => plugin_basename(__FILE__),
		'name' => 'Views Block',
		'type' => 'block',
		'current_version' => VIEWS_BLOCK_VERSION
	));

}