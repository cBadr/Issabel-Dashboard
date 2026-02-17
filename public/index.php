<?php
// نقطة الدخول الرئيسية للتطبيق (Entry Point)
// يتم توجيه جميع الطلبات هنا عبر ملف .htaccess

// تعريف المسار الجذري
define('ROOT_PATH', dirname(__DIR__));

// استدعاء ملف التهيئة الأساسي وتشغيل التطبيق
require_once ROOT_PATH . '/app/Core/App.php';

use App\Core\App;

// بدء التطبيق
$app = new App();
$app->run();
