- Place PHP's Braintree folder under App/Vendor
- Place BraintreeComponent.php inside App/Controller/Component
- Initialize your environment and define your keys inside core.php


```sh
Configure::write('APP_ENV', 'local'); //options: production, local

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
```