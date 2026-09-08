<?php
/**
 * Enqueue scripts and styles.
 *
 * @package Designces_Core
 */

function designces_core_enqueue_assets() {

	/**
	 * Main stylesheet.
	 */
	wp_enqueue_style(
		'designces-core-main',
		get_template_directory_uri() . '/assets/css/main.css',
		array(),
		filemtime( get_template_directory() . '/assets/css/main.css' )
	);

	/**
	 * Navigation script.
	 */
	wp_enqueue_script(
		'designces-core-navigation',
		get_template_directory_uri() . '/js/navigation.js',
		array(),
		_S_VERSION,
		true
	);

	/**
	 * Comment reply script.
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'designces_core_enqueue_assets' );