<?php

require_once App::path('Vendor')[0].'Braintree/lib/Braintree.php';

class BraintreeComponent extends Component {

	private $environment = '';
	private $merchantId = '';
	private $publicKey = '';
	private $privateKey = '';

	public function __construct() {
		$this->initializeCredentials();
	}

	public function initializeCredentials() {
		$env = $this->getEnvironment();
		$envVars = Configure::read('environments')[$env];
		$this->environment = $envVars['environment'];
		$this->merchantId = $envVars['merchantId'];
		$this->publicKey = $envVars['publicKey'];
		$this->privateKey = $envVars['privateKey'];

		Braintree_Configuration::environment($this->environment);
		Braintree_Configuration::merchantId($this->merchantId);
		Braintree_Configuration::publicKey($this->publicKey);
		Braintree_Configuration::privateKey($this->privateKey);
	}

	public function getEnvironment() {
		return Configure::read('APP_ENV');
	}

	public function generateClientToken() {
		$clientToken = Braintree_ClientToken::generate();
		return $clientToken;
	}

	public function makeTransaction($amount, $nonce) {
		$result = Braintree_Transaction::sale([
			'amount' => $amount,
			'paymentMethodNonce' => $nonce,
		]);

		$response = $this->parseTransactionResponse($result);
		return $response;
	}

	public function parseTransactionResponse($response) {
		$status = $response->success;
		$finalObject = array();
		if($status) {
			$finalObject = $this->buildSuccessfulResponse($response);
		}
		else {
			$finalObject = $this->buildFailedResponse($response);
		}
		return $finalObject;
	}

	public function buildSuccessfulResponse($response) {
		$successObject = array();
		$successObject['status'] = $response->success;
		$successObject['message'] = array();
		$successObject['response'] = array('transaction_id' => $response->transaction->id, 'amount' => $response->transaction->amount);
		return $successObject;
	}

	public function buildFailedResponse($response) {
		$failedObject = array();
		$failedObject['status'] = $response->success ? $response->success : 0;
		$failedObject['message'] = array();
		foreach ($response->errors->deepAll() AS $error) {
			array_push($failedObject['message'], $error->message);
		}
		$failedObject['message'] = implode(' ', $failedObject['message']);
		$failedObject['response'] = array();
		return $failedObject;
	}
}
