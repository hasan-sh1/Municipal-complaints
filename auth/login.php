<?php
session_start();
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']); // حذف الرسالة بعد عرضها
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
            <!-- فورم تسجيل الدخول -->
            <div class="signForm">
                <form action="login_check.php" method="post">
                    <h1>Sign In</h1>
                    <div class="formRow">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-google"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                    </div>
                    <div class="formRow">
                        <p>or use your email account</p>

                    </div>
                    <div class="formRow">
                        <input type="email" name="Email" placeholder="Email" required>
                    </div>
                    <div class="formRow">
                        <input type="password" class="password" name="Password" placeholder="Password" required><i class="fa-solid fa-eye-slash eye" id="eye"></i>
                    </div>
                    <div class="formRow">
                        <input type="hidden" name="Confirm_Password" placeholder="Confirm Password">
                    </div>
                    <div class="formRow">
                        <a href="forgetpassword.php" class="forgetPass">Forget your password?</a>
                    </div>
                    <button type="submit" name="signin">SIGN IN</button>
                </form>
            </div>
            <!-- فورم تسجيل الاشتراك الجديد -->
            <div class="signForm hidden">
                <form action="login_check.php" method="post">
                    <h1>Sign up</h1>
                    <div class="formRow">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-google"></i></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                    </div>
                    <div class="formRow">
                        <p>or use your email account</p>
                        </div>
                        <div class="formRow">
                            <div class="formGroup"><input type="text" name="FullName" placeholder="FullName" required></div>
                        
                            <div class="formGroup"> <input type="tel" name="nationalID" placeholder="National ID" required></div>
                        </div>
                    
                    <div class="formRow">
                        <input type="email" name="Email" placeholder="Email" required>
                    </div>
                    <div class="formRow">
                        <input type="password" class="password" name="Password" placeholder="Password" required><i class="fa-solid fa-eye-slash eye"></i>
                    </div>
                    <div class="formRow">
                        <input type="password" class="password" name="Confirm_Password" placeholder="Confirm Password" required>
                    </div>
                    <div class="formRow">
                        <a href="#" class="forgetPass" hidden>Forget your password?</a>
                    </div>
                    <button type="submit" name="signup">SIGN UP</button>
                </form>
            </div>
        </div>
        <!-- الديف الجانبي -->
        <div class="overlay" id="overlay">
            <!-- خيار تسجيل اشتراك جديد -->
            <div class="signOverlay ">
                <h1>register</h1>
                <button class="moveL">sign up</button>
            </div>
            <!-- خيار تسجيل دخول بحساب موجود -->
            <div class="signOverlay hidden">
                <h1>login</h1>
                <button class="moveL">sign in</button>
            </div>
        </div>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>