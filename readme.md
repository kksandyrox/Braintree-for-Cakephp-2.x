1) Place PHP's Braintree folder under  App/Vendor
2) Place BraintreeComponent.php inside 	App/Controller/Component

3) Initialize your environment and define your keys inside core.php

Configure::write('APP_ENV', 'local'); //options: production, development

Configure::write(array(
	'environments' => array(
		'local' => array(
			'environment' => 'sandbox',
			'merchantId' => 'd5dr58d9hjxmcmm9',
			'publicKey' => 'pxwgwxd67g7q22by',
			'privateKey' => '719beb6ef0c3fdb5811450471dc5132a'
			),
		'production' => array(
			'environment' => 'production',
			'merchantId' => 'aaaaaaaaaaaaaa',
			'publicKey' => 'aaaaaaaaaaa',
			'privateKey' => 'aaaaaaaaaa'
			)
		)
	)
);
