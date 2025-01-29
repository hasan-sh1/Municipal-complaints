<?php
// استيراد ملفات الاتصال بقاعدة البيانات والدوال المساعدة
include('../comploments/sql.php');
require_once('../comploments/connect.php');
session_start();

// التحقق من وجود كوكيز واستعادة بيانات الجلسة إذا لزم الأمر
if (!isset($_SESSION['user_id']) && isset($_COOKIE['user_id'])) {
    // استعادة جميع بيانات الجلسة من الكوكيز
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['user_email'] = $_COOKIE['user_email'];
    $_SESSION['user_name'] = $_COOKIE['user_name'];
    $_SESSION['type'] = $_COOKIE['user_type'];

    $user = getuser($_SESSION['user_id']);
    $_SESSION['sreach_status'] = 'all';
    $_SESSION['complaints'] = getcomplaint();
}

// التحقق من تسجيل دخول المستخدم وأنه من نوع مدير
if (isset($_SESSION["user_id"]) && $_SESSION["type"] == 'admin') {
    $user = getuser($_SESSION['user_id']);
    $_SESSION['sreach_status'] = 'all';
    $_SESSION['complaints'] = getcomplaint();

    // تحديث حالة الشكوى
    if (isset($_POST['status'])) {
        $status = $_POST['status'];
        $complaint_id = $_POST['complaint_id'];
        $sql = $conn->prepare("update complaints set status=? where complaint_id=?");
        $sql->execute([$status, $complaint_id]);
        header('location:dashboard.php');
    }

    // البحث عن الشكاوى حسب الحالة
    if (isset($_POST['search_status'])) {
        $_SESSION['sreach_status'] = $_POST['statu_value'];
        $_SESSION['complaints'] = getcomplaint(status: $_SESSION['sreach_status']);
    }

    // تحديث بيانات الملف الشخصي
    if (!headers_sent() && isset($_POST['update_profile'])) {
        $id = $_POST['id'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (updateuser($id, $fullname, $email, $password)) {
            $_SESSION['success_msg'] = 'تم تحديث البيانات بنجاح';
        } else {
            $_SESSION['error_msg'] = 'حدث خطأ في تحديث البيانات';
        }
    }

    $search_status = $_SESSION['sreach_status'];
    $complaints = $_SESSION['complaints'];

} else {
    // إعادة التوجيه إلى الصفحة الرئيسية إذا لم يكن المستخدم مسجل دخول أو ليس مدير
    header('location:../index.php');
}

// إدارة الرسائل
$messages = getmessage();

// إرسال رسالة جديدة
if (isset($_POST['send_message'])) {
    $message_content = $_POST['message'];
    $user_id = $_SESSION['user_id'];
    $receiver_id = $_POST['admin_id'];
    $created_at = date('Y-m-d H:i:s');

    $id = unique_id();
    sendmessage($user_id, $message_content, $created_at, $id, $receiver_id);
}

// جلب الرسائل الخاصة بالمستخدم الحالي
$messages = getmessagebyid($_SESSION['user_id']);
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