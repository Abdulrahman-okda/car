<?php
try {
    // استخدام متغيرات بيئة لتكوين الاتصال بقاعدة البيانات
    $db_host = 'localhost';
    $db_name = 'shop_db';
    $username = 'root';
    $password = '';

    // إنشاء اتصال PDO
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $username, $password);

    // تعيين خيارات PDO لعرض الأخطاء كاستثناءات
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // تعيين ترميز الحروف لقاعدة البيانات
    $conn->exec("SET NAMES 'utf8'");

    // استخدام تعليمات التحضير للتعامل مع الاستعلامات بأمان
    $stmt = $conn->prepare("SELECT * FROM users WHERE name = :name");
    $stmt->execute(['name' => $username]);

    // استرداد البيانات
    $row = $stmt->fetch();
    print_r($row);
} catch(PDOException $e) {
    // في حالة حدوث خطأ في الاتصال، يمكن التعامل معه هنا
    echo "خطأ في الاتصال بقاعدة البيانات: " . $e->getMessage();
    // يمكن إضافة إجراءات إضافية هنا مثل تسجيل الخطأ في ملف السجلات أو إرسال إشعار إلى المسؤول
    // يجب أن يتم التعامل مع الأخطاء بشكل آمن ومناسب حسب متطلبات التطبيق
}
?>
