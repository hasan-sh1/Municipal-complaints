<?php
// بدء جلسة المستخدم
session_start();
require_once('../comploments/connect.php');
require_once('../comploments/sql.php');

// التحقق من وجود كوكيز واستعادة بيانات الجلسة إذا لزم الأمر
if (!isset($_SESSION['user_id']) && isset($_COOKIE['user_id'])) {
    // استعادة جميع بيانات الجلسة من الكوكيز
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['user_email'] = $_COOKIE['user_email'];
    $_SESSION['user_name'] = $_COOKIE['user_name'];
    $_SESSION['type'] = $_COOKIE['user_type'];
}

// التحقق من تسجيل دخول المستخدم وأنه من نوع "مستخدم"
if (isset($_SESSION['user_id']) && $_SESSION['type'] == 'user') {
    // جلب بيانات المستخدم والشكاوى والرسائل
    $user = getuser($_SESSION['user_id']);
    $complaints = getcomplaint($user['id']);
    $complaints_type = getcomplainttype($user['id'], $type = 'public');
    $messages = getmessage();
    $admins = getadmins();
    $messages = getmessagebyid($user['id']);

    // معالجة إرسال رسالة جديدة
    if (isset($_POST['send_message'])) {
        $message_content = $_POST['message'];
        $user_id = $_SESSION['user_id'];
        $receiver_id = $_POST['admin_id'];
        $created_at = date('Y-m-d H:i:s');

        $id = unique_id();
        sendmessage($user_id, $message_content, $created_at, $id, $receiver_id);
    }

    // معالجة تحديث الملف الشخصي
    if (!headers_sent() && isset($_POST['update_profile'])) {
        $id = $_POST['id'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // محاولة تحديث بيانات المستخدم وعرض رسالة نجاح أو فشل
        if (updateuser($id, $fullname, $email, $password)) {
            $_SESSION['success_msg'] = 'تم تحديث البيانات بنجاح';
        } else {
            $_SESSION['error_msg'] = 'حدث خطأ في تحديث البيانات';
        }
    }

} else {
    // إعادة توجيه المستخدم غير المصرح له إلى الصفحة الرئيسية
    header('location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include('partials/head.php'); ?>

<body class="fixed-navbar">
    <!-- رسالة اشعار اول التحميل بعد التعديلات -->
    <?php if (isset($_SESSION['success_msg']) || isset($_SESSION['error_msg'])): ?>
        <div class="alert-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
            <?php if (isset($_SESSION['success_msg'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>نجاح!</strong> <?php echo $_SESSION['success_msg']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['success_msg']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error_msg'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>خطأ!</strong> <?php echo $_SESSION['error_msg']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['error_msg']); ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="page-wrapper">
        <!-- START HEADER-->
        <?php include('partials/header.php'); ?>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <?php include('partials/sidebar.php'); ?>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="content">
                <?php include('profile.php'); ?>
            </div>
            <!-- END PAGE CONTENT-->
            <?php include('partials/footer.php'); ?>
        </div>
    </div>
    <!-- BEGIN THEME CONFIG PANEL-->
    <?php include('partials/settings.php'); ?>
    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <?php include('partials/scripts.php'); ?>
</body>

</html>