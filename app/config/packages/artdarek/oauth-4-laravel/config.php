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
		'Google' => array(
		    'client_id'     => '922581738738-ffdmggjnis4obeodsqd7k9i74vbq1iqc.apps.googleusercontent.com',
		    'client_secret' => 'TQblj3UBIkFhrP3-B6JMldim',
		    'scope'         => array('userinfo_email', 'userinfo_profile'),
		), 	

	)

);