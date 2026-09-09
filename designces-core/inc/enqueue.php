<?php
/**
 * Enqueue scripts and styles.
 *
 * @package Designces_Core
 */

function designces_core_enqueue_assets() {

	/**
	 * Custom Google Font: Source Sans Pro.
	 */
	wp_enqueue_style(
		'designces-core-source-sans-pro',
		'https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;0,700;1,600&display=swap',
		array(),
		null
	);

	/**
	 * Custom Google Font: Nunito.
	 */
	wp_enqueue_style(
		'designces-core-nunito',
		'https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap',
		array(),
		null
	);

	/**
	 * Bootstrap Icons.
	 */
	wp_enqueue_style(
		'designces-core-bootstrap-icons',
		get_template_directory_uri() . '/assets/icons/bootstrap-icons-1.13.1/bootstrap-icons.css',
		array(),
		'1.13.1'
	);

	/**
	 * Main stylesheet.
	 */
	wp_enqueue_style(
		'designces-core-main',
		get_template_directory_uri() . '/assets/css/main.css',
		array(
			'designces-core-source-sans-pro',
			'designces-core-nunito',
		),
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