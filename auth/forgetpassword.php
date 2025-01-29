<?php
require_once('../comploments/connect.php');
require_once('../comploments/sql.php');
session_start();
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']); // حذف الرسالة بعد عرضها
}
if (isset($_POST['save'])) {
    $email=$_POST['email'];
    $password=$_POST['Password'];
    $confirm_password=$_POST['Confirm_Password'];
    if(isset(getuser(email:$email)['id'])){
        if($password===$confirm_password){
            $password=password_hash($password,PASSWORD_DEFAULT);
        $stmt=$conn->prepare("update users set password=? where email=?");
        $stmt->execute([$password,$email]);
        $_SESSION["message"]= "تم تغيير كلمة المرور بنجاح, قم بتسجيل الدخول الآن.";
        header("location:login.php");
        }
        else{
            $_SESSION['massage'] ='كلمة المرور غير متطابقة.';
        }
    }
    else{
        $_SESSION['message']="فشل العثور على البريد الالكتروني";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/auth_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php if (isset($message)): ?>
        <div class="message">
            <h3><?php print ($message); ?></h3>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="logo">
        <h2><a href="../index.php" style="all:unset;">logo</a></h2>
        </div>
        <!-- الديف الذي يحوي الفورمات -->
        <div class="formDiv" id="formDiv">
            <!-- فورم ادراج الايميل المراد اعادة تعيين كلمة المرور له -->
            <div class="signForm">
                <form action="" method="post">
                    <h1>forget password</h1>
                    <div class="formRow">
                        <input  type="email" name="Email" placeholder="Email" onkeyup="document.getElementById('email').value=this.value" required >
                    </div>
                    <div class="formRow">
                        <input type="hidden">
                    </div>
                    <button type="button" name="resetPassword" class="moveL">Reset</button>
                </form>
            </div>
            <!-- فورم تسجيل الاشتراك الجديد -->
            <div class="signForm hidden">
                <form action="" method="post">
                    <h1>new password</h1>
                    <div class="formRow">
                        <input type="password" class="password" name="Password" placeholder="Password" required><i class="fa-solid fa-eye-slash eye"></i>
                        <input type="hidden" id="email"  class="email" name="email" placeholder="email" required>
                    </div>
                    <div class="formRow">
                        <input type="password" class="password" name="Confirm_Password" placeholder="Confirm Password" required>
                    </div>
                    <button type="submit" name="save">Save</button>
                </form>
            </div>
        </div>
        <!-- الديف الجانبي -->
        <div class="overlay" id="overlay">
            <!-- خيار تسجيل اشتراك جديد -->
            <div class="signOverlay ">
                <h1>reset the password</h1>
            </div>
            <!-- خيار تسجيل دخول بحساب موجود -->
            <div class="signOverlay hidden">
                <h1>enter the new password</h1>
            </div>
        </div>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>