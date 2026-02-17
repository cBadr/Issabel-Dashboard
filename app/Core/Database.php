<?php
namespace App\Core;

use PDO;
use PDOException;

// فئة الاتصال بقاعدة البيانات (Database Class)
// تستخدم نمط Singleton لضمان اتصال واحد

class Database {
    private $host = '65.75.201.81'; // تم تحديثه بناءً على طلب المستخدم
    private $user = 'root';
    private $pass = 'Medoza120a';
    private $dbname = 'asterisk';

    private $dbh;
    private $error;
    private static $instance = null;

    private function __construct() {
        // إعداد اتصال DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8';
        
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // محاولة الاتصال
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            // في حالة الفشل، يمكن تسجيل الخطأ ولكن سنكمل لغرض العرض التجريبي
            // echo "Connection Error: " . $this->error;
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->dbh;
    }
    
    // دالة لتنفيذ استعلام (Query Execution)
    public function query($sql) {
        if ($this->dbh) {
            return $this->dbh->query($sql);
        }
        return null;
    }
}
