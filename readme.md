- Place PHP's Braintree folder under App/Vendor
- Place BraintreeComponent.php inside App/Controller/Component
- Initialize your environment and define your keys inside core.php

### INITIALIZE CORE VARIABLES
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

### HTML/CTP LAYOUT
Here is how your payment form view will look like. Please pay attention to the data attribute: ```data-braintree-name```
```sh
<?php echo $this->Form->create('Checkout', array('id' => 'checkout-form'));?>
  	<div class="form-group">
  		<?php
		  	echo $this->Form->input('amount', array(
		  		'class'=>'form-control',
		  		'value' => ltrim($amount, '0'),
		  		'disabled'
		  		)
		  	);
  		?>
  	</div>
  	<div class="form-group">
	  	<?php
		  	echo $this->Form->input('card_number', array(
		  		'class'=>'form-control',
		  		'label'=> 'Card Number *',
		  		'data-braintree-name' => 'number',
		  		'required'
		  		)
		  	);
	  	?>
  	</div>
  	<div class="form-group">
	  	<?php
		  	echo $this->Form->input('exp_date', array(
		  		'class'=>'form-control',
		  		'label'=> 'Expiration Date (MM/YY)*',
		  		'data-braintree-name' => 'expiration_date',
		  		'maxlength' => '5',
		  		'required'
		  		)
		  	);
	  	?>
  	</div>
  	<div class="form-group">
	  	<?php
		  	echo $this->Form->input('cvv', array(
		  		'class'=>'form-control',
		  		'label'=>"CVV *",
		  		'data-braintree-name' => 'cvv',
		  		'maxlength' => '4',
		  		'required'
		  		)
		  	);
	  	?>
  	</div>
  	<div class="form-group">
	  	<?php
		  	echo $this->Form->submit('Confirm Payment', array(
		  		'class' => 'admin-btn'
		  		)
		  	);
	  	?>
  	</div>
<?php echo $this->Form->end();?>
```
### JAVASCRIPT
Make sure you add the JS library on the page/layout where you wish to integrate the Braintree Payment.
```sh
$this->Html->script('..path-to-your-js/braintree-2.31.0.min');
```

```sh
if($("#checkout-form").length) {
	$.get('/userWallets/generateClientToken', function(data) {
		braintree.setup(
			data,
			"custom", {
				id : "checkout-form"
		});
	});
}

```

### Todo
- Response messages for all sandbox test amounts

Feel free to contribute, and generate a pull request for bug fix/enhancement.
