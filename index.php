<?php
session_start();                        // 1) بدء الجلسة
require 'db.php';                       // 2) تضمين ملف الاتصال بقاعدة البيانات

if ($_SERVER["REQUEST_METHOD"] === "POST") {   // 3) التأكد أن الطلب جاء عبر POST
    $username = trim($_POST['username']);      // 4) التقاط اسم المستخدم مع إزالة الفراغات
    $password = trim($_POST['password']);      // 5) التقاط كلمة المرور مع إزالة الفراغات

    // 6) تجهيز استعلام مُحضَّر للبحث عن المستخدم بالاسم (يمكن تغييره للهاتف)
    $stmt = $conn->prepare("SELECT id, name, role, phone, password FROM users WHERE name = ? LIMIT 1");
                   // 15) المستخدم العادي -> لوحة المستخدم

    $stmt->bind_param("s", $username);         // 7) ربط قيمة الاسم مكان علامة الاستفهام كـ string
    $stmt->execute();                          // 8) تنفيذ الاستعلام
    $res = $stmt->get_result();                // 9) جلب نتيجة التنفيذ كـ mysqli_result

    if ($user = $res->fetch_assoc()) {         // 10) إذا تم إيجاد صف واحد للمستخدم
        if ($password === $user['password']) { // 11) مقارنة كلمة المرور (نص عادي بدون تشفير ❗)
            // 12) حفظ بيانات الجلسة (تسجيل الدخول)
            $_SESSION['id']   = (int)$user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            // 13) توجيه المستخدم حسب الدور
            if ($user['role'] === 'admain') {
                header("Location: manager.php"); 
                // 14) المدير -> الصفحة الرئيسية
            } else if($user['role'] === 'teacher') {
                header("Location: teacher.php");// 15) المستخدم العادي -> لوحة المستخدم
            }
            else{
                header("Location: student.php");// 15) المستخدم العادي -> لوحة المستخدم
              
            }
            exit;                                     // 16) إيقاف التنفيذ بعد التوجيه

        } else {
            $error = "❌ كلمة المرور غير صحيحة";      // 17) كلمة المرور خطأ
        }
    } else {
        $error = "❌ اسم المستخدم غير موجود";        // 18) لا يوجد مستخدم بهذا الاسم
    }
}
?>



<!DOCTYPE html>
<html><head>
<meta charset="utf-8"/>
<link crossorigin="" href="https://fonts.gstatic.com/" rel="preconnect"/>
<link as="style" href="https://fonts.googleapis.com/css2?display=swap&amp;family=Noto+Sans+Arabic:wght@400;500;700;900&amp;family=Plus+Jakarta+Sans:wght@400;500;700;800" onload="this.rel='stylesheet'" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<title>Stitch Design</title>
<link href="data:image/x-icon;base64," rel="icon" type="image/x-icon"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<style type="text/tailwindcss">
      :root {
        --primary-color: #141414;
      }
      body {
        font-family: 'Noto Sans Arabic', 'Plus Jakarta Sans', sans-serif;
      }
    </style>
