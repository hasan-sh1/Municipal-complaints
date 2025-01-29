<!-- صفحة الاتصال بقاعدة البيانات -->
<?php
// محاولة الاتصال بقاعدة البيانات
try {
    // تعريف معلومات الاتصال بقاعدة البيانات
    $dsn = "mysql:host=localhost;dbname=complaints;charset=utf8mb4";
    $username = "root";
    $password = "";
    
    // إعدادات الاتصال بقاعدة البيانات
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // تفعيل وضع الأخطاء
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // تحديد نمط جلب البيانات
        PDO::ATTR_EMULATE_PREPARES => false, // تعطيل محاكاة الاستعلامات المجهزة
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4" // تحديد ترميز الاتصال
    ];

    // إنشاء اتصال جديد بقاعدة البيانات
    $conn = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    // في حالة فشل الاتصال، عرض رسالة الخطأ
    die("Connection failed: " . $e->getMessage());
}

// دالة لتوليد معرف فريد مكون من 20 حرف وأرقام عشوائية
function unique_id()
{
    // تحديد الأحرف والأرقام المسموح استخدامها
    $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $rand = array();
    $length = strlen($str) - 1;
    
    // توليد 20 حرف عشوائي
    for ($i = 0; $i < 20; $i++) {
        $n = mt_rand(0, $length);
        $rand[] = $str[$n];
    }
    
    // دمج الأحرف العشوائية في نص واحد
    return implode($rand);
}

?>