<?php
// معلومات اتصال قاعدة البيانات
$servername = "localhost";   // عنوان الخادم
$username = "wessam";        // اسم المستخدم
$password = "/4_O6A2UiYXo-KC/"; // كلمة المرور
$dbname = "sales_store";     // اسم قاعدة البيانات

// إنشاء اتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من وجود أخطاء في الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
} else {
    echo "تم الاتصال بنجاح!<br>";
}

// يمكنك هنا إضافة أوامر أخرى للتعامل مع قاعدة البيانات

// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>
