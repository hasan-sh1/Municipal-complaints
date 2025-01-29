<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>نظام شكاوي البلدية</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">

    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto');

        :root {
            --mian_color: #257180;
            --crame: #F2E5BF;
            --orange: #FD8B51;
            --brown: #CB6040;
            --gray: #dadadae2;
        }

        body {

            font-family: 'Roboto', sans-serif;
            background-color: var(--gray);
        }

        * {
            margin: 0;
            padding: 0;
        }

        i {
            margin-right: 10px;
        }

        /*----------bootstrap-navbar-css------------*/
        .navbar-logo {
            padding: 15px;
            color: #fff;
        }

        .navbar-mainbg {
            background-color: var(--mian_color);
            padding: 0px;
            position: fixed;
            z-index: 1000;
        }

        #navbarSupportedContent {
            overflow: hidden;
        }

        #navbarSupportedContent ul {
            padding: 0px;
            margin: 0px;
        }

        #navbarSupportedContent ul li a i {
            margin-right: 10px;
        }

        #navbarSupportedContent li {
            list-style-type: none;
            float: left;
        }

        #navbarSupportedContent ul li a {
            color: rgba(7, 0, 0, 0.5);
            text-decoration: none;
            font-size: 15px;
            display: block;
            padding: 20px 20px;
            transition-duration: 0.6s;
            transition-timing-function: cubic-bezier(0.68, -0.55, 0.265, 1.55);
            position: relative;
        }

        #navbarSupportedContent>ul>li.active>a {
            color: #333;
            background-color: transparent;
            transition: all 0.7s;
        }

        #navbarSupportedContent a:not(:only-child):after {
            content: "\f105";
            position: absolute;
            right: 20px;
            top: 10px;
            font-size: 14px;
            font-family: "Font Awesome 5 Free";
            display: inline-block;
            padding-right: 3px;
            vertical-align: middle;
            font-weight: 900;
            transition: 0.5s;
        }

        #navbarSupportedContent .active>a:not(:only-child):after {
            transform: rotate(90deg);
        }

        .hori-selector {
            display: inline-block;
            position: absolute;
            height: 100%;
            top: 0px;
            left: 0px;
            transition-duration: 0.6s;
            transition-timing-function: cubic-bezier(0.68, -0.55, 0.265, 1.55);
            background-color: #fff;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .hori-selector .right,
        .hori-selector .left {
            position: absolute;
            width: 25px;
            height: 25px;
            background-color: #fff;
            bottom: 0px;
        }

        .hori-selector .right {
            right: -25px;
        }

        .hori-selector .left {
            left: -25px;
        }

        .hori-selector .right:before,
        .hori-selector .left:before {
            content: '';
            position: absolute;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--mian_color);
        }

        .hori-selector .right:before {
            bottom: 0;
            right: -25px;
        }

        .hori-selector .left:before {
            bottom: 0;
            left: -25px;
        }


        @media(min-width: 992px) {
            .navbar-expand-custom {
                -ms-flex-flow: row nowrap;
                flex-flow: row nowrap;
                -ms-flex-pack: start;
                justify-content: flex-start;
            }

            .navbar-expand-custom .navbar-nav {
                -ms-flex-direction: row;
                flex-direction: row;
            }

            .navbar-expand-custom .navbar-toggler {
                display: none;
            }

            .navbar-expand-custom .navbar-collapse {
                display: -ms-flexbox !important;
                display: flex !important;
                -ms-flex-preferred-size: auto;
                flex-basis: auto;
            }
        }


        @media (max-width: 991px) {
            #navbarSupportedContent ul li a {
                padding: 12px 30px;
            }

            .hori-selector {
                margin-top: 0px;
                margin-left: 10px;
                border-radius: 0;
                border-top-left-radius: 25px;
                border-bottom-left-radius: 25px;
            }

            .hori-selector .left,
            .hori-selector .right {
                right: 10px;
            }

            .hori-selector .left {
                top: -25px;
                left: auto;
            }

            .hori-selector .right {
                bottom: -25px;
            }

            .hori-selector .left:before {
                left: -25px;
                top: -25px;
            }

            .hori-selector .right:before {
                bottom: -25px;
                left: -25px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-custom navbar-mainbg w-100 ">
        <a class="navbar-brand navbar-logo" href="#">شكاوي بلدية</a>
        <?php if (isset($_SESSION["user_id"]) || isset($_COOKIE['user_id'])): ?>
            <div class="user-circle" style="margin-right: 15px;">
                <?php
                $user_type = isset($_SESSION["type"]) ? $_SESSION["type"] : $_COOKIE['user_type'];
                $dashboard_url = ($user_type == 'admin') ? 'admin/dashboard.php' : 'user/user.php';
                ?>
                <a href="<?php echo $dashboard_url; ?>" style="text-decoration: none;">
                    <i class="fas fa-user-circle fa-2x" style="color: #fff;"></i>
                </a>
            </div>
        <?php endif; ?>
        <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <div class="hori-selector">
                    <div class="left"></div>
                    <div class="right"></div>
                </div>
                <li class="nav-item">
                    <a class="nav-link" href="#services"><i class="fas fa-tachometer-alt"></i>خدماتنا</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#about"><i class="far fa-address-book"></i>حول </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php
                    if (isset($_SESSION["user_id"]) || isset($_COOKIE['user_id'])) {
                        echo "auth/logout.php";
                    } else {
                        echo "auth/login.php";
                    }
                    ?>"><i class="far fa-clone"></i><?php
                    if (isset($_SESSION["user_id"]) || isset($_COOKIE['user_id'])) {
                        echo "تسجيل الخروج";
                    } else {
                        echo "تسجيل الدخول";
                    }
                    ?></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#complaint"><i class="far fa-chart-bar"></i>تقديم شكوى</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#footer"><i class="far fa-copy"></i>اتصل بنا</a>
                </li>
            </ul>
        </div>
    </nav>


    <!-- Hero Section -->
    <div class="hero"
        style="background-image: url('img/بلدية اعزاز.png'); background-size: cover; background-position: center; background-repeat: no-repeat; position: relative; height: 500px;">
        <div class="hero-section"
            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(255, 255, 255, 0.5); backdrop-filter: blur(5px); padding: 4rem; border-radius: 1rem; width: 80%; max-width: 800px; text-align: center;">
            <h1>مرحبًا بك في نظام شكاوي البلدية</h1>
            <p>نحن هنا للاستماع إلى شكواك والعمل على تحسين الخدمات. شاركنا رأيك وشكواك بسهولة!</p>
        </div>
    </div>
    <br>
    <!-- Info Section -->
    <div id="services" style="height: 60px;"></div>

    <section class="first-section ">
        <div class="first-section-title">
            <h2>خدماتنا</h2>
            <p>كل الخدمات التي تقدمها البلدية</p>
        </div>

        <div class="info-section ">
            <div class="row">
                <div class="col-md-4">
                    <div class="info-box">
                        <i class="fas fa-bullhorn"></i>
                        <h3>خدمات فعالة</h3>
                        <p>نضمن الاستجابة السريعة لشكواك وحلها بأسرع وقت ممكن.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box">
                        <i class="fas fa-users"></i>
                        <h3>تواصل مباشر</h3>
                        <p>تواصل مع فريق البلدية بسهولة عبر منصتنا.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box">
                        <i class="fas fa-file-alt"></i>
                        <h3>توثيق الشكاوى</h3>
                        <p>احصل على سجل كامل لشكاواك واستفساراتك.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <div id="about" style="height: 60px;"></div>
    <section class="first-section">
        <div class="first-section-title">
            <h2>حول البلدية</h2>
            <p>التفاصيل المتعلقة بالبلدية</p>
        </div>

        <div class="info-section ">
            <div class="row">
                <div class="col-md-4">
                    <div class="info-box">
                        <i class="fas fa-bullhorn"></i>
                        <h3>المنطقة</h3>
                        <p>نضمن الاستجابة السريعة لشكواك وحلها بأسرع وقت ممكن.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box">
                        <i class="fas fa-users"></i>
                        <h3>المديرية</h3>
                        <p>تواصل مع فريق البلدية بسهولة عبر منصتنا.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box">
                        <i class="fas fa-file-alt"></i>
                        <h3>المحافظة</h3>
                        <p>احصل على سجل كامل لشكاويك واستفساراتك.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <section class="services-section" id="">
        <div class="first-section-title">
            <h2>خدماتنا المتكاملة</h2>
            <p>نقدم مجموعة واسعة من الخدمات لخدمة مجتمعنا</p>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="info-box" style=" transition: all 0.3s;">
                        <i class="fas fa-building" style="color: var(--mian_color); font-size: 2rem;"></i><br>
                        <h3>تراخيص البناء</h3>
                        <p>إصدار وتجديد رخص البناء بكل سهولة ويسر</p>
                        <button class="btn btn-primary mt-3"
                            style="background:var(--mian_color) ; border: none; transition: all 0.3s;"
                            onmouseover="this.style.backgroundColor='#052e36'"
                            onmouseout="this.style.backgroundColor='var(--mian_color)' ">المزيد</button>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="info-box" style=" transition: all 0.3s;">
                        <i class="fas fa-trash" style="color: var(--mian_color); font-size: 2rem;"></i><br>
                        <h3>إدارة النفايات</h3>
                        <p>خدمات جمع ومعالجة النفايات بطريقة صديقة للبيئة</p>
                        <button class="btn btn-primary mt-3"
                            style="background: var(--mian_color); border: none; transition: all 0.3s;"
                            onmouseover="this.style.backgroundColor='#052e36'"
                            onmouseout="this.style.backgroundColor='var(--mian_color)' ">المزيد</button>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="info-box" style=" transition: all 0.3s;">
                        <i class="fas fa-road" style="color: var(--mian_color); font-size: 2rem;"></i><br>
                        <h3>صيانة الطرق</h3>
                        <p>خدمات صيانة وتطوير شبكة الطرق في المدينة</p>
                        <button class="btn btn-primary mt-3"
                            style="background: var(--mian_color); border: none; transition: all 0.3s;"
                            onmouseover="this.style.backgroundColor='#052e36'"
                            onmouseout="this.style.backgroundColor='var(--mian_color)'">المزيد</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="complaint" style="height: 80px;"></div>
    <section>
        <center><a href="user/complaints.php"><button class="btn btn-primary btn-block w-50"
                    style="background: var(--brown); border: none; transition: all 0.3s; padding: 15px 30px; font-size: 1.5rem; font-weight: bold; border-radius: 50px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);"
                    onmouseover="this.style.backgroundColor='#052e36'; this.style.transform='scale(1.05)'; this.style.boxShadow='0 6px 20px rgba(0,0,0,0.3)'"
                    onmouseout="this.style.backgroundColor='var(--brown)'; this.style.transform='scale(1)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.2)'">تقديم
                    شكوى</button></a></center>
    </section>
    <br>
    <br>
    <br>

    <section class="statistics-section" style="padding: 50px 0; background: var(--mian_color);">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3">
                    <div class="stat-box" style="color: white;">
                        <i class="fas fa-project-diagram fa-3x mb-3"></i>
                        <h3>+500</h3>
                        <p>مشروع منجز</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-box" style="color: white;">
                        <i class="fas fa-users fa-3x mb-3"></i>
                        <h3>+100,000</h3>
                        <p>مواطن مستفيد</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-box" style="color: white;">
                        <i class="fas fa-handshake fa-3x mb-3"></i>
                        <h3>+50</h3>
                        <p>شراكة استراتيجية</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-box" style="color: white;">
                        <i class="fas fa-award fa-3x mb-3"></i>
                        <h3>+20</h3>
                        <p>جائزة تميز</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <div id="footer" style="height: 80px;"></div>
    <footer style="background-color: #333; color: #fff; padding: 40px 0; margin-top: 50px; ">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>عن البلدية</h4>
                    <p>بلدية اعزاز تعمل على خدمة المواطنين وتطوير المدينة وتحسين جودة الحياة للجميع.</p>
                    <div class="social-links mt-3">
                        <a href="#" class="mr-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="mr-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="mr-3"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h4>روابط سريعة</h4>
                    <ul class="list-unstyled">
                        <li><a href="#services" style="color: #fff;">خدماتنا</a></li>
                        <li><a href="#about" style="color: #fff;">حول البلدية</a></li>
                        <li><a href="#complaint" style="color: #fff;">تقديم شكوى</a></li>
                        <li><a href="#content" style="color: #fff;">اتصل بنا</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>معلومات الاتصال</h4>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt mr-2"></i> اعزاز، سوريا</li>
                        <li><i class="fas fa-phone mr-2"></i> +963 XX XXXX XXX</li>
                        <li><i class="fas fa-envelope mr-2"></i> info@azaz-municipality.sy</li>
                        <li><i class="fas fa-clock mr-2"></i> ساعات العمل: 8 صباحاً - 4 مساءً</li>
                    </ul>
                </div>
            </div>
            <hr style="background-color: #fff;">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="mb-0">جميع الحقوق محفوظة &copy; 2024 بلدية اعزاز</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"> </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>


    <script>// ---------Responsive-navbar-active-animation-----------
        function test() {
            var tabsNewAnim = $('#navbarSupportedContent');
            var selectorNewAnim = $('#navbarSupportedContent').find('li').length;
            var activeItemNewAnim = tabsNewAnim.find('.active');
            var activeWidthNewAnimHeight = activeItemNewAnim.innerHeight();
            var activeWidthNewAnimWidth = activeItemNewAnim.innerWidth();
            var itemPosNewAnimTop = activeItemNewAnim.position();
            var itemPosNewAnimLeft = activeItemNewAnim.position();
            $(".hori-selector").css({
                "top": itemPosNewAnimTop.top + "px",
                "left": itemPosNewAnimLeft.left + "px",
                "height": activeWidthNewAnimHeight + "px",
                "width": activeWidthNewAnimWidth + "px"
            });
            $("#navbarSupportedContent").on("click", "li", function (e) {
                $('#navbarSupportedContent ul li').removeClass("active");
                $(this).addClass('active');
                var activeWidthNewAnimHeight = $(this).innerHeight();
                var activeWidthNewAnimWidth = $(this).innerWidth();
                var itemPosNewAnimTop = $(this).position();
                var itemPosNewAnimLeft = $(this).position();
                $(".hori-selector").css({
                    "top": itemPosNewAnimTop.top + "px",
                    "left": itemPosNewAnimLeft.left + "px",
                    "height": activeWidthNewAnimHeight + "px",
                    "width": activeWidthNewAnimWidth + "px"
                });
            });
        }
        $(document).ready(function () {
            setTimeout(function () { test(); });
        });
        $(window).on('resize', function () {
            setTimeout(function () { test(); }, 500);
        });
        $(".navbar-toggler").click(function () {
            $(".navbar-collapse").slideToggle(300);
            setTimeout(function () { test(); });
        });



        // --------------add active class-on another-page move----------
        jQuery(document).ready(function ($) {
            // Get current path and find target link
            var path = window.location.pathname.split("/").pop();

            // Account for home page with empty path
            if (path == '') {
                path = 'index.html';
            }

            var target = $('#navbarSupportedContent ul li a[href="' + path + '"]');
            // Add active class to target link
            target.parent().addClass('active');
        });




        // Add active class on another page linked
        // ==========================================
        // $(window).on('load',function () {
        //     var current = location.pathname;
        //     console.log(current);
        //     $('#navbarSupportedContent ul li a').each(function(){
        //         var $this = $(this);
        //         // if the current path is like this link, make it active
        //         if($this.attr('href').indexOf(current) !== -1){
        //             $this.parent().addClass('active');
        //             $this.parents('.menu-submenu').addClass('show-dropdown');
        //             $this.parents('.menu-submenu').parent().addClass('active');
        //         }else{
        //             $this.parent().removeClass('active');
        //         }
        //     })
        // });</script>
</body>

</html>