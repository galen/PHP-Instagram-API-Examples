<?php

define( 'GITHUB_URL',			'https://github.com/galen/PHP-Instagram-API/blob/master/Examples/' );

// Turn on error reporting
error_reporting( E_ALL );
ini_set( 'display_errors', 'On' );

// Start the session
session_start();

require( 'system/vendor/autoload.php' );

// Start authorization if an access token session isnt present
if ( !isset( $_SESSION['instagram_access_token'] ) ) {
	require( 'system/config.php' );
	$auth_config = array(
	    'client_id'         => CLIENT_ID,
	    'client_secret'     => CLIENT_SECRET,
	    'redirect_uri'      => REDIRECT_URI,
	    'scope'             => array( 'likes', 'comments', 'relationships' )
	);
	require( 'system/examples/_auth.php' );
	exit;
}

// If an example has been chosen, include it and exit
if ( isset( $_GET['example'] ) ) {
	try {
		date_default_timezone_set('America/Los_Angeles');
		require( 'system/examples/' . $_GET['example'] );
		exit;
	}
	catch ( \Instagram\Core\ApiException $e ) {
		$error = ucwords( $e->getMessage() );
		require( 'system/examples/views/_header.php' );
		require( 'system/examples/views/_error.php' );
		require( 'system/examples/views/_footer.php' );
		exit;
	}
}

// Get all the examples for display
$files = glob( 'system/examples/*.php' );

// Unset index file
unset( $files[array_search( 'system/examples/index.php', $files )] );

require( 'system/examples/views/_header.php' );
require( 'system/examples/views/index.php' );
require( 'system/examples/views/_footer.php' );