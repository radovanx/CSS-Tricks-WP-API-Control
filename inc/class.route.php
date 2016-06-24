<?php

/**
 * A class for registering network settings with the WP API on the control blog.
 *
 * @package WordPress
 * @subpackage CSS_Tricks_WP_API_Control
 * @since CSS_Tricks_WP_API_Control 1.0
 */

function css_tricks_wp_api_route_init() {
	new CSS_Tricks_WP_API_Control_Route;
}
add_action( 'plugins_loaded', 'css_tricks_wp_api_route_init' );

class CSS_Tricks_WP_API_Control_Route {

	public function __construct() {

		// Register a new rest route for our plugin.
		add_action( 'rest_api_init', array( $this, 'register' ) );

	}

	/**
	 * Register a new route with the WP API for getting network options from the control blog.
	 * 
	 * @return bool True on success, false on error.
	 */
	function register() {

		// A version namespace for making calls to our endpoint.
		$version = 'v1';

		$out = register_rest_route(

			// A namespace for our plugin.
			CSS_TRICKS_WP_API_CONTROL . '/' . $version,

			// The route for querying network settings.
			'/options/',

			// An array of args for config'ing our route.
			array(

				// Our route expects get requests.
				'methods' => 'GET',

				// Our route handles requests via this cb function.
				'callback' => array( $this, 'callback' ),

				// Our route handles some url variables.
				'args' => array(
					
					// A url variable for the user to specify a meta_key for the option he wishes to grab.
					'meta_key' => array(

						// There is no default.
						'default' => FALSE,

						// Sanizite the meta key.
						'sanitize_callback' => 'sanitize_key',
					
					),
				
				),

				// You must pass our permissions cb in order to use this route.
				'permission_callback' => array( $this, 'permission_callback' ),
			
			// End the array of args for register_rest_route().
			)
		
		// End register_rest_route().
		);

		return $out;

	}

	/**
	 * A permissions callback for register_rest_route.
	 * 
	 * @return bool Returns TRUE if the user can update core, else FALSE.
	 */
	function permission_callback() {

		return current_user_can( 'update_core' );
	
	}

	/**
	 * A callback function for register_rest_route.
	 * 
	 * @param  array $args An array of url variables that the user might enter.
	 * @return mixed Returns the value for a network setting.
	 */
	function callback( $args ) {
		
	 	// Grab the url vars.
		$args = $args -> get_params();

		// If there is no meta_key provided, bail.
		if( empty( $args['meta_key'] ) ) { return FALSE; }

		// Get the site option.
		$out = get_site_option( $args['meta_key'] );

		return $out;

	}

}