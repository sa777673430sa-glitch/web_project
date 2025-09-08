<?php
// ابدأ الجلسة
session_start();

// قم بتضمين ملف الاتصال بقاعدة البيانات
require 'db.php'; // تأكد من أن هذا الملف يحتوي على $conn

// تحقق من أن الطلب من نوع POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // جلب وتصفية البيانات المرسلة من النموذج
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $level = filter_input(INPUT_POST, 'level', FILTER_SANITIZE_NUMBER_INT);
    $mojar_id = filter_input(INPUT_POST, 'major_id', FILTER_SANITIZE_NUMBER_INT);
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// die(); // توق
//     // تحقق من أن البيانات الأساسية موجودة وصالحة
    if ($user_id && $name  && $phone  && $password && $role && $status ) {
        
        // إعداد استعلام التحديث الآمن
        $sql = "UPDATE users SET name=?, phone=?,password=?, role=?,level =?, major_id =?,  status=? WHERE id=?";
        
        // تهيئة الاستعلام
        $stmt = $conn->prepare($sql);
        
        // ربط القيم بالاستعلام (sssi: 4 strings, 1 integer)
        $stmt->bind_param("ssssiiii", $name, $phone,$password,$level,$mojar_id, $role, $status, $user_id);
        
        // تنفيذ الاستعلام
        if ($stmt->execute()) {
            $_SESSION['message'] = "تم تحديث بيانات المستخدم بنجاح!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "حدث خطأ أثناء تحديث البيانات: " . $stmt->error;
            $_SESSION['message_type'] = "error";
        }
        
        $stmt->close();
    } else {
        $_SESSION['message'] = "بيانات غير صالحة.";
        $_SESSION['message_type'] = "error";
    }

    $conn->close();
    
    // إعادة التوجيه إلى الصفحة الرئيسية
    header("Location: manager.php");
    exit();
}