<?php
// متحكم الصفحة الرئيسية (Home Controller)
// يدير عرض لوحة التحكم وتغيير اللغة والقوالب

class HomeController extends Controller {
    public function index() {
        // إدارة اللغة (الجلسة بدأت بالفعل في App.php)
        if (!isset($_SESSION['lang'])) {
            $_SESSION['lang'] = 'ar';
        }
        
        // تغيير اللغة إذا تم طلبه
        if (isset($_GET['lang'])) {
            $_SESSION['lang'] = $_GET['lang'];
        }
        
        $langCode = $_SESSION['lang'];
        $lang = require ROOT_PATH . "/resources/lang/{$langCode}.php";

        // إدارة القوالب
        $templatesDir = ROOT_PATH . '/public/templates/';
        $templates = array_filter(glob($templatesDir . '*'), 'is_dir');
        $templateNames = array_map('basename', $templates);

        // القالب الافتراضي
        $currentTemplate = isset($_SESSION['template']) ? $_SESSION['template'] : 'default';

        // تغيير القالب إذا تم طلبه
        if (isset($_POST['change_template'])) {
            $_SESSION['template'] = $_POST['template'];
            $currentTemplate = $_POST['template'];
        }

        // محاولة الاتصال بقاعدة البيانات لجلب بعض الإحصائيات (Mock Data if failed)
        // في بيئة حقيقية سنستخدم النماذج (Models)
        // مثال لاستخدام قاعدة البيانات:
        // $db = \App\Core\Database::getInstance();
        // $conn = $db->getConnection();
        // $activeCalls = $conn->query("SELECT count(*) FROM channels")->fetchColumn();
        
        $stats = [
            'active_calls' => 12, // يمكن استبدالها بـ $activeCalls
            'waiting_calls' => 5,
            'agents_online' => 8,
            'total_calls_today' => 150 // SELECT count(*) FROM cdr WHERE calldate > CURDATE()
        ];

        // تمرير البيانات للعرض
        $this->view('dashboard', [
            'lang' => $lang,
            'langCode' => $langCode,
            'stats' => $stats,
            'templates' => $templateNames,
            'currentTemplate' => $currentTemplate
        ]);
    }

    public function uploadTemplate() {
        // منطق رفع القالب (سيتم تنفيذه لاحقاً بشكل كامل)
        // هنا نقوم فقط بإنشاء المجلد
        if (isset($_FILES['template_zip'])) {
            // ... implementation
        }
        header('Location: index.php');
    }
}
