<?php
$servername = "127.0.0.1"; // عنوان الخادم
$username = "wessam"; // اسم المستخدم للاتصال بقاعدة البيانات
$password = "/4_O6A2UiYXo-KC/"; // كلمة المرور للاتصال بقاعدة البيانات
$dbname = "sales_store"; // اسم قاعدة البيانات التي ترغب في الاتصال بها

// إنشاء اتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من وجود أخطاء في الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}
?>
