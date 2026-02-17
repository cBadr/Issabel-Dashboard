<?php
namespace App\Core;

// الفئة الأساسية للتطبيق (Core Application Class)
// مسؤولة عن التوجيه (Routing) وتحميل المتحكمات (Controllers)

class App {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        // بدء الجلسة إذا لم تكن قد بدأت
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // تفكيك الرابط URL
        $url = $this->parseUrl();

        // تحميل الفئة الأساسية للمتحكم
        require_once ROOT_PATH . '/app/Core/Controller.php';

        // التحقق من وجود ملف المتحكم
        if (file_exists(ROOT_PATH . '/app/Controllers/' . ucfirst($url[0] ?? '') . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }

        require_once ROOT_PATH . '/app/Controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // التحقق من الطريقة (Method)
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // تمرير المعلمات المتبقية
        $this->params = $url ? array_values($url) : [];
    }

    public function run() {
        // استدعاء الطريقة مع المعلمات
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    protected function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
