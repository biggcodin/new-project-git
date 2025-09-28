<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <title>قالب هاستینگ پلی هاست - روشاک</title>
    <link rel="icon" href="images/icon.png" type="image/gif" sizes="16x16">
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Playhost - Game Hosting Website Template" name="description">
    <meta content="" name="keywords">
    <meta content="" name="author">
    <!-- CSS Files
    ================================================== -->
    <link href="css/bootstrap.rtl.min.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="css/plugins.css" rel="stylesheet" type="text/css">
    <link href="css/swiper.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/coloring.css" rel="stylesheet" type="text/css">
    <!-- color scheme -->
    <link id="colors" href="css/colors/scheme-01.css" rel="stylesheet" type="text/css">
    <!-- Additional CSS Files for product details -->

    <link rel="stylesheet" href="css/templatemo-lugx-gaming.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        .bottom-nav {
            position: fixed;
            bottom: 10px;
            right: 0;
            left: 0;
            margin: 0 auto;
            width: 95%;
            background: #1e1b2e;
            border-radius: 16px;
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            z-index: 1000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            direction: rtl;
        }

        .bottom-nav .nav-item {
            color: #ccc;
            text-align: center;
            font-size: 12px;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: color 0.3s ease;
        }

        .bottom-nav .nav-item i {
            font-size: 20px;
            margin-bottom: 2px;
        }

        .bottom-nav .nav-item.active,
        .bottom-nav .nav-item:hover {
            color: #fff;
        }

        @media (min-width: 768px) {
            .bottom-nav {
                display: none;
            }
        }
    </style>



</head>

<body class="dark-scheme">
    <div id="wrapper">
        <div class="float-text show-on-scroll">
            <span><a href="#">به بالا بروید</a></span>
        </div>
        <div class="scrollbar-v show-on-scroll"></div>
        <!-- page preloader begin -->
        {{-- <div id="de-loader"></div> --}}
        <!-- page preloader close -->

        <!-- header begin -->
        <header class="transparent">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="de-flex sm-pt10">
                            <div class="de-flex-col">
                                <div class="de-flex-col">
                                    <!-- logo begin -->
                                    <div id="logo">
                                        <a href="index.html">
                                            <img class="logo-main" src="images/logo.png" alt="">
                                            <img class="logo-mobile" src="images/logo-mobile.png" alt="">
                                        </a>
                                    </div>
                                    <!-- logo close -->

                                </div>
                            </div>
                            <div class="de-flex-col">
                                <div class="de-flex-col">
                                    <!-- middle of header begin -->

                                    @yield('mid-header')

                                    <!-- middle of header close -->

                                </div>
                            </div>



                            <div class="de-flex-col">
                                <div class="menu_side_area">
                                    <a href="game-server-1.html" class="btn-main btn-line"><span>سبد خرید</span></a>
                                    <span id="menu-btn"></span>
                                </div>
                                <div class="menu_side_area">
                                    <a href="game-server-1.html" class="btn-main btn-line"><span>ویرایش
                                            پروفایل</span></a>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </header>
        <!--تغییرات من-->

        @yield('content')


        <!--تغییرات من پایان-->


        <!-- ` begin -->
        <footer>
            <div class="container">
                <div class="row gx-5">
                    <div class="col-lg-4">
                        <img src="images/logo.png" alt="">
                        <div class="spacer-20"></div>
                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است،
                            چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی
                            تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</p>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <div class="widget">
                                    <h5> سرور بازی</h5>
                                    <ul>
                                        <li><a href="#">تندر و شهر</a></li>
                                        <li><a href="#">مسابقه مرموز الف</a></li>
                                        <li><a href="#">خشم خاموش</a></li>
                                        <li><a href="#">سیاهچال فانک</a></li>
                                        <li><a href="#">اودیسه کهکشانی</a></li>
                                        <li><a href="#">افسانه جنگ</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="widget">
                                    <h5>صفحات</h5>
                                    <ul>
                                        <li><a href="#"> سرور بازی</a></li>
                                        <li><a href="#">پایگاه دانش</a></li>
                                        <li><a href="#">درباره ما</a></li>
                                        <li><a href="#">بازاریابی</a></li>
                                        <li><a href="#">مکان ها</a></li>
                                        <li><a href="#">اخبار</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="widget">
                            <h5>خبرنامه</h5>
                            <form action="blank.php" class="row form-dark" id="form_subscribe" method="post"
                                name="form_subscribe">
                                <div class="col text-center">
                                    <a href="#" id="btn-subscribe"><i
                                            class="arrow_left bg-color-secondary"></i></a>
                                    <input class="form-control" id="txt_subscribe" name="txt_subscribe"
                                        placeholder="ایمیل خود را وارد کنید" type="text">
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                            <div class="spacer-10"></div>
                            <small>ایمیل شما نزد ما محفوظ است. ما اسپم نمی کنیم.</small>
                            <div class="spacer-30"></div>
                            <div class="widget">
                                <h5>ما را دنبال کنید</h5>
                                <div class="social-icons">
                                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                    <a href="#"><i class="fa-brands fa-discord"></i></a>
                                    <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="subfooter">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            کپی رایت 2024 - طراحی شده توسط روشاک
                        </div>
                        <div class="col-lg-6 col-sm-6 text-lg-end text-sm-start">
                            <ul class="menu-simple">
                                <li><a href="#">شرایط &amp; قوانین</a></li>
                                <li><a href="#">سیاست حفظ حریم خصوصی</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer close -->
    </div>
    <!-- منوی پایین-->
    <div class="bottom-nav d-md-none rtl-bottom-nav">
        <a href="#" class="nav-item active">
            <i class="bi bi-house"></i><span>خانه</span>
        </a>
        <a href="#" class="nav-item">
            <i class="bi bi-search"></i><span>جستجو</span>
        </a>
        <a href="#" class="nav-item">
            <i class="bi bi-chat-dots"></i><span>پیام‌ها</span>
        </a>
        <a href="#" class="nav-item">
            <i class="bi bi-person"></i><span>پروفایل</span>
        </a>
    </div>


    <!-- Javascript Files
    ================================================== -->
    <script src="js/plugins.js"></script>
    <script src="js/designesia.js"></script>
    <script src="js/swiper.js"></script>
    <script src="js/custom-marquee.js"></script>
    <script src="js/custom-swiper-1.js"></script>

</body>

</html>
