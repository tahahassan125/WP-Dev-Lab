<?php
/**
 * Enqueue scripts and styles.
 *
 * @package Designces_Core
 */

function designces_core_enqueue_assets() {

	/**
	 * Custom Google Fonts.
	 *
	 * Source Sans Pro + Nunito
	 */
	wp_enqueue_style(
		'designces-core-fonts',
		'https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Source+Sans+Pro:ital,wght@0,400;0,700;1,600&display=swap',
		array(),
		null
	);

	/**
	 * Main stylesheet.
	 */
	wp_enqueue_style(
		'designces-core-main',
		get_template_directory_uri() . '/assets/css/main.css',
		array( 'designces-core-fonts' ),
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