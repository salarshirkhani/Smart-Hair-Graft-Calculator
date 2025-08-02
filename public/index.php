<?php

use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


$host   = "localhost";
$user   = "root";
$pass   = "";
$dbname = "hair_estimator";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

use Core\Router;

$router = new Router();

// نمایش فرم
$router->get('/', 'EstimatorController@form');

// API ها
$router->post('/step1', 'EstimatorController@handleStep1');
$router->post('/step2', 'EstimatorController@handleStep2');
$router->post('/step3', 'EstimatorController@handleStep3');
$router->post('/step4', 'EstimatorController@handleStep4');
$router->post('/step5', 'EstimatorController@handleStep5');
$router->get('/result/{user_id}', 'EstimatorController@apiResult');


$router->dispatch();
