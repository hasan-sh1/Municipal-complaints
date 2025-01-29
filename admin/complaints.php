<?php
// بدء جلسة المستخدم
session_start();

// التحقق من تسجيل دخول المستخدم وأنه من نوع admin
if (isset($_SESSION["user_id"]) && $_SESSION["type"] == 'admin') {

    // استدعاء ملفات الاتصال بقاعدة البيانات والوظائف المساعدة
    require_once('../comploments/connect.php');
    require_once('../comploments/sql.php');
    
    // تهيئة متغيرات الجلسة الخاصة بحالة البحث والشكاوى
    $_SESSION['sreach_status'] = 'all';
    $_SESSION['complaints'] = getcomplaint();

    // معالجة تحديث حالة الشكوى
    if (isset($_POST['status'])) {
        $status = $_POST['status'];
        $complaint_id = $_POST['complaint_id'];
        $sql = $conn->prepare("update complaints set status=? where complaint_id=?");
        $sql->execute([$status, $complaint_id]);
        header('location:dashboard.php');
    }

    // معالجة البحث حسب حالة الشكوى 
    if (isset($_POST['search_status'])) {
        $_SESSION['sreach_status'] = $_POST['statu_value'];
        $_SESSION['complaints'] = getcomplaint(status: $_SESSION['sreach_status']);
    }

    // معالجة الإجراءات على الشكوى (مثل الحل أو الرفض)
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $complaint_id = $_POST['complaint_id'];

        if (actioncomplaint($action, $complaint_id)) {
            $_SESSION['success_msg'] = "تم معالجة الشكوى بنجاح";
            header('location:complaints.php');
            exit();
        }
    }

    // تحديد متغيرات حالة البحث والشكاوى للعرض
    $search_status = $_SESSION['sreach_status'];
    $complaints = $_SESSION['complaints'];

} else {
    // إعادة التوجيه إلى الصفحة الرئيسية إذا لم يكن المستخدم مسجل دخول كمشرف
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
            <div class="page-heading">
                <h1 class="page-title">Complaints</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">Complaints</li>
                </ol>
            </div>
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Complaints Table</div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>الحالة</th>
                                    <th>الموقع</th>
                                    <th>التصنيف</th>
                                    <th>المحتوى</th>
                                    <th>تاريخ التقديم</th>
                                    <th>تاريخ الحل</th>
                                    <th>الاجراءات</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>الحالة</th>
                                    <th>الموقع</th>
                                    <th>التصنيف</th>
                                    <th>المحتوى</th>
                                    <th>تاريخ التقديم</th>
                                    <th>تاريخ الحل</th>
                                    <th>الاجراءات</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <!-- عرض الشكاوي -->
                                <?php foreach ($complaints as $complaint): ?>
                                    <tr>
                                        <td><?= $complaint['status'] ?></td>
                                        <td><?= getarea($complaint['area_id'])['area_name'] ?></td>
                                        <td><?= getcategory($complaint['category_id'])['category_name'] ?></td>
                                        <td><?= $complaint['description'] ?></td>
                                        <td><?= $complaint['submission_date'] ?></td>
                                        <td><?= $complaint['resolution_date'] ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    <form action="complaints.php" method="post">
                                                        <input type="hidden" name="complaint_id"
                                                            value="<?= $complaint['complaint_id'] ?>">
                                                        <button type="submit" name="action" class="dropdown-item"
                                                            value="Accept">Accept</button>
                                                        <button type="submit" name="action" class="dropdown-item"
                                                            value="Deny">Deny</button>
                                                    </form>
                                                    </form>

                                                </div>
                                            </div>
                                        </td>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- END PAGE CONTENT-->
            <!-- footer -->
        </div>
    </div>
    <!-- BEGIN THEME CONFIG PANEL-->

    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->
    <?php include('partials/scripts.php'); ?>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="../css/assets/vendors/DataTables/datatables.min.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="../css/assets/js/app.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
        $(function () {
            if (!$.fn.DataTable.isDataTable('#example-table')) {
                $('#example-table').DataTable({
                    pageLength: 10
                });
            }
        })
    </script>
</body>

</html>