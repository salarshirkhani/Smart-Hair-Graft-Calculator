<?php
namespace Core;

class Router {
    private $routes = ['GET' => [], 'POST' => []];

    // ثبت مسیر GET
    public function get($path, $action) {
        $this->routes['GET'][$path] = $action;
    }

    // ثبت مسیر POST
    public function post($path, $action) {
        $this->routes['POST'][$path] = $action;
    }


    // پردازش درخواست
    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];      // GET یا POST
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // مسیر URL

        // مسیر بدون اسلش آخر
        $uri = rtrim($uri, '/');
        
        if ($uri === '') $uri = '/';
        // اگر روت ثبت شده باشه
        $action = $this->routes[$method][$uri] ?? null;

        if (!$action) {
            http_response_code(404);
            echo "404 Not Found";
            exit;
        }

        // مثال: 'EstimatorController@step1'
        list($controller, $methodName) = explode('@', $action);

        // مسیر فایل کنترلر
        $controllerClass = "App\\Controllers\\$controller";

        // ساخت شی کنترلر و صدا زدن متد
        $controllerObj = new $controllerClass();
        call_user_func([$controllerObj, $methodName]);
    }
}
