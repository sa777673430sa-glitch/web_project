<?php
// ابدأ الجلسة في بداية الملف
session_start();

// تفاصيل الاتصال بقاعدة البيانات
// تأكد من أن هذا الملف موجود في نفس المجلد وأن تفاصيله صحيحة
$host = "localhost";
$user = "root";
$pass = "";
$db = "itcs3";

// الاتصال بقاعدة البيانات
$conn = new mysqli($host, $user, $pass, $db);

// فحص الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// استعلام SQL لجلب جميع بيانات المستخدمين
// تأكد أن أسماء الأعمدة تطابق تماماً أسماء الأعمدة في قاعدة بياناتك
$sql = "SELECT id, name, password, phone, role, status, level, major_id FROM users";

// تنفيذ الاستعلام
$result = $conn->query($sql);

// فحص وجود خطأ في الاستعلام
if (!$result) {
    die("خطأ في الاستعلام: " . $conn->error);
}
?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>إدارة المستخدمين</title>

    <link crossorigin="" href="https://fonts.gstatic.com/" rel="preconnect"/>
    <link as="style" href="https://fonts.googleapis.com/css2?display=swap&family=Noto+Kufi+Arabic:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;700;800" onload="this.rel='stylesheet'" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="stylesheet" href="styeles/manager.css">
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
                        <a class="flex items-center gap-3 px-4 py-2 text-white bg-indigo-600 rounded-lg shadow-sm" href="#"  onclick="loadContent('1.html')">
                            <span class="material-symbols-outlined">group</span>
                            <span class="text-sm font-medium">المستخدمون</span>
                        </a>
                        <a class="flex items-center gap-3 px-4 py-2 text-gray-500 rounded-lg hover:bg-gray-100" href="#" >
                            <span class="material-symbols-outlined">school</span>
                            <span class="text-sm font-medium">التخصصات</span>
                        </a>
                        <a class="flex items-center gap-3 px-4 py-2 text-gray-500 rounded-lg hover:bg-gray-100" href="#"">
                            <span class="material-symbols-outlined">book</span>
                            <span class="text-sm font-medium">المواد</span>
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
                    <button onclick="openTab()" class="flex items-center justify-center gap-2 px-5 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        <span class="material-symbols-outlined">add</span>
                        <span>إضافة مستخدم جديد</span>
                    </button>
                </div>
                <div id="tabContent"></div>
                <div class="mb-6">
                    <div class="relative">
                        <span class="material-symbols-outlined absolute text-gray-400 right-4 top-1/2 -translate-y-1/2">search</span>
                        <input class="w-full py-3 pr-12 pl-4 text-gray-700 bg-white border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="البحث عن مستخدم بالاسم أو رقم الهاتف..." type="text"/>
                    </div>
                </div>
                
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="mb-4 p-4 rounded-lg <?php echo ($_SESSION['message_type'] == 'success') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php
                    unset($_SESSION['message']);
                    unset($_SESSION['message_type']);
                    ?>
                <?php endif; ?>

                <div class="overflow-x-auto bg-white border border-gray-200 rounded-lg shadow-sm">
                    <table class="w-full text-right">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 font-semibold text-gray-600">اسم المستخدم</th>
                                <th class="px-6 py-4 font-semibold text-gray-600">رقم الهاتف</th>
                                <th class="px-6 py-4 font-semibold text-gray-600">الدور</th>
                                <th class="px-6 py-4 font-semibold text-gray-600">الحالة</th>
                                <th class="px-6 py-4 font-semibold text-gray-600">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php
                            if ($result->num_rows > 0) {
                                while ($user = $result->fetch_assoc()):
                            ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <img alt="" class="w-10 h-10 rounded-full" src="assests/person.png"/>
                                                <span class="font-medium text-gray-800"><?php echo htmlspecialchars($user['name']); ?></span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-500 whitespace-nowrap"><?php echo htmlspecialchars($user['phone']); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php
                                            $roleClass = 'bg-gray-100 text-gray-800';
                                            if ($user['role'] == 'مدير') {
                                                $roleClass = 'bg-blue-100 text-blue-800';
                                            } elseif ($user['role'] == 'معلم') {
                                                $roleClass = 'bg-purple-100 text-purple-800';
                                            }
                                            ?>
                                            <span class="px-3 py-1 text-sm font-medium rounded-full <?php echo $roleClass; ?>">
                                                <?php echo htmlspecialchars($user['role']); ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php
                                            $statusClass = 'bg-red-100 text-red-800';
                                            if ($user['status'] == 'نشط') {
                                                $statusClass = 'bg-green-100 text-green-800';
                                            }
                                            ?>
                                            <span class="px-3 py-1 text-sm font-medium rounded-full <?php echo $statusClass; ?>">
                                                <?php echo htmlspecialchars($user['status']); ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-4">
                                                <a href="#" class="text-indigo-600 hover:text-indigo-900 edit-btn"
                                                   data-id="<?php echo $user['id']; ?>"
                                                   data-name="<?php echo htmlspecialchars($user['name']); ?>"
                                                   data-phone="<?php echo htmlspecialchars($user['phone']); ?>"
                                                   data-password="<?php echo htmlspecialchars($user['password']); ?>"
                                                   data-role="<?php echo htmlspecialchars($user['role']); ?>"
                                                   data-status="<?php echo htmlspecialchars($user['status']); ?>"
                                                   data-level="<?php echo htmlspecialchars($user['level']); ?>"
                                                   data-major_id="<?php echo htmlspecialchars($user['major_id']); ?>">تعديل</a>
                                                
                                                <a href="delet_user.php?id=<?php echo $user['id']; ?>" class="text-red-600 hover:text-red-900 delete-btn" data-id="<?php echo $user['id']; ?>">حذف</a>
                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                endwhile;
                            } else {
                            ?>
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        لا يوجد مستخدمون لعرضهم.
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    
    <div id="editModal" class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-40 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 w-96 max-w-full m-4 relative">
            <h2 class="text-xl font-semibold mb-4 text-center">تعديل بيانات المستخدم</h2>
            <button id="closeModal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <form id="editForm" method="post" action="edit_user.php">
                <input type="hidden" name="user_id" id="modal_user_id">
                <div class="mb-4">
                    <label for="modal_name" class="block text-gray-700">اسم المستخدم:</label>
                    <input type="text" id="modal_name" name="name" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="modal_PASSWORD" class="block text-gray-700"> كلمة المرور:</label>
                    <input type="text" id="modal_PASSWORD" name="password" class="w-full px-3 py-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="modal_phone" class="block text-gray-700">رقم الهاتف:</label>
                    <input type="tel" id="modal_phone" name="phone" class="w-full px-3 py-2 border rounded-md" required>
                </div>
               
                <div class="mb-4">
                    <label for="modal_role" class="block text-gray-700" >الصلاحية:</label>
                    <select id="modal_role"0 name="role" class="w-full px-3 py-2 border rounded-md" required>
                     <option value="student">student</option>
                      <option value="teacher">teacher</option>
                      <option value="admain">admain </option>

                  </select>
                
                </div>
                  <div class="mb-4">
                    <label for="modal_status" class="block text-gray-700">الحالة:</label>
              <select id="modal_status" name="status" class="w-full px-3 py-2 border rounded-md" required>
              <option value=1>نشط</option>
                      <option value=0 >غير نشط</option>
                  </select>
                </div>
                <div class="mb-4">
                    <label for="modal_majorId" class="block text-gray-700">التخصص:</label>
                    <select id="modal_majorId"  name ="major_id"class="w-full px-3 py-2 border rounded-md" required>
                     <option value=1>علوم حاسوب</option>
                      <option value=2> امن السيبراني</option>
                      <option value=3>تقنيات المعلومات </option>


                  </select>
                </div>
                <div class="mb-4">
                    <label for="modal_level" class="block text-gray-700">المستوى:</label>
                    <select id="modal_level" name="level" class="w-full px-3 py-2 border rounded-md" required>
                     <option value=1>الاول</option>
                      <option value=2> الثاني</option>
                      <option value=3>الثالث </option>
                      <option value=4>الرابع </option>


                  </select>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" id="cancelEdit" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">إلغاء</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">حفظ التغييرات</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        // navigate to the  item 
        function loadContent(page) {
    fetch(page)
        .then(response => response.text())
        .then(html => {
            document.getElementById('main-content').innerHTML = html;
        });
}
        // show add user
         function openTab() {

      fetch('add_user.html')

        .then(response => response.text())

        .then(html => {

          document.getElementById('tabContent').innerHTML = html;

        });

    }
    $(document).ready(function() {
        // JavaScript لإظهار النافذة المنبثقة للتعديل
        $('.edit-btn').on('click', function(e) {
            e.preventDefault();

            // جلب بيانات المستخدم من الخصائص data-*
            const userId = $(this).data('id');
            const userName = $(this).data('name');
            const userPassword = $(this).data('PASSWORD');
            const userPhone = $(this).data('phone');
            const userRole = $(this).data('role');
            const userStatus = $(this).data('status');
            const userLevel = $(this).data('level');
            const userMajorId = $(this).data('major_id');
           
            
            // ملء النموذج داخل النافذة المنبثقة بالبيانات المجلوبة
            $('#modal_user_id').val(userId);
            $('#modal_name').val(userName);
            $('#modal_PASSWORD').val(userPassword);
            $('#modal_level').val(userLevel);
            $('#modal_majorId').val(userMajorId);

            $('#modal_phone').val(userPhone);
            $('#modal_role').val(userRole);
            $('#modal_status').val(userStatus);
            
            // إظهار النافذة المنبثقة
            $('#editModal').removeClass('hidden');
        });

        // إخفاء النافذة عند النقر على أزرار الإلغاء أو الإغلاق
        $('#closeModal, #cancelEdit').on('click', function() {
            $('#editModal').addClass('hidden');
        });

        // // إخفاء النافذة عند النقر خارجها
        // $(window).on('click', function(e) {
        //     if ($(e.target).is('#editModal')) {
        //         $('#editModal').addClass('hidden');
        //     }
        // });
        
        // JavaScript لعملية الحذف بدون تحديث الصفحة
        $('.delete-btn').on('click', function(e) {
            e.preventDefault();
            
            const userId = $(this).data('id');
            const row = $(this).closest('tr');

            if (confirm("هل أنت متأكد من أنك تريد حذف هذا المستخدم؟")) {
                $.ajax({
                    url: 'delet_user.php',
                    type: 'GET', // استخدام GET هنا ليتوافق مع رابطك
                    data: { id: userId },
                    success: function(response) {
                        const messageBox = $('#status-message');
                        messageBox.text(response).removeClass('hidden').addClass('bg-green-100 text-green-800');
                        row.fadeOut(500, function() {
                            $(this).remove();
                        });
                    },
                    error: function() {
                        const messageBox = $('#status-message');
                        messageBox.text('حدث خطأ أثناء الحذف.').removeClass('hidden').addClass('bg-red-100 text-red-800');
                    }
                });
            }
        });
    });
    </script>

    <?php
    // تحرير الذاكرة وإغلاق الاتصال
    $result->free();
    $conn->close();
    ?>
</body>
</html>