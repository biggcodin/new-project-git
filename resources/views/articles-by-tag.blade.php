<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <title>مقالات مرتبط با تگ - {{ $pageTitle }}</title>
    <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/gif" sizes="16x16">
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="مقالات مرتبط با تگ: {{ $tag->name }}" name="description">
    <meta content="" name="keywords">
    <meta content="" name="author">
    <!-- CSS Files -->
    <link href="{{ asset('css/bootstrap.rtl.min.css') }}" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="{{ asset('css/plugins.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/swiper.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/coloring.css') }}" rel="stylesheet" type="text/css">
    <!-- color scheme -->
    <link id="colors" href="{{ asset('css/colors/scheme-01.css') }}" rel="stylesheet" type="text/css">
</head>

<body class="dark-scheme">
    <div id="wrapper">
        <!-- Header Begin -->
        <header class="transparent">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="de-flex sm-pt10">
                            <div class="de-flex-col">
                                <div id="logo">
                                    <a href="{{ url('/') }}">
                                        <img class="logo-main" src="{{ asset('images/logo.png') }}" alt="">
                                        <img class="logo-mobile" src="{{ asset('images/logo-mobile.png') }}"
                                            alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="de-flex-col header-col-mid">
                                <ul id="mainmenu" class="d-lg-flex">
                                    <li><a class="menu-item" href="{{ url('/') }}">خانه</a></li>
                                    <li><a class="menu-item" href="{{ route('news.index') }}">اخبار</a></li>
                                </ul>
                            </div>
                            <div class="de-flex-col">
                                <div class="menu_side_area">
                                    <a href="{{ route('articles.tag', $tag->slug) }}" class="btn-main btn-line">
                                        <span>مقالات مرتبط با تگ</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header Close -->

        <!-- Content Begin -->
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>

            <!-- Section Begin -->
            <section id="subheader" class="jarallax">
                <img src="{{ asset('images/background/subheader-news.png') }}" class="jarallax-img" alt="">
                <div class="container z-1000">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="subtitle wow fadeInUp mb-3">تگ: {{ $tag->name }}</div>
                        </div>
                        <div class="col-lg-6">
                            <h2 class="wow fadeInUp mb20" data-wow-delay=".2s">{{ $pageTitle }}</h2>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Section Close -->

            <!-- Section Articles Begin -->
            <section id="section-content" aria-label="section">
                <div class="container">
                    <div class="row g-4">
                        <!-- مقالات مرتبط با تگ -->
                        @foreach ($articles as $article)
                            <div class="col-lg-4 col-md-6 mb10">
                                <div class="bloglist item">
                                    <div class="post-content">
                                        <!-- تصویر مقاله -->
                                        <div class="post-image">
                                            <div class="d-tagline">
                                                @foreach ($article->tags as $tag)
                                                    <span><a
                                                            href="{{ route('articles.tag', $tag->slug) }}">{{ $tag->name }}</a></span>
                                                @endforeach
                                            </div>
                                            <img alt="{{ $article->title }}"
                                                src="{{ asset('storage/' . $article->image) }}" class="lazy">
                                        </div>
                                        <!-- متن و تاریخ مقاله -->
                                        <div class="post-text">
                                            <div class="d-date">{{ $article->persian_date }}</div>
                                            <h4>
                                                <a href="{{ route('news.single', $article->slug) }}">
                                                    {{ $article->title }}
                                                </a>
                                            </h4>
                                            <p>
                                                {{ Str::limit(strip_tags($article->content), 150, '...') }}
                                            </p>
                                        </div>
                                        <!-- دکمه "مطالب بیشتر" -->
                                        <a href="{{ route('news.single', $article->slug) }}" class="btn-main mt-3"
                                            data-hover="مطالب بیشتر">
                                            <span>مطالب بیشتر</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- صفحه‌بندی -->
                        <div class="pagination">
                            {{ $articles->links() }}
                        </div>
                    </div>
                </div>
            </section>
            <!-- Section Articles Close -->
        </div>
        <!-- Content Close -->

        <!-- Footer Begin -->
        <footer>
            <div class="container">
                <div class="row gx-5">
                    <div class="col-lg-4">
                        <img src="{{ asset('images/logo.png') }}" alt="">
                        <div class="spacer-20"></div>
                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است.
                        </p>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <div class="widget">
                                    <h5>سرور بازی</h5>
                                    <ul>
                                        <li><a href="#">تندر و شهر</a></li>
                                        <li><a href="#">مسابقه مرموز الف</a></li>
                                        <li><a href="#">خشم خاموش</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="widget">
                                    <h5>صفحات</h5>
                                    <ul>
                                        <li><a href="{{ route('news.index') }}">اخبار</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="widget">
                            <h5>خبرنامه</h5>
                            <form action="#" method="post" class="row form-dark" id="form_subscribe">
                                <div class="col text-center">
                                    <input class="form-control" placeholder="ایمیل خود را وارد کنید" type="text">
                                    <a href="#" id="btn-subscribe"><i
                                            class="arrow_left bg-color-secondary"></i></a>
                                </div>
                            </form>
                            <small>ایمیل شما نزد ما محفوظ است. ما اسپم نمی‌کنیم.</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="subfooter">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="de-flex">
                                <div class="de-flex-col">
                                    <a href="{{ url('/') }}">کپی رایت 2024 - طراحی شده توسط روشاک</a>
                                </div>
                                <ul class="menu-simple">
                                    <li><a href="#">شرایط &amp; قوانین</a></li>
                                    <li><a href="#">سیاست حفظ حریم خصوصی</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Close -->
    </div>
    <!-- Javascript Files -->
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/designesia.js') }}"></script>
</body>

</html>
