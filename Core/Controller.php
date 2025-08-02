<?php
namespace Core;

class Controller {
    protected function render($view, $data = []) {
        // متغیرها رو در دسترس ویو قرار بده
        extract($data);

        // مسیر فایل ویو
        $viewFile = __DIR__ . "/../app/Views/$view.php";

        if (file_exists($viewFile)) {
            require_once __DIR__ . "/../app/Views/layouts/main.php";
        } else {
            echo "View not found: $view";
        }
    }
}
