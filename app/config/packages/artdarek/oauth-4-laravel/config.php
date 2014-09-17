<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Facebook
		 */
        'Facebook' => array(
            'client_id'     => '1497689920490189',
            'client_secret' => '58a06ac828e94c86708c1a558fae461b',
            'scope'         => array('email','read_friendlists','user_online_presence'),
        ),		

	)

);