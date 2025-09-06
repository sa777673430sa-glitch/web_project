<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <link crossorigin="" href="https://fonts.gstatic.com/" rel="preconnect"/>
    <link as="style" href="https://fonts.googleapis.com/css2?display=swap&family=Noto+Kufi+Arabic:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;700;800" onload="this.rel='stylesheet'" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <title>Stitch Design</title>
    <link href="data:image/x-icon;base64," rel="icon" type="image/x-icon"/>
    <link rel="stylesheet" href="styeles/manager.css">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
</head>
<body class="bg-gray-50">
    <div class="relative flex min-h-screen flex-col group/design-root">
        <div class="flex flex-1">
            <aside class="flex h-screen flex-col justify-between bg-white p-6 shadow-sm sticky top-0">
                <div class="flex flex-col gap-8">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-black rounded-full"></div>
                        <h1 class="text-xl font-bold text-gray-800">مدير</h1>
                    </div>
                    <nav class="flex flex-col gap-2">
                        
                        <a class="flex items-center gap-3 px-4 py-2 text-white bg-indigo-600 rounded-lg shadow-sm" href="#">
                            <span class="material-symbols-outlined">group</span>
                            <span class="text-sm font-medium">المستخدمون</span>
                        </a>
                        <a class="flex items-center gap-3 px-4 py-2 text-gray-500 rounded-lg hover:bg-gray-100" href="#">
                            <span class="material-symbols-outlined">school</span>
                            <span class="text-sm font-medium">الاقسام</span>
                        </a>

                        <a class="flex items-center gap-3 px-4 py-2 text-gray-500 rounded-lg hover:bg-gray-100" href="#">
                            <span class="material-symbols-outlined">settings</span>
                            <span class="text-sm font-medium">الإعدادات</span>
                        </a>
                    </nav>
                </div>
                <div class="flex flex-col gap-2">
                    <a class="flex items-center gap-3 px-4 py-2 text-gray-500 rounded-lg hover:bg-gray-100" href="#">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="text-sm font-medium">تسجيل الخروج</span>
                    </a>
                </div>
            </aside>
            <main class="flex-1 p-8">
                <div class="flex items-center justify-between mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">إدارة المستخدمين</h1>
                    <button class="flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="material-symbols-outlined">add</span>
                        <span>إضافة مستخدم جديد</span>
                    </button>
                </div>
                <div class="mb-6">
                    <div class="relative">
                        <span class="material-symbols-outlined absolute text-gray-400 right-4 top-1/2 -translate-y-1/2">search</span>
                        <input class="w-full py-3 pr-12 pl-4 text-gray-700 bg-white border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="البحث عن مستخدم بالاسم أو البريد الإلكتروني..." type="text"/>
                    </div>
                </div>
                <div class="overflow-x-auto bg-white border border-gray-200 rounded-lg shadow-sm">
                    <table class="w-full text-right">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 font-semibold text-gray-600">اسم المستخدم</th>
                                <th class="px-6 py-4 font-semibold text-gray-600">البريد الإلكتروني</th>
                                <th class="px-6 py-4 font-semibold text-gray-600">الدور</th>
                                <th class="px-6 py-4 font-semibold text-gray-600">الحالة</th>
                                <th class="px-6 py-4 font-semibold text-gray-600">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <img alt="أحمد علي" class="w-10 h-10 rounded-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD1f60YsXiYtOiVF-LyDBc8jCylyK6XJw7gwKJrzHB3iegpoq7NyfBhYlGEB_h--1rWlQtsCWFSi-HPqsuSvngaGkg3779Zqt5LFYa9pSr3LkLdptHcpivTc5rw8Vg7jfLBBtP9FvC0kzk9QaiUySM5Vl0QQOysrJo5rXiZx96FHTQWWLdJS0HHFD6tiG1kb8CnQVYzyXOVP0ZvBWLq-ru1hDpClUAmjJ_Rm6XBkFA8Vj44PRlHyZXqw0yOuQ_HUYYQC1q5TP2801k"/>
                                        <span class="font-medium text-gray-800">أحمد علي</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-500 whitespace-nowrap">ahmed.ali@example.com</td>
                                <td class="px-6 py-4 whitespace-nowrap"><span class="px-3 py-1 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">مدير</span></td>
                                <td class="px-6 py-4 whitespace-nowrap"><span class="px-3 py-1 text-sm font-medium text-green-800 bg-green-100 rounded-full">نشط</span></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-4">
                                        <button class="text-indigo-600 hover:text-indigo-900">تعديل</button>
                                        <button class="text-red-600 hover:text-red-900">حذف</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <img alt="ليلى محمد" class="w-10 h-10 rounded-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCzetSwJiN6P92Z6eYouaHRzw7coOvSdJq5iXNjNemY9FN9qxmC1pFkzEtbTSRWG22Yd_tF2B9i6Q7zUehkMuSzMLOihXtv7UdF_5SM8erJYqnub4gVy7Lv1scdHi3RNBrZU-tBGXBfHLtEGrtxliKloMU1pPp1-L0b_N2BsD48gQJiO1sZXNr_-M8mRNkypQnvwtc7bbBImN9VlBT9LeG578Azf_M1nslRxT9uB2vXM88r3IRdmPHa6FpjYLKyeldYFasL7_bx9R0"/>
                                        <span class="font-medium text-gray-800">ليلى محمد</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-500 whitespace-nowrap">layla.mohamed@example.com</td>
                                <td class="px-6 py-4 whitespace-nowrap"><span class="px-3 py-1 text-sm font-medium text-purple-800 bg-purple-100 rounded-full">معلم</span></td>
                                <td class="px-6 py-4 whitespace-nowrap"><span class="px-3 py-1 text-sm font-medium text-green-800 bg-green-100 rounded-full">نشط</span></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-4">
                                        <button class="text-indigo-600 hover:text-indigo-900">تعديل</button>
                                        <button class="text-red-600 hover:text-red-900">حذف</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <img alt="خالد سالم" class="w-10 h-10 rounded-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD8oweOjrJBPc3EsiidrDdJ8Tiav6u3rvq7yVx6WHC1QA7XVhaoI0O6r-tMybO8RstChL_RO2F-Qjtl-kozxg1whHUSztevzhP_SntMSemxIlhLcF1k8DOFdT2BtcoowVVesVQnUAonmCOYC2I1pErsGOB6uz6HskGlNy8SnjObFKuhanWDaFQPZlFOY6CXoXpr9g8l9T-ybmP-hMfW_pSBQ_dMIuFXwltPXQc2OR0hPNptdziZNWiDarmMITpTTx10HrMjhu64Ptc"/>
                                        <span class="font-medium text-gray-800">خالد سالم</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-500 whitespace-nowrap">khaled.salem@example.com</td>
                                <td class="px-6 py-4 whitespace-nowrap"><span class="px-3 py-1 text-sm font-medium text-gray-800 bg-gray-100 rounded-full">طالب</span></td>
                                <td class="px-6 py-4 whitespace-nowrap"><span class="px-3 py-1 text-sm font-medium text-green-800 bg-green-100 rounded-full">نشط</span></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-4">
                                        <button class="text-indigo-600 hover:text-indigo-900">تعديل</button>
                                        <button class="text-red-600 hover:text-red-900">حذف</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <img alt="نورة عبد الله" class="w-10 h-10 rounded-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC4lFBqgz_Kdcrxb4eb4cgAOtOwLopTMV1rRlXKyINSSEVP1lepQT4G57DU1F6W6OOaxKJdOzvqs8vxp3cdPgLWdXXoJEnMmV7mdOJSVY5r5LvU5iHgSW7KBv23pz9fr4v9QNGqVDQTANP7XO7SJzj7NEpK_Ts9MQH-sRGKXnpkKl_p8hmRlvZJBvfALKrfAZehjuXWOVlIhUtuHFt5o7m4LyW0f48fsGa523KFwVc20ztDhxxYSP5_moyrwxZ1cBre6szzBwzVagA"/>
                                        <span class="font-medium text-gray-800">نورة عبد الله</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-500 whitespace-nowrap">nora.abdullah@example.com</td>
                                <td class="px-6 py-4 whitespace-nowrap"><span class="px-3 py-1 text-sm font-medium text-gray-800 bg-gray-100 rounded-full">طالب</span></td>
                                <td class="px-6 py-4 whitespace-nowrap"><span class="px-3 py-1 text-sm font-medium text-red-800 bg-red-100 rounded-full">غير نشط</span></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-4">
                                        <button class="text-indigo-600 hover:text-indigo-900">تعديل</button>
                                        <button class="text-red-600 hover:text-red-900">حذف</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <img alt="سارة حسن" class="w-10 h-10 rounded-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAsVkYx9Qr2z7O6_iObgQxPtwmkmA0dQ4I9gkt07TY8IoWA7jRA75szpJJkDkeJ_kWE0CG0Qq6Mm43KeJA1fEiPwehlFcoFYat1akjevIPgWXiDAwZi1uO2DKgyiN5mBhnoB42RGuk60cZYFwUy3bj9K2pnm5YAtjIdA1GfSxRyYWVCXv7gEhwfm5AX4EtNpfQHoNoaU7ZM9CffsNoI7gmr5rKl5uUJmcU8eaE8VN1Z_TP_r152e1UknwXHDo7s2RQdMhRZFOlvgyk"/>
                                        <span class="font-medium text-gray-800">سارة حسن</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-500 whitespace-nowrap">sara.hassan@example.com</td>
                                <td class="px-6 py-4 whitespace-nowrap"><span class="px-3 py-1 text-sm font-medium text-purple-800 bg-purple-100 rounded-full">معلم</span></td>
                                <td class="px-6 py-4 whitespace-nowrap"><span class="px-3 py-1 text-sm font-medium text-green-800 bg-green-100 rounded-full">نشط</span></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-4">
                                        <button class="text-indigo-600 hover:text-indigo-900">تعديل</button>
                                        <button class="text-red-600 hover:text-red-900">حذف</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>
</html>