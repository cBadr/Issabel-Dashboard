<?php
// متحكم إدارة القوالب (Template Controller)
// مسؤول عن رفع وحذف وتفعيل القوالب

class TemplateController extends Controller {
    
    // عرض صفحة إدارة القوالب
    public function index() {
        // session_start() handled in App.php
        $langCode = $_SESSION['lang'] ?? 'ar';
        $lang = require ROOT_PATH . "/resources/lang/{$langCode}.php";
        
        $templatesDir = ROOT_PATH . '/public/templates/';
        $templates = array_filter(glob($templatesDir . '*'), 'is_dir');
        $templateList = [];
        
        foreach ($templates as $dir) {
            $name = basename($dir);
            $templateList[] = [
                'name' => $name,
                'path' => $dir,
                'active' => (isset($_SESSION['template']) && $_SESSION['template'] == $name) || (!isset($_SESSION['template']) && $name == 'default')
            ];
        }

        $this->view('templates', ['lang' => $lang, 'templates' => $templateList]);
    }

    // تفعيل قالب
    public function activate($name) {
        // session_start() handled in App.php
        if (is_dir(ROOT_PATH . '/public/templates/' . $name)) {
            $_SESSION['template'] = $name;
        }
        header('Location: index.php?url=template/index');
    }

    // حذف قالب
    public function delete($name) {
        if ($name == 'default') {
            // لا يمكن حذف القالب الافتراضي
            header('Location: index.php?url=template/index');
            return;
        }

        $dir = ROOT_PATH . '/public/templates/' . $name;
        if (is_dir($dir)) {
            $this->deleteDir($dir);
        }
        header('Location: index.php?url=template/index');
    }

    // رفع قالب جديد
    public function upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['template_zip'])) {
            $file = $_FILES['template_zip'];
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            
            if ($ext === 'zip') {
                $zip = new \ZipArchive;
                if ($zip->open($file['tmp_name']) === TRUE) {
                    $templateName = pathinfo($file['name'], PATHINFO_FILENAME);
                    $targetPath = ROOT_PATH . '/public/templates/' . $templateName;
                    
                    if (!is_dir($targetPath)) {
                        mkdir($targetPath);
                    }
                    
                    $zip->extractTo($targetPath);
                    $zip->close();
                }
            }
        }
        header('Location: index.php?url=template/index');
    }

    // دالة مساعدة لحذف المجلدات
    private function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            return; // ليس مجلداً
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                $this->deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
}
