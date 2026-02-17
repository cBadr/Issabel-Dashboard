<?php
// الفئة الأساسية للمتحكم (Base Controller)
// تحتوي على دوال مساعدة لتحميل العروض (Views) والنماذج (Models)

class Controller {
    // دالة لعرض الصفحة (Render View)
    public function view($view, $data = []) {
        // استخراج البيانات لتصبح متغيرات
        extract($data);
        
        // التحقق من ملف العرض
        if (file_exists(ROOT_PATH . '/resources/views/' . $view . '.php')) {
            require_once ROOT_PATH . '/resources/views/' . $view . '.php';
        } else {
            die("View does not exist: " . $view);
        }
    }

    // دالة لتحميل النموذج (Load Model)
    public function model($model) {
        require_once ROOT_PATH . '/app/Models/' . $model . '.php';
        return new $model();
    }
    
    // دالة للترجمة (Translation Helper)
    public function trans($key) {
        // سيتم تنفيذ منطق الترجمة هنا لاحقاً
        return $key;
    }
}
