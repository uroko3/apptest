<?php

return [
	'base_url' => env('GITLAB_BASE_URL'),
	
	// Application ID(client_id)
	'app_id' => '35a5b4fae1943ff7b2e18bf03874d7471cefc873e21259d982d7b732d0c618c9',
	
	// Secret
	'secret' => 'gloas-21f64bab33b90cb7cd9c9e6a962fdbd640f220578f4a45e7908aecddfc54ba82',
	
	// Callback URL(REDIRECT URL)
	'callback_url' => env('APP_URL') . '/gitlab/oauth',
];