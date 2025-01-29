<!-- الاتصال بقاعدة البيانات -->
<?php include '../comploments/connect.php' ?>
<!-- فحص حالة تسجيل الدخول -->
<?php
session_start(); //بدء جلسة جديدة لحفظ بيانات المستخدم
if (isset($_POST['signin'])) { //التحقق من ان زر الفورم تم الضغط عليه و استقبال بيانات
    $email = $_POST['Email'];
    $pass = $_POST['Password'];
    // تنظيف وتأمين المدخلات من الرموز الضارة
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $pass = trim($pass);

    if (empty($email) || empty($pass)) {
        $_SESSION['message'] = 'الرجاء ملء جميع الحقول';
        header('location:login.php');
    } else {
        // التحقق من وجود المستخدم في قاعدة البيانات عن طريق البريد الإلكتروني
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch();
            // التحقق من تطابق كلمة المرور المشفرة
            if (password_verify($pass, $user['password'])) {
                // تخزين معلومات المستخدم في متغيرات الجلسة
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email']; 
                $_SESSION['user_name'] = $user['fullname'];
                $_SESSION['type'] = $user['type'];

                // حفظ معلومات المستخدم في ملفات تعريف الارتباط لمدة شهر
                setcookie('user_id', $user['id'], time() + (86400 * 30), '/');
                setcookie('user_email', $user['email'], time() + (86400 * 30), '/');
                setcookie('user_name', $user['fullname'], time() + (86400 * 30), '/');
                setcookie('user_type', $user['type'], time() + (86400 * 30), '/');

                // توجيه المستخدم حسب نوع حسابه (مدير/مستخدم عادي)
                if ($user['type'] == 'admin') {
                    header('location:../admin/dashboard.php');
                }
                elseif ($user['type'] == 'user') {
                    header('location:../user/user.php');
                }
            } else {
                $_SESSION['message'] = 'كلمة المرور غير صحيحة';
                header('location:login.php');
            }
        } else {
            $_SESSION['message'] = 'البريد الإلكتروني غير موجود';
            header('location:login.php');
        }

    }
} elseif (isset($_POST["signup"])) { // التحقق من طلب إنشاء حساب جديد
    $email = $_POST['Email'];
    $pass = $_POST['Password'];
    $confirm_pass = $_POST['Confirm_Password'];
    $fullname = $_POST['FullName'];
    $nationalID = $_POST['nationalID'];
    $id = unique_id(); // توليد معرف فريد للمستخدم الجديد

    // تنظيف وتأمين المدخلات من الرموز الضارة
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $pass = trim($pass);
    $confirm_pass = trim($confirm_pass);

    if (empty($email) || empty($pass) || empty($confirm_pass)) {
        $_SESSION['message'] = 'الرجاء ملء جميع الحقول';
        header('location:login.php');
    } elseif ($pass != $confirm_pass) {
        $_SESSION['message'] = 'كلمات المرور غير متطابقة';
        header('location:login.php');
    } else {
        // التحقق من عدم وجود البريد الإلكتروني مسجل مسبقاً
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['message'] = 'البريد الإلكتروني مستخدم بالفعل';
            header('location:login.php');
        } else {
            // تشفير كلمة المرور وإضافة المستخدم الجديد لقاعدة البيانات
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (id, email, password,fullname,national_id) VALUES (?, ?, ?,?, ?)");
            $stmt->execute([$id, $email, $hashed_password, $fullname, $nationalID]);

            $_SESSION['message'] = 'تم إنشاء الحساب بنجاح';
            header('location:login.php');
                }
    }

} else {
    $_SESSION['message'] = "error11";
    session_reset(); // إعادة تعيين متغيرات الجلسة
    header('location:login.php');}
?>