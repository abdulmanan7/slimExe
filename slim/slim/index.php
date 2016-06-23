<?php
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim();

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */
const DEFAULT_URL = 'https://exercise-f7686.firebaseio.com/';
const DEFAULT_TOKEN = 'HFc6hXFuBOWTkfSXWP3SwdOaenx1';
const DEFAULT_PATH = 'project/exercise-f7686';
// GET route
$app->get(
	'/users',
	function () {
		echo "string";
		try {
			$ch = _getCurlHandler(DEFAULT_PATH . "/", 'GET', "");
			$return = curl_exec($ch);
		} catch (Exception $e) {
			$return = null;
		}
		print_r($return);
	}
);

// POST route
$app->post(
	'/addUser',
	function () {
		$data = array('userId' => 2, 'firstName' => "jon", "lastName" => "doe", "phone" => '32132131');
		return _writeData(DEFAULT_PATH . "/user", $data, 'POST', $options);
	}
);
$app->post(
	'/addOrder',
	function () {
		$data = array('userId' => 2, 'orderId' => "2", "orderStatus" => "1", "ordertotal" => '321');
		return _writeData(DEFAULT_PATH . "/order", $data, 'POST', $options);
	}
);
$app->post(
	'/orderStatusChange',
	function () {
		$data = array("orderStatus" => "2");
		return _writeData(DEFAULT_PATH . "/order/orderStatus", "2", 'PUT', $options);
	}
);

// DELETE route
$app->delete(
	'/delete',
	function () {
		try {
			$ch = _getCurlHandler($path, 'DELETE', $options);
			$return = curl_exec($ch);
		} catch (Exception $e) {
			$return = null;
		}
		return $return;
	}
);
/**
 * Returns with Initialized CURL Handler
 *
 * @param string $path Path
 * @param string $mode Mode
 * @param array $options Options
 *
 * @return resource Curl Handler
 */
function _getCurlHandler($path, $mode, $options = array()) {
	$url = _getJsonPath($path, $options);
	$ch = _curlHandler;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 3600);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3600);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $mode);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	return $ch;
}

function _writeData($path, $data, $method = 'PUT', $options = array()) {
	$jsonData = json_encode($data);
	$header = array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen($jsonData),
	);
	try {
		$ch = _getCurlHandler($path, $method, $options);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
		$return = curl_exec($ch);
	} catch (Exception $e) {
		$return = null;
	}
	return $return;
}
function _getJsonPath($path, $options = array()) {
	$options['auth'] = DEFAULT_TOKEN;
	$path = ltrim($path, '/');
	return DEFAULT_URL . $path . '.json?' . http_build_query($options);
}
/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();
