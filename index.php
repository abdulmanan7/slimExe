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

// GET route
$app->get(
    '/',
    function () {
        
        echo __DIR__ . '/firebase-php/src/firebaseLib.php';
    }
);
$app->get(
    '/firebase',
    function () {
       require_once __DIR__ . "../firebase-php/src/firebaseLib.php";
        $DEFAULT_URL = 'https://exercise-f7686.firebaseio.com/';
        $DEFAULT_TOKEN = 'MqL0c8tKCtheLSYcygYNtGhU8Z2hULOFs9OKPdEp';
        $DEFAULT_PATH = 'project/exercise-f7686/';
       $firebase = new FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);

// --- storing an array ---
$user = array(
    "userId" => "1",
    "firstName" => "Jany",
    "lastName" => "Doe",
    "email" => "Doe",
    "phone" => "0145210121"
);
$dateTime = new DateTime();
$firebase->set($DEFAULT_PATH . '/data/user' . $dateTime->format('c'), $test);
echo "Request has been send and save";
$user = array(
    "userId" => "1",
    "orderId" => "1",
    "orderTotal" => "10",
    "orderDate" => date('Y-m-d'),
    "orderStatus" => 1
);
echo "Starting saving order now ....";
$dateTime = new DateTime();
$firebase->set($DEFAULT_PATH . '/data/order' . $dateTime->format('c'), $test);
    }
);

// POST route
$app->post(
    '/post',
    function () {
        echo 'This is a POST route';
    }
);

// PUT route
$app->put(
    '/put',
    function () {
        echo 'This is a PUT route';
    }
);

// PATCH route
$app->patch('/patch', function () {
    echo 'This is a PATCH route';
});

// DELETE route
$app->delete(
    '/delete',
    function () {
        echo 'This is a DELETE route';
    }
);


/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();