</head>
<body dir="rtl">
<div class="relative flex size-full min-h-screen flex-col bg-slate-50 group/design-root overflow-x-hidden">
<div class="flex-1 flex items-center justify-center p-4">
<div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 space-y-6">
<div class="text-center space-y-2">
<svg class="mx-auto h-12 w-auto text-[var(--primary-color)]" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_6_543)">
<path d="M42.1739 20.1739L27.8261 5.82609C29.1366 7.13663 28.3989 10.1876 26.2002 13.7654C24.8538 15.9564 22.9595 18.3449 20.6522 20.6522C18.3449 22.9595 15.9564 24.8538 13.7654 26.2002C10.1876 28.3989 7.13663 29.1366 5.82609 27.8261L20.1739 42.1739C21.4845 43.4845 24.5355 42.7467 28.1133 40.548C30.3042 39.2016 32.6927 37.3073 35 35C37.3073 32.6927 39.2016 30.3042 40.548 28.1133C42.7467 24.5355 43.4845 21.4845 42.1739 20.1739Z" fill="currentColor"></path>
<path clip-rule="evenodd" d="M7.24189 26.4066C7.31369 26.4411 7.64204 26.5637 8.52504 26.3738C9.59462 26.1438 11.0343 25.5311 12.7183 24.4963C14.7583 23.2426 17.0256 21.4503 19.238 19.238C21.4503 17.0256 23.2426 14.7583 24.4963 12.7183C25.5311 11.0343 26.1438 9.59463 26.3738 8.52504C26.5637 7.64204 26.4411 7.31369 26.4066 7.24189C26.345 7.21246 26.143 7.14535 25.6664 7.1918C24.9745 7.25925 23.9954 7.5498 22.7699 8.14278C20.3369 9.32007 17.3369 11.4915 14.4142 14.4142C11.4915 17.3369 9.32007 20.3369 8.14278 22.7699C7.5498 23.9954 7.25925 24.9745 7.1918 25.6664C7.14534 26.143 7.21246 26.345 7.24189 26.4066ZM29.9001 10.7285C29.4519 12.0322 28.7617 13.4172 27.9042 14.8126C26.465 17.1544 24.4686 19.6641 22.0664 22.0664C19.6641 24.4686 17.1544 26.465 14.8126 27.9042C13.4172 28.7617 12.0322 29.4519 10.7285 29.9001L21.5754 40.747C21.6001 40.7606 21.8995 40.931 22.8729 40.7217C23.9424 40.4916 25.3821 39.879 27.0661 38.8441C29.1062 37.5904 31.3734 35.7982 33.5858 33.5858C35.7982 31.3734 37.5904 29.1062 38.8441 27.0661C39.879 25.3821 40.4916 23.9425 40.7216 22.8729C40.931 21.8995 40.7606 21.6001 40.747 21.5754L29.9001 10.7285ZM29.2403 4.41187L43.5881 18.7597C44.9757 20.1473 44.9743 22.1235 44.6322 23.7139C44.2714 25.3919 43.4158 27.2666 42.252 29.1604C40.8128 31.5022 38.8165 34.012 36.4142 36.4142C34.012 38.8165 31.5022 40.8128 29.1604 42.252C27.2666 43.4158 25.3919 44.2714 23.7139 44.6322C22.1235 44.9743 20.1473 44.9757 18.7597 43.5881L4.41187 29.2403C3.29027 28.1187 3.08209 26.5973 3.21067 25.2783C3.34099 23.9415 3.8369 22.4852 4.54214 21.0277C5.96129 18.0948 8.43335 14.7382 11.5858 11.5858C14.7382 8.43335 18.0948 5.9613 21.0277 4.54214C22.4852 3.8369 23.9415 3.34099 25.2783 3.21067C26.5973 3.08209 28.1187 3.29028 29.2403 4.41187Z" fill="currentColor" fill-rule="evenodd"></path>
</g>
<defs>
<clipPath id="clip0_6_543"><rect fill="white" height="48" width="48"></rect></clipPath>
</defs>
</svg>
<h1 class="text-3xl font-bold text-gray-900">تسجيل الدخول إلى LearnHub</h1>
<p class="text-gray-500">أهلاً بك في منصة بلاك بورد التعليمية</p>
</div>
<form class="space-y-6"  method="POST">
<div>
<label class="sr-only" for="username">اسم المستخدم</label>
<div class="relative">
<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
<span class="material-symbols-outlined text-gray-400">person</span>
</div>
<input class="form-input block w-full rounded-md border-0 py-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[var(--primary-color)] sm:text-sm sm:leading-6" id="username" name="username" placeholder="اسم المستخدم" required="" type="text"/>
</div>
</div>
<div>
<label class="sr-only" for="password">كلمة المرور</label>
<div class="relative">
<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
<span class="material-symbols-outlined text-gray-400">lock</span>
</div>
<input class="form-input block w-full rounded-md border-0 py-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[var(--primary-color)] sm:text-sm sm:leading-6" id="password" name="password" placeholder="كلمة المرور" required="" type="password"/>
</div>
</div>
<div class="flex items-center justify-between">
<div class="flex items-center">
<input class="h-4 w-4 rounded border-gray-300 text-[var(--primary-color)] focus:ring-[var(--primary-color)]" id="remember-me" name="remember-me" type="checkbox"/>
<label class="mr-2 block text-sm text-gray-900" for="remember-me">تذكرني</label>
</div>
<div class="text-sm">
<a class="font-medium text-[var(--primary-color)] hover:text-opacity-80" href="#">هل نسيت كلمة المرور؟</a>
</div>
</div>
<div>
<button class="flex w-full justify-center rounded-md bg-[var(--primary-color)] px-3 py-3 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-opacity-90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--primary-color)] transition-colors duration-200" type="submit">
                تسجيل الدخول
              </button>
</div>
</form>
<p class="text-center text-sm text-gray-500">
            ليس لديك حساب؟
            <a class="font-semibold leading-6 text-[var(--primary-color)] hover:text-opacity-80" href="#">أنشئ حساباً جديداً</a>
</p>
</div>
</div>
</div>
</body></html